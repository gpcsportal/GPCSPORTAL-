<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\Paper;
use App\Observers\AdminNoteObserver;
use App\Observers\AdminPaperObserver;
use App\Observers\NoteObserver;
use App\Observers\PaperObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Surface accidental N+1 relationship access during local development
        // and CI without risking production request failures.
        Model::preventLazyLoading(! $this->app->isProduction());

        if ($this->app->environment('production')) {
            $origin = rtrim((string) config('app.url', ''), '/');

            if ($origin !== '') {
                config([
                    'filesystems.disks.public.url' => $origin.'/storage',
                ]);

                URL::forceScheme('https');
                URL::useOrigin($origin);
            }
        }

        Paper::observe([
            PaperObserver::class,
            AdminPaperObserver::class,
        ]);

        Note::observe([
            NoteObserver::class,
            AdminNoteObserver::class,
        ]);
    }
}
