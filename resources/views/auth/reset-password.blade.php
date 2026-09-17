<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a2558">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<title>Reset Password — GPCS Portal</title>
<style>
*{box-sizing:border-box}body{font-family:system-ui,-apple-system,"Segoe UI",sans-serif;background:#eef4fb;margin:0;display:grid;min-height:100vh;place-items:center;padding:18px;color:#142b4a}.card{width:min(100%,430px);background:#fff;padding:28px;border-radius:20px;box-shadow:0 20px 60px #1232}.card h1{margin-top:0}label{display:block;margin:14px 0;font-weight:700}input{width:100%;padding:12px;border:1px solid #ccd8e8;border-radius:10px;min-height:44px;font:inherit;font-size:16px}button{width:100%;min-height:46px;padding:12px;border:0;border-radius:10px;background:#1268e8;color:#fff;font:inherit;font-weight:800;cursor:pointer}.error{color:#b42318;background:#fff1f2;border:1px solid #fecdd3;padding:10px;border-radius:10px}:focus-visible{outline:3px solid #2563eb;outline-offset:3px}@media(max-width:420px){.card{padding:20px;border-radius:16px}}
</style>
</head>
<body>
<form class="card" method="POST" action="{{ route('password.update') }}">
@csrf
<h1>Reset Password</h1>
@if($errors->any())<div class="error" role="alert">{{ $errors->first() }}</div>@endif
<input type="hidden" name="token" value="{{ $token }}">
<label>Email<input type="email" name="email" value="{{ old('email',$email) }}" autocomplete="email" required></label>
<label>New Password<input type="password" name="password" minlength="8" autocomplete="new-password" required></label>
<label>Confirm Password<input type="password" name="password_confirmation" minlength="8" autocomplete="new-password" required></label>
<button type="submit">Reset Password</button>
</form>
</body>
</html>
