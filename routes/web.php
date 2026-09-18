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

use App\Services\PortalSettingsService;
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

Route::get('/terms', static fn () => view('legal', [
    'title' => 'Terms & Conditions',
    'intro' => 'These terms explain the basic rules for using the GPCS Portal as an academic resource and account-based college portal.',
    'sections' => [
        [
            'heading' => 'Academic use',
            'body' => 'Use the portal for legitimate academic and college-related purposes. Do not use it to impersonate others, disrupt service, or upload unlawful or unrelated material.',
        ],
        [
            'heading' => 'Your account',
            'items' => [
                'Keep your login credentials private and sign out on shared devices.',
                'Provide accurate registration information and keep it reasonably up to date.',
                'Accounts may be suspended when needed to protect the portal, its users, or college resources.',
            ],
        ],
        [
            'heading' => 'Uploads and moderation',
            'body' => 'Only upload material you are allowed to share. Papers, notes, images and other submissions may be reviewed, rejected or removed by portal administrators when they are duplicates, unsafe, inaccurate, unrelated or otherwise unsuitable.',
        ],
        [
            'heading' => 'External resources',
            'body' => 'The portal links to official or third-party academic services. Those services are operated separately and their own terms and availability apply.',
        ],
        [
            'heading' => 'Availability',
            'body' => 'The portal is maintained as an academic service. Features may be updated, temporarily unavailable or changed when required for maintenance, security or reliability.',
        ],
    ],
]))->name('portal.terms');

Route::get('/privacy', static fn () => view('legal', [
    'title' => 'Privacy Policy',
    'intro' => 'This page explains the information the GPCS Portal uses to provide accounts, academic resources, moderation and basic security.',
    'sections' => [
        [
            'heading' => 'Information used by the portal',
            'items' => [
                'Registration information such as name, email, role and relevant academic details.',
                'Optional information you choose to provide, such as mobile number, profile photo or other optional fields.',
                'Academic uploads and their metadata, including papers, notes and gallery submissions.',
                'Basic session, security and activity information needed to authenticate users, prevent abuse and administer the portal.',
            ],
        ],
        [
            'heading' => 'Why it is used',
            'body' => 'Information is used to operate sign-in, account access, academic libraries, moderation, password recovery and security controls.',
        ],
        [
            'heading' => 'Cookies and sessions',
            'body' => 'The portal uses secure session cookies that are necessary to keep users signed in and protect authenticated actions. These are not advertising cookies.',
        ],
        [
            'heading' => 'Public and private information',
            'body' => 'Approved academic uploads may be visible or downloadable to signed-in portal users. Account passwords are not displayed, and personal registration information is not intentionally published as part of academic resources.',
        ],
        [
            'heading' => 'External links and requests',
            'body' => 'External websites have their own privacy practices. For correction, access or removal requests relating to portal account data, contact the portal administrator or college through the available contact channel.',
        ],
    ],
]))->name('portal.privacy');

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
| contact actions, uploads, downloads and outbound feature links all
| require a signed-in active portal account.
*/

Route::middleware('portal.access')->group(function (): void {
    Route::get('/api/papers', [PaperController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('papers.index');

    Route::get('/api/notes', [NoteController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('notes.index');

    Route::get('/api/gallery', [GalleryController::class, 'index'])
        ->middleware('throttle:120,1')
        ->name('gallery.index');

    Route::get('/papers/{paper}/download', [PaperController::class, 'download'])
        ->name('papers.download');

    Route::get('/notes/{note}/download', [NoteController::class, 'download'])
        ->name('notes.download');

    Route::get('/gallery/{image}', [GalleryController::class, 'show'])
        ->name('gallery.show');

    Route::get('/go/{destination}', static function (
        PortalSettingsService $settings,
        string $destination
    ) {
        $destinations = $settings->officialLinks();

        abort_unless(array_key_exists($destination, $destinations), 404);

        return redirect()->away($destinations[$destination]);
    })->where('destination', 'student|syllabus|previous|main-result|all-result')
        ->name('portal.outbound');
});

Route::middleware(['auth', 'account.active'])->group(function (): void {
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
});

require __DIR__.'/admin.php';
