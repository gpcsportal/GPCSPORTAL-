<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\{User,Paper,Note,GalleryImage,ContactMessage,AdminActivityLog};
class AdminDashboardController extends Controller {public function index(){return view('admin.dashboard',['users'=>User::where('role','!=','admin')->count(),'pendingPapers'=>Paper::where('status','pending')->count(),'pendingNotes'=>Note::where('status','pending')->count(),'pendingGallery'=>GalleryImage::where('status','pending')->count(),'messages'=>ContactMessage::where('status','new')->count(),'logs'=>AdminActivityLog::latest()->limit(10)->get()]);}}
