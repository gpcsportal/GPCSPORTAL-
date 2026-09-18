<?php

namespace App\Services;

use FilesystemIterator;
use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Throwable;

class UploadStorageService
{
    public function hasCapacityFor(int $bytes, int $reserveMb = 32): bool
    {
        if ($bytes <= 0) {
            return true;
        }

        try {
            $root = Storage::disk('public')->path('');
        } catch (Throwable) {
            // The actual write remains verified by the upload controller.
            return true;
        }

        $effectiveFreeBytes = null;

        $filesystemFree = @disk_free_space($root);
        if (is_int($filesystemFree) || is_float($filesystemFree)) {
            $effectiveFreeBytes = max(0, (int) $filesystemFree);
        }

        $configuredCapacityMb = max(
            0,
            (int) config('gpcs_uploads.volume_capacity_mb', 0)
        );

        if ($configuredCapacityMb > 0) {
            $usedBytes = $this->directorySize($root);

            if ($usedBytes !== null) {
                $configuredCapacityBytes = $configuredCapacityMb * 1024 * 1024;
                $configuredFreeBytes = max(0, $configuredCapacityBytes - $usedBytes);

                $effectiveFreeBytes = $effectiveFreeBytes === null
                    ? $configuredFreeBytes
                    : min($effectiveFreeBytes, $configuredFreeBytes);
            }
        }

        // If both probes are unavailable, fail open here and let the verified
        // filesystem write fail safely in the controller instead of blocking
        // uploads because of an unreliable capacity probe.
        if ($effectiveFreeBytes === null) {
            return true;
        }

        $reserveBytes = max(
            max(0, $reserveMb) * 1024 * 1024,
            (int) ceil($bytes * 0.10)
        );

        return $effectiveFreeBytes >= ($bytes + $reserveBytes);
    }

    private function directorySize(string $root): ?int
    {
        if (! is_dir($root)) {
            return null;
        }

        try {
            $bytes = 0;
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(
                    $root,
                    FilesystemIterator::SKIP_DOTS
                ),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            /** @var SplFileInfo $file */
            foreach ($iterator as $file) {
                if (! $file->isFile() || $file->isLink()) {
                    continue;
                }

                $size = $file->getSize();
                if ($size > 0) {
                    $bytes += $size;
                }
            }

            return $bytes;
        } catch (Throwable) {
            return null;
        }
    }
}
