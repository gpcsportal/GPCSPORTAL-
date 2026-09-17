<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaperUploadRequest;
use App\Models\Paper;
use App\Services\FileCompressionService;
use App\Services\PdfCompressionService;
use App\Services\UploadMetadataService;
use App\Services\UploadStorageService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class PaperController extends Controller
{
    public function index(Request $request)
    {
        $query = Paper::where('status', 'approved')->latest();

        if ($search = trim((string) $request->query('q'))) {
            $query->where(fn ($item) => $item
                ->where('paper_name', 'like', "%{$search}%")
                ->orWhere('subject_name', 'like', "%{$search}%")
                ->orWhere('paper_code', 'like', "%{$search}%")
                ->orWhere('subject_code', 'like', "%{$search}%"));
        }

        return response()->json(
            $query->limit(100)->get()->map(fn (Paper $paper) => [
                'id' => $paper->id,
                'paper_code' => $paper->paper_code,
                'paper_name' => $paper->paper_name ?: $paper->original_name,
                'year' => $paper->year,
                'session' => $paper->session,
                'branch' => $paper->branch,
                'semester' => $paper->semester,
                'download_url' => route('papers.download', $paper, false),
            ])
        );
    }

    public function store(
        StorePaperUploadRequest $request,
        UploadMetadataService $metadata,
        FileCompressionService $images,
        PdfCompressionService $pdf,
        UploadStorageService $storageCapacity
    ) {
        $data = $metadata->enrichPaper($request->safe()->except('file'));
        $fingerprint = $metadata->fingerprintPaper($data);

        if ($fingerprint && Paper::where('fingerprint', $fingerprint)->exists()) {
            return response()->json([
                'message' => 'This exact paper record already exists.',
            ], 422);
        }

        $file = $request->file('file');

        if (! $file || ! $file->isValid()) {
            return response()->json([
                'message' => 'The Paper file could not be read. Please choose the file again.',
            ], 422);
        }

        $fileHash = hash_file('sha256', $file->getRealPath());

        if ($fileHash && Paper::where('file_hash', $fileHash)->exists()) {
            return response()->json([
                'message' => 'This exact paper file has already been uploaded.',
            ], 422);
        }

        if (! $storageCapacity->hasCapacityFor((int) $file->getSize())) {
            return response()->json([
                'message' => 'Upload storage is nearly full. Please contact the Admin before uploading this Paper.',
            ], 507);
        }

        $path = null;

        try {
            $storedPath = $file->store('papers', 'public');

            if (! is_string($storedPath) || $storedPath === '') {
                return response()->json([
                    'message' => 'Paper file could not be saved to portal storage. Please try again later.',
                ], 507);
            }

            $path = $storedPath;
            $disk = Storage::disk('public');

            if (! $disk->exists($path)) {
                throw new RuntimeException('Stored Paper file is missing from the public disk.');
            }

            $absolutePath = $disk->path($path);

            if (! is_file($absolutePath)) {
                throw new RuntimeException('Stored Paper path is not a readable file.');
            }

            $mime = $file->getMimeType() ?: 'application/octet-stream';

            if ($mime === 'application/pdf') {
                $pdf->compressInPlace($absolutePath);
            } elseif (str_starts_with($mime, 'image/')) {
                $images->compressImageInPlace($absolutePath);
            }

            clearstatcache(true, $absolutePath);
            $finalSize = filesize($absolutePath);

            if ($finalSize === false || $finalSize <= 0) {
                throw new RuntimeException('Stored Paper file is empty after processing.');
            }

            $paper = Paper::create(array_merge($data, [
                'user_id' => $request->user()->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $mime,
                'file_size' => $finalSize,
                'file_hash' => $fileHash ?: null,
                'fingerprint' => $fingerprint,
                'status' => 'pending',
            ]));

            return response()->json([
                'message' => 'Paper uploaded and sent for Admin review.',
                'id' => $paper->id,
            ], 201);
        } catch (QueryException $exception) {
            $this->deleteStoredFile($path);

            if ($this->isUniqueConstraintViolation($exception)) {
                return response()->json([
                    'message' => 'This Paper was already uploaded. Duplicate upload was blocked.',
                ], 422);
            }

            report($exception);

            return response()->json([
                'message' => 'Paper upload could not be completed. Please try again.',
            ], 500);
        } catch (Throwable $exception) {
            $this->deleteStoredFile($path);
            report($exception);

            return response()->json([
                'message' => 'Paper upload could not be completed. Please try again.',
            ], 500);
        }
    }

    public function download(Paper $paper)
    {
        abort_unless($paper->status === 'approved', 404);
        abort_unless(Storage::disk('public')->exists($paper->file_path), 404);

        return Storage::disk('public')->download(
            $paper->file_path,
            $paper->original_name
        );
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function isUniqueConstraintViolation(QueryException $exception): bool
    {
        $message = strtolower($exception->getMessage());

        return in_array((string) $exception->getCode(), ['23000', '23505'], true)
            && (str_contains($message, 'duplicate') || str_contains($message, 'unique'));
    }
}
