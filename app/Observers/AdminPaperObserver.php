<?php
namespace App\Observers;
use App\Models\Paper; use App\Services\AdminActivityService;
class AdminPaperObserver {public function created(Paper $paper): void {if(auth()->check()&&auth()->user()->isAdmin())app(AdminActivityService::class)->log('paper_created','paper',$paper->id);}}
