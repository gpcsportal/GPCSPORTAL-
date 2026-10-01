<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#0a2558">
<title>{{ $title }} — Government Polytechnic College, Shivpuri</title><meta name="description" content="{{ $description }}"><link rel="canonical" href="{{ url()->current() }}"><meta property="og:title" content="{{ $title }} — GPCS Portal"><meta property="og:description" content="{{ $description }}"><meta property="og:url" content="{{ url()->current() }}"><meta property="og:type" content="website"><meta property="og:image" content="{{ url('/assets/gpcs-campus.webp') }}"><link rel="icon" href="/favicon.svg"><link rel="stylesheet" href="/assets/gpcs-portal.css?v=20261001"><link rel="stylesheet" href="/assets/gpcs-college.css?v=20261001"><script src="/assets/gpcs-college.js?v=20261001" defer></script>
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'EducationalOrganization','name'=>config('college.name'),'url'=>url('/'),'address'=>['@type'=>'PostalAddress','streetAddress'=>'Chhatri Road','addressLocality'=>'Shivpuri','addressRegion'=>'Madhya Pradesh','addressCountry'=>'IN']], JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_SLASHES) !!}</script>
</head><body class="college-page">
<a class="college-skip" href="#main-content">Skip to main content</a>
@include('college.header', ['collegeInnerPage' => true])
<script src="/assets/gpcs-theme.js?v=20261001"></script>
<main id="main-content" tabindex="-1"><section class="college-page-hero"><div class="college-shell"><nav aria-label="Breadcrumb"><a href="/">Home</a> / <span aria-current="page">{{ $title }}</span></nav><p class="college-eyebrow">Government Polytechnic College, Shivpuri</p><h1>{{ $title }}</h1><p>{{ $description }}</p></div></section>@yield('content')</main>
<footer class="college-footer"><div class="college-shell"><strong>{{ config('college.name') }}</strong><p>{{ config('college.address') }}</p><nav aria-label="Footer">@foreach(['about'=>'About','departments'=>'Academics','admissions'=>'Admissions','contact'=>'Contact','faq'=>'FAQ','privacy'=>'Privacy','terms'=>'Terms'] as $slug=>$label)<a href="/{{ $slug }}">{{ $label }}</a>@endforeach</nav><small>© {{ date('Y') }} GPCS Portal</small></div></footer>
</body></html>
