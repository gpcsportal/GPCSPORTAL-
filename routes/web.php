<?php

use App\Http\Controllers\{
    PortalController,
    PaperController,
    NoteController,
    GalleryController,
    ContactController,
    UploadMetadataLookupController
};

use App\Http\Controllers\Auth\{
    PortalAuthController,
    ForgotPasswordController,
    ResetPasswordController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', [PortalController::class, 'index'])
    ->name('portal.home');

Route::post('/login', [PortalAuthController::class, 'login'])
    ->middleware('throttle:10,1')
    ->name('portal.login');

Route::post('/register', [PortalAuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('portal.register');

Route::post('/logout', [PortalAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('portal.logout');

Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'form'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/api/papers', [PaperController::class, 'index'])
    ->name('papers.index');

Route::get('/api/notes', [NoteController::class, 'index'])
    ->name('notes.index');

Route::get('/api/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.store');

Route::get('/metadata/papers', [UploadMetadataLookupController::class, 'paper'])
    ->name('metadata.papers.lookup');

Route::get('/metadata/notes', [UploadMetadataLookupController::class, 'note'])
    ->name('metadata.notes.lookup');

Route::middleware(['auth', 'account.active'])->group(function (): void {
    Route::post('/papers', [PaperController::class, 'store'])
        ->name('papers.store');

    Route::post('/notes', [NoteController::class, 'store'])
        ->name('notes.store');

    Route::post('/gallery', [GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::get('/papers/{paper}/download', [PaperController::class, 'download'])
        ->name('papers.download');

    Route::get('/notes/{note}/download', [NoteController::class, 'download'])
        ->name('notes.download');

    Route::get('/gallery/{image}', [GalleryController::class, 'show'])
        ->name('gallery.show');
});

/*
|--------------------------------------------------------------------------
| Temporary targeted 419 diagnostic
|--------------------------------------------------------------------------
| Safe output only: no APP_KEY, cookie values, passwords or DB credentials.
| Remove after the session/CSRF issue is resolved.
*/
Route::get('/__gpcs/419-check', function (Request $request) {
    $sentFile = '';
    $sentLine = 0;
    $headersAlreadySent = headers_sent($sentFile, $sentLine);

    $session = $request->session();
    $cookieName = (string) config('session.cookie');
    $rawCookieHeader = (string) $request->headers->get('cookie', '');

    $rawSessionCookiePresent = preg_match(
        '/(?:^|;\\s*)'.preg_quote($cookieName, '/').'=/',
        $rawCookieHeader
    ) === 1;

    $decryptedSessionCookiePresent = $request->cookies->has($cookieName);
    $previousSessionProbeFound = $session->get('gpcs_419_probe') === 'ok';
    $session->put('gpcs_419_probe', 'ok');

    $connection = (string) (config('session.connection') ?: config('database.default'));
    $table = (string) config('session.table', 'sessions');

    $databaseConnectionOk = false;
    $sessionsTableExists = false;
    $currentSessionRowExists = false;

    try {
        DB::connection($connection)->getPdo();
        $databaseConnectionOk = true;
        $sessionsTableExists = Schema::connection($connection)->hasTable($table);

        if ($sessionsTableExists) {
            $currentSessionRowExists = DB::connection($connection)
                ->table($table)
                ->where('id', $session->getId())
                ->exists();
        }
    } catch (\Throwable $e) {
        // Never expose database exception details on this public diagnostic route.
    }

    return response()->json([
        'diagnostic_version' => 'gpcs-419-v3',
        'https_detected' => $request->isSecure(),
        'scheme' => $request->getScheme(),
        'headers_already_sent' => $headersAlreadySent,
        'headers_sent_from' => $headersAlreadySent
            ? basename((string) $sentFile).':'.$sentLine
            : null,
        'session_driver' => config('session.driver'),
        'session_connection' => $connection,
        'session_table' => $table,
        'session_cookie_name' => $cookieName,
        'raw_session_cookie_sent_by_browser' => $rawSessionCookiePresent,
        'session_cookie_decrypted_by_laravel' => $decryptedSessionCookiePresent,
        'previous_session_data_found' => $previousSessionProbeFound,
        'session_id_present' => ! empty($session->getId()),
        'csrf_token_present' => is_string($session->token()) && strlen($session->token()) > 20,
        'database_connection_ok' => $databaseConnectionOk,
        'sessions_table_exists' => $sessionsTableExists,
        'current_session_row_exists' => $currentSessionRowExists,
        'secure_cookie' => (bool) config('session.secure'),
        'session_domain' => config('session.domain'),
        'session_path' => config('session.path'),
        'same_site' => config('session.same_site'),
        'app_key_configured' => filled(config('app.key')),
    ])->withHeaders([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0, private',
        'Pragma' => 'no-cache',
        'Expires' => '0',
    ]);
})->name('gpcs.419.check');

require __DIR__.'/admin.php';
