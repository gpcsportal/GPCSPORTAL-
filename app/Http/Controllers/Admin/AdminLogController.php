<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\AdminActivityLog;
class AdminLogController extends Controller {public function index(){return view('admin.logs.index',['logs'=>AdminActivityLog::with('admin')->latest()->paginate(50)]);}}
