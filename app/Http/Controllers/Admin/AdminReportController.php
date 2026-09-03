<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\{User,Paper,Note,GalleryImage,AdminActivityLog};
class AdminReportController extends Controller {public function index(){return view('admin.reports.index',['counts'=>['users'=>User::count(),'papers'=>Paper::count(),'notes'=>Note::count(),'gallery'=>GalleryImage::count()]]);}public function csv(){return response()->streamDownload(function(){ $out=fopen('php://output','w');fputcsv($out,['Metric','Count']);foreach(['Users'=>User::count(),'Papers'=>Paper::count(),'Notes'=>Note::count(),'Gallery Images'=>GalleryImage::count(),'Activity Logs'=>AdminActivityLog::count()] as $k=>$v)fputcsv($out,[$k,$v]);fclose($out);},'gpcs-report-'.now()->format('Ymd-His').'.csv',['Content-Type'=>'text/csv']);}}
