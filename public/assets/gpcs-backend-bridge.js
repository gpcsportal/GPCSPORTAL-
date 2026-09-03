(() => {
  const cfg = window.GPCS_BACKEND || {};
  const routes = cfg.routes || {};
  const csrf = cfg.csrf || '';
  const toast = (message) => { if (typeof window.toast === 'function') window.toast(message); else alert(message); };
  const request = async (url, options = {}) => {
    const headers = new Headers(options.headers || {}); headers.set('X-CSRF-TOKEN', csrf); headers.set('Accept','application/json');
    const res = await fetch(url, {...options, headers});
    let body = {}; try { body = await res.json(); } catch (_) {}
    if (!res.ok) { const errors = body.errors ? Object.values(body.errors).flat().join(' ') : body.message; throw new Error(errors || 'Request failed.'); }
    return body;
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
        const data=await request((kind==='paper'?routes.paperLookup:routes.noteLookup)+'?'+params.toString());
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
    try {
      if (id === 'previewStudentPassword' || id === 'previewFacultyPassword') {
        const els = inputs(form,'input'); const email=els.find(x=>x.type==='email')?.value||''; const password=els.find(x=>x.type==='password')?.value||'';
        const body=await submitJson(routes.login,{email,password,role:id.includes('Faculty')?'faculty':'student'}); toast(body.message); location.href='/'; return;
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
        const body=await request(routes.register,{method:'POST',body:fd});toast(body.message);location.href='/';return;
      }
      if (id === 'previewUploadForm') {
        const fd=new FormData(); const f=fileByLabel(form,'Choose Paper File'); if(!f)throw new Error('Choose a Paper file.'); fd.set('file',f);
        for(const [label,key] of [['Paper Code','paper_code'],['Subject Code','subject_code'],['Paper Name','paper_name'],['Subject Name','subject_name'],['Branch','branch'],['Semester','semester'],['Year','year'],['Session','session']]){const v=valueByLabel(form,label);if(v)fd.set(key,v);}
        const body=await request(routes.paperStore,{method:'POST',body:fd});toast(body.message);form.reset();return;
      }
      if (id === 'previewNoteForm') { const fd=new FormData(form); const body=await request(routes.noteStore,{method:'POST',body:fd});toast(body.message);form.reset();return; }
      if (id === 'previewContactForm') { const els=inputs(form); const body=await submitJson(routes.contactStore,{name:els[0]?.value||'',contact:els[1]?.value||'',message:els[2]?.value||''});toast(body.message);form.reset();return; }
      if (id === 'previewResetForm') { const email=form.querySelector('input[name="email"]')?.value?.trim() || valueByLabel(form,'Email ID'); if(!email.includes('@'))throw new Error('Enter the registered Email ID.'); const body=await submitJson(routes.forgot,{email});toast(body.message);return; }
    } catch (e) { toast(e.message || 'Unable to complete the request.'); }
  }, true);


  const escapeHtml = (value) => String(value ?? '').replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));
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
      try{const rows=await request(routes.galleryApi);gallery.innerHTML=rows.length?rows.map(g=>`<a class="route-gallery-card" href="${escapeHtml(g.image_url)}" target="_blank" rel="noopener"><img src="${escapeHtml(g.image_url)}" alt="${escapeHtml(g.caption||g.category||'College gallery image')}" loading="lazy" style="width:100%;height:150px;object-fit:cover;border-radius:12px;margin-bottom:10px"><b>${escapeHtml(g.caption||g.category||'College Image')}</b><small>${escapeHtml(g.category||'Gallery')}</small></a>`).join(''):'<div class="route-gallery-card"><b>No approved gallery images are available yet.</b></div>';}catch(e){gallery.innerHTML='<div class="route-gallery-card"><b>Unable to load gallery right now.</b></div>';}
    }
  };
  const observer=new MutationObserver(()=>loadLibraries()); observer.observe(document.documentElement,{childList:true,subtree:true}); document.addEventListener('DOMContentLoaded',loadLibraries); setTimeout(loadLibraries,0);

  document.addEventListener('change', async (event) => {
    if (event.target?.id !== 'previewGalleryInput') return;
    event.stopImmediatePropagation();
    const files=[...event.target.files]; if(!files.length)return;
    for(const file of files){const fd=new FormData();fd.set('image',file);fd.set('category','Other College Related');try{const body=await request(routes.galleryStore,{method:'POST',body:fd});toast(body.message);}catch(e){toast(e.message);break;}}
    event.target.value='';
  }, true);
})();
