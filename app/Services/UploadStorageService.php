<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
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
            $freeBytes = @disk_free_space($root);
        } catch (Throwable) {
            // Capacity probes are advisory. The actual storage write is still
            // verified by the upload controller and will fail safely if needed.
            return true;
        }

        if ($freeBytes === false) {
            return true;
        }

        $reserveBytes = max(
            $reserveMb * 1024 * 1024,
            (int) ceil($bytes * 0.10)
        );

        return $freeBytes >= ($bytes + $reserveBytes);
    }
}
