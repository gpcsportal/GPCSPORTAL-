 /*
|--------------------------------------------------------------------------
| TEMPORARY GPCS SESSION / CSRF TEST
|--------------------------------------------------------------------------
| 419 error diagnose karne ke liye temporary routes.
| Test complete hone ke baad is poore block ko remove kar dena.
*/

\Illuminate\Support\Facades\Route::get(
    '/__gpcs/session-test',
    function (\Illuminate\Http\Request $request) {

        $session = $request->session();

        /*
         * Session mein ek temporary value save karte hain.
         */
        if (! $session->has('gpcs_test_created')) {
            $session->put(
                'gpcs_test_created',
                now()->toIso8601String()
            );
        }

        $session->put(
            'gpcs_test_last_seen',
            now()->toIso8601String()
        );

        $session->save();

        /*
         * Database / sessions table ko safely check karo.
         * Kisi password ya DB error ko browser par expose nahi karenge.
         */
        $dbOk = false;
        $sessionsTableOk = false;
        $sessionRowOk = false;

        try {
            $connection = config('session.connection')
                ?: config('database.default');

            $table = config('session.table', 'sessions');

            \Illuminate\Support\Facades\DB::connection(
                $connection
            )->getPdo();

            $dbOk = true;

            $sessionsTableOk =
                \Illuminate\Support\Facades\Schema::connection(
                    $connection
                )->hasTable($table);

            if ($sessionsTableOk) {
                $sessionRowOk =
                    \Illuminate\Support\Facades\DB::connection(
                        $connection
                    )
                    ->table($table)
                    ->where(
                        'id',
                        $session->getId()
                    )
                    ->exists();
            }

        } catch (\Throwable $e) {
            /*
             * Intentionally empty.
             * Real database error public page par nahi dikhana.
             */
        }

        $cookieName = config(
            'session.cookie',
            'gpcs_portal_session'
        );

        $csrfToken = csrf_token();

        $status = [
            'HTTPS detected' =>
                $request->isSecure()
                    ? 'YES'
                    : 'NO',

            'Scheme' =>
                $request->getScheme(),

            'Session driver' =>
                (string) config('session.driver'),

            'Session connection' =>
                (string) (
                    config('session.connection')
                    ?: config('database.default')
                ),

            'Session table' =>
                (string) config(
                    'session.table',
                    'sessions'
                ),

            'Cookie name' =>
                (string) $cookieName,

            'Cookie received' =>
                $request->hasCookie($cookieName)
                    ? 'YES'
                    : 'NO',

            'Session ID exists' =>
                ! empty($session->getId())
                    ? 'YES'
                    : 'NO',

            'CSRF token exists' =>
                strlen((string) $csrfToken) > 20
                    ? 'YES'
                    : 'NO',

            'Database connection' =>
                $dbOk
                    ? 'OK'
                    : 'FAILED',

            'Sessions table' =>
                $sessionsTableOk
                    ? 'FOUND'
                    : 'NOT FOUND',

            'Current session DB row' =>
                $sessionRowOk
                    ? 'FOUND'
                    : 'NOT FOUND',

            'Secure cookie' =>
                config('session.secure')
                    ? 'TRUE'
                    : 'FALSE',

            'Session domain' =>
                config('session.domain')
                    ?: 'NULL / NOT SET',

            'SameSite' =>
                (string) config(
                    'session.same_site',
                    'lax'
                ),
        ];

        $rows = '';

        foreach ($status as $label => $value) {
            $safeLabel = e($label);
            $safeValue = e($value);

            $rows .= "
                <tr>
                    <td>{$safeLabel}</td>
                    <td><strong>{$safeValue}</strong></td>
                </tr>
            ";
        }

        $safeToken = e($csrfToken);

        return response(
            <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>GPCS Session Test</title>

    <style>
        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f7fb;
            color: #172b4d;
            margin: 0;
            padding: 24px;
        }

        .box {
            max-width: 760px;
            margin: 20px auto;
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow:
                0 10px 35px
                rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
            color: #0a4a9c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        td {
            padding: 11px;
            border-bottom:
                1px solid #e5ebf3;
        }

        td:first-child {
            width: 55%;
        }

        button {
            border: 0;
            border-radius: 10px;
            padding: 13px 20px;
            background: #0a66d8;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .note {
            background: #eef6ff;
            border-radius: 10px;
            padding: 12px;
        }
    </style>
</head>

<body>

<div class="box">

    <h1>GPCS Portal Session Test</h1>

    <p class="note">
        Page ko ek baar refresh karo.
        Uske baad neeche
        <strong>Test CSRF</strong>
        button dabao.
    </p>

    <table>
        {$rows}
    </table>

    <form
        method="POST"
        action="/__gpcs/session-test"
    >

        <input
            type="hidden"
            name="_token"
            value="{$safeToken}"
        >

        <button type="submit">
            Test CSRF
        </button>

    </form>

</div>

</body>
</html>
HTML
        );
    }
);


\Illuminate\Support\Facades\Route::post(
    '/__gpcs/session-test',
    function (\Illuminate\Http\Request $request) {

        return response()->json([
            'result' => 'PASS',

            'message' =>
                'Laravel session and CSRF are working correctly.',

            'session_driver' =>
                config('session.driver'),

            'session_cookie' =>
                config('session.cookie'),

            'https' =>
                $request->isSecure(),
        ]);
    }
);
