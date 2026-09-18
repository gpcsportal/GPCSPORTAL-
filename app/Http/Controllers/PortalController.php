<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
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

}
