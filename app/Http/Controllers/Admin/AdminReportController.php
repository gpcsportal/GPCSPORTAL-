<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\GalleryImage;
use App\Models\Note;
use App\Models\Paper;
use App\Models\SubjectMaster;
use App\Models\User;

class AdminReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', ['counts' => $this->counts()]);
    }

    public function csv()
    {
        return response()->streamDownload(function (): void {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Metric', 'Count']);
            foreach ($this->counts() + ['activity_logs' => AdminActivityLog::count()] as $key => $value) {
                fputcsv($out, [str_replace('_', ' ', ucfirst($key)), $value]);
            }
            fclose($out);
        }, 'gpcs-report-'.now()->format('Ymd-His').'.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function counts(): array
    {
        return [
            'student_faculty_users' => User::where('role', '!=', 'admin')->count(),
            'papers' => Paper::count(),
            'approved_papers' => Paper::where('status', 'approved')->count(),
            'notes' => Note::count(),
            'approved_notes' => Note::where('status', 'approved')->count(),
            'gallery' => GalleryImage::count(),
            'approved_gallery' => GalleryImage::where('status', 'approved')->count(),
            'master_subjects' => SubjectMaster::count(),
        ];
    }
}
