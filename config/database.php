 <?php

use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Safe MySQL PDO options
|--------------------------------------------------------------------------
|
| Railway's PHP runtime may not expose every PDO MySQL SSL constant.
| Never reference a PDO SSL class constant directly unless it exists.
|
| By default Railway's internal MySQL connection does not require a custom
| CA file. If MYSQL_ATTR_SSL_CA is empty, Laravel connects normally without
| adding any SSL PDO option.
|
*/

$mysqlOptions = static function (): array {
    if (! extension_loaded('pdo_mysql')) {
        return [];
    }

    $sslCa = env('MYSQL_ATTR_SSL_CA');

    if (! is_string($sslCa) || trim($sslCa) === '') {
        return [];
    }

    /*
     * Correct MySQL PDO constant is PDO::MYSQL_ATTR_SSL_CA.
     * Using defined()/constant() prevents a fatal error when the constant
     * is unavailable in the current PHP build.
     */
    $sslCaConstant = 'PDO::MYSQL_ATTR_SSL_CA';

    if (! defined($sslCaConstant)) {
        return [];
    }

    return [
        constant($sslCaConstant) => $sslCa,
    ];
};

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env(
                'DB_DATABASE',
                database_path('database.sqlite')
            ),
            'prefix' => '',
            'foreign_key_constraints' => env(
                'DB_FOREIGN_KEYS',
                true
            ),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
        ],

        'mysql' => [
            'driver' => 'mysql',

            'url' => env('DB_URL'),

            /*
             * Laravel DB_* variables are preferred.
             * Railway MYSQL* variables are used automatically as fallback.
             */
            'host' => env(
                'DB_HOST',
                env('MYSQLHOST', '127.0.0.1')
            ),

            'port' => env(
                'DB_PORT',
                env('MYSQLPORT', '3306')
            ),

            'database' => env(
                'DB_DATABASE',
                env('MYSQLDATABASE', 'gpcs_portal')
            ),

            'username' => env(
                'DB_USERNAME',
                env('MYSQLUSER', 'root')
            ),

            'password' => env(
                'DB_PASSWORD',
                env('MYSQLPASSWORD', '')
            ),

            'unix_socket' => env('DB_SOCKET', ''),

            'charset' => env(
                'DB_CHARSET',
                'utf8mb4'
            ),

            'collation' => env(
                'DB_COLLATION',
                'utf8mb4_unicode_ci'
            ),

            'prefix' => '',

            'prefix_indexes' => true,

            'strict' => true,

            'engine' => null,

            /*
             * Safe SSL behaviour:
             *
             * - pdo_mysql missing      -> []
             * - MYSQL_ATTR_SSL_CA empty -> []
             * - SSL CA constant missing -> []
             * - otherwise SSL CA option is enabled
             *
             * This prevents Railway from crashing during Laravel boot.
             */
            'options' => $mysqlOptions(),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    */

    'redis' => [

        'client' => env(
            'REDIS_CLIENT',
            'phpredis'
        ),

        'options' => [
            'cluster' => env(
                'REDIS_CLUSTER',
                'redis'
            ),

            'prefix' => env(
                'REDIS_PREFIX',
                Str::slug(
                    env('APP_NAME', 'laravel'),
                    '_'
                ).'_database_'
            ),
        ],

        'default' => [
            'url' => env('REDIS_URL'),

            'host' => env(
                'REDIS_HOST',
                '127.0.0.1'
            ),

            'username' => env(
                'REDIS_USERNAME'
            ),

            'password' => env(
                'REDIS_PASSWORD'
            ),

            'port' => env(
                'REDIS_PORT',
                '6379'
            ),

            'database' => env(
                'REDIS_DB',
                '0'
            ),
        ],
    ],

];
