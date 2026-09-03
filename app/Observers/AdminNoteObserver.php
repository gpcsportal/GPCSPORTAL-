<?php
namespace App\Observers;
use App\Models\Note; use App\Services\AdminActivityService;
class AdminNoteObserver {public function created(Note $note): void {if(auth()->check()&&auth()->user()->isAdmin())app(AdminActivityService::class)->log('note_created','note',$note->id);}}
