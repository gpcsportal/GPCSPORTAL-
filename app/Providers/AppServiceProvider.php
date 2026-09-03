<?php
namespace App\Providers;
use App\Models\{Paper,Note}; use App\Observers\{PaperObserver,NoteObserver,AdminPaperObserver,AdminNoteObserver}; use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider {public function register(): void {} public function boot(): void {Paper::observe([PaperObserver::class,AdminPaperObserver::class]);Note::observe([NoteObserver::class,AdminNoteObserver::class]);}}
