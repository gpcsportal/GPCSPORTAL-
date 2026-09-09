 <?php

use Illuminate\Support\Str;

return [

    'driver' => env('SESSION_DRIVER', 'database'),

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    'encrypt' => false,

    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION'),

    'table' => env('SESSION_TABLE', 'sessions'),

    'store' => env('SESSION_STORE'),

    'lottery' => [2, 100],

    'cookie' => Str::slug(
        (string) env('APP_NAME', 'GPCS Portal')
    ).'-session',

    'path' => '/',

    'domain' => null,

    /*
     * IMPORTANT:
     * null rakha hai taaki Laravel/Symfony HTTPS ke hisaab se
     * cookie security automatically handle kare.
     */
    'secure' => null,

    /*
     * Secure setting:
     * JavaScript session cookie nahi padh sakta.
     */
    'http_only' => true,

    'same_site' => 'lax',

    'partitioned' => false,

];
