<?php
namespace App\Services;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use RuntimeException;
use Throwable;

class FileCompressionService
{
    public function compressImageInPlace(string $absolutePath): bool
    {
        if (! is_file($absolutePath)) {
            return false;
        }

        $backup = $absolutePath.'.gpcs-backup';
        $temporary = $absolutePath.'.gpcs-compressed';
        $originalSize = filesize($absolutePath) ?: 0;

        if (! @copy($absolutePath, $backup)) {
            return false;
        }

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($absolutePath)->scaleDown(width: 1920, height: 1920);
            $extension = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));
            $encoded = match ($extension) {
                'jpg', 'jpeg' => $image->toJpeg(82),
                'png' => $image->toPng(),
                'webp' => $image->toWebp(82),
                default => throw new RuntimeException('Unsupported image type.'),
            };

            $bytes = file_put_contents($temporary, (string) $encoded, LOCK_EX);
            if ($bytes === false || $bytes <= 0 || ! is_file($temporary)) {
                throw new RuntimeException('Unable to write compressed image.');
            }

            $compressedSize = filesize($temporary) ?: 0;
            if ($originalSize > 0 && $compressedSize >= $originalSize) {
                @unlink($temporary);
                @unlink($backup);
                return false;
            }

            if (! @rename($temporary, $absolutePath)) {
                throw new RuntimeException('Unable to replace image atomically.');
            }

            @unlink($backup);
            return true;
        } catch (Throwable $exception) {
            @unlink($temporary);
            if (is_file($backup)) {
                @copy($backup, $absolutePath);
                @unlink($backup);
            }
            report($exception);
            return false;
        }
    }
}
