# GPCS Portal college upgrade — 1 October 2026

## Initial audit

Source baseline: `05e7f1c04e1b31ef5575f60deb11a4cc7ca9df52` from `gpcsportal/GPCSPORTAL-`, main. Laravel 12, PHP 8.2+, Blade and MySQL/MariaDB; no frontend build tool required.

Existing folders: `app/Http/Controllers`, `app/Http/Middleware`, `app/Http/Requests`, `app/Models`, `app/Services`, `app/Support`, `bootstrap`, `config`, `database/migrations`, `database/seeders`, `public/assets`, `resources/views`, `routes`, `storage`, `tests`.

Existing public endpoints: `/`, `/index.php`, `/terms`, `/privacy`, `/auth/status`, `/auth/csrf`, login/registration/password recovery. Existing client views: home, papers, upload, notes, gallery, about, contact, login, student/faculty dashboards. Student and faculty forms include role selection, registration, password visibility, validation, recovery and login states. Paper and note metadata lookups, upload review, duplicate/storage controls, downloads and gallery are retained. Contact submission is authenticated. The retired chunk endpoint continues returning 410.

Existing Admin sections: dashboard, users, papers, notes, gallery, messages, subjects, settings, reports, logs, account; user activation/deletion, moderation, forms and paginated tables. Backend authorization, CSRF/session regeneration, password hashing, login rate limits, active-account checks, security headers and safe redirects were already present. No secrets or production database contents were imported into this upgrade.

### Confirmed issues and fixes

| Finding | Fix | File |
|---|---|---|
| Dynamic client route content was outside the main landmark | Correct main boundary, named skip target | `resources/views/portal.blade.php` |
| Campus PNG was 2,854,631 bytes | Preserve original; add 311,694-byte WebP for new campus displays (89% smaller), intrinsic dimensions and loading hints | `public/assets/gpcs-campus.webp`, college views |
| College information lacked distinct crawlable routes and metadata | Add public college routes, titles, descriptions, canonical/OG tags, structured data and sitemap | `CollegeController.php`, `routes/web.php`, college views |
| Many large head style blocks duplicated document payload for each visit | Extract compatibility CSS, remove unreferenced selectors with dynamic-state safeguards, minify into a cacheable asset | `public/assets/gpcs-portal.css`, portal view |
| Mobile clock caused document overflow at 360px | Allow utility text to wrap; constrain decorative sign-in glow | `public/assets/gpcs-college.css` |
| Quick Access subtitle contrast failed AA | Darker subtitle text | `public/assets/gpcs-college.css` |
| Horizontal statistics strip was not keyboard-focusable | Add focus target and descriptive label | portal view |
| Shared inner-page theme control needed the original behaviour | Extract and reuse original theme logic | `public/assets/gpcs-theme.js`, college layout |
| Absolute shared-header legacy links needed client navigation compatibility | Accept both historical relative and root-relative portal links | portal view |
| Admin tables lacked quick row filtering and sorting | Add current-page sort buttons and a modal row filter; preserve original server pagination and action positions | admin layout, `gpcs-college.js` |
| Dependency audit flagged two advisories in the existing CommonMark 2.10.1 lock | Upgrade CommonMark to 2.10.3 and its compatible PHP 8.0 polyfill; audit now reports no advisories | `composer.lock` |
| New search dialog conflicted with legacy Escape handling | Explicit dialog Escape/cancel handling | `gpcs-college.js` |

Live hosting audit: `https://gpcsportal.up.railway.app` returned Railway fallback 404 on 1 October 2026. Latest listed web deployments were REMOVED; this predates these changes. Railway still uses main and Wait-for-CI (`checkSuites`) is true. Hosting, volume size, environment values and deployment state were not mutated.

## Final folder additions

```text
app/Http/Controllers/CollegeController.php
config/college.php
public/assets/
  gpcs-campus.webp
  gpcs-campus-480.webp
  gpcs-campus-800.webp
  gpcs-logo.webp
  gpcs-college.css
  gpcs-college.js
  gpcs-portal.css
  gpcs-theme.js
resources/css/gpcs-portal.css
resources/views/college/
  header.blade.php
  hero.blade.php
  home-sections.blade.php
  programmes.blade.php
  faq.blade.php
  layout.blade.php
  page.blade.php
  sitemap.blade.php
tests/Feature/CollegePublicPagesTest.php
tools/college-qa/
  package.json
  package-lock.json
  audit.cjs
  build-css.cjs
.github/workflows/college-browser-qa.yml
docs/COLLEGE_UPGRADE.md
```

Modified existing files: `.gitignore`, `public/robots.txt`, `resources/views/portal.blade.php`, `resources/views/admin/layout.blade.php`, `routes/web.php`, `tests/Feature/LaunchReadinessAuditTest.php`, `composer.lock`. The full source bundle includes complete files at these exact repository-relative paths.

## Run instructions

Requirements: PHP 8.2+ with the extensions declared in `composer.json`, Composer, MySQL/MariaDB or SQLite for isolated development. Use existing production environment values; do not generate a replacement production application key.

For a fresh local installation only:

```bash
composer install --prefer-dist --no-interaction
cp .env.example .env
php artisan key:generate
# Set APP_URL and database settings in the local .env.
php artisan migrate
php artisan db:seed --class=SubjectMasterSeeder
php artisan serve
```

For an existing installation, retain `.env`, database and uploaded files; install dependencies from the updated lock file and run `php artisan optimize:clear`. This upgrade adds no database migration and requires no production data changes. Production Admin provisioning continues using the existing environment-based mechanism.

New pages: `/about`, `/departments`, `/programmes/{cs|me|ee|et}`, `/admissions`, `/faculty`, `/facilities`, `/placements`, `/notices`, `/gallery`, `/contact`, `/faq`, `/sitemap.xml`. Existing `/#gallery`, `/#contact` and all original portal/APIs remain intact. Public information routes do not expose account details, unapproved uploads or protected APIs.

Run tests with an isolated test database as the existing workflow does:

```bash
php artisan test
npm ci --prefix tools/college-qa
cd tools/college-qa && npx playwright install --with-deps chromium firefox webkit
# Start the local Laravel server in another terminal, then from repository root:
node tools/college-qa/audit.cjs
```

The browser audit writes development screenshots/results to ignored `qa-artifacts/`. QA packages are development tooling, never served to users.

## Changelog and locked behaviour

Added the campus hero, admission guidance, public page search, programme cards, campus/faculty/placement information states, FAQs and college navigation. Added semantic page metadata and reusable header, programme and FAQ partials. New pages use local system body typography and a serif heading font, with explicit focus states, reduced-motion support and responsive layouts.

Preserved the original Student Login navigation slot, GPCS Sign In control, Student/Faculty selector and form layouts, hidden Admin entry, Admin navigation order/dashboard layout and row action positions. Kept all original form endpoints, APIs, routes, authentication/data flows, upload limits (papers up to 100 MB, notes up to 200 MB), moderation, storage limits and settings. Digital Board routes/table/UI remain removed. The Notices page is an informational page, not a resurrected Digital Board.

Admin row search/sort is explicitly restricted to rows on the current server page. Server pagination and the original backend ordering remain authoritative. It does not pretend to search the entire database.

## Missing information and neutral choices

Current fee schedules, admission dates/application destination, intake/duration/eligibility, verified helpline/email, named faculty profiles, placement statistics, recruiter logos and student/alumni stories were not supplied. The site uses clear information states and enquiries rather than invented facts. Apply Now leads to admissions guidance, not a fabricated application form. The map is an external campus search link, avoiding a third-party embedded tracker or a CSP change. Programme titles expand the existing CS/ME/EE/ET branch codes; college staff should confirm current course titles and availability. AICTE/RGPV text and Chhatri Road location come from the existing About content; current approval documents were not independently verified.

The locked existing header remains in place with additive college navigation. No claim of a complete layout redesign is made. Original compatibility CSS is retained because existing portal selectors and dynamically rendered views still depend on it.

## Final verification

- Laravel/PHP regression suite: 69 tests and 525 assertions passed, including original authentication, logout, access control, metadata, moderation, storage and upload checks plus new public-page tests.
- Chromium 153: 48 page/viewport combinations passed (12 pages × 360/768/1024/1440 px), with no page horizontal overflow, loaded-image failures or console errors/warnings.
- Automated axe WCAG A/AA scans passed on all 12 pages at 360 and 1440 px. This is automated coverage, not a claim of a manual assistive-technology certification.
- Search filtering/Escape close and Student-to-Faculty selector interactions passed.
- PHP syntax, JavaScript syntax, Blade compilation, route boot and Composer validation passed.
- Desktop/mobile screenshots inspected visually.
- Firefox/WebKit browser verification is configured in the draft PR workflow; its result is reported separately. Actual Edge and Safari devices have not been tested locally. Public outbound third-party destinations, real production account journeys, MySQL runtime and mail delivery were not exercised against production. Existing backend tests use isolated SQLite.
- Live deployment is blocked by the pre-existing Railway fallback 404; this source upgrade has not been deployed.

Final mobile Lighthouse (local isolated PHP preview, Chromium): Performance 90, Accessibility 100, Best Practices 100, SEO 100. These are lab results, not production guarantees. Smaller responsive campus sources and a thumbnail logo are served; the original high-resolution logo is fetched only when its preview is opened. Original PNG and full-resolution logo assets remain available.

The readable compatibility stylesheet is `resources/css/gpcs-portal.css`; regenerate the shipped asset from the repository root with `node tools/college-qa/build-css.cjs` after `npm ci --prefix tools/college-qa`. Re-run the browser audit whenever selectors or styles change. There is no build step required to run the delivered application.

Dependency security: CI identified [GHSA-97jj-33gv-5xf9](https://github.com/thephpleague/commonmark/security/advisories/GHSA-97jj-33gv-5xf9) and [GHSA-3q6v-r5mr-hxv8](https://github.com/thephpleague/commonmark/security/advisories/GHSA-3q6v-r5mr-hxv8) affecting the original CommonMark 2.10.1 dependency. The compatible patch update locks CommonMark 2.10.3 and symfony/polyfill-php80 1.43.0; Composer audit reports no advisories. This does not establish that the portal was previously exploited.

WebKit CI exposed that the existing CSP upgraded assets to HTTPS even on a plain HTTP development server. Apply `upgrade-insecure-requests` only to secure requests; production HTTPS retains the directive. Ambient decorations are also bounded inside the viewport.

Additional isolated-browser checks: all 11 Admin sections returned 200 and passed automated WCAG A/AA scans. Admin current-page row filtering and sorting were exercised successfully using disposable SQLite QA accounts. Student and Faculty Sign In scans passed at both 360 and 1440 px. No production accounts or credentials were used.
