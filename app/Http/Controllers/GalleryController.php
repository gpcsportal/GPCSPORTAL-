<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Services\FileCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GalleryController extends Controller
{
    public function index()
    {
        return response()->json(
            GalleryImage::where('status', 'approved')
                ->latest()
                ->limit(100)
                ->get()
                ->map(fn (GalleryImage $image) => [
                    'id' => $image->id,
                    'category' => $image->category,
                    'caption' => $image->caption,
                    'image_url' => route('gallery.show', $image, false),
                ])
        );
    }

    public function store(Request $request, FileCompressionService $images)
    {
        $maxKilobytes = config('gpcs_uploads.gallery_max_mb', 20) * 1024;

        $validated = $request->validate([
            'image' => ['required', 'image', 'max:'.$maxKilobytes],
            'category' => ['required', 'string', 'max:100'],
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $file = $request->file('image');
        $path = null;

        try {
            $path = $file->store('gallery', 'public');
            $absolutePath = storage_path('app/public/'.$path);

            // Compression is fail-safe inside the image service; if a later
            // database operation fails, the stored file is still removed below.
            $images->compressImageInPlace($absolutePath);

            $image = GalleryImage::create([
                'user_id' => $request->user()->id,
                'category' => $validated['category'],
                'caption' => $validated['caption'] ?? null,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                'file_size' => filesize($absolutePath) ?: $file->getSize(),
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Image uploaded for Admin review.',
                'id' => $image->id,
            ], 201);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            report($exception);

            return response()->json([
                'message' => 'Image upload could not be completed. Please try again.',
            ], 500);
        }
    }

    public function show(GalleryImage $image)
    {
        abort_unless($image->status === 'approved', 404);
        abort_unless(Storage::disk('public')->exists($image->file_path), 404);

        return Storage::disk('public')->response($image->file_path);
    }
}
