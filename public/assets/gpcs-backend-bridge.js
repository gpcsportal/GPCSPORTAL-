(() => {
  const cfg = window.GPCS_BACKEND || {};
  const routes = cfg.routes || {};
  const csrf = cfg.csrf || '';
  const toast = (message) => { if (typeof window.toast === 'function') window.toast(message); else alert(message); };

  if (!document.querySelector('link[data-gpcs-audit-fixes]')) {
    const stylesheet = document.createElement('link');
    stylesheet.rel = 'stylesheet';
    stylesheet.href = '/assets/gpcs-audit-fixes.css';
    stylesheet.dataset.gpcsAuditFixes = '1';
    document.head.appendChild(stylesheet);
  }

  const normalizeRequestUrl = (value) => {
    if (!value) return value;
    try {
      const parsed = new URL(value, window.location.origin);
      if (parsed.host === window.location.host) {
        return `${parsed.pathname}${parsed.search}${parsed.hash}`;
      }
      return parsed.toString();
    } catch (_) {
      return value;
    }
  };

  const request = async (url, options = {}) => {
    const headers = new Headers(options.headers || {});
    headers.set('X-CSRF-TOKEN', csrf);
    headers.set('Accept', 'application/json');

    const controller = new AbortController();
    const timeout = window.setTimeout(() => controller.abort(), options.timeoutMs || 30000);

    let res;
    try {
      res = await fetch(normalizeRequestUrl(url), {
        ...options,
        headers,
        credentials: options.credentials || 'same-origin',
        signal: options.signal || controller.signal,
      });
    } catch (error) {
      if (error?.name === 'AbortError') {
        throw new Error('The portal request timed out. Please check your connection and try again.');
      }
      throw new Error('Unable to reach the secure portal server. Please try again.');
    } finally {
      window.clearTimeout(timeout);
    }

    let body = {};
    try { body = await res.json(); } catch (_) {}

    if (!res.ok) {
      if (res.status === 413) {
        throw new Error('The selected file is larger than the server upload limit.');
      }
      if (res.status === 419) {
        throw new Error('Your secure session expired. Refresh the page and try again.');
      }
      if (res.status === 429) {
        throw new Error('Too many requests. Please wait a moment and try again.');
      }
      const errors = body.errors ? Object.values(body.errors).flat().join(' ') : body.message;
      throw new Error(errors || 'Request failed.');
    }
    return body;
  };

  const adminForm = document.getElementById('gpcsHiddenAdminForm');
  if (adminForm) adminForm.setAttribute('action', '/admin/hidden-login');

  const ensureLoginEnhancements = () => {
    for (const id of ['previewStudentPassword', 'previewFacultyPassword']) {
      const form = document.getElementById(id);
      if (!form || form.querySelector('input[name="remember"]')) continue;

      const remember = document.createElement('label');
      remember.className = 'auth-preview-check gpcs-remember-check';
      remember.innerHTML = '<input type="checkbox" name="remember" value="1"> <span>Remember me on this device</span>';

      const linkRow = form.querySelector('.auth-preview-linkrow');
      if (linkRow) linkRow.before(remember);
      else form.querySelector('button[type="submit"]')?.before(remember);
    }

    const hash = window.location.hash;
    if (hash !== '#student-dashboard' && hash !== '#faculty-dashboard') return;

    const dashboard = document.querySelector('.reference-dashboard-section');
    if (!dashboard) return;

    dashboard.id = hash.slice(1);
    if (dashboard.dataset.roleLandingHandled !== '1') {
      dashboard.dataset.roleLandingHandled = '1';
      window.requestAnimationFrame(() => dashboard.scrollIntoView({block:'start'}));
    }
  };

  const inputs = (form, selector='input,select,textarea') => [...form.querySelectorAll(selector)].filter(x => !x.disabled);
  const valueByLabel = (form, labelText) => {
    const label = [...form.querySelectorAll('label')].find(l => l.textContent.trim().toLowerCase().startsWith(labelText.toLowerCase()));
    return label?.querySelector('input,select,textarea')?.value?.trim() || '';
  };
  const fileByLabel = (form, labelText) => {
    const label = [...form.querySelectorAll('label')].find(l => l.textContent.trim().toLowerCase().startsWith(labelText.toLowerCase()));
    return label?.querySelector('input[type=file]')?.files?.[0] || null;
  };
  const submitJson = async (url, payload) => request(url,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});

  const getByLabel = (form, labelText) => [...form.querySelectorAll('label')].find(l => l.textContent.trim().toLowerCase().startsWith(labelText.toLowerCase()))?.querySelector('input,select,textarea') || null;
  const fillIfBlank = (el, value) => { if (el && !el.value && value !== null && value !== undefined && String(value).trim() !== '') { el.value = String(value); el.dispatchEvent(new Event('change',{bubbles:true})); return true; } return false; };
  const normalizeSemesterForUi = (value, wantsPrefix=false) => { const v=String(value||'').replace(/^Semester\s+/i,'').trim().toUpperCase(); return wantsPrefix && v ? `Semester ${v}` : v; };
  let lookupTimer = null;
  const scheduleMetadataLookup = (form, kind) => {
    clearTimeout(lookupTimer);
    lookupTimer=setTimeout(async()=>{
      try{
        const params=new URLSearchParams();
        if(kind==='paper'){
          const mapping=[['Paper Code','paper_code'],['Subject Code','subject_code'],['Paper Name','paper_name'],['Subject Name','subject_name'],['Branch','branch'],['Semester','semester']];
          for(const [label,key] of mapping){const el=getByLabel(form,label);let v=el?.value?.trim()||'';if(key==='semester')v=v.replace(/^Semester\s+/i,'');if(v)params.set(key,v);}
        }else{
          for(const key of ['subject_code','subject_name','branch','semester']){const el=form.elements.namedItem(key);let v=el?.value?.trim()||'';if(key==='semester')v=v.replace(/^Semester\s+/i,'');if(v)params.set(key,v);}
        }
        if(!params.toString())return;
        const data=await request((kind==='paper'?routes.paperLookup:routes.noteLookup)+'?'+params.toString(), {timeoutMs:10000});
        if(!data?.unique)return;
        const u=data.unique;
        if(kind==='paper'){
          fillIfBlank(getByLabel(form,'Paper Code'),u.paper_code);fillIfBlank(getByLabel(form,'Subject Code'),u.subject_code);fillIfBlank(getByLabel(form,'Paper Name'),u.paper_name);fillIfBlank(getByLabel(form,'Subject Name'),u.subject_name);fillIfBlank(getByLabel(form,'Branch'),u.branch);fillIfBlank(getByLabel(form,'Semester'),normalizeSemesterForUi(u.semester,true));
        }else{
          fillIfBlank(form.elements.namedItem('subject_code'),u.subject_code);fillIfBlank(form.elements.namedItem('subject_name'),u.subject_name);fillIfBlank(form.elements.namedItem('branch'),u.branch);fillIfBlank(form.elements.namedItem('semester'),normalizeSemesterForUi(u.semester,true));
        }
      }catch(_){ /* Lookup is assistive; server-side validation remains authoritative. */ }
    },280);
  };

  document.addEventListener('input', (event) => {
    const form=event.target?.closest?.('form'); if(!form)return;
    if(form.id==='previewUploadForm')scheduleMetadataLookup(form,'paper');
    if(form.id==='previewNoteForm')scheduleMetadataLookup(form,'note');
  }, true);
  document.addEventListener('change', (event) => {
    const form=event.target?.closest?.('form'); if(!form)return;
    if(form.id==='previewUploadForm')scheduleMetadataLookup(form,'paper');
    if(form.id==='previewNoteForm')scheduleMetadataLookup(form,'note');
  }, true);

  document.addEventListener('submit', async (event) => {
    const form = event.target; if (!(form instanceof HTMLFormElement)) return;
    const id = form.id;
    if (!['previewStudentPassword','previewFacultyPassword','previewDynamicRegister','previewUploadForm','previewNoteForm','previewContactForm','previewResetForm'].includes(id)) return;
    event.preventDefault(); event.stopImmediatePropagation();
    const submitter = event.submitter;
    if (submitter instanceof HTMLButtonElement) submitter.disabled = true;
    try {
      if (id === 'previewStudentPassword' || id === 'previewFacultyPassword') {
        const els = inputs(form,'input'); const email=els.find(x=>x.type==='email')?.value||''; const password=els.find(x=>x.type==='password')?.value||'';
        const remember=form.querySelector('input[name="remember"]')?.checked===true;
        const body=await submitJson(routes.login,{email,password,role:id.includes('Faculty')?'faculty':'student',remember}); toast(body.message); location.href=body.redirect||'/'; return;
      }
      if (id === 'previewDynamicRegister') {
        const role = form.querySelector('[data-faculty-fields]')?.hidden === false ? 'faculty' : 'student';
        const fd = new FormData(); fd.set('role', role);
        const active = role==='faculty' ? form.querySelector('[data-faculty-fields]') : form.querySelector('[data-student-fields]');
        const a=[...active.querySelectorAll('input,select')];
        fd.set('name',a[0]?.value||'');fd.set('surname',a[1]?.value||'');fd.set('gender',a[2]?.value||'');fd.set('college_name',a[3]?.value||'');
        if(role==='student'){fd.set('college_year',a[4]?.value||'');fd.set('branch',a[5]?.value||'');fd.set('semester',a[6]?.value||'');}
        else{fd.set('subject_department',a[4]?.value||'');fd.set('employee_id',a[5]?.value||'');}
        const outer=[...form.querySelectorAll(':scope > label input, :scope > label textarea')];
        const mobile=outer.find(x=>x.inputMode==='numeric'&&x.maxLength===10);const email=outer.find(x=>x.type==='email');const passes=outer.filter(x=>x.type==='password');const pin=outer.find(x=>x.inputMode==='numeric'&&x.maxLength===6);const address=outer.find(x=>x.tagName==='TEXTAREA');const photo=outer.find(x=>x.type==='file');
        if(mobile?.value)fd.set('mobile',mobile.value);fd.set('email',email?.value||'');fd.set('password',passes[0]?.value||'');fd.set('password_confirmation',passes[1]?.value||'');if(pin?.value)fd.set('pin_code',pin.value);fd.set('address',address?.value||'');if(photo?.files?.[0])fd.set('profile_photo',photo.files[0]);
        const body=await request(routes.register,{method:'POST',body:fd,timeoutMs:45000});toast(body.message);location.href=body.redirect||'/';return;
      }
      if (id === 'previewUploadForm') {
        const fd=new FormData(); const f=fileByLabel(form,'Choose Paper File'); if(!f)throw new Error('Choose a Paper file.');
        if(f.size > 100 * 1024 * 1024) throw new Error('Paper file must be 100 MB or smaller.');
        fd.set('file',f);
        for(const [label,key] of [['Paper Code','paper_code'],['Subject Code','subject_code'],['Paper Name','paper_name'],['Subject Name','subject_name'],['Branch','branch'],['Semester','semester'],['Year','year'],['Session','session']]){const v=valueByLabel(form,label);if(v)fd.set(key,v);}
        const body=await request(routes.paperStore,{method:'POST',body:fd,timeoutMs:600000});toast(body.message);form.reset();return;
      }
      if (id === 'previewNoteForm') {
        const fd=new FormData(form);
        const attachment=form.querySelector('input[type="file"]')?.files?.[0];
        if(attachment && attachment.size > 200 * 1024 * 1024) throw new Error('Notes file must be 200 MB or smaller.');
        const body=await request(routes.noteStore,{method:'POST',body:fd,timeoutMs:900000});toast(body.message);form.reset();return;
      }
      if (id === 'previewContactForm') { const els=inputs(form); const body=await submitJson(routes.contactStore,{name:els[0]?.value||'',contact:els[1]?.value||'',message:els[2]?.value||''});toast(body.message);form.reset();return; }
      if (id === 'previewResetForm') { const email=form.querySelector('input[name="email"]')?.value?.trim() || valueByLabel(form,'Email ID'); if(!email.includes('@'))throw new Error('Enter the registered Email ID.'); const body=await submitJson(routes.forgot,{email});toast(body.message);return; }
    } catch (e) { toast(e.message || 'Unable to complete the request.'); }
    finally { if (submitter instanceof HTMLButtonElement) submitter.disabled = false; }
  }, true);

  const escapeHtml = (value) => String(value ?? '').replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));
  const safeHref = (value) => {
    if (!value) return null;
    try {
      const url = new URL(value, window.location.origin);
      if (url.origin === window.location.origin) return `${url.pathname}${url.search}${url.hash}`;
      return url.protocol === 'https:' ? url.toString() : null;
    } catch (_) { return null; }
  };

  const loadDigitalBoard = async () => {
    const main=document.querySelector('main');
    if(!main || document.getElementById('gpcsDigitalBoard'))return;
    const board=document.createElement('section');
    board.id='gpcsDigitalBoard';board.className='gpcs-digital-board';board.setAttribute('aria-live','polite');
    board.innerHTML='<div class="gpcs-digital-board-head"><h2>Digital Board</h2><span>Latest college notices</span></div><div class="gpcs-digital-board-list"><div class="gpcs-digital-board-empty">Loading notices…</div></div>';
    main.prepend(board);
    const list=board.querySelector('.gpcs-digital-board-list');
    try{
      const rows=await request('/api/notifications',{timeoutMs:12000});
      list.innerHTML=rows.length?rows.map(n=>{const href=safeHref(n.link);const tag=href?'a':'div';const attrs=href?` href="${escapeHtml(href)}"${href.startsWith('https://')?' target="_blank" rel="noopener noreferrer"':''}`:'';const date=n.published_at?new Date(n.published_at).toLocaleDateString(undefined,{day:'2-digit',month:'short',year:'numeric'}):'';return `<${tag} class="gpcs-digital-board-card"${attrs}><strong>${escapeHtml(n.title||'Notice')}</strong><p>${escapeHtml(n.message||'')}</p>${date?`<time>${escapeHtml(date)}</time>`:''}</${tag}>`;}).join(''):'<div class="gpcs-digital-board-empty">No notices are available right now.</div>';
    }catch(_){list.innerHTML='<div class="gpcs-digital-board-empty">Notices are temporarily unavailable. Please try again later.</div>';}
  };

  const loadLibraries = async () => {
    const paperRows=document.getElementById('previewPaperRows');
    if(paperRows && paperRows.dataset.liveLoaded!=='1'){
      paperRows.dataset.liveLoaded='1';
      try{const rows=await request(routes.papersApi);paperRows.innerHTML=rows.length?rows.map((p,i)=>`<tr><td>${i+1}</td><td>${escapeHtml(p.paper_code||'—')}</td><td>${escapeHtml(p.paper_name||'Paper')}</td><td>${escapeHtml(p.year||'—')}</td><td>${escapeHtml(p.session||'—')}</td><td><a class="route-btn small" href="${escapeHtml(p.download_url)}">Download</a></td></tr>`).join(''):'<tr><td colspan="6">No approved papers are available yet.</td></tr>';}catch(e){paperRows.innerHTML='<tr><td colspan="6">Unable to load papers right now.</td></tr>';}
    }
    const notes=document.getElementById('previewNotes');
    if(notes && notes.dataset.liveLoaded!=='1'){
      notes.dataset.liveLoaded='1';
      try{const rows=await request(routes.notesApi);notes.innerHTML=rows.length?rows.map(n=>`<div class="route-note"><div><b>${escapeHtml(n.title)}</b><small>${escapeHtml(n.branch)} • Semester ${escapeHtml(n.semester)} • ${escapeHtml(n.year)}</small></div><div class="route-actions" style="margin:0">${n.download_url?`<a class="route-btn" href="${escapeHtml(n.download_url)}">Download</a>`:'<span class="route-status">Text Notes</span>'}</div></div>`).join(''):'<div class="route-note"><div><b>No approved notes are available yet.</b></div></div>';}catch(e){notes.innerHTML='<div class="route-note"><div><b>Unable to load notes right now.</b></div></div>';}
    }
    const gallery=document.getElementById('previewGalleryLive');
    if(gallery && gallery.dataset.liveLoaded!=='1'){
      gallery.dataset.liveLoaded='1';
      try{const rows=await request(routes.galleryApi);gallery.innerHTML=rows.length?rows.map(g=>`<a class="route-gallery-card" href="${escapeHtml(g.image_url)}" target="_blank" rel="noopener"><img src="${escapeHtml(g.image_url)}" alt="${escapeHtml(g.caption||g.category||'College gallery image')}" loading="lazy" style="width:100%;height:150px;object-fit:cover;border-radius:12px;margin-bottom:10px"><b>${escapeHtml(g.caption||g.category||'College Image')}</b><small>${escapeHtml(g.category||'Gallery')}</small></a>`).join(''):'<div class="route-gallery-card"><b>No approved gallery images are available yet.</b></div>';}catch(e){gallery.innerHTML='<div class="route-gallery-card"><div><b>Unable to load gallery right now.</b></div></div>';}
    }
  };

  const observer=new MutationObserver(()=>{ensureLoginEnhancements();loadLibraries();});
  observer.observe(document.documentElement,{childList:true,subtree:true});
  document.addEventListener('DOMContentLoaded',()=>{ensureLoginEnhancements();loadDigitalBoard();loadLibraries();});
  setTimeout(()=>{ensureLoginEnhancements();loadDigitalBoard();loadLibraries();},0);

  document.addEventListener('change', async (event) => {
    if (event.target?.id !== 'previewGalleryInput') return;
    event.stopImmediatePropagation();
    const files=[...event.target.files]; if(!files.length)return;
    for(const file of files){const fd=new FormData();fd.set('image',file);fd.set('category','Other College Related');try{const body=await request(routes.galleryStore,{method:'POST',body:fd,timeoutMs:120000});toast(body.message);}catch(e){toast(e.message);break;}}
    event.target.value='';
  }, true);
})();
