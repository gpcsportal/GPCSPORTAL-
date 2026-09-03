<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\User; use App\Services\AdminActivityService; use Illuminate\Http\Request;
class AdminUserController extends Controller {public function index(){return view('admin.users.index',['users'=>User::where('role','!=','admin')->latest()->paginate(30)]);}public function toggle(User $user,AdminActivityService $log){abort_if($user->isAdmin(),422);$new=!$user->is_active;$user->update(['is_active'=>$new,'suspended_at'=>$new?null:now()]);$log->log('user_status_changed','user',$user->id,['is_active'=>$new]);return back()->with('status','User status updated.');}}
