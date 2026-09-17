<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\PortalNotification;
use App\Models\SubjectMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortalController extends Controller
{
    public function index()
    {
        $counts = Cache::remember('portal.home.counts', now()->addMinutes(5), static fn (): array => [
            'paperCount' => Paper::where('status', 'approved')->count(),
            'noteCount' => Note::where('status', 'approved')->count(),
            'galleryCount' => GalleryImage::where('status', 'approved')->count(),
            'subjectCount' => SubjectMaster::count(),
        ]);

        return view('portal', $counts);
    }

    public function notifications(Request $request)
    {
        $user = $request->user();
        $role = $user?->role;

        $query = PortalNotification::query()
            ->where(function ($builder) use ($role, $user): void {
                $builder->where('audience', 'all');

                if ($role === 'student') {
                    $builder->orWhere('audience', 'students');
                }

                if ($role === 'faculty') {
                    $builder->orWhere('audience', 'faculty');
                }

                if ($user) {
                    $builder->orWhere(function ($single) use ($user): void {
                        $single->where('audience', 'single')
                            ->where(function ($recipient) use ($user): void {
                                $recipient->where('recipient', $user->email);

                                if ($user->mobile) {
                                    $recipient->orWhere('recipient', $user->mobile);
                                }
                            });
                    });
                }
            })
            ->latest()
            ->limit(12)
            ->get(['id', 'title', 'message', 'link', 'created_at']);

        return response()->json(
            $query->map(fn (PortalNotification $notice) => [
                'id' => $notice->id,
                'title' => $notice->title,
                'message' => $notice->message,
                'link' => $notice->link,
                'published_at' => $notice->created_at?->toIso8601String(),
            ])
        );
    }
}
