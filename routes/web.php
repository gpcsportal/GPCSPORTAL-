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

require __DIR__.'/admin.php';
