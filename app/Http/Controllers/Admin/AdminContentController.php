<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\{Paper,Note,GalleryImage,ContactMessage}; use App\Services\AdminActivityService; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage;
class AdminContentController extends Controller {
 private function model(string $type){return match($type){'papers'=>Paper::class,'notes'=>Note::class,'gallery'=>GalleryImage::class,'messages'=>ContactMessage::class,default=>abort(404)};}
 public function index(string $type){$m=$this->model($type);return view('admin.content.index',['type'=>$type,'items'=>$m::latest()->paginate(30)]);}
 public function status(Request $r,string $type,int $id,AdminActivityService $log){$m=$this->model($type);$item=$m::findOrFail($id);$status=$r->validate(['status'=>'required|in:approved,rejected,pending'])['status'];$item->update(['status'=>$status,'rejection_reason'=>$r->input('rejection_reason')]);$log->log('content_status_changed',$type,$id,['status'=>$status]);return back()->with('status','Content status updated.');}
 public function destroy(string $type,int $id,AdminActivityService $log){$m=$this->model($type);$item=$m::findOrFail($id);foreach(['file_path','attachment_path'] as $f){if(!empty($item->{$f}))Storage::disk('public')->delete($item->{$f});}$item->delete();$log->log('content_deleted',$type,$id);return back()->with('status','Content deleted.');}
}
