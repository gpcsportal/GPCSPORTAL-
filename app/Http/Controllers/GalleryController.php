<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Services\FileCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
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
        $disk = Storage::disk('public');

        if (! $file || ! $file->isValid()) {
            return response()->json([
                'message' => 'The selected image could not be read. Please choose it again.',
            ], 422);
        }

        try {
            $storedPath = $file->store('gallery', 'public');
            if (! is_string($storedPath) || $storedPath === '') {
                throw new RuntimeException('Gallery image storage returned an empty path.');
            }

            $path = $storedPath;
            if (! $disk->exists($path)) {
                throw new RuntimeException('Stored gallery image is not available on disk.');
            }

            $absolutePath = $disk->path($path);
            if (! is_file($absolutePath) || ! is_readable($absolutePath)) {
                throw new RuntimeException('Stored gallery image is not readable.');
            }

            // Compression is fail-safe inside the image service; if a later
            // database operation fails, the stored file is still removed below.
            $images->compressImageInPlace($absolutePath);

            clearstatcache(true, $absolutePath);
            $finalSize = filesize($absolutePath);
            if ($finalSize === false || $finalSize <= 0) {
                throw new RuntimeException('Stored gallery image is empty after processing.');
            }

            $image = GalleryImage::create([
                'user_id' => $request->user()->id,
                'category' => $validated['category'],
                'caption' => $validated['caption'] ?? null,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                'file_size' => $finalSize,
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Image uploaded for Admin review.',
                'id' => $image->id,
            ], 201);
        } catch (Throwable $exception) {
            if ($path) {
                $disk->delete($path);
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
