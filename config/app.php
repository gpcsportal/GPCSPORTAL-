<?php

$environment = (string) env('APP_ENV', 'production');
$railwayDomain = trim((string) env('RAILWAY_PUBLIC_DOMAIN', ''));
$defaultUrl = $railwayDomain !== ''
    ? 'https://'.$railwayDomain
    : 'https://gpcsportal.up.railway.app';

$appUrl = trim((string) env('APP_URL', $defaultUrl));

if ($environment === 'production') {
    if (str_starts_with($appUrl, 'http://')) {
        $appUrl = 'https://'.substr($appUrl, 7);
    } elseif (! preg_match('#^https://#i', $appUrl)) {
        $appUrl = 'https://'.ltrim($appUrl, '/');
    }
}

return [
    'name' => env('APP_NAME', 'GPCS Portal'),
    'env' => $environment,
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => rtrim($appUrl, '/'),
    'timezone' => env('APP_TIMEZONE', 'Asia/Kolkata'),
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_IN',
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [],
    'maintenance' => [
        'driver' => 'file',
        'store' => 'database',
    ],
];
