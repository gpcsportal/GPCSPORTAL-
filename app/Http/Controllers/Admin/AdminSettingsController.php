<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
use App\Models\User;
use App\Services\AdminActivityService;
use App\Services\PortalSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class AdminSettingsController extends Controller
{
    public function edit(PortalSettingsService $settings)
    {
        return view('admin.settings.edit', [
            'paperMaxMb' => $settings->paperMaxMb(),
            'notesMaxMb' => $settings->notesMaxMb(),
            'galleryMaxMb' => $settings->galleryMaxMb(),
            'branches' => $settings->branches(),
            'loginWallEnabled' => $settings->loginWallEnabled(),
            'officialLinks' => $settings->officialLinks(),
        ]);
    }

    public function update(
        Request $request,
        PortalSettingsService $settings,
        AdminActivityService $log
    ) {
        $validated = $request->validate([
            'paper_max_mb' => ['required', 'integer', 'between:1,100'],
            'notes_max_mb' => ['required', 'integer', 'between:1,200'],
            'gallery_max_mb' => ['required', 'integer', 'between:1,20'],
            'branches' => ['required', 'string', 'max:255'],
            'login_wall_enabled' => ['required', 'boolean'],
            'student_url' => ['required', 'url:https', 'max:500'],
            'syllabus_url' => ['required', 'url:https', 'max:500'],
            'previous_url' => ['required', 'url:https', 'max:500'],
            'main_result_url' => ['required', 'url:https', 'max:500'],
            'all_result_url' => ['required', 'url:https', 'max:500'],
        ]);

        $branches = collect(preg_split('/[\s,]+/', strtoupper($validated['branches'])) ?: [])
            ->map(fn ($value) => trim((string) $value))
            ->filter()
            ->unique()
            ->values();

        if ($branches->isEmpty() || $branches->count() > 12) {
            throw ValidationException::withMessages([
                'branches' => 'Provide between 1 and 12 branch codes.',
            ]);
        }

        foreach ($branches as $branch) {
            if (preg_match('/^[A-Z0-9-]{2,10}$/', $branch) !== 1) {
                throw ValidationException::withMessages([
                    'branches' => 'Branch codes may contain only A-Z, 0-9 and hyphen, with 2 to 10 characters.',
                ]);
            }
        }

        $removed = array_values(array_diff($settings->branches(), $branches->all()));
        if ($removed !== []) {
            $inUse = User::whereIn('branch', $removed)->exists()
                || Paper::whereIn('branch', $removed)->exists()
                || Note::whereIn('branch', $removed)->exists()
                || SubjectMaster::whereIn('branch', $removed)->exists();

            if ($inUse) {
                throw ValidationException::withMessages([
                    'branches' => 'A branch that is already used by users, subjects or uploads cannot be removed. Keep it active or migrate that data first.',
                ]);
            }
        }

        $links = [
            'student' => $validated['student_url'],
            'syllabus' => $validated['syllabus_url'],
            'previous' => $validated['previous_url'],
            'main-result' => $validated['main_result_url'],
            'all-result' => $validated['all_result_url'],
        ];

        foreach ($links as $key => $url) {
            $host = strtolower((string) parse_url($url, PHP_URL_HOST));
            $allowed = match ($key) {
                'student', 'syllabus' => in_array($host, ['rgpvdiploma.in', 'www.rgpvdiploma.in'], true),
                'previous' => in_array($host, ['polygwalior.ac.in', 'www.polygwalior.ac.in'], true),
                'main-result', 'all-result' => $host === 'result.rgpv.ac.in',
                default => false,
            };

            if (! $allowed) {
                throw ValidationException::withMessages([
                    $this->linkField($key) => 'Use the official RGPV / Polytechnic academic domain for this link.',
                ]);
            }
        }

        $settings->setMany([
            'paper_max_mb' => (int) $validated['paper_max_mb'],
            'notes_max_mb' => (int) $validated['notes_max_mb'],
            'gallery_max_mb' => (int) $validated['gallery_max_mb'],
            'branches' => $branches->all(),
            'login_wall_enabled' => (bool) $validated['login_wall_enabled'],
            'official_student_url' => $links['student'],
            'official_syllabus_url' => $links['syllabus'],
            'official_previous_url' => $links['previous'],
            'official_main-result_url' => $links['main-result'],
            'official_all-result_url' => $links['all-result'],
        ]);

        Cache::forget('portal.home.counts');
        $log->log('portal_settings_updated', 'portal_settings', null, [
            'paper_max_mb' => (int) $validated['paper_max_mb'],
            'notes_max_mb' => (int) $validated['notes_max_mb'],
            'gallery_max_mb' => (int) $validated['gallery_max_mb'],
            'branches' => $branches->all(),
            'login_wall_enabled' => (bool) $validated['login_wall_enabled'],
        ]);

        return back()->with('status', 'Portal settings updated and applied immediately.');
    }

    private function linkField(string $key): string
    {
        return match ($key) {
            'student' => 'student_url',
            'syllabus' => 'syllabus_url',
            'previous' => 'previous_url',
            'main-result' => 'main_result_url',
            'all-result' => 'all_result_url',
        };
    }
}
