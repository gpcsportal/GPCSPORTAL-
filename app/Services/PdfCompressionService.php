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

        $token = bin2hex(random_bytes(8));
        $tempRoot = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);
        $backup = $tempRoot.DIRECTORY_SEPARATOR.'gpcs-pdf-backup-'.$token.'.pdf';
        $temporaryDirectory = $tempRoot.DIRECTORY_SEPARATOR.'gpcs-ilovepdf-'.$token;
        $replacement = $tempRoot.DIRECTORY_SEPARATOR.'gpcs-pdf-compressed-'.$token.'.pdf';
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

            $candidates = array_values(array_filter(
                glob($temporaryDirectory.'/*') ?: [],
                'is_file'
            ));

            if (count($candidates) !== 1 || ! @copy($candidates[0], $replacement)) {
                throw new RuntimeException('iLovePDF did not produce a usable single output PDF.');
            }

            $compressedSize = filesize($replacement) ?: 0;

            if ($compressedSize <= 0) {
                throw new RuntimeException('Compressed PDF is empty.');
            }

            if ($originalSize > 0 && $compressedSize >= $originalSize) {
                return false;
            }

            if (! @copy($replacement, $absolutePath)) {
                throw new RuntimeException('Unable to replace PDF safely.');
            }

            clearstatcache(true, $absolutePath);
            $writtenSize = filesize($absolutePath) ?: 0;

            if ($writtenSize !== $compressedSize) {
                throw new RuntimeException('Compressed PDF replacement was incomplete.');
            }

            return true;
        } catch (Throwable $exception) {
            if (is_file($backup)) {
                @copy($backup, $absolutePath);
            }

            report($exception);

            return false;
        } finally {
            @unlink($replacement);
            @unlink($backup);

            if (is_dir($temporaryDirectory)) {
                File::deleteDirectory($temporaryDirectory);
            }
        }
    }
}
