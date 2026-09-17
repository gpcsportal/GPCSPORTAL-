<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteUploadRequest;
use App\Models\Note;
use App\Services\FileCompressionService;
use App\Services\PdfCompressionService;
use App\Services\UploadMetadataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        PdfCompressionService $pdf
    ) {
        $data = $request->safe()->except('attachment');
        $data['semester'] = $metadata->normalizeSemester($data['semester']);
        $fingerprint = $metadata->fingerprintNote($data);

        if (Note::where('fingerprint', $fingerprint)->exists()) {
            return response()->json([
                'message' => 'This exact Notes academic record already exists.',
            ], 422);
        }

        $file = $request->file('attachment');
        $fileHash = $file ? hash_file('sha256', $file->getRealPath()) : null;

        if ($fileHash && Note::where('file_hash', $fileHash)->exists()) {
            return response()->json([
                'message' => 'This exact Notes file has already been uploaded.',
            ], 422);
        }

        $path = null;

        try {
            $name = null;
            $mime = null;
            $size = 0;

            if ($file) {
                $path = $file->store('notes', 'public');
                $name = $file->getClientOriginalName();
                $mime = $file->getMimeType() ?: 'application/octet-stream';
                $absolutePath = storage_path('app/public/'.$path);

                if ($mime === 'application/pdf') {
                    $pdf->compressInPlace($absolutePath);
                } elseif (str_starts_with($mime, 'image/')) {
                    $images->compressImageInPlace($absolutePath);
                }

                $size = filesize($absolutePath) ?: $file->getSize();
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
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

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
}
