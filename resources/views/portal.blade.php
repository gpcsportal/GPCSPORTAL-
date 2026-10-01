<!DOCTYPE html>

<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1, viewport-fit=cover" name="viewport"/>
<meta content="#0a2558" name="theme-color"/>
<meta content="light dark" name="color-scheme"/>
<meta content="GPCS Portal" name="application-name"/>
<meta content="index,follow" name="robots"/>
<meta content="Government Polytechnic College, Shivpuri academic resource portal for papers, notes, results and college resources." name="description"/>
<meta content="GPCS Portal — Government Polytechnic College Shivpuri" property="og:title"/>
<meta content="Government Polytechnic College, Shivpuri academic resource portal for papers, notes, results and college resources." property="og:description"/>
<meta content="website" property="og:type"/>
<meta content="{{ url('/') }}" property="og:url"/>
<link href="{{ url('/') }}" rel="canonical"/>
<link href="/favicon.svg" rel="icon" type="image/svg+xml"/>
<title>Government Polytechnic College, Shivpuri — GPCS Portal</title>


<link rel="dns-prefetch" href="//www.rgpvdiploma.in">
<link rel="preconnect" href="https://www.rgpvdiploma.in" crossorigin>
<link rel="dns-prefetch" href="//result.rgpv.ac.in">
<link rel="preconnect" href="https://result.rgpv.ac.in" crossorigin>
<link rel="dns-prefetch" href="//www.polygwalior.ac.in">
<link rel="preconnect" href="https://www.polygwalior.ac.in" crossorigin>







<link rel="stylesheet" href="/assets/gpcs-portal.css?v=20261001">
<link rel="stylesheet" href="/assets/gpcs-college.css?v=20261001">
<script src="/assets/gpcs-college.js?v=20261001" defer></script>
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'EducationalOrganization','name'=>'Government Polytechnic College, Shivpuri','url'=>url('/'),'image'=>url('/assets/gpcs-campus.webp'),'address'=>['@type'=>'PostalAddress','streetAddress'=>'Chhatri Road','addressLocality'=>'Shivpuri','addressRegion'=>'Madhya Pradesh','addressCountry'=>'IN']], JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_SLASHES) !!}</script>
<meta property="og:image" content="{{ url('/assets/gpcs-campus.webp') }}">
</head>
<body class="page-home" id="top">
<div class="bg-orb orb-a"></div><div class="bg-orb orb-b"></div>
@include('college.header')
<a class="college-skip" href="#main-content">Skip to main content</a>
<main id="main-content" tabindex="-1">
<div class="gpcs-preview-view is-active" id="gpcsHomeView" data-route-view="home">
@include('college.hero')
<section class="reference-stat-wrap">
<div class="container reference-stat-strip" tabindex="0" aria-label="Portal resource statistics">
<div class="reference-stat-item stat-blue"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><div><strong>{{ $paperCount }}</strong><small>Question Papers</small></div></div>
<div class="reference-stat-item stat-green"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><ellipse cx="12" cy="5" rx="7" ry="3"></ellipse><path d="M5 5v6c0 1.7 3.1 3 7 3s7-1.3 7-3V5M5 11v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"></path></svg></span><div><strong>{{ $subjectCount }}</strong><small>Master Subjects</small></div></div>
<div class="reference-stat-item stat-orange"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><div><strong>{{ max($paperMaxMb,$notesMaxMb,$galleryMaxMb) }} MB</strong><small>Max Upload Size</small></div></div>
<div class="reference-stat-item stat-purple"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"></path><path d="M5.5 10.5V20h13v-9.5"></path><path d="M9.5 20v-5h5v5"></path></svg></span><div><strong>{{ $branchCount }}</strong><small>Branches</small></div></div>
<div class="reference-stat-item stat-cyan"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 3 19 6v5c0 4.7-2.8 8-7 10-4.2-2-7-5.3-7-10V6z"></path><path d="m9 12 2 2 4-4"></path></svg></span><div><strong>{{ $loginWallEnabled ? 'Signed-in' : 'Public' }}</strong><small>Paper Access</small></div></div>
</div>
</section>
<section class="reference-dashboard-section">
<div class="container reference-dashboard-grid">
<section class="reference-panel quick-panel">
<div class="reference-panel-head"><span class="panel-icon rocket"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M14 4c3-1 5-1 6-1 0 1 0 3-1 6l-5 5-4-4z"></path><path d="M10 10 5 9l-2 2 5 3M14 14l1 5-2 2-3-5M7 17l-3 3"></path></svg></span><div><h2>Quick Access</h2><p>Everything you need, just one click away</p></div></div>
<div class="reference-quick-grid">
<a class="reference-quick-card quick-blue" href="{{ route('portal.outbound','student') }}" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20a7 7 0 0 1 14 0"></path></svg></span><div><b>Student Login</b><small>Official portal</small></div><i>→</i></a>
<a class="reference-quick-card quick-teal" href="{{ route('portal.outbound','syllabus') }}" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"></path></svg></span><div><b>Syllabus</b><small>Official syllabus</small></div><i>→</i></a>
<a class="reference-quick-card quick-purple" href="index.php?page=papers"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 4h11a3 3 0 0 1 3 3v12H8a3 3 0 0 1-3-3z"></path><path d="M8 19a3 3 0 0 0 0-6h11"></path><path d="M8 7h7M8 10h6"></path></svg></span><div><b>Paper Library</b><small>Search papers</small></div><i>→</i></a>
<a class="reference-quick-card quick-red" href="{{ route('portal.outbound','previous') }}" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="15" rx="2" width="17" x="3.5" y="5"></rect><path d="M7 3v4M17 3v4M3.5 9.5h17"></path></svg></span><div><b>Previous Year</b><small>Question papers</small></div><i>→</i></a>
<a class="reference-quick-card quick-green" href="index.php?page=login"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><div><b>Upload Paper</b><small>Share a paper</small></div><i>→</i></a>
<a class="reference-quick-card quick-gold" href="{{ route('portal.outbound','main-result') }}" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M8 4h8v4a4 4 0 0 1-8 0z"></path><path d="M8 6H4v1a4 4 0 0 0 4 4M16 6h4v1a4 4 0 0 1-4 4M12 12v4M8.5 20h7M10 16h4"></path></svg></span><div><b>Main Result</b><small>Official result</small></div><i>→</i></a>
<a class="reference-quick-card quick-violet" href="{{ route('portal.outbound','all-result') }}" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 20V10M12 20V4M19 20v-7"></path></svg></span><div><b>All Result</b><small>Complete results</small></div><i>→</i></a>
<a class="reference-quick-card quick-pink" href="index.php?page=notes"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><div><b>Notes</b><small>Study resources</small></div><i>→</i></a>
<a class="reference-quick-card quick-sky" href="index.php?page=gallery"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="4"></rect><circle cx="9" cy="9" r="2"></circle><path d="m5 18 5-5 3 3 2-2 4 4"></path></svg></span><div><b>Gallery</b><small>College activities</small></div><i>→</i></a>
</div>
</section>

</div>
</section>
@include('college.home-sections')
</div>

<section class="gpcs-preview-view gpcs-route-view" id="gpcsRouteView" aria-live="polite" hidden>
  <div class="gpcs-route-shell" id="gpcsRouteShell"></div>
</section>
</main>
<footer class="site-footer reference-footer">
<div class="container reference-footer-shell">
<div class="reference-footer-grid">
<div class="reference-footer-brand">
<div class="brand footer-brand">
<span class="brand-mark brand-logo-mark logo-interactive" role="button" tabindex="0" aria-label="View GPCS Portal logo. Double tap for GPCS Sign In." title="Tap to view logo • Double tap for GPCS Sign In"><img alt="" src="/assets/gpcs-logo.webp" width="160" height="118"/></span>
<span><strong>GPCS Portal<span id="gpcs-brand-admin-trigger" class="gpcs-brand-admin-trigger" aria-hidden="true">©</span></strong><small>Government Polytechnic College, Shivpuri</small></span>
</div>
<p>“Empowering Polytechnic Students,<br/>Building Better Futures.”</p>
</div>
<div class="reference-footer-links">
<h3>Quick Links</h3>
<div class="footer-link-columns">
<div><a href="index.php?page=home">Home</a><a href="index.php?page=papers">Paper Library</a><a href="index.php?page=login">Upload Paper</a><a href="index.php?page=notes">Notes</a></div>
<div><a href="{{ route('portal.outbound','student') }}" rel="noopener noreferrer" target="_blank">Student Login</a><a href="{{ route('portal.outbound','previous') }}" rel="noopener noreferrer" target="_blank">Previous Year</a><a href="{{ route('portal.outbound','main-result') }}" rel="noopener noreferrer" target="_blank">Main Result</a><a href="index.php?page=gallery">Gallery</a></div>
<div><a href="{{ route('portal.outbound','syllabus') }}" rel="noopener noreferrer" target="_blank">Syllabus</a><a href="{{ route('portal.outbound','all-result') }}" rel="noopener noreferrer" target="_blank">All Result</a><a href="index.php?page=about">About Us</a><a href="index.php?page=contact">Contact Us</a></div>
</div>
</div>
</div>
<div class="reference-footer-bottom">
<p>© 2026 GPCS Portal <span>•</span> Government Polytechnic College, Shivpuri <span>•</span> All Rights Reserved <span>•</span> <a href="{{ route('portal.terms') }}" data-gpcs-public-link>Terms</a> <span>•</span> <a href="{{ route('portal.privacy') }}" data-gpcs-public-link>Privacy</a></p>
<p>Designed for a fast, student-friendly academic experience.</p>
</div>
</div>
<a aria-label="Back to top" class="reference-back-top" href="#top">↑</a>
</footer>




<dialog id="gpcsHiddenAdminDialog" class="gpcs-hidden-admin-dialog" aria-labelledby="gpcsHiddenAdminTitle">
  <form method="dialog" class="gpcs-hidden-admin-close-form">
    <button class="gpcs-hidden-admin-close" type="submit" aria-label="Close">×</button>
  </form>
  <div class="gpcs-hidden-admin-card">
    <div class="gpcs-hidden-admin-mark">GP</div>
    <h2 id="gpcsHiddenAdminTitle">GPCS Admin Sign In</h2>
    <p>Authorized administration access.</p>
    <div class="gpcs-hidden-admin-error" id="gpcsHiddenAdminError" hidden>Invalid credentials</div>
    <form id="gpcsHiddenAdminForm" method="POST" action="{{ route('admin.hidden.login') }}" autocomplete="off">@csrf
      <label>Admin ID / Email<input id="gpcsHiddenAdminLogin" name="admin_login" type="text" required maxlength="190" autocomplete="username"></label>
      <label>Password<input id="gpcsHiddenAdminPassword" name="password" type="password" required maxlength="255" autocomplete="current-password"></label>
      <button type="submit" class="gpcs-hidden-admin-submit">Sign In</button>
    </form>
  </div>
</dialog>

<div class="gpcs-logo-lightbox" id="gpcsLogoLightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="GPCS Portal logo preview">
  <div class="gpcs-logo-dialog">
    <button class="gpcs-logo-close" type="button" aria-label="Close logo preview">×</button>
    <img src="/assets/gpcs-logo.webp" data-gpcs-full-src="/assets/gpcs-embedded-628bb00a48b0.webp" alt="GPCS Portal — Government Polytechnic College, Shivpuri logo">
    <div class="gpcs-logo-hint">Double tap the logo for GPCS Sign In</div>
  </div>
</div>

<script src="/assets/gpcs-theme.js?v=20261001"></script>
<script>
(() => {
  const lightbox = document.getElementById('gpcsLogoLightbox');
  if (!lightbox) return;

  const closeBtn = lightbox.querySelector('.gpcs-logo-close');
  const logoMarks = [...document.querySelectorAll('.logo-interactive')];
  const signInUrl = 'index.php?page=login';
  let tapTimer = null;
  let lastTap = 0;

  const openPreview = () => {
    const fullLogo = lightbox.querySelector('[data-gpcs-full-src]');
    if (fullLogo) fullLogo.src = fullLogo.dataset.gpcsFullSrc;
    lightbox.classList.add('is-open');
    lightbox.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
    closeBtn?.focus({preventScroll:true});
  };

  const closePreview = () => {
    lightbox.classList.remove('is-open');
    lightbox.setAttribute('aria-hidden','true');
    document.body.style.overflow = '';
  };

  const openSignIn = () => {
    closePreview();
    if (typeof window.gpcsPreviewNavigate === 'function') {
      window.gpcsPreviewNavigate('login');
    } else {
      window.location.href = signInUrl;
    }
  };

  logoMarks.forEach(mark => {
    mark.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();

      // Keyboard activation should open the preview immediately.
      if (event.detail === 0) {
        openPreview();
        return;
      }

      const now = Date.now();
      if (now - lastTap < 340) {
        lastTap = 0;
        clearTimeout(tapTimer);
        openSignIn();
        return;
      }

      lastTap = now;
      clearTimeout(tapTimer);
      tapTimer = setTimeout(() => {
        lastTap = 0;
        openPreview();
      }, 285);
    });

    mark.addEventListener('dblclick', (event) => {
      event.preventDefault();
      event.stopPropagation();
      lastTap = 0;
      clearTimeout(tapTimer);
      openSignIn();
    });

    mark.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        openPreview();
      }
    });
  });

  closeBtn?.addEventListener('click', closePreview);
  lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) closePreview();
  });
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && lightbox.classList.contains('is-open')) closePreview();
  });
})();
</script>






<script>
(() => {
  const homeView=document.getElementById('gpcsHomeView');
  const routeView=document.getElementById('gpcsRouteView');
  const routeShell=document.getElementById('gpcsRouteShell');
  if(!homeView||!routeView||!routeShell) return;

  const externalPages={
    student:'{{ route('portal.outbound','student') }}',
    syllabus:'{{ route('portal.outbound','syllabus') }}',
    previous:'{{ route('portal.outbound','previous') }}',
    mainresult:'{{ route('portal.outbound','main-result') }}',
    allresult:'{{ route('portal.outbound','all-result') }}'
  };

  const escapeHtml=s=>String(s??'').replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));
  const toast=(msg)=>{let t=document.querySelector('.route-toast');if(!t){t=document.createElement('div');t.className='route-toast';document.body.appendChild(t)}t.textContent=msg;t.classList.add('show');clearTimeout(t._tm);t._tm=setTimeout(()=>t.classList.remove('show'),2200)};
  const hero=(k,t,d,b='GPCS Portal')=>`<div class="route-hero"><div><div class="route-kicker">${k}</div><h1>${t}</h1><p>${d}</p></div><span class="route-badge">${b}</span></div>`;

  const pages={
    papers:()=>hero('Academic Resources','Paper Library','Search question papers using one universal search box. Paper Code, Paper Name, Year, Session, Branch and Semester can all be searched.')+`<div class="route-content"><div class="route-searchbar"><input id="previewPaperSearch" placeholder="Search Paper Code, Paper Name, Year, Session…" aria-label="Search papers"><button class="route-btn primary" type="button" id="previewPaperSearchBtn">Search</button></div><div class="route-table-wrap"><table class="route-table"><thead><tr><th>S.No.</th><th>Paper Code</th><th>Paper Name</th><th>Year</th><th>Session</th><th>Paper</th></tr></thead><tbody id="previewPaperRows"><tr><td colspan="6">Loading approved papers…</td></tr></tbody></table></div><div class="route-actions"><span class="route-status">Approved papers are loaded from the portal database</span></div></div>`,
    upload:()=>hero('Paper Contribution','Upload Paper','Upload a genuine academic paper. All metadata is optional; blank fields are auto-filled using the GPCS Master Subject Database.','Up to {{ $paperMaxMb }} MB')+`<div class="route-content"><div class="route-grid"><div class="route-card"><h2>Upload Paper</h2><form class="route-form" id="previewUploadForm"><label>Choose Paper File<input id="previewPaperFile" type="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"></label><label>Paper Code <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. 7488"></label><label>Subject Code <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. 403"></label><label>Paper Name <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="Leave blank for auto-detect"></label><label>Subject Name <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="Leave blank for auto-detect"></label><label>Branch <span style="font-weight:500;color:#8295aa">(optional)</span><select><option value="">Auto-detect</option>@foreach($branches as $branch)<option>{{ $branch }}</option>@endforeach</select></label><label>Semester <span style="font-weight:500;color:#8295aa">(optional)</span><select><option value="">Auto-detect</option><option>Semester I</option><option>Semester II</option><option>Semester III</option><option>Semester IV</option><option>Semester V</option><option>Semester VI</option></select></label><label>Year <span style="font-weight:500;color:#8295aa">(optional)</span><input inputmode="numeric" placeholder="e.g. 2026"></label><label>Session <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. F / S"></label><div class="route-actions"><button class="route-btn primary" type="submit">⇧ Upload Paper</button><button class="route-btn" type="button" data-preview-route="papers">Browse Library</button></div></form></div><div class="route-card"><h3>Automatic matching</h3><p>Paper Code, Subject Code, Paper Name, Subject Name, Branch and Semester are matched against the local 141-row Master Subject Database. Year and Session are also detected when available. Duplicate codes are resolved using full context instead of blindly selecting the first match.</p><div class="route-actions"><span class="route-status approved">Optional metadata</span><span class="route-status">{{ $paperMaxMb }} MB max upload</span></div><div class="admin-security-note" style="margin-top:14px">A genuine paper is not rejected for a small metadata mismatch. The system auto-corrects recognized details from the Master Database and asks for confirmation only when multiple valid matches exist.</div></div></div></div>`,
    notes:()=>hero('Study Resources','Notes','Students, Teachers and Faculty can upload notes. New uploads become public only after Admin approval.','Admin Moderated')+`<div class="route-content"><div class="route-searchbar"><input id="previewNoteSearch" placeholder="Search notes by title, subject, code, branch, semester…"><button class="route-btn primary" type="button">Search</button></div><div class="route-grid"><div class="route-card"><h2>Upload Notes</h2><form class="route-form" id="previewNoteForm" data-gpcs-upload-autofill="note"><div class="admin-security-note" style="margin-bottom:4px"><b>Required academic details:</b> Branch Name, Semester, Year, Subject Name and Subject Code. Known values are auto-filled from existing Notes data; only missing values need manual entry.</div><label>Branch Name <span style="color:#c2410c;font-weight:900">*</span><select name="branch" required><option value="">Select / auto-fill</option>@foreach($branches as $branch)<option value="{{ $branch }}">{{ $branch }}</option>@endforeach</select></label><label>Semester <span style="color:#c2410c;font-weight:900">*</span><select name="semester" required><option value="">Select / auto-fill</option><option value="Semester I">Semester I</option><option value="Semester II">Semester II</option><option value="Semester III">Semester III</option><option value="Semester IV">Semester IV</option><option value="Semester V">Semester V</option><option value="Semester VI">Semester VI</option></select></label><label>Year <span style="color:#c2410c;font-weight:900">*</span><input name="year" required inputmode="numeric" pattern="[0-9]{4}" maxlength="4" placeholder="e.g. 2026"></label><label>Subject Name <span style="color:#c2410c;font-weight:900">*</span><input name="subject_name" required placeholder="Auto-fill when known"></label><label>Subject Code <span style="color:#c2410c;font-weight:900">*</span><input name="subject_code" required placeholder="Auto-fill when known"></label><label>Note Title <span style="font-weight:500;color:#8295aa">(optional)</span><input name="title" placeholder="e.g. Unit 1 Handwritten Notes"></label><label>Text / Description <span style="font-weight:500;color:#8295aa">(optional)</span><textarea name="description" rows="4" placeholder="Type notes or description"></textarea></label><label>Attachment <span style="font-weight:500;color:#8295aa">(optional, PDF/image up to {{ $notesMaxMb }} MB)</span><input name="attachment" type="file" accept=".pdf,.jpg,.jpeg,.png"></label><div data-preview-note-message role="status" aria-live="polite" style="display:none"></div><div class="route-actions"><button class="route-btn primary" type="submit">Submit Notes</button></div></form><div class="admin-security-note" style="margin-top:14px">After upload: <b>Pending Review</b> → Admin Approves → Note becomes public. Rejected notes stay hidden from the public library and remain marked for the uploader.</div></div><div class="route-card"><h2>Available Notes <span class="route-status approved">Approved only</span></h2><div class="route-note-list" id="previewNotes"><div class="route-note"><div><b>Loading approved notes…</b></div></div></div><div class="admin-section"><h3>Your Upload Status</h3><p>Sign in to upload notes. New submissions remain pending until Admin approval.</p></div></div></div></div></div>`,
    gallery:()=>hero('College Life','Image Gallery','Browse college-related images or add images through category-specific or Smart Add flows.')+`<div class="route-content"><div class="route-actions" style="margin-top:0;margin-bottom:15px"><button class="route-btn primary" type="button" id="previewAddImage">＋ Add Image</button></div><input id="previewGalleryInput" type="file" accept="image/*" multiple hidden><div class="route-gallery"><div class="route-gallery-card"><b>Campus & Infrastructure</b><small>View / Add</small></div><div class="route-gallery-card"><b>College Events</b><small>View / Add</small></div><div class="route-gallery-card"><b>Labs & Workshops</b><small>View / Add</small></div><div class="route-gallery-card"><b>Students & Staff</b><small>View / Add</small></div><div class="route-gallery-card"><b>Sports & Cultural</b><small>View / Add</small></div><div class="route-gallery-card"><b>Projects & Activities</b><small>View / Add</small></div><div class="route-gallery-card"><b>Other College Related</b><small>View / Add</small></div></div><div class="admin-section" style="margin-top:18px"><h3>Approved Gallery Images</h3><div id="previewGalleryLive" class="route-gallery" aria-live="polite"><div class="route-gallery-card"><b>Loading gallery…</b></div></div></div></div>`,
    about:()=>hero('About the Institution','About Us','Government Polytechnic College, Shivpuri — empowering future engineers through technical excellence.')+`<div class="route-content"><div class="route-card"><h2>Government Polytechnic College, Shivpuri</h2><p>Welcome to Government Polytechnic College, Shivpuri — a premier government technical institution dedicated to excellence in engineering education and skill development.</p><div class="route-about-list" style="margin-top:16px"><div><b>Accreditation & Affiliation</b><p>Approved by AICTE, New Delhi • Affiliated with Rajiv Gandhi Proudyogiki Vishwavidyalaya (RGPV), Bhopal.</p></div><div><b>Campus & Environment</b><p>Located on Chhatri Road, Shivpuri, with an academic environment focused on practical and industry-aligned diploma education.</p></div><div><b>Academic Highlights</b><p>Experienced faculty, laboratories and workshops, hands-on learning, career guidance and vibrant campus activities.</p></div></div></div></div>`,
    contact:()=>hero('Get in Touch','Contact Us','Contact information can be maintained by the Admin. Use the form below to send a message to the college portal team.')+`<div class="route-content"><div class="route-grid"><div class="route-card"><h2>Contact Details</h2><p>Phone, email and address will appear here when added by the Admin.</p><div class="route-actions"><span class="route-status">Admin-managed content</span></div></div><div class="route-card"><h2>Send a Message</h2><form class="route-form" id="previewContactForm"><label>Name<input required placeholder="Your name"></label><label>Email / Mobile<input required placeholder="Email or mobile"></label><label>Message<textarea required rows="5" placeholder="How can we help?"></textarea></label><button class="route-btn primary" type="submit">Send Message</button></form></div></div></div>`,
    {{-- UPDATED: credential autocomplete hints only; login placement and structure are unchanged. --}}
    login:()=>hero('Portal Access','GPCS Sign In','Choose Student or Faculty access, then sign in with Email ID + GPCS account password.','Secure Access')+`<div class="route-content auth-preview-shell">
      <div class="auth-role-selector-wrap"><button class="auth-role-selector" type="button" data-auth-preview-toggle aria-label="Student selected. Switch to Faculty"><span class="auth-role-icon" aria-hidden="true"><svg class="auth-role-svg auth-role-svg-student" viewBox="0 0 24 24"><path d="M3 10.2 12 5l9 5.2-9 5.2L3 10.2Z"></path><path d="M7 12.5v4.1c2.9 2 7.1 2 10 0v-4.1"></path><path d="M21 10.2v5"></path></svg><svg class="auth-role-svg auth-role-svg-faculty" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.2"></circle><path d="M5.5 19c.7-3.6 3.2-5.6 6.5-5.6s5.8 2 6.5 5.6"></path><path d="M18.5 5.2 21 6.7l-2.5 1.5"></path></svg></span><span class="auth-role-copy"><small data-auth-role-context>Sign in as</small><strong data-auth-toggle-state>Student</strong></span><span class="auth-role-action"><span data-auth-toggle-hint>Change to Faculty</span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M14 7l5 5-5 5"></path></svg></span></button></div>
      <div class="auth-preview-role" data-auth-preview-panel="student"><div class="route-card auth-glass-card auth-signin-card"><div class="auth-preview-head"><span class="route-status approved">Student</span><h2>Student Sign In</h2><p>Sign in with your Email ID and Password. Your account role is detected automatically.</p></div><div data-auth-method-panel="password"><form class="route-form" id="previewStudentPassword"><label>Email ID<input type="email" required autocomplete="email" inputmode="email" placeholder="student@example.com"></label><label>Password<input type="password" required minlength="8" autocomplete="current-password" placeholder="GPCS account password"></label><div class="auth-preview-linkrow"><button type="button" class="link-button" data-auth-reset="student">Forgot Password?</button></div><button class="route-btn primary auth-main-submit" type="submit">Student Sign In</button></form></div><p class="auth-preview-register">New user? <button type="button" class="link-button" data-auth-register="student">Register here</button></p><div class="auth-trust-row" aria-label="Secure sign in"><span>Secure access</span><span>Password protected</span><span>Responsive</span></div></div></div>
      <div class="auth-preview-role" data-auth-preview-panel="faculty" hidden><div class="route-card auth-glass-card auth-signin-card"><div class="auth-preview-head"><span class="route-status pending">Faculty</span><h2>Faculty Sign In</h2><p>Sign in with your Email ID and Password. Your account role is detected automatically.</p></div><div data-auth-method-panel="password"><form class="route-form" id="previewFacultyPassword"><label>Email ID<input type="email" required autocomplete="email" inputmode="email" placeholder="faculty@example.com"></label><label>Password<input type="password" required minlength="8" autocomplete="current-password" placeholder="GPCS account password"></label><div class="auth-preview-linkrow"><button type="button" class="link-button" data-auth-reset="faculty">Forgot Password?</button></div><button class="route-btn primary auth-main-submit" type="submit">Faculty Sign In</button></form></div><p class="auth-preview-register">New user? <button type="button" class="link-button" data-auth-register="faculty">Register here</button></p><div class="auth-trust-row" aria-label="Secure sign in"><span>Secure access</span><span>Password protected</span><span>Responsive</span></div></div></div>
      <div class="auth-preview-register-panel" data-register-panel hidden><div class="route-card auth-glass-card auth-register-card"><div class="auth-preview-head"><span class="route-status" data-register-role-badge>Student</span><h2 data-register-title>Student Registration</h2><p>Complete the required account details below.</p></div><form class="route-form auth-preview-registration" id="previewDynamicRegister"><div data-student-fields><label>Full Name<input required></label><label>Surname<input required></label><label>Gender<select required><option>Select</option><option>Male</option><option>Female</option><option>Other</option></select></label><label>College Name<input required></label><label>College Year<select required><option>1st Year</option><option>2nd Year</option><option>3rd Year</option></select></label><label>Branch<select required>@foreach($branches as $branch)<option>{{ $branch }}</option>@endforeach</select></label><label>Semester<select required><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option></select></label></div><div data-faculty-fields hidden><label>Full Name <span class="auth-field-required">Required</span><input required></label><label>Surname <span class="auth-field-required">Required</span><input required></label><label>Gender <span class="auth-field-required">Required</span><select required><option>Select</option><option>Male</option><option>Female</option><option>Other</option></select></label><label>College Name <span class="auth-field-required">Required</span><input required></label><label>Subject Name <span class="auth-field-required">Required</span><input required></label><label>Faculty / Employee ID <span class="auth-field-optional">Optional</span><input></label></div><label>Mobile Number <span class="auth-field-optional" data-faculty-optional-note hidden>Optional</span><input inputmode="numeric" autocomplete="tel" maxlength="10" required data-faculty-optional></label><label>Email ID <span class="auth-field-required">Required</span><input type="email" autocomplete="email" inputmode="email" required></label><label>Email Password <small>(GPCS account login)</small> <span class="auth-field-required">Required</span><input type="password" autocomplete="new-password" minlength="8" required></label><label>Confirm Password <span class="auth-field-required">Required</span><input type="password" autocomplete="new-password" minlength="8" required></label><label>Pin Code <span class="auth-field-optional" data-faculty-optional-note hidden>Optional</span><input inputmode="numeric" autocomplete="postal-code" maxlength="6" required data-faculty-optional></label><label>Address <span class="auth-field-required" data-faculty-required-note hidden>Required</span><textarea rows="3" autocomplete="street-address" required></textarea></label><label data-profile-photo>Profile Photo <span class="auth-field-optional">Optional</span><input type="file" accept="image/*"></label><label class="auth-preview-check"><input type="checkbox" name="terms_accepted" value="1" required> <span>I agree to <a href="{{ route('portal.terms') }}" target="_blank" rel="noopener noreferrer" data-gpcs-public-link>Terms &amp; Conditions</a> and <a href="{{ route('portal.privacy') }}" target="_blank" rel="noopener noreferrer" data-gpcs-public-link>Privacy Policy</a></span></label><div class="route-actions"><button class="route-btn primary" type="submit" data-register-submit>Create Account</button><button class="route-btn" type="button" data-back-login>Back to Sign In</button></div></form></div></div>
      <div class="auth-preview-reset-panel" data-reset-panel hidden><div class="route-card auth-glass-card auth-reset-card"><h2>Forgot Password</h2><p>Enter your registered Email ID. We will send a secure reset link.</p><form class="route-form" id="previewResetForm"><label>Email ID<input type="email" name="email" required autocomplete="email" placeholder="Enter registered Email ID"></label><button class="route-btn primary" type="submit">Send Reset Link</button><button class="route-btn" type="button" data-back-login>Back to Sign In</button></form></div></div>

    </div>`
  };

  function normalizeRoute(route){return ['home','papers','upload','notes','gallery','about','contact','login'].includes(route)?route:'home'}
  function updateActive(route){document.querySelectorAll('.main-nav .nav-link').forEach(a=>a.classList.remove('active'));const map={home:'.nav-important',papers:'.nav-library',upload:'.nav-upload',notes:'.nav-notes',gallery:'a[href*="page=gallery"]',about:'a[href*="page=about"]',contact:'a[href*="page=contact"]'};if(map[route]) document.querySelector('.main-nav '+map[route])?.classList.add('active')}
  function bindRoutePage(route){
    routeShell.querySelectorAll('[data-preview-route]').forEach(b=>b.addEventListener('click',e=>{
      e.preventDefault();
      navigate(b.dataset.previewRoute);
    }));

    /* Keep ordinary preview forms working, but auth forms below get their own behavior. */
    routeShell.querySelectorAll('form').forEach(f=>f.addEventListener('submit',e=>{
      if(route==='login') return;
      e.preventDefault();
      if(route==='notes') toast('Notes submitted — Pending Review until Admin approval.');
      else if(route==='upload') toast('Paper upload form validated — optional metadata will be auto-filled when blank.');
      else toast('Request ready to submit.');
    }));

    const ps=routeShell.querySelector('#previewPaperSearch');
    if(ps){
      const run=()=>{
        const q=ps.value.trim().toLowerCase();
        routeShell.querySelectorAll('#previewPaperRows tr').forEach(tr=>tr.hidden=q&&!tr.dataset.search.includes(q));
      };
      ps.addEventListener('input',run);
      routeShell.querySelector('#previewPaperSearchBtn')?.addEventListener('click',run);
    }

    const ns=routeShell.querySelector('#previewNoteSearch');
    if(ns) ns.addEventListener('input',()=>{
      const q=ns.value.trim().toLowerCase();
      routeShell.querySelectorAll('#previewNotes .route-note').forEach(n=>n.hidden=q&&!n.dataset.search.includes(q));
    });

    routeShell.querySelector('#previewAddImage')?.addEventListener('click',()=>routeShell.querySelector('#previewGalleryInput')?.click());
    routeShell.querySelector('#previewGalleryInput')?.addEventListener('change',e=>toast(`${e.target.files.length} image(s) selected`));
    routeShell.querySelectorAll('[data-preview-action="view-note"]').forEach(b=>b.addEventListener('click',()=>toast('Opening note…')));
    routeShell.querySelectorAll('[data-preview-action="download-note"]').forEach(b=>b.addEventListener('click',()=>toast('Preparing download…')));

    if(route!=='login') return;

    const roleToggle=routeShell.querySelector('[data-auth-preview-toggle]');
    const rolePanels=[...routeShell.querySelectorAll('[data-auth-preview-panel]')];
    const registerPanel=routeShell.querySelector('[data-register-panel]');
    const resetPanel=routeShell.querySelector('[data-reset-panel]');
    const registerForm=routeShell.querySelector('#previewDynamicRegister');
    const studentFields=routeShell.querySelector('[data-student-fields]');
    const facultyFields=routeShell.querySelector('[data-faculty-fields]');
    const photoField=routeShell.querySelector('[data-profile-photo]');
    const registerTitle=routeShell.querySelector('[data-register-title]');
    const registerBadge=routeShell.querySelector('[data-register-role-badge]');
    const registerSubmit=routeShell.querySelector('[data-register-submit]');
    let activeRole='student';

    const setGroupEnabled=(container,enabled)=>{
      if(!container) return;
      container.hidden=!enabled;
      container.querySelectorAll('input,select,textarea,button').forEach(el=>el.disabled=!enabled);
    };

    const syncRoleSelector=(view='signin')=>{
      if(!roleToggle) return;
      const isFaculty=activeRole==='faculty';
      const isRegister=view==='register';
      roleToggle.classList.toggle('is-faculty',isFaculty);
      roleToggle.setAttribute('aria-label',`${isFaculty?'Faculty':'Student'} ${isRegister?'registration':'sign in'} selected. Change to ${isFaculty?'Student':'Faculty'}`);
      const state=roleToggle.querySelector('[data-auth-toggle-state]');
      const hint=roleToggle.querySelector('[data-auth-toggle-hint]');
      const context=roleToggle.querySelector('[data-auth-role-context]');
      if(state) state.textContent=isFaculty?'Faculty':'Student';
      if(hint) hint.textContent=`Change to ${isFaculty?'Student':'Faculty'}`;
      if(context) context.textContent=isRegister?'Register as':'Sign in as';
    };

    const showRole=(role)=>{
      activeRole=role==='faculty'?'faculty':'student';
      syncRoleSelector('signin');
      rolePanels.forEach(panel=>panel.hidden=panel.dataset.authPreviewPanel!==activeRole);
      if(registerPanel) registerPanel.hidden=true;
      if(resetPanel) resetPanel.hidden=true;
    };

    roleToggle?.addEventListener('click',()=>{
      const next=activeRole==='student'?'faculty':'student';
      const registrationOpen=registerPanel && !registerPanel.hidden;
      if(registrationOpen) prepareRegistration(next,{scroll:false});
      else showRole(next);
    });
    showRole('student');

    const prepareRegistration=(role,options={})=>{
      activeRole=role==='faculty'?'faculty':'student';
      rolePanels.forEach(panel=>panel.hidden=true);
      if(resetPanel) resetPanel.hidden=true;
      if(registerPanel) registerPanel.hidden=false;
      syncRoleSelector('register');

      const isFaculty=activeRole==='faculty';
      setGroupEnabled(studentFields,!isFaculty);
      setGroupEnabled(facultyFields,isFaculty);

      if(photoField){
        /* Profile photo stays visible for both roles and remains optional. */
        photoField.hidden=false;
        photoField.querySelectorAll('input').forEach(el=>el.disabled=false);
      }
      /* Faculty-only optional fields are Mobile Number and Pin Code.
         Email/password remain required because they are login/recovery credentials. */
      registerForm?.querySelectorAll('[data-faculty-optional]').forEach(el=>{
        el.required=!isFaculty;
      });
      registerForm?.querySelectorAll('[data-faculty-optional-note]').forEach(el=>{
        el.hidden=!isFaculty;
      });
      registerForm?.querySelectorAll('[data-faculty-required-note]').forEach(el=>{
        el.hidden=!isFaculty;
      });
      if(registerTitle) registerTitle.textContent=isFaculty?'Faculty Registration':'Student Registration';
      if(registerBadge){
        registerBadge.textContent=isFaculty?'Faculty':'Student';
        registerBadge.className='route-status '+(isFaculty?'pending':'approved');
      }
      if(registerSubmit) registerSubmit.textContent=isFaculty?'Submit Registration':'Create Student Account';
      if(options.scroll!==false) registerPanel?.scrollIntoView({behavior:'smooth',block:'start'});
    };

    routeShell.querySelectorAll('[data-auth-register]').forEach(btn=>btn.addEventListener('click',()=>prepareRegistration(btn.dataset.authRegister)));

    const openReset=(role)=>{
      activeRole=role==='faculty'?'faculty':'student';
      rolePanels.forEach(panel=>panel.hidden=true);
      if(registerPanel) registerPanel.hidden=true;
      if(resetPanel) resetPanel.hidden=false;
      syncRoleSelector('signin');
      resetPanel?.scrollIntoView({behavior:'smooth',block:'start'});
    };
    routeShell.querySelectorAll('[data-auth-reset]').forEach(btn=>btn.addEventListener('click',()=>openReset(btn.dataset.authReset)));
    routeShell.querySelectorAll('[data-back-login]').forEach(btn=>btn.addEventListener('click',()=>showRole(activeRole)));

    /* Real auth is owned by gpcs-backend-bridge.js. If that script fails,
       do not simulate success and do not expose the removed OTP workflow. */
    registerForm?.addEventListener('submit',e=>{
      e.preventDefault();
      if(!registerForm.checkValidity()){registerForm.reportValidity();return}
      toast('Secure registration service is unavailable. Refresh the page and try again.');
    });

    routeShell.querySelectorAll('#previewStudentPassword,#previewFacultyPassword').forEach(form=>form.addEventListener('submit',e=>{
      e.preventDefault();
      if(!form.checkValidity()){form.reportValidity();return}
      toast('Secure sign-in service is unavailable. Refresh the page and try again.');
    }));

    /* Password recovery is submitted to Laravel by gpcs-backend-bridge.js. */

    /* Mobile/pin numeric cleanup for preview forms. */
    routeShell.querySelectorAll('input[inputmode="numeric"]').forEach(input=>input.addEventListener('input',()=>{
      input.value=input.value.replace(/\D/g,'').slice(0,Number(input.maxLength)>0?Number(input.maxLength):99);
    }));

    showRole('student');
  }
  function navigate(route,push=true){
    route=normalizeRoute(route);
    if(route==='home'){homeView.hidden=false;homeView.classList.add('is-active');routeView.hidden=true;routeShell.innerHTML=''}else{homeView.hidden=true;homeView.classList.remove('is-active');routeView.hidden=false;routeShell.innerHTML=pages[route]();bindRoutePage(route)}
    updateActive(route);document.title=(route==='home'?'Government Polytechnic College, Shivpuri — GPCS Portal':`${route.charAt(0).toUpperCase()+route.slice(1)} — GPCS Portal`);if(push) history.replaceState(null,'','#'+route);window.scrollTo({top:0,behavior:'smooth'})
  }
  window.gpcsPreviewNavigate=navigate;

  document.addEventListener('click',e=>{
    if(e.target.closest('.logo-interactive')) return;
    const a=e.target.closest('a[href]'); if(!a) return;
    const href=a.getAttribute('href')||'';
    if(href.startsWith('index.php?page=') || href.startsWith('/index.php?page=')){
      e.preventDefault();
      const text=(a.textContent||'').trim().toLowerCase();
      let route=new URLSearchParams(href.split('?')[1]||'').get('page')||'home';
      if(a.classList.contains('nav-upload')||a.classList.contains('reference-cta-primary')||text.includes('upload paper')) route='upload';
      else if(a.classList.contains('gpcs-signin-btn')||text.includes('gpcs sign in')) route='login';
      navigate(route);
    }
  },true);

  window.addEventListener('hashchange',()=>navigate(location.hash.slice(1)||'home',false));
  navigate(location.hash.slice(1)||'home',false);
})();
</script>

<script>
(() => {
  const trigger=document.getElementById('gpcs-brand-admin-trigger');
  const dialog=document.getElementById('gpcsHiddenAdminDialog');
  const login=document.getElementById('gpcsHiddenAdminLogin');
  if(!trigger||!dialog) return;
  let lastPointerType='mouse', lastTouchOpenAt=0;
  const openAdminDialog=()=>{if(dialog.open)return;if(typeof dialog.showModal==='function')dialog.showModal();else dialog.setAttribute('open','open');setTimeout(()=>login?.focus(),0)};
  if('PointerEvent' in window){
    trigger.addEventListener('pointerdown',e=>{lastPointerType=e.pointerType||'mouse'});
    trigger.addEventListener('pointerup',e=>{lastPointerType=e.pointerType||lastPointerType;if(lastPointerType==='touch'||lastPointerType==='pen'){e.preventDefault();lastTouchOpenAt=Date.now();openAdminDialog()}});
  } else {
    trigger.addEventListener('touchend',e=>{e.preventDefault();lastTouchOpenAt=Date.now();openAdminDialog()},{passive:false});
  }
  trigger.addEventListener('dblclick',e=>{if(Date.now()-lastTouchOpenAt<800)return;if(lastPointerType==='mouse'){e.preventDefault();openAdminDialog()}});
})();
</script>

<script>
(() => {
  const clock = document.querySelector('[data-live-portal-clock]');
  if (!clock) return;

  const TIME_ZONE = 'Asia/Kolkata';
  const locale = 'en-IN';

  const dateFormatter = new Intl.DateTimeFormat(locale, {
    timeZone: TIME_ZONE,
    weekday: 'short',
    day: '2-digit',
    month: 'short',
    year: 'numeric'
  });

  const timeFormatter = new Intl.DateTimeFormat(locale, {
    timeZone: TIME_ZONE,
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  });

  const renderClock = () => {
    const now = new Date();
    const parts = Object.fromEntries(
      dateFormatter.formatToParts(now)
        .filter(part => part.type !== 'literal')
        .map(part => [part.type, part.value])
    );
    const datePart = `${parts.weekday}, ${parts.day} ${parts.month} ${parts.year}`;
    const timePart = timeFormatter.format(now).toUpperCase();
    clock.textContent = `${datePart} | ${timePart}`;
    clock.setAttribute(
      'aria-label',
      `Current date and time in Shivpuri: ${datePart}, ${timePart}`
    );
    clock.title = `Live Shivpuri time • ${datePart} | ${timePart}`;
  };

  renderClock();

  // Keep the displayed minute accurate without relying on a hard-coded timestamp.
  const tick = () => renderClock();
  const intervalId = window.setInterval(tick, 1000);

  document.addEventListener('visibilitychange', () => {
    if (!document.hidden) renderClock();
  });

  window.addEventListener('pageshow', renderClock);
  window.addEventListener('beforeunload', () => window.clearInterval(intervalId), {once:true});
})();
</script>


<script>
(() => {
  const warm = new Set();
  const warmOrigin = href => {
    try {
      const u = new URL(href, location.href);
      if (!/^https?:$/.test(u.protocol) || warm.has(u.origin)) return;
      warm.add(u.origin);
      const l=document.createElement('link');l.rel='preconnect';l.href=u.origin;l.crossOrigin='anonymous';document.head.appendChild(l);
    } catch(_) {}
  };
  document.querySelectorAll('a[target="_blank"][href^="http"]').forEach(a=>{
    a.addEventListener('pointerenter',()=>warmOrigin(a.href),{once:true,passive:true});
    a.addEventListener('touchstart',()=>warmOrigin(a.href),{once:true,passive:true});
  });
})();
</script>








<script>
window.GPCS_BACKEND = {
  csrf: document.querySelector('meta[name="csrf-token"]')?.content || '',
  loginWallEnabled: @json($loginWallEnabled),
  limits: { paper: @json($paperMaxMb), notes: @json($notesMaxMb), gallery: @json($galleryMaxMb) },
  routes: {
    login: @json(route('portal.login')),
    register: @json(route('portal.register')),
    csrf: @json(route('portal.csrf')),
    forgot: @json(route('password.email')),
    paperStore: @json(route('papers.store')),
    noteStore: @json(route('notes.store')),
    galleryStore: @json(route('gallery.store')),
    contactStore: @json(route('contact.store')),
    noteLookup: @json(route('metadata.notes.lookup')),
    paperLookup: @json(route('metadata.papers.lookup')),
    papersApi: @json(route('papers.index')),
    notesApi: @json(route('notes.index')),
    galleryApi: @json(route('gallery.index'))
  }
};
</script>
<script src="/assets/gpcs-backend-bridge.js?v=20260929-ui-polish" defer></script>

</body></html>
