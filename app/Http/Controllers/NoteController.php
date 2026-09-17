<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteUploadRequest;
use App\Models\Note;
use App\Services\FileCompressionService;
use App\Services\PdfCompressionService;
use App\Services\UploadMetadataService;
use App\Services\UploadStorageService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::where('status', 'approved')->latest();

        if ($search = trim((string) $request->query('q'))) {
            $query->where(fn ($item) => $item
                ->where('title', 'like', "%{$search}%")
                ->orWhere('subject_name', 'like', "%{$search}%")
                ->orWhere('subject_code', 'like', "%{$search}%"));
        }

        return response()->json(
            $query->limit(100)->get()->map(fn (Note $note) => [
                'id' => $note->id,
                'title' => $note->title ?: $note->subject_name,
                'subject_name' => $note->subject_name,
                'subject_code' => $note->subject_code,
                'branch' => $note->branch,
                'semester' => $note->semester,
                'year' => $note->year,
                'download_url' => $note->attachment_path
                    ? route('notes.download', $note, false)
                    : null,
            ])
        );
    }

    public function store(
        StoreNoteUploadRequest $request,
        UploadMetadataService $metadata,
        FileCompressionService $images,
        PdfCompressionService $pdf,
        UploadStorageService $storageCapacity
    ) {
        $data = $request->safe()->except('attachment');
        $data['semester'] = $metadata->normalizeSemester($data['semester']);

        $file = $request->file('attachment');

        if ($file && ! $file->isValid()) {
            return response()->json([
                'message' => 'The Notes attachment could not be read. Please choose the file again.',
            ], 422);
        }

        $fileHash = $file ? hash_file('sha256', $file->getRealPath()) : null;

        if ($fileHash && Note::where('file_hash', $fileHash)->exists()) {
            return response()->json([
                'message' => 'This exact Notes file has already been uploaded.',
            ], 422);
        }

        $fingerprint = $metadata->fingerprintNote($data, $fileHash ?: null);

        if (Note::where('fingerprint', $fingerprint)->exists()) {
            return response()->json([
                'message' => 'This exact Notes submission already exists.',
            ], 422);
        }

        if ($file && ! $storageCapacity->hasCapacityFor((int) $file->getSize())) {
            return response()->json([
                'message' => 'Upload storage is nearly full. Please contact the Admin before uploading this Notes file.',
            ], 507);
        }

        $path = null;

        try {
            $name = null;
            $mime = null;
            $size = 0;

            if ($file) {
                $storedPath = $file->store('notes', 'public');

                if (! is_string($storedPath) || $storedPath === '') {
                    return response()->json([
                        'message' => 'Notes file could not be saved to portal storage. Please try again later.',
                    ], 507);
                }

                $path = $storedPath;
                $disk = Storage::disk('public');

                if (! $disk->exists($path)) {
                    throw new RuntimeException('Stored Notes file is missing from the public disk.');
                }

                $absolutePath = $disk->path($path);

                if (! is_file($absolutePath)) {
                    throw new RuntimeException('Stored Notes path is not a readable file.');
                }

                $name = $file->getClientOriginalName();
                $mime = $file->getMimeType() ?: 'application/octet-stream';

                if ($mime === 'application/pdf') {
                    $pdf->compressInPlace($absolutePath);
                } elseif (str_starts_with($mime, 'image/')) {
                    $images->compressImageInPlace($absolutePath);
                }

                clearstatcache(true, $absolutePath);
                $finalSize = filesize($absolutePath);

                if ($finalSize === false || $finalSize <= 0) {
                    throw new RuntimeException('Stored Notes file is empty after processing.');
                }

                $size = $finalSize;
            }

            $note = Note::create(array_merge($data, [
                'user_id' => $request->user()->id,
                'attachment_path' => $path,
                'original_name' => $name,
                'mime_type' => $mime,
                'file_size' => $size,
                'file_hash' => $fileHash,
                'fingerprint' => $fingerprint,
                'status' => 'pending',
            ]));

            return response()->json([
                'message' => 'Notes submitted for Admin approval.',
                'id' => $note->id,
            ], 201);
        } catch (QueryException $exception) {
            $this->deleteStoredFile($path);

            if ($this->isUniqueConstraintViolation($exception)) {
                return response()->json([
                    'message' => 'This Notes submission was already uploaded. Duplicate upload was blocked.',
                ], 422);
            }

            report($exception);

            return response()->json([
                'message' => 'Notes upload could not be completed. Please try again.',
            ], 500);
        } catch (Throwable $exception) {
            $this->deleteStoredFile($path);
            report($exception);

            return response()->json([
                'message' => 'Notes upload could not be completed. Please try again.',
            ], 500);
        }
    }

    public function download(Note $note)
    {
        abort_unless($note->status === 'approved' && $note->attachment_path, 404);
        abort_unless(Storage::disk('public')->exists($note->attachment_path), 404);

        return Storage::disk('public')->download(
            $note->attachment_path,
            $note->original_name ?: 'notes-file'
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
