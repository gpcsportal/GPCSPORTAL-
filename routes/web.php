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
use Illuminate\Support\Facades\Route;

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
    ->middleware(['guest', 'throttle:5,1'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'form'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('password.update');

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

// Legacy preview JavaScript can still reference the old chunk-upload endpoint.
// The active Laravel bridge intercepts real uploads; this stateless tombstone
// guarantees a clear JSON error instead of an HTML 404 if the fallback runs.
Route::post('/chunk_upload.php', static fn () => response()->json([
    'ok' => false,
    'error' => 'The legacy upload method is retired. Refresh the portal and try the upload again.',
], 410))
    ->withoutMiddleware(ValidateCsrfToken::class)
    ->middleware('throttle:20,1')
    ->name('legacy.chunk-upload.retired');

Route::middleware(['auth', 'account.active'])->group(function (): void {
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
});

require __DIR__.'/admin.php';
