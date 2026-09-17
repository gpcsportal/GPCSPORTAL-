<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\Paper;
use App\Observers\AdminNoteObserver;
use App\Observers\AdminPaperObserver;
use App\Observers\NoteObserver;
use App\Observers\PaperObserver;
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
        if ($this->app->environment('production')) {
            $railwayDomain = trim((string) env('RAILWAY_PUBLIC_DOMAIN', ''));
            $configuredUrl = rtrim((string) config('app.url', ''), '/');

            if ($railwayDomain !== '') {
                $origin = 'https://'.$railwayDomain;
            } else {
                $origin = $configuredUrl !== ''
                    ? preg_replace('#^http://#i', 'https://', $configuredUrl)
                    : 'https://gpcsportal.up.railway.app';
            }

            $origin = rtrim((string) $origin, '/');

            config([
                'app.url' => $origin,
                'filesystems.disks.public.url' => $origin.'/storage',
            ]);

            URL::forceScheme('https');
            URL::useOrigin($origin);
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
