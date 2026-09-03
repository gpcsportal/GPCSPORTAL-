<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminActivityLog extends Model {protected $fillable=['admin_id','action','target_type','target_id','context','ip_address']; protected function casts(): array {return ['context'=>'array'];} public function admin(){return $this->belongsTo(User::class,'admin_id');}}
