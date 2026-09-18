<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Services\AdminActivityService;
use App\Services\FileCompressionService;
use App\Services\PdfCompressionService;
use App\Services\PortalSettingsService;
use App\Services\UploadMetadataService;
use App\Services\UploadStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Throwable;

class AdminContentController extends Controller
{
    private function model(string $type): string
    {
        return match ($type) {
            'papers' => Paper::class,
            'notes' => Note::class,
            'gallery' => GalleryImage::class,
            'messages' => ContactMessage::class,
            default => abort(404),
        };
    }

    public function index(string $type)
    {
        $model = $this->model($type);

        return view('admin.content.index', [
            'type' => $type,
            'items' => $model::latest()->paginate(30),
        ]);
    }

    public function create(string $type, PortalSettingsService $settings)
    {
        abort_unless(in_array($type, ['papers', 'notes', 'gallery'], true), 404);

        $model = $this->model($type);

        return view('admin.content.form', [
            'type' => $type,
            'item' => new $model(),
            'branches' => $settings->branches(),
            'paperMaxMb' => $settings->paperMaxMb(),
            'notesMaxMb' => $settings->notesMaxMb(),
            'galleryMaxMb' => $settings->galleryMaxMb(),
        ]);
    }

    public function store(
        Request $request,
        string $type,
        PortalSettingsService $settings,
        UploadMetadataService $metadata,
        FileCompressionService $images,
        PdfCompressionService $pdf,
        UploadStorageService $storageCapacity,
        AdminActivityService $log
    ) {
        $item = match ($type) {
            'papers' => $this->storePaper($request, $settings, $metadata, $images, $pdf, $storageCapacity),
            'notes' => $this->storeNote($request, $settings, $metadata, $images, $pdf, $storageCapacity),
            'gallery' => $this->storeGallery($request, $settings, $images, $storageCapacity),
            default => abort(404),
        };

        $log->log('content_created', $type, $item->id, [
            'status' => $item->status,
        ]);

        return redirect()->route('admin.content.index', $type)
            ->with('status', ucfirst($type).' content created.');
    }

    public function edit(string $type, int $id, PortalSettingsService $settings)
    {
        abort_unless(in_array($type, ['papers', 'notes', 'gallery'], true), 404);
        $model = $this->model($type);

        return view('admin.content.form', [
            'type' => $type,
            'item' => $model::findOrFail($id),
            'branches' => $settings->branches(),
            'paperMaxMb' => $settings->paperMaxMb(),
            'notesMaxMb' => $settings->notesMaxMb(),
            'galleryMaxMb' => $settings->galleryMaxMb(),
        ]);
    }

    public function update(
        Request $request,
        string $type,
        int $id,
        PortalSettingsService $settings,
        UploadMetadataService $metadata,
        AdminActivityService $log
    ) {
        abort_unless(in_array($type, ['papers', 'notes', 'gallery'], true), 404);
        $model = $this->model($type);
        $item = $model::findOrFail($id);

        if ($type === 'papers') {
            $validated = $request->validate([
                'paper_code' => ['nullable', 'string', 'max:30'],
                'subject_code' => ['nullable', 'string', 'max:30'],
                'paper_name' => ['nullable', 'string', 'max:255'],
                'subject_name' => ['nullable', 'string', 'max:255'],
                'branch' => ['nullable', Rule::in($settings->branches())],
                'semester' => ['nullable', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
                'year' => ['nullable', 'integer', 'between:2000,2100'],
                'session' => ['nullable', 'string', 'max:30'],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
                'rejection_reason' => ['nullable', 'string', 'max:2000'],
            ]);

            $status = $validated['status'];
            $reason = $validated['rejection_reason'] ?? null;
            unset($validated['status'], $validated['rejection_reason']);
            $data = $metadata->enrichPaper($validated);
            $fingerprint = $metadata->fingerprintPaper($data);

            if ($fingerprint && Paper::where('fingerprint', $fingerprint)->whereKeyNot($item->id)->exists()) {
                throw ValidationException::withMessages(['paper_code' => 'This exact Paper metadata already exists.']);
            }

            $item->update($data + [
                'fingerprint' => $fingerprint,
                'status' => $status,
                'rejection_reason' => $reason,
            ]);
        } elseif ($type === 'notes') {
            $validated = $request->validate([
                'branch' => ['required', Rule::in($settings->branches())],
                'semester' => ['required', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
                'year' => ['required', 'integer', 'between:2000,2100'],
                'subject_name' => ['required', 'string', 'max:255'],
                'subject_code' => ['required', 'string', 'max:30'],
                'title' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:5000'],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
                'rejection_reason' => ['nullable', 'string', 'max:2000'],
            ]);

            $validated['semester'] = $metadata->normalizeSemester($validated['semester']);
            $status = $validated['status'];
            $reason = $validated['rejection_reason'] ?? null;
            unset($validated['status'], $validated['rejection_reason']);
            $fingerprint = $metadata->fingerprintNote($validated, $item->file_hash);

            if (Note::where('fingerprint', $fingerprint)->whereKeyNot($item->id)->exists()) {
                throw ValidationException::withMessages(['subject_code' => 'This exact Notes metadata already exists.']);
            }

            $item->update($validated + [
                'fingerprint' => $fingerprint,
                'status' => $status,
                'rejection_reason' => $reason,
            ]);
        } else {
            $validated = $request->validate([
                'category' => ['required', 'string', 'max:100'],
                'caption' => ['nullable', 'string', 'max:255'],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
                'rejection_reason' => ['nullable', 'string', 'max:2000'],
            ]);

            $item->update($validated);
        }

        $log->log('content_updated', $type, $id, [
            'status' => $item->fresh()->status,
        ]);

        return redirect()->route('admin.content.index', $type)
            ->with('status', 'Content updated.');
    }

    public function status(
        Request $request,
        string $type,
        int $id,
        AdminActivityService $log
    ) {
        abort_unless(in_array($type, ['papers', 'notes', 'gallery'], true), 404);

        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
            'rejection_reason' => ['nullable', 'string', 'max:2000'],
        ]);

        $model = $this->model($type);
        $item = $model::findOrFail($id);

        $item->update([
            'status' => $validated['status'],
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);

        $log->log('content_status_changed', $type, $id, [
            'status' => $validated['status'],
        ]);

        return back()->with('status', 'Content status updated.');
    }

    public function destroy(
        string $type,
        int $id,
        AdminActivityService $log
    ) {
        $model = $this->model($type);
        $item = $model::findOrFail($id);

        foreach (['file_path', 'attachment_path'] as $field) {
            if (! empty($item->{$field})) {
                Storage::disk('public')->delete($item->{$field});
            }
        }

        $item->delete();
        $log->log('content_deleted', $type, $id);

        return back()->with('status', 'Content deleted.');
    }

    private function storePaper(
        Request $request,
        PortalSettingsService $settings,
        UploadMetadataService $metadata,
        FileCompressionService $images,
        PdfCompressionService $pdf,
        UploadStorageService $storageCapacity
    ): Paper {
        $validated = $request->validate([
            'file' => ['required', 'file', 'max:'.($settings->paperMaxMb() * 1024), 'mimes:pdf,jpg,jpeg,png,doc,docx', 'extensions:pdf,jpg,jpeg,png,doc,docx'],
            'paper_code' => ['nullable', 'string', 'max:30'],
            'subject_code' => ['nullable', 'string', 'max:30'],
            'paper_name' => ['nullable', 'string', 'max:255'],
            'subject_name' => ['nullable', 'string', 'max:255'],
            'branch' => ['nullable', Rule::in($settings->branches())],
            'semester' => ['nullable', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
            'year' => ['nullable', 'integer', 'between:2000,2100'],
            'session' => ['nullable', 'string', 'max:30'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'rejection_reason' => ['nullable', 'string', 'max:2000'],
        ]);

        $file = $request->file('file');
        if (! $file || ! $file->isValid()) {
            throw ValidationException::withMessages(['file' => 'Choose a valid Paper file.']);
        }

        $hash = hash_file('sha256', $file->getRealPath());
        if ($hash && Paper::where('file_hash', $hash)->exists()) {
            throw ValidationException::withMessages(['file' => 'This exact Paper file already exists.']);
        }

        $status = $validated['status'];
        $reason = $validated['rejection_reason'] ?? null;
        unset($validated['file'], $validated['status'], $validated['rejection_reason']);
        $data = $metadata->enrichPaper($validated);
        $fingerprint = $metadata->fingerprintPaper($data);

        if ($fingerprint && Paper::where('fingerprint', $fingerprint)->exists()) {
            throw ValidationException::withMessages(['paper_code' => 'This exact Paper metadata already exists.']);
        }

        if (! $storageCapacity->hasCapacityFor((int) $file->getSize())) {
            throw ValidationException::withMessages(['file' => 'Upload storage is nearly full.']);
        }

        $path = null;
        try {
            $path = $file->store('papers', 'public');
            if (! is_string($path) || $path === '') {
                throw new RuntimeException('Paper storage returned an empty path.');
            }

            $absolute = Storage::disk('public')->path($path);
            $mime = $file->getMimeType() ?: 'application/octet-stream';

            if ($mime === 'application/pdf') {
                $pdf->compressInPlace($absolute);
            } elseif (str_starts_with($mime, 'image/')) {
                $images->compressImageInPlace($absolute);
            }

            clearstatcache(true, $absolute);
            $size = filesize($absolute);
            if ($size === false || $size <= 0) {
                throw new RuntimeException('Stored Paper is empty.');
            }

            return Paper::create($data + [
                'user_id' => $request->user()->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $mime,
                'file_size' => $size,
                'file_hash' => $hash ?: null,
                'fingerprint' => $fingerprint,
                'status' => $status,
                'rejection_reason' => $reason,
            ]);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            throw $exception;
        }
    }

    private function storeNote(
        Request $request,
        PortalSettingsService $settings,
        UploadMetadataService $metadata,
        FileCompressionService $images,
        PdfCompressionService $pdf,
        UploadStorageService $storageCapacity
    ): Note {
        $validated = $request->validate([
            'branch' => ['required', Rule::in($settings->branches())],
            'semester' => ['required', 'regex:/^(?:Semester )?(?:I|II|III|IV|V|VI)$/'],
            'year' => ['required', 'integer', 'between:2000,2100'],
            'subject_name' => ['required', 'string', 'max:255'],
            'subject_code' => ['required', 'string', 'max:30'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'max:'.($settings->notesMaxMb() * 1024), 'mimes:pdf,jpg,jpeg,png', 'extensions:pdf,jpg,jpeg,png'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'rejection_reason' => ['nullable', 'string', 'max:2000'],
        ]);

        $status = $validated['status'];
        $reason = $validated['rejection_reason'] ?? null;
        unset($validated['attachment'], $validated['status'], $validated['rejection_reason']);
        $validated['semester'] = $metadata->normalizeSemester($validated['semester']);

        $file = $request->file('attachment');
        $hash = $file ? hash_file('sha256', $file->getRealPath()) : null;
        if ($hash && Note::where('file_hash', $hash)->exists()) {
            throw ValidationException::withMessages(['attachment' => 'This exact Notes file already exists.']);
        }

        $fingerprint = $metadata->fingerprintNote($validated, $hash ?: null);
        if (Note::where('fingerprint', $fingerprint)->exists()) {
            throw ValidationException::withMessages(['subject_code' => 'This exact Notes submission already exists.']);
        }

        if ($file && ! $storageCapacity->hasCapacityFor((int) $file->getSize())) {
            throw ValidationException::withMessages(['attachment' => 'Upload storage is nearly full.']);
        }

        $path = null;
        try {
            $name = null;
            $mime = null;
            $size = 0;

            if ($file) {
                $path = $file->store('notes', 'public');
                if (! is_string($path) || $path === '') {
                    throw new RuntimeException('Notes storage returned an empty path.');
                }

                $absolute = Storage::disk('public')->path($path);
                $name = $file->getClientOriginalName();
                $mime = $file->getMimeType() ?: 'application/octet-stream';

                if ($mime === 'application/pdf') {
                    $pdf->compressInPlace($absolute);
                } elseif (str_starts_with($mime, 'image/')) {
                    $images->compressImageInPlace($absolute);
                }

                clearstatcache(true, $absolute);
                $finalSize = filesize($absolute);
                if ($finalSize === false || $finalSize <= 0) {
                    throw new RuntimeException('Stored Notes file is empty.');
                }
                $size = $finalSize;
            }

            return Note::create($validated + [
                'user_id' => $request->user()->id,
                'attachment_path' => $path,
                'original_name' => $name,
                'mime_type' => $mime,
                'file_size' => $size,
                'file_hash' => $hash ?: null,
                'fingerprint' => $fingerprint,
                'status' => $status,
                'rejection_reason' => $reason,
            ]);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            throw $exception;
        }
    }

    private function storeGallery(
        Request $request,
        PortalSettingsService $settings,
        FileCompressionService $images,
        UploadStorageService $storageCapacity
    ): GalleryImage {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:'.($settings->galleryMaxMb() * 1024)],
            'category' => ['required', 'string', 'max:100'],
            'caption' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'rejection_reason' => ['nullable', 'string', 'max:2000'],
        ]);

        $file = $request->file('image');
        if (! $file || ! $file->isValid()) {
            throw ValidationException::withMessages(['image' => 'Choose a valid gallery image.']);
        }

        if (! $storageCapacity->hasCapacityFor((int) $file->getSize())) {
            throw ValidationException::withMessages(['image' => 'Upload storage is nearly full.']);
        }

        $path = null;
        try {
            $path = $file->store('gallery', 'public');
            if (! is_string($path) || $path === '') {
                throw new RuntimeException('Gallery storage returned an empty path.');
            }

            $absolute = Storage::disk('public')->path($path);
            $images->compressImageInPlace($absolute);
            clearstatcache(true, $absolute);
            $size = filesize($absolute);
            if ($size === false || $size <= 0) {
                throw new RuntimeException('Stored Gallery image is empty.');
            }

            return GalleryImage::create([
                'user_id' => $request->user()->id,
                'category' => $validated['category'],
                'caption' => $validated['caption'] ?? null,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                'file_size' => $size,
                'status' => $validated['status'],
                'rejection_reason' => $validated['rejection_reason'] ?? null,
            ]);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            throw $exception;
        }
    }
}
