<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class GalleryImage extends Model {protected $fillable=['user_id','category','caption','file_path','original_name','mime_type','file_size','status','rejection_reason']; public function user(){return $this->belongsTo(User::class);} }
