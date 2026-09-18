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
</style>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>
<header aria-label="Admin navigation">
<strong>GPCS Admin</strong>
<a href="{{ route('admin.dashboard') }}">Dashboard</a>
<a href="{{ route('admin.users.index') }}">Users</a>
<a href="{{ route('admin.content.index','papers') }}">Papers</a>
<a href="{{ route('admin.content.index','notes') }}">Notes</a>
<a href="{{ route('admin.content.index','gallery') }}">Gallery</a>
<a href="{{ route('admin.notifications.index') }}">Notifications</a>
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
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        document.documentElement.style.visibility = 'hidden';
        window.location.reload();
    }
});
</script>
</body>
</html>
