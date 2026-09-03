<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PortalNotification extends Model {protected $fillable=['admin_id','audience','recipient','title','message','link']; public function admin(){return $this->belongsTo(User::class,'admin_id');}}
