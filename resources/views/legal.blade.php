<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#0a2558">
<meta name="robots" content="index,follow">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<title>{{ $title }} — GPCS Portal</title>
<style>
*{box-sizing:border-box}body{margin:0;background:#f5f8fc;color:#142b4a;font-family:system-ui,-apple-system,"Segoe UI",sans-serif;line-height:1.65}.wrap{width:min(calc(100% - 28px),860px);margin:0 auto;padding:32px 0 56px}.card{background:#fff;border:1px solid #dbe4ef;border-radius:18px;padding:clamp(20px,4vw,34px);box-shadow:0 16px 42px rgba(13,42,95,.07)}h1{margin:0 0 8px;color:#0a2558}h2{margin:26px 0 8px;font-size:1.06rem;color:#163a70}p,li{color:#42526c}.back{display:inline-flex;min-height:44px;align-items:center;margin-bottom:16px;padding:9px 13px;border-radius:10px;background:#0a2558;color:#fff;text-decoration:none;font-weight:800}:focus-visible{outline:3px solid #2563eb;outline-offset:3px}
</style>
</head>
<body>
<main class="wrap">
<a class="back" href="{{ route('portal.home') }}">← Back to GPCS Portal</a>
<article class="card">
<h1>{{ $title }}</h1>
<p>{{ $intro }}</p>
@foreach($sections as $section)
<h2>{{ $section['heading'] }}</h2>
@if(isset($section['body']))<p>{{ $section['body'] }}</p>@endif
@if(isset($section['items']))
<ul>
@foreach($section['items'] as $item)<li>{{ $item }}</li>@endforeach
</ul>
@endif
@endforeach
</article>
</main>
</body>
</html>
