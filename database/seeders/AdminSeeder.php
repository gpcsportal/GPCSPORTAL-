<?php
namespace Database\Seeders;
use App\Models\User; use Illuminate\Database\Seeder; use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder {public function run(): void {$id=config('gpcs_admin.seed_identifier');$email=config('gpcs_admin.seed_email');$password=config('gpcs_admin.seed_password');if(!$id||!$email||!$password)throw new \RuntimeException('Set ADMIN_IDENTIFIER, ADMIN_EMAIL and ADMIN_PASSWORD environment variables before running AdminSeeder.');if(strlen($password)<12)throw new \RuntimeException('ADMIN_PASSWORD must be at least 12 characters.');User::updateOrCreate(['email'=>$email],['name'=>'GPCS Administrator','admin_identifier'=>$id,'password'=>Hash::make($password),'role'=>'admin','is_active'=>true]);}}
