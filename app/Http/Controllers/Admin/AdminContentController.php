<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Services\AdminActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
