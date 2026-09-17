<?php

$isProduction = (string) env('APP_ENV', 'production') === 'production';

return [
    'driver' => env('SESSION_DRIVER', 'database'),
    'lifetime' => (int) env('SESSION_LIFETIME', 120),
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),
    'encrypt' => env('SESSION_ENCRYPT', false),

    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION'),
    'table' => env('SESSION_TABLE', 'sessions'),
    'store' => env('SESSION_STORE'),

    'lottery' => [2, 100],

    'cookie' => env('SESSION_COOKIE', 'gpcs_portal_session'),
    'path' => '/',

    // Host-only cookies avoid stale or mismatched Railway domain settings.
    'domain' => $isProduction ? null : env('SESSION_DOMAIN'),

    // Railway public traffic is HTTPS; always mark production session cookies Secure.
    'secure' => $isProduction ? true : env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
];
