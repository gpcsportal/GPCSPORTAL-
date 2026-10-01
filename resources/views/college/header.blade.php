<div aria-label="College information" class="portal-utility-strip">
<div class="container portal-utility-inner">
<span class="utility-item"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11Z"></path><circle cx="12" cy="10" r="2"></circle></svg> Shivpuri, Madhya Pradesh</span>
<span aria-hidden="true" class="utility-divider"></span>
<span class="utility-item utility-motto"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="m3 9 9-5 9 5-9 5z"></path><path d="M7 12v4c3 2 7 2 10 0v-4M21 9v6"></path></svg> Knowledge <b>•</b> Skills <b>•</b> Better Future</span>
<span class="utility-spacer"></span>
<span class="utility-item utility-clock"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg> <span class="live-portal-clock" data-live-portal-clock aria-live="off" title="Current time in Shivpuri, Madhya Pradesh"></span></span>

</div>
</div>
<header class="site-header reference-header">
<div class="container header-row reference-header-row">
<a aria-label="GPCS Portal home" class="brand reference-brand" href="/index.php?page=home">
<span class="brand-mark brand-logo-mark logo-interactive" @unless($collegeInnerPage ?? false) role="button" tabindex="0" aria-label="View GPCS Portal logo. Double tap for GPCS Sign In." title="Tap to view logo • Double tap for GPCS Sign In" @endunless><img alt="" src="/assets/gpcs-logo.webp" width="160" height="118"/></span>
<span class="brand-copy"><strong>GPCS Portal</strong><small>Government Polytechnic College, Shivpuri</small></span>
</a>
<div aria-label="Portal utilities" class="header-tools">
<button aria-label="Change theme" class="theme-cycle-btn reference-theme-btn" data-theme-cycle="" title="Theme: System" type="button">
<span aria-hidden="true" class="theme-cycle-halo"></span>
<span aria-hidden="true" class="theme-cycle-icon" data-theme-cycle-icon="light"><svg viewbox="0 0 24 24"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42"></path></svg></span>
<span aria-hidden="true" class="theme-cycle-icon" data-theme-cycle-icon="dark"><svg viewbox="0 0 24 24"><path d="M20.5 14.2A8.5 8.5 0 0 1 9.8 3.5 8.5 8.5 0 1 0 20.5 14.2Z"></path></svg></span>
<span aria-hidden="true" class="theme-cycle-icon" data-theme-cycle-icon="system"><svg viewbox="0 0 24 24"><rect height="12" rx="2" width="18" x="3" y="4"></rect><path d="M8 20h8M12 16v4"></path></svg></span>
<span class="theme-cycle-label" data-theme-cycle-label="">System</span>
</button>
@auth
<form method="POST" action="{{ route('portal.logout') }}" class="gpcs-logout-form" data-gpcs-logout-form>
@csrf
<button aria-label="Logout from GPCS Portal" class="gpcs-logout-btn" type="submit">
<span aria-hidden="true" class="signin-icon-shell"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M10 5H5v14h5"></path><path d="M14 8l4 4-4 4M18 12H9"></path></svg></span>
<span class="logout-label-full">Logout</span>
<span class="logout-label-short">Exit</span>
</button>
</form>
@else
<a aria-label="GPCS Sign In" class="gpcs-signin-btn reference-signin" href="/index.php?page=login">
<span aria-hidden="true" class="signin-glow"></span>
<span aria-hidden="true" class="signin-icon-shell"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20a7 7 0 0 1 14 0"></path></svg></span>
<span class="signin-copy"><span><span class="signin-label-full">GPCS Sign In</span><span class="signin-label-short">Sign In</span></span><small>Student access</small></span>
<span aria-hidden="true" class="signin-arrow">→</span>
</a>
@endauth
</div>
</div>
<div class="container topbar-shell reference-nav-shell">
<nav aria-label="Main navigation" class="main-nav top-action-bar reference-nav">
<a class="nav-link nav-important active" href="/index.php?page=home"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"></path><path d="M5.5 10.5V20h13v-9.5"></path><path d="M9.5 20v-5h5v5"></path></svg></span><span>Home</span></a>
<a class="nav-link nav-student nav-external" href="{{ route('portal.outbound','student') }}" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20a7 7 0 0 1 14 0"></path></svg></span><span>Student Login</span></a>
<a class="nav-link nav-academic nav-external" href="{{ route('portal.outbound','syllabus') }}" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"></path></svg></span><span>Syllabus</span></a>
<a class="nav-link nav-library" href="/index.php?page=papers"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 4h11a3 3 0 0 1 3 3v12H8a3 3 0 0 1-3-3z"></path><path d="M8 19a3 3 0 0 0 0-6h11"></path><path d="M8 7h7M8 10h6"></path></svg></span><span>Paper Library</span></a>
<a class="nav-link nav-previous nav-external" href="{{ route('portal.outbound','previous') }}" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="15" rx="2" width="17" x="3.5" y="5"></rect><path d="M7 3v4M17 3v4M3.5 9.5h17"></path></svg></span><span>Previous Year Paper</span></a>
<a class="nav-link nav-upload" href="/index.php?page=login"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><span>Upload Paper</span><span aria-hidden="true" class="nav-upload-arrow">→</span></a>
<a class="nav-link nav-result nav-external" href="{{ route('portal.outbound','main-result') }}" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M8 4h8v4a4 4 0 0 1-8 0z"></path><path d="M8 6H4v1a4 4 0 0 0 4 4M16 6h4v1a4 4 0 0 1-4 4M12 12v4M8.5 20h7M10 16h4"></path></svg></span><span>Main Result</span></a>
<a class="nav-link nav-result nav-external" href="{{ route('portal.outbound','all-result') }}" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 20V10M12 20V4M19 20v-7"></path></svg></span><span>All Result</span></a>
<a class="nav-link nav-notes" href="/index.php?page=notes"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><span>Notes</span></a>
<a class="nav-link nav-more" href="/index.php?page=gallery"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="4"></rect><circle cx="9" cy="9" r="2"></circle><path d="m5 18 5-5 3 3 2-2 4 4"></path></svg></span><span>Gallery</span></a>
<a class="nav-link nav-more" href="/index.php?page=about"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 11v6M12 7h.01"></path></svg></span><span>About Us</span></a>
<a class="nav-link nav-more" href="/index.php?page=contact"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="14" rx="2" width="18" x="3" y="5"></rect><path d="m4 7 8 6 8-6"></path></svg></span><span>Contact Us</span></a>
</nav>
</div>
<div class="college-nav container"><button class="college-menu-toggle" type="button" aria-expanded="false" aria-controls="college-menu">Explore college <span aria-hidden="true">☰</span></button><nav id="college-menu" aria-label="College navigation">@foreach(['departments'=>'Academics','admissions'=>'Admissions','facilities'=>'Campus Life','placements'=>'Placements','notices'=>'Notices','faq'=>'FAQ'] as $slug=>$label)<a href="{{ url('/'.$slug) }}" data-gpcs-public-link>{{ $label }}</a>@endforeach<button type="button" class="college-search-trigger">Search</button><details><summary>Discover</summary><div><a href="/about" data-gpcs-public-link>About the college</a><a href="/faculty" data-gpcs-public-link>Faculty</a><a href="/gallery" data-gpcs-public-link>Campus gallery</a><a href="/contact" data-gpcs-public-link>Contact</a></div></details></nav></div></header>
<dialog class="college-search-dialog" aria-labelledby="college-search-title"><div class="college-search-top"><h2 id="college-search-title">Find college information</h2><button type="button" data-college-search-close aria-label="Close search">Close</button></div><label for="college-search-input">Search pages and programmes</label><input id="college-search-input" type="search" placeholder="Admissions, fees, departments…" autocomplete="off"><div class="college-search-results" aria-live="polite"></div></dialog>
