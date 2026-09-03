<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
 use HasFactory, Notifiable;
 protected $fillable=['name','surname','email','mobile','password','role','gender','college_name','college_year','branch','semester','subject_department','designation','employee_id','pin_code','address','profile_photo_path','admin_identifier','is_active','last_login_at','suspended_at'];
 protected $hidden=['password','remember_token'];
 protected function casts(): array {return ['email_verified_at'=>'datetime','password'=>'hashed','is_active'=>'boolean','last_login_at'=>'datetime','suspended_at'=>'datetime'];}
 public function isAdmin(): bool {return $this->role==='admin';}
}
