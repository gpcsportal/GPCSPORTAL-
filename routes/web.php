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

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public landing/auth routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PortalController::class, 'index'])
    ->name('portal.home');

// Compatibility for the historical SPA links such as index.php?page=notes.
// The front-end auth gate canonicalizes feature navigation after the page loads.
Route::get('/index.php', [PortalController::class, 'index'])
    ->name('portal.legacy');

Route::get('/auth/status', static function (Request $request) {
    $user = $request->user();

    return response()->json([
        'authenticated' => $user !== null && (bool) $user->is_active,
        'role' => $user?->role,
    ]);
})->middleware('throttle:120,1')->name('portal.auth-status');

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
    ->middleware(['guest', 'throttle:5,1'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'form'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('password.update');

// Legacy preview JavaScript can still reference the old chunk-upload endpoint.
// It does not accept uploads anymore; the active Laravel bridge owns uploads.
Route::post('/chunk_upload.php', static fn () => response()->json([
    'ok' => false,
    'error' => 'The legacy upload method is retired. Refresh the portal and try the upload again.',
], 410))
    ->withoutMiddleware(ValidateCsrfToken::class)
    ->middleware('throttle:20,1')
    ->name('legacy.chunk-upload.retired');

/*
|--------------------------------------------------------------------------
| Signed-in portal features
|--------------------------------------------------------------------------
|
| Only the landing/branding/auth experience is public. Data APIs, metadata,
| notices, contact actions, uploads, downloads and outbound feature links all
| require a signed-in active portal account.
*/

Route::middleware(['auth', 'account.active'])->group(function (): void {
    Route::get('/api/papers', [PaperController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('papers.index');

    Route::get('/api/notes', [NoteController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('notes.index');

    Route::get('/api/gallery', [GalleryController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('gallery.index');

    Route::get('/api/notifications', [PortalController::class, 'notifications'])
        ->middleware('throttle:120,1')
        ->name('portal.notifications');

    Route::post('/contact', [ContactController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('contact.store');

    Route::get('/metadata/papers', [UploadMetadataLookupController::class, 'paper'])
        ->middleware('throttle:120,1')
        ->name('metadata.papers.lookup');

    Route::get('/metadata/notes', [UploadMetadataLookupController::class, 'note'])
        ->middleware('throttle:120,1')
        ->name('metadata.notes.lookup');

    Route::post('/papers', [PaperController::class, 'store'])
        ->middleware('throttle:20,1')
        ->name('papers.store');

    Route::post('/notes', [NoteController::class, 'store'])
        ->middleware('throttle:20,1')
        ->name('notes.store');

    Route::post('/gallery', [GalleryController::class, 'store'])
        ->middleware('throttle:30,1')
        ->name('gallery.store');

    Route::get('/papers/{paper}/download', [PaperController::class, 'download'])
        ->name('papers.download');

    Route::get('/notes/{note}/download', [NoteController::class, 'download'])
        ->name('notes.download');

    Route::get('/gallery/{image}', [GalleryController::class, 'show'])
        ->name('gallery.show');

    // Safe relay for the fixed official external resources shown in the portal.
    // The login redirect remains same-origin; only these server-side allowlisted
    // keys can leave the GPCS site after authentication.
    Route::get('/go/{destination}', static function (string $destination) {
        $destinations = [
            'student' => 'https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx',
            'syllabus' => 'https://www.rgpvdiploma.in/Academics/AICTEBased.aspx',
            'previous' => 'https://www.polygwalior.ac.in/diploma_papers.php',
            'main-result' => 'https://result.rgpv.ac.in/Result/Diplomarslt.aspx',
            'all-result' => 'https://result.rgpv.ac.in/Result/ProgramSelect.aspx',
        ];

        abort_unless(array_key_exists($destination, $destinations), 404);

        return redirect()->away($destinations[$destination]);
    })->where('destination', 'student|syllabus|previous|main-result|all-result')
        ->name('portal.outbound');
});

require __DIR__.'/admin.php';
