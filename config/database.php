<?php

use Illuminate\Support\Str;

$mysqlOptions = static function (): array {
    if (! extension_loaded('pdo_mysql')) {
        return [];
    }

    // Keep PDO connections request-scoped instead of using PHP persistent
    // sockets. Laravel/FrankenPHP may reuse the application worker, while PDO
    // and the framework safely manage the live connection lifecycle.
    $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
    ];

    $sslCa = env('MYSQL_ATTR_SSL_CA');

    if (! is_string($sslCa) || trim($sslCa) === '') {
        return $options;
    }

    $sslCaConstant = 'PDO::MYSQL_ATTR_SSL_CA';

    if (defined($sslCaConstant)) {
        $options[constant($sslCaConstant)] = $sslCa;
    }

    return $options;
};

return [
    'default' => env('DB_CONNECTION', 'mysql'),

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', env('MYSQLHOST', '127.0.0.1')),
            'port' => env('DB_PORT', env('MYSQLPORT', '3306')),
            'database' => env('DB_DATABASE', env('MYSQLDATABASE', 'gpcs_portal')),
            'username' => env('DB_USERNAME', env('MYSQLUSER', 'root')),
            'password' => env('DB_PASSWORD', env('MYSQLPASSWORD', '')),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => $mysqlOptions(),
        ],
    ],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],
    ],
];
