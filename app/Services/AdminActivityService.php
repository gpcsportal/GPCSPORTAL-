<?php
namespace App\Services;
use App\Models\AdminActivityLog;
class AdminActivityService {public function log(string $action,?string $targetType=null,?int $targetId=null,array $context=[]): void {if(!auth()->check())return;AdminActivityLog::create(['admin_id'=>auth()->id(),'action'=>$action,'target_type'=>$targetType,'target_id'=>$targetId,'context'=>$context,'ip_address'=>request()->ip()]);}}
