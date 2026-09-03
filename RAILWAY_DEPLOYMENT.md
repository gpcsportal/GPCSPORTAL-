# GPCS Portal — Railway Deployment

## Builder / start command
Railway currently defaults new services to **Railpack**. This repository includes `railway.json` with `RAILPACK` as the current builder. `Procfile` and `nixpacks.toml` are retained only for requested legacy Nixpacks compatibility.

The application start command is:

```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

`$PORT` is supplied by Railway; do not hardcode a port. The Railway start command also sets `PHPRC=/app/php.ini` so PHP accepts the approved 100 MiB Paper / 200 MiB Notes limits (with multipart overhead). If a new Railway service ignores/deprecates Config-as-Code, put the same command in **Service → Settings → Deploy → Start Command**.

## MySQL variables
Add Railway's MySQL service and map the app service variables:

```text
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

If the database service is renamed, replace `MySQL` with its Railway service name. `config/database.php` also supports direct `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, and `MYSQLPASSWORD` fallbacks.

## Required application variables
Set `APP_KEY` with a real Laravel key, `APP_URL` to the Railway public domain, and configure SMTP plus iLovePDF keys when those features are required. Never commit real credentials. Generate a key locally or in a trusted Laravel environment with `php artisan key:generate --show`, then paste the returned value into Railway `APP_KEY`.

## Database setup
For current Railway, configure the **Pre-deploy Command** in the service dashboard as:

```bash
php artisan migrate --force && php artisan db:seed --class=SubjectMasterSeeder --force
```

The Subject Master seeder is idempotent and loads the verified 141-row academic database.


## Persistent uploads — required
Paper, Notes and Gallery files use Laravel's `public` filesystem disk. Railway deployment filesystems are ephemeral, so attach a **Railway Volume** to the app service at:

```text
/app/storage/app/public
```

Without this volume, uploaded files can disappear on redeploy. After the volume is attached and the first deployment is healthy, run `php artisan storage:link` once from the running service shell.

## Logging
The production example uses `LOG_CHANNEL=stderr` so Laravel logs are visible in Railway deployment logs rather than depending on ephemeral log files.

## Public storage link
`storage:link` changes the deployment filesystem, so do **not** rely on it as a pre-deploy database command. After the first successful deployment, run once from Railway's service shell:

```bash
php artisan storage:link
```

If the symlink is already present Laravel will report that instead of recreating it.

## Admin bootstrap
Before intentionally running `AdminSeeder`, set strong values for `ADMIN_IDENTIFIER`, `ADMIN_EMAIL`, and `ADMIN_PASSWORD` (minimum 12 characters). Then run:

```bash
php artisan db:seed --class=AdminSeeder --force
```

Sign in through the hidden Admin entry and change the temporary Admin credentials immediately. Remove/rotate the bootstrap environment values afterward.

## Composer lock
No fabricated `composer.lock` is included. Railway resolves dependencies during build with Composer. For reproducible future builds, generate a genuine lock file in a trusted Composer-enabled environment and commit that genuine file.
