<?php

$rawOrigins = trim((string) env('CORS_ALLOWED_ORIGINS', ''));
if ($rawOrigins === '') {
    $rawOrigins = trim((string) env('APP_URL', ''));
}

$allowedOrigins = array_values(array_filter(array_map(
    static fn (string $origin): string => rtrim(trim($origin), '/'),
    explode(',', $rawOrigins)
)));

return [
    'paths' => ['api/*', 'metadata/*'],

    'allowed_methods' => ['GET', 'OPTIONS'],

    // Exact origins only. Production never falls back to a wildcard.
    'allowed_origins' => $allowedOrigins,
    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Accept',
        'Content-Type',
        'Origin',
        'X-Requested-With',
        'X-CSRF-TOKEN',
    ],

    'exposed_headers' => [],
    'max_age' => 600,
    'supports_credentials' => true,
];
