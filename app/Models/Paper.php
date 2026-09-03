<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Paper extends Model {protected $fillable=['user_id','paper_code','subject_code','paper_name','subject_name','branch','semester','year','session','file_path','original_name','mime_type','file_size','fingerprint','status','rejection_reason']; public function user(){return $this->belongsTo(User::class);} }
