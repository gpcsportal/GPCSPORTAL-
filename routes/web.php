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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public portal
|--------------------------------------------------------------------------
*/

Route::get('/', [PortalController::class, 'index'])
    ->name('portal.home');

/*
|--------------------------------------------------------------------------
| Student / Faculty authentication
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Public APIs / lookup
|--------------------------------------------------------------------------
*/

Route::get('/api/papers', [PaperController::class, 'index'])
    ->name('papers.index');

Route::get('/api/notes', [NoteController::class, 'index'])
    ->name('notes.index');

Route::get('/api/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.store');

Route::get(
    '/metadata/papers',
    [UploadMetadataLookupController::class, 'paper']
)->name('metadata.papers.lookup');

Route::get(
    '/metadata/notes',
    [UploadMetadataLookupController::class, 'note']
)->name('metadata.notes.lookup');

/*
|--------------------------------------------------------------------------
| Authenticated student/faculty actions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'account.active'])->group(function (): void {

    Route::post('/papers', [PaperController::class, 'store'])
        ->name('papers.store');

    Route::post('/notes', [NoteController::class, 'store'])
        ->name('notes.store');

    Route::post('/gallery', [GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::get(
        '/papers/{paper}/download',
        [PaperController::class, 'download']
    )->name('papers.download');

    Route::get(
        '/notes/{note}/download',
        [NoteController::class, 'download']
    )->name('notes.download');

    Route::get(
        '/gallery/{image}',
        [GalleryController::class, 'show']
    )->name('gallery.show');
});

/*
|--------------------------------------------------------------------------
| TEMPORARY SESSION / CSRF DIAGNOSTIC
|--------------------------------------------------------------------------
|
| Railway 419 issue diagnose karne ke liye temporary routes.
| Ye passwords, APP_KEY, DB password ya CSRF token values expose nahi karte.
|
*/

Route::get('/__gpcs/session-test', function (Request $request) {

    $session = $request->session();

    $session->put(
        'gpcs_session_probe',
        now()->toIso8601String()
    );

    $session->save();

    return response()->json([

        'https' =>
            $request->isSecure(),

        'scheme' =>
            $request->getScheme(),

        'session_driver' =>
            config('session.driver'),

        'session_connection' =>
            config('session.connection')
            ?: config('database.default'),

        'session_table' =>
            config('session.table', 'sessions'),

        'session_cookie' =>
            config('session.cookie'),

        'cookie_received' =>
            $request->hasCookie(
                (string) config('session.cookie')
            ),

        'session_id_present' =>
            ! empty($session->getId()),

        'csrf_token_present' =>
            ! empty(csrf_token()),

        'secure_cookie' =>
            (bool) config('session.secure'),

        'session_domain' =>
            config('session.domain'),

        'same_site' =>
            config('session.same_site'),
    ]);

})->name('gpcs.session.test');


Route::get('/__gpcs/csrf-test', function () {

    $action = e(
        url('/__gpcs/csrf-test')
    );

    $token = e(
        csrf_token()
    );

    return response(

        '<!doctype html>' .

        '<html lang="en">' .

        '<head>' .

        '<meta charset="utf-8">' .

        '<meta name="viewport" content="width=device-width, initial-scale=1">' .

        '<title>GPCS CSRF Test</title>' .

        '</head>' .

        '<body style="
            font-family:Arial,sans-serif;
            background:#f4f7fb;
            padding:30px
        ">' .

        '<div style="
            max-width:620px;
            margin:40px auto;
            background:#fff;
            padding:24px;
            border-radius:16px
        ">' .

        '<h2>GPCS Portal CSRF Test</h2>' .

        '<p>
            Button dabao.
            Agar JSON me PASS aaye to
            Laravel CSRF/session sahi hai.
        </p>' .

        '<form
            method="POST"
            action="' . $action . '"
        >' .

        '<input
            type="hidden"
            name="_token"
            value="' . $token . '"
        >' .

        '<button
            type="submit"
            style="
                padding:12px 20px;
                border:0;
                border-radius:10px;
                background:#0a66d8;
                color:#fff;
                font-weight:700;
                cursor:pointer
            "
        >
            Test CSRF
        </button>' .

        '</form>' .

        '</div>' .

        '</body>' .

        '</html>'
    );

})->name('gpcs.csrf.test.form');


Route::post('/__gpcs/csrf-test', function (Request $request) {

    return response()->json([

        'result' =>
            'PASS',

        'message' =>
            'Laravel session and CSRF validation are working correctly.',

        'https' =>
            $request->isSecure(),

        'session_driver' =>
            config('session.driver'),

        'session_cookie' =>
            config('session.cookie'),

        'session_id_present' =>
            ! empty(
                $request->session()->getId()
            ),
    ]);

})->name('gpcs.csrf.test.submit');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/admin.php';
