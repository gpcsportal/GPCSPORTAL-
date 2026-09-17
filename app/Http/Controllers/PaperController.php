<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaperUploadRequest;
use App\Models\Paper;
use App\Services\FileCompressionService;
use App\Services\PdfCompressionService;
use App\Services\UploadMetadataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        PdfCompressionService $pdf
    ) {
        $data = $metadata->enrichPaper($request->safe()->except('file'));
        $fingerprint = $metadata->fingerprintPaper($data);

        if ($fingerprint && Paper::where('fingerprint', $fingerprint)->exists()) {
            return response()->json([
                'message' => 'This exact paper record already exists.',
            ], 422);
        }

        $file = $request->file('file');
        $path = $file->store('papers', 'public');
        $absolutePath = storage_path('app/public/'.$path);
        $mime = $file->getMimeType() ?: 'application/octet-stream';

        if ($mime === 'application/pdf') {
            $pdf->compressInPlace($absolutePath);
        } elseif (str_starts_with($mime, 'image/')) {
            $images->compressImageInPlace($absolutePath);
        }

        $paper = Paper::create(array_merge($data, [
            'user_id' => $request->user()->id,
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $mime,
            'file_size' => filesize($absolutePath) ?: $file->getSize(),
            'fingerprint' => $fingerprint,
            'status' => 'pending',
        ]));

        return response()->json([
            'message' => 'Paper uploaded and sent for Admin review.',
            'id' => $paper->id,
        ], 201);
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
}
