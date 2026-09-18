<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
use App\Models\User;
use App\Services\PortalSettingsService;

class AdminDashboardController extends Controller
{
    public function index(PortalSettingsService $settings)
    {
        return view('admin.dashboard', [
            'users' => User::where('role', '!=', 'admin')->count(),
            'pendingPapers' => Paper::where('status', 'pending')->count(),
            'pendingNotes' => Note::where('status', 'pending')->count(),
            'pendingGallery' => GalleryImage::where('status', 'pending')->count(),
            'approvedPapers' => Paper::where('status', 'approved')->count(),
            'approvedNotes' => Note::where('status', 'approved')->count(),
            'approvedGallery' => GalleryImage::where('status', 'approved')->count(),
            'subjects' => SubjectMaster::count(),
            'messages' => ContactMessage::where('status', 'new')->count(),
            'paperMaxMb' => $settings->paperMaxMb(),
            'notesMaxMb' => $settings->notesMaxMb(),
            'loginWallEnabled' => $settings->loginWallEnabled(),
            'logs' => AdminActivityLog::latest()->limit(10)->get(),
        ]);
    }
}
