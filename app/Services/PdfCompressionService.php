<?php
namespace App\Services;

use Ilovepdf\Ilovepdf;
use Illuminate\Support\Facades\File;
use RuntimeException;
use Throwable;

class PdfCompressionService
{
    public function compressInPlace(string $absolutePath): bool
    {
        $publicKey = (string) config('services.ilovepdf.public_key');
        $secretKey = (string) config('services.ilovepdf.secret_key');

        if ($publicKey === '' || $secretKey === '' || ! is_file($absolutePath)) {
            return false;
        }

        $backup = $absolutePath.'.gpcs-backup';
        $temporaryDirectory = dirname($absolutePath).'/.ilovepdf-'.bin2hex(random_bytes(6));
        $replacement = $absolutePath.'.gpcs-compressed';
        $originalSize = filesize($absolutePath) ?: 0;

        if (! @copy($absolutePath, $backup)) {
            return false;
        }

        try {
            File::ensureDirectoryExists($temporaryDirectory);
            $api = new Ilovepdf($publicKey, $secretKey);
            $task = $api->newTask('compress');
            if (method_exists($task, 'setCompressionLevel')) {
                $task->setCompressionLevel((string) config('services.ilovepdf.compression_level', 'recommended'));
            }
            $task->addFile($absolutePath);
            $task->execute();
            $task->download($temporaryDirectory);

            $candidates = array_values(array_filter(glob($temporaryDirectory.'/*') ?: [], 'is_file'));
            if (count($candidates) !== 1 || ! @copy($candidates[0], $replacement)) {
                throw new RuntimeException('iLovePDF did not produce a usable single output PDF.');
            }

            $compressedSize = filesize($replacement) ?: 0;
            if ($compressedSize <= 0) {
                throw new RuntimeException('Compressed PDF is empty.');
            }
            if ($originalSize > 0 && $compressedSize >= $originalSize) {
                @unlink($replacement);
                @unlink($backup);
                return false;
            }

            if (! @rename($replacement, $absolutePath)) {
                throw new RuntimeException('Unable to replace PDF atomically.');
            }

            @unlink($backup);
            return true;
        } catch (Throwable $exception) {
            @unlink($replacement);
            if (is_file($backup)) {
                @copy($backup, $absolutePath);
                @unlink($backup);
            }
            report($exception);
            return false;
        } finally {
            if (is_dir($temporaryDirectory)) {
                File::deleteDirectory($temporaryDirectory);
            }
        }
    }
}
