<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a2558">
<meta name="robots" content="noindex,nofollow">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<title>@yield('title','Admin') — GPCS Portal</title>
<style>
*{box-sizing:border-box}html{color-scheme:light;max-width:100%}.skip-link{position:fixed;z-index:1000;top:8px;left:8px;transform:translateY(-160%);padding:10px 14px;border-radius:8px;background:#fff;color:#0a2558;font-weight:800;text-decoration:none;box-shadow:0 8px 24px rgba(0,0,0,.2)}.skip-link:focus{transform:translateY(0)}body{font-family:system-ui,-apple-system,"Segoe UI",sans-serif;margin:0;background:#f5f8fc;color:#142b4a;line-height:1.5;max-width:100%;overflow-x:hidden}a{color:inherit}header{background:#0a2558;color:white;padding:12px 18px;display:flex;gap:10px;align-items:center;flex-wrap:wrap;position:sticky;top:0;z-index:30;max-width:100%}header strong{margin-right:6px}header a{color:white;text-decoration:none;font-weight:700;padding:9px 10px;border-radius:8px;min-height:44px;display:inline-flex;align-items:center}header a:hover,header a:focus-visible{background:rgba(255,255,255,.12)}header form{margin-left:auto}.wrap{width:min(calc(100% - 32px),1200px);margin:auto;padding:24px 0;min-width:0}.card{background:white;border:1px solid #dbe4ef;border-radius:14px;padding:18px;margin-bottom:18px;overflow-wrap:anywhere;min-width:0}.table-wrap{max-width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;overscroll-behavior-inline:contain;scrollbar-gutter:stable}table{width:100%;border-collapse:collapse;min-width:620px}th,td{padding:10px;border-bottom:1px solid #e6edf5;text-align:left;vertical-align:top;overflow-wrap:anywhere}button,.btn{display:inline-flex;align-items:center;justify-content:center;border:0;border-radius:8px;padding:10px 13px;min-height:44px;max-width:100%;background:#1268e8;color:white;text-decoration:none;font-weight:700;cursor:pointer}.danger{background:#b42318}.logout-btn{background:#b42318}.logout-btn:hover,.logout-btn:focus-visible{background:#8f1c13}.muted{color:#63758f}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(min(180px,100%),1fr));gap:14px;min-width:0}.grid>*{min-width:0}.metric strong{font-size:1.8rem}.status{padding:3px 8px;border-radius:999px;background:#eef3f8}input,select,textarea{width:100%;max-width:100%;padding:11px;border:1px solid #ccd8e8;border-radius:8px;font:inherit;font-size:16px;min-height:44px}textarea{min-height:110px;resize:vertical}label{display:block;margin:12px 0;font-weight:700;min-width:0}.flash{background:#e8f7ee;color:#176b36;padding:10px;border-radius:8px;margin-bottom:15px;overflow-wrap:anywhere}:focus-visible{outline:3px solid #67a6ff;outline-offset:2px}
@media(max-width:1024px){header{flex-wrap:nowrap;overflow-x:auto;overflow-y:hidden;-webkit-overflow-scrolling:touch;overscroll-behavior-inline:contain;scrollbar-width:none}header::-webkit-scrollbar{display:none}header strong,header a,header form{flex:0 0 auto}header form{margin-left:0}.wrap{width:min(calc(100% - 28px),1200px);padding:18px 0}.grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:599px){header{position:sticky;padding:max(8px,env(safe-area-inset-top)) 10px 8px;gap:6px}header a,header button{min-height:44px;padding:9px 10px}.wrap{width:calc(100% - 20px);padding:12px 0}.card{padding:14px;border-radius:12px}.grid{grid-template-columns:minmax(0,1fr)}table{min-width:600px}button,.btn{min-height:44px}input,select,textarea{min-height:46px}}
@media(max-width:360px){.wrap{width:calc(100% - 14px)}.card{padding:12px}}
@media(min-width:1280px){.wrap{width:min(calc(100% - 48px),1200px)}header{padding-inline:max(18px,calc((100vw - 1240px)/2))}}
@media print{header,button,.btn{display:none!important}.wrap{width:100%;max-width:none;padding:0}.card{border:0;box-shadow:none}body{background:#fff;color:#000}table{min-width:0}}

/* UPDATED: centralized institutional palette and interaction polish; dimensions/layout unchanged. */
:root{
  --admin-primary:#0a2558;
  --admin-primary-hover:#12366f;
  --admin-accent:#1268e8;
  --admin-accent-hover:#0f5fcf;
  --admin-bg:#f5f8fc;
  --admin-surface:#ffffff;
  --admin-text:#142b4a;
  --admin-muted:#63758f;
  --admin-line:#dbe4ef;
  --admin-line-soft:#e6edf5;
  --admin-success-bg:#e8f7ee;
  --admin-success:#176b36;
  --admin-error-bg:#fff1f2;
  --admin-error:#9f1239;
  --admin-danger:#b42318;
  --admin-danger-hover:#8f1c13;
  --admin-focus:#67a6ff;
  --admin-shadow:0 8px 22px rgba(15,42,80,.055);
}
body{background:var(--admin-bg);color:var(--admin-text)}
header{background:var(--admin-primary)}
header a,button,.btn,input,select,textarea{transition:background-color .16s ease,border-color .16s ease,color .16s ease,box-shadow .16s ease,opacity .16s ease}
.card{background:var(--admin-surface);border-color:var(--admin-line);box-shadow:var(--admin-shadow)}
th{background:#f8fbff;color:#294868;font-size:.78rem;letter-spacing:.015em;font-weight:800}
tbody tr:hover td{background:#fbfdff}
th,td{border-bottom-color:var(--admin-line-soft)}
button,.btn{background:var(--admin-accent)}
button:hover,.btn:hover{background:var(--admin-accent-hover)}
.danger,.logout-btn{background:var(--admin-danger)}
.danger:hover,.danger:focus-visible,.logout-btn:hover,.logout-btn:focus-visible{background:var(--admin-danger-hover)}
.muted{color:var(--admin-muted)}
.status{background:#eef3f8;color:#3a526d}
input,select,textarea{background:#fff;color:var(--admin-text);border-color:#ccd8e8}
input:hover,select:hover,textarea:hover{border-color:#aec3dd}
input:focus,select:focus,textarea:focus{outline:0;border-color:var(--admin-accent);box-shadow:0 0 0 3px rgba(18,104,232,.14)}
.flash{background:var(--admin-success-bg);color:var(--admin-success);border:1px solid rgba(23,107,54,.12)}
.flash.error{background:var(--admin-error-bg);color:var(--admin-error);border-color:#fecdd3}
button:disabled,.btn[aria-disabled="true"]{opacity:.58;cursor:not-allowed;box-shadow:none}
form[aria-busy="true"] button[type="submit"]{cursor:progress}
:focus-visible{outline:3px solid var(--admin-focus);outline-offset:2px}
.table-wrap{scrollbar-color:#a9bdd6 transparent;scrollbar-width:thin}
.table-wrap::-webkit-scrollbar{height:8px}
.table-wrap::-webkit-scrollbar-thumb{background:#a9bdd6;border-radius:999px}
.table-wrap::-webkit-scrollbar-track{background:transparent}
@media(prefers-reduced-motion:reduce){
  header a,button,.btn,input,select,textarea{transition:none}
}
</style>
<script src="/assets/gpcs-college.js?v=20261001" defer></script>
<style>.college-table-sort{background:transparent;color:#294868;padding:0;min-height:24px;justify-content:flex-start}.college-table-sort:hover{background:transparent;color:#075985}.college-table-dialog{width:min(460px,calc(100% - 32px));padding:24px;border:1px solid #dbe4ef;border-radius:14px}.college-table-dialog::backdrop{background:#142b4a88}.college-table-filter{margin:0 0 14px;max-width:380px}th[aria-sort=ascending] button:after{content:" ↑"}th[aria-sort=descending] button:after{content:" ↓"}</style>
</head>
<body data-college-admin>
<a class="skip-link" href="#main-content">Skip to main content</a>
<header aria-label="Admin navigation">
<strong>GPCS Admin</strong>
<a href="{{ route('admin.dashboard') }}">Dashboard</a>
<a href="{{ route('admin.users.index') }}">Users</a>
<a href="{{ route('admin.content.index','papers') }}">Papers</a>
<a href="{{ route('admin.content.index','notes') }}">Notes</a>
<a href="{{ route('admin.content.index','gallery') }}">Gallery</a>
<a href="{{ route('admin.content.index','messages') }}">Messages</a>
<a href="{{ route('admin.subjects.index') }}">Subjects</a>
<a href="{{ route('admin.settings.edit') }}">Settings</a>
<a href="{{ route('admin.reports.index') }}">Reports</a>
<a href="{{ route('admin.logs.index') }}">Logs</a>
<a href="{{ route('admin.account.edit') }}">Account</a>
<form method="POST" action="{{ route('admin.logout') }}" aria-label="Admin logout">@csrf<button class="logout-btn" type="submit">Logout</button></form>
</header>
<main class="wrap" id="main-content">
@if(session('status'))<div class="flash" role="status">{{ session('status') }}</div>@endif
@yield('content')
</main>
<script>
/* UPDATED: preserve the existing BFCache logout protection. */
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        document.documentElement.style.visibility = 'hidden';
        window.location.reload();
    }
});

/* UPDATED: prevent accidental double-submit without changing any form action or button position. */
document.addEventListener('submit', function (event) {
    if (event.defaultPrevented) return;

    const form = event.target;
    if (!(form instanceof HTMLFormElement)) return;

    if (form.dataset.submitting === '1') {
        event.preventDefault();
        return;
    }

    form.dataset.submitting = '1';
    form.setAttribute('aria-busy', 'true');

    const submitter = event.submitter;
    if (submitter instanceof HTMLButtonElement) {
        submitter.disabled = true;
        submitter.setAttribute('aria-disabled', 'true');
    }
});
</script>
</body>
</html>
