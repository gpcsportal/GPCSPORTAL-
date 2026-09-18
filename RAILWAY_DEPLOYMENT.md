# GPCS Portal — Railway Deployment

## Builder and start command

The production web service uses **Railpack** and this repository keeps the deploy settings in `railway.json`.

`deploy.startCommand` is intentionally `null`. That means Railway/Railpack should use its detected Laravel start command instead of overriding it with the development server (`php artisan serve`). For the current Railpack PHP image this starts the production FrankenPHP/Caddy runtime.

Railway injects the `PORT` variable automatically. The detected Railpack runtime binds the service on Railway's injected port and on all container interfaces; do not hardcode a port and do not force a localhost-only listener.

The repository health check is:

```text
/up
```

Laravel owns this endpoint and it is intentionally outside the portal login wall so Railway can receive a `2xx` response before routing production traffic to a new deployment.

## Pre-deploy command

The repository runs these commands before a new release becomes active:

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan db:seed --class=SubjectMasterSeeder --force
```

The Subject Master seeder is idempotent. Pre-deploy commands must not depend on the persistent upload volume because Railway runs them in a separate pre-deploy container.

## MySQL variables

Attach Railway's MySQL service and map the application variables:

```text
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

If the database service is renamed, replace `MySQL` with its Railway service name. `config/database.php` also supports Railway's direct `MYSQLHOST`, `MYSQLPORT`, `MYSQLDATABASE`, `MYSQLUSER`, and `MYSQLPASSWORD` fallbacks.

The Laravel MySQL connection explicitly uses native prepared statements and disables PHP persistent PDO sockets. This keeps SQL parameterization native and avoids unmanaged persistent connections in long-lived application workers.

## Required application variables

Set `APP_ENV=production`, `APP_DEBUG=false`, a real `APP_KEY`, and the public `APP_URL`. Configure SMTP and iLovePDF credentials only in Railway variables. Never commit real credentials or a production `.env` file.

Generate an application key in a trusted Laravel environment with:

```bash
php artisan key:generate --show
```

## Persistent uploads

Paper, Notes, Gallery, and profile files use Laravel's `public` filesystem disk. Railway deployment filesystems are ephemeral, so the web service must keep its persistent volume mounted at:

```text
/app/storage/app/public
```

Do not move this mount without migrating existing uploaded files first.

## Protected upload storage

Do **not** run `php artisan storage:link` for this portal. Paper, Notes, Gallery and profile uploads are intentionally delivered through authenticated Laravel routes so the login wall cannot be bypassed with a direct `/storage/...` URL.

The persistent Railway volume still mounts at:

```text
/app/storage/app/public
```

The directory name is retained for compatibility with the existing application and volume, but it must not be symlinked into `public/storage`.

## Database backup / recovery

The MySQL volume contains production account, moderation, session, notification and content metadata. Before public launch, enable and verify a Railway database backup / point-in-time recovery policy appropriate for the production plan, and test a restore procedure with non-production data.

Do not replace this with an ad-hoc destructive database command or an unverified dump job. Backup/PITR settings are infrastructure state and should be reviewed in Railway before applying any staged environment change.

## Logging

Production should use stderr-compatible Laravel logging so application exceptions are visible in Railway deployment logs rather than relying on ephemeral local log files.

## Admin bootstrap

Before intentionally running `AdminSeeder`, set strong values for `ADMIN_IDENTIFIER`, `ADMIN_EMAIL`, and `ADMIN_PASSWORD` (minimum 12 characters). Then run:

```bash
php artisan db:seed --class=AdminSeeder --force
```

Change temporary bootstrap credentials after first use and rotate/remove bootstrap values when they are no longer required.

## Composer lock

A genuine `composer.lock` is committed and must remain committed. Production builds use `composer install` from the lock file so dependency versions are reproducible.

## Railway Config-as-Code lifecycle

Railway has deprecated legacy `railway.json` / `railway.toml` Config-as-Code for future services and documents a hard cutoff for existing Config-as-Code on **2026-12-01**. The current production service is healthy and its dashboard settings match this repository, so no risky infrastructure migration is performed automatically here. Migrate the service to Railway Infrastructure-as-Code before that cutoff and verify the generated deployment plan before applying it.
