<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
use App\Services\PortalSettingsService;

class PortalController extends Controller
{
    public function index(PortalSettingsService $settings)
    {
        $branches = $settings->branches();

        return view('portal', [
            'paperCount' => Paper::where('status', 'approved')->count(),
            'noteCount' => Note::where('status', 'approved')->count(),
            'galleryCount' => GalleryImage::where('status', 'approved')->count(),
            'subjectCount' => SubjectMaster::count(),
            'branches' => $branches,
            'branchCount' => count($branches),
            'paperMaxMb' => $settings->paperMaxMb(),
            'notesMaxMb' => $settings->notesMaxMb(),
            'galleryMaxMb' => $settings->galleryMaxMb(),
            'loginWallEnabled' => $settings->loginWallEnabled(),
        ]);
    }
}
