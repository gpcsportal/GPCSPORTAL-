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

        $token = bin2hex(random_bytes(8));
        $extension = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));
        $tempRoot = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);
        $backup = $tempRoot.DIRECTORY_SEPARATOR.'gpcs-img-backup-'.$token;
        $temporary = $tempRoot.DIRECTORY_SEPARATOR.'gpcs-img-compressed-'.$token.'.'.$extension;
        $originalSize = filesize($absolutePath) ?: 0;

        if (! @copy($absolutePath, $backup)) {
            return false;
        }

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($absolutePath)->scaleDown(width: 1920, height: 1920);
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
                return false;
            }

            // Keep only one copy on the persistent upload volume. The backup and
            // compressed candidate live in Railway's ephemeral /tmp workspace.
            if (! @copy($temporary, $absolutePath)) {
                throw new RuntimeException('Unable to replace image safely.');
            }

            return true;
        } catch (Throwable $exception) {
            if (is_file($backup)) {
                @copy($backup, $absolutePath);
            }
            report($exception);
            return false;
        } finally {
            @unlink($temporary);
            @unlink($backup);
        }
    }
}
