# GPCS Portal

Production Laravel 12 portal for Government Polytechnic College, Shivpuri.

## Included modules
- Student/Faculty registration, login, forgot-password and reset-password.
- Hidden Admin entry with protected dashboard, moderation, notifications, reports, activity logs and account settings.
- Paper upload with Subject Master metadata lookup and exact duplicate protection.
- Notes upload with five mandatory academic fields: Branch, Semester, Year, Subject Name and Subject Code. Attachment is optional.
- Gallery uploads and moderation.
- Intervention Image compression with fail-safe original retention.
- iLovePDF compression with fail-safe original retention.
- Contact form.

## Upload limits
- One Paper file: 100 MiB maximum.
- One Notes attachment: 200 MiB maximum.
- Gallery image: 20 MiB maximum by default.

## Admin first login
`AdminSeeder` does not ship a working password in source code. Before first seeding, set `ADMIN_IDENTIFIER`, `ADMIN_EMAIL`, and a strong temporary `ADMIN_PASSWORD` in Railway. A suitable setup identity can be `GPCS-ADMIN` and `admin@example.com`; the password must be unique and supplied only as an environment variable. After the first successful Admin login, immediately change the Admin ID/password from Admin → Account Settings and remove or rotate the temporary seeding password variable.

## Composer lock
A fake `composer.lock` is not included. Railway/Composer resolves dependencies during build. Commit a genuine generated `composer.lock` after the first trusted resolution for reproducible later builds.

See `RAILWAY_DEPLOYMENT.md` for deployment steps and `QA_REPORT.txt` for verified checks and runtime limitations.

## Railway deployment
See `RAILWAY_DEPLOYMENT.md`. Current Railway defaults to Railpack; the repository also retains the requested Procfile/Nixpacks compatibility files.

## Admin bootstrap credentials
No working Admin password is hardcoded in source. `AdminSeeder` reads `ADMIN_IDENTIFIER`, `ADMIN_EMAIL`, and `ADMIN_PASSWORD` from environment. Example bootstrap placeholders are:

```text
ADMIN_IDENTIFIER=GPCS-ADMIN
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=<set-your-own-strong-temporary-password-12+-chars>
```

The ID/email are examples; the password must be your own strong temporary value. **Do not use a documented example password. Change the Admin ID/password immediately after the first successful login and rotate/remove bootstrap environment values.**

## Dependency lock
`composer.lock` is intentionally absent because a genuine dependency resolution was not available in this build environment. `composer.lock.NOT_INCLUDED.txt` explains this; Railway runs Composer during build.

## Front-end build
No Node/Vite build is required for deployment. The approved portal UI is delivered by `resources/views/portal.blade.php` and the production integration bridge is `public/assets/gpcs-backend-bridge.js`.

## Persistent uploads
Attach a Railway Volume at `/app/storage/app/public` before relying on Paper, Notes or Gallery uploads. See `RAILWAY_DEPLOYMENT.md`.
