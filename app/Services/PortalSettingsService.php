<?php

namespace App\Services;

use App\Models\PortalSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

class PortalSettingsService
{
    private const CACHE_KEY = 'portal.runtime.settings';

    public function paperMaxMb(): int
    {
        return $this->boundedInt('paper_max_mb', (int) config('gpcs_uploads.paper_max_mb', 100), 1, 100);
    }

    public function notesMaxMb(): int
    {
        return $this->boundedInt('notes_max_mb', (int) config('gpcs_uploads.notes_max_mb', 200), 1, 200);
    }

    public function galleryMaxMb(): int
    {
        return $this->boundedInt('gallery_max_mb', (int) config('gpcs_uploads.gallery_max_mb', 20), 1, 20);
    }

    public function branches(): array
    {
        $fallback = array_values(array_unique(array_map(
            static fn ($value): string => strtoupper(trim((string) $value)),
            (array) config('gpcs_portal.default_branches', ['CS', 'ME', 'EE', 'ET'])
        )));

        $raw = $this->value('branches');
        if (! is_string($raw) || trim($raw) === '') {
            return $fallback;
        }

        $decoded = json_decode($raw, true);
        if (! is_array($decoded)) {
            return $fallback;
        }

        $branches = array_values(array_unique(array_filter(array_map(
            static fn ($value): string => strtoupper(trim((string) $value)),
            $decoded
        ), static fn (string $value): bool => preg_match('/^[A-Z0-9-]{2,10}$/', $value) === 1)));

        return $branches ?: $fallback;
    }

    public function loginWallEnabled(): bool
    {
        $raw = $this->value('login_wall_enabled');

        if ($raw === null) {
            return (bool) config('gpcs_portal.login_wall_enabled', true);
        }

        return filter_var($raw, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            ?? (bool) config('gpcs_portal.login_wall_enabled', true);
    }

    public function officialLinks(): array
    {
        $defaults = (array) config('gpcs_portal.official_links', []);
        $stored = $this->stored();

        foreach (array_keys($defaults) as $key) {
            $value = $stored['official_'.$key.'_url'] ?? null;
            if (is_string($value) && $value !== '') {
                $defaults[$key] = $value;
            }
        }

        return $defaults;
    }

    public function setMany(array $settings): void
    {
        DB::transaction(function () use ($settings): void {
            foreach ($settings as $key => $value) {
                PortalSetting::updateOrCreate(
                    ['key' => (string) $key],
                    ['value' => is_array($value) ? json_encode(array_values($value), JSON_THROW_ON_ERROR) : (string) $value]
                );
            }
        });

        $this->forget();
    }

    public function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function value(string $key): ?string
    {
        $stored = $this->stored();

        return array_key_exists($key, $stored)
            ? (string) $stored[$key]
            : null;
    }

    private function stored(): array
    {
        try {
            if (! Schema::hasTable('portal_settings')) {
                return [];
            }

            return Cache::remember(self::CACHE_KEY, now()->addMinutes(10), static fn (): array =>
                PortalSetting::query()->pluck('value', 'key')->all()
            );
        } catch (Throwable) {
            return [];
        }
    }

    private function boundedInt(string $key, int $fallback, int $min, int $max): int
    {
        $raw = $this->value($key);
        $value = is_numeric($raw) ? (int) $raw : $fallback;

        return max($min, min($max, $value));
    }
}
