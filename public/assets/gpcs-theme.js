(() => {
  const THEME_STORAGE_KEY = 'gpcs-theme';
  const root = document.documentElement;
  const media = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
  const validThemes = new Set(['light','dark','system']);

  const storedPreference = () => {
    try {
      const value = localStorage.getItem(THEME_STORAGE_KEY) || root.dataset.themePreference || 'system';
      return validThemes.has(value) ? value : 'system';
    } catch (_) { return 'system'; }
  };

  const resolvedTheme = preference => preference === 'system' ? (media?.matches ? 'dark' : 'light') : preference;

  const updateMetaColor = theme => {
    const meta = document.querySelector('meta[name="theme-color"]');
    if (meta) meta.setAttribute('content', theme === 'dark' ? '#07101f' : '#0a2558');
  };

  const themeNames = { light: 'Light', dark: 'Dark', system: 'System' };
  const applyTheme = (preference, persist = true) => {
    const safe = validThemes.has(preference) ? preference : 'system';
    const resolved = resolvedTheme(safe);
    root.dataset.theme = resolved;
    root.dataset.themePreference = safe;
    updateMetaColor(resolved);
    document.querySelectorAll('[data-theme-option]').forEach(button => {
      const active = button.dataset.themeOption === safe;
      button.classList.toggle('active', active);
      button.setAttribute('aria-pressed', active ? 'true' : 'false');
    });
    document.querySelectorAll('[data-theme-cycle]').forEach(button => {
      const label = button.querySelector('[data-theme-cycle-label]');
      if (label) label.textContent = themeNames[safe];
      button.setAttribute('aria-label', `Theme: ${themeNames[safe]}. Click to change theme`);
      button.setAttribute('title', `Theme: ${themeNames[safe]} · click to change`);
    });
    if (persist) { try { localStorage.setItem(THEME_STORAGE_KEY, safe); } catch (_) {} }
  };

  applyTheme(storedPreference(), false);
  document.querySelectorAll('[data-theme-option]').forEach(button => {
    button.addEventListener('click', () => applyTheme(button.dataset.themeOption || 'system'));
  });
  document.querySelectorAll('[data-theme-cycle]').forEach(button => {
    button.addEventListener('click', () => {
      const current = root.dataset.themePreference || storedPreference();
      const next = current === 'light' ? 'dark' : current === 'dark' ? 'system' : 'light';
      applyTheme(next);
    });
  });
  const onSystemChange = () => { if (storedPreference() === 'system') applyTheme('system', false); };
  if (media?.addEventListener) media.addEventListener('change', onSystemChange);
  else if (media?.addListener) media.addListener(onSystemChange);
})();

(() => {
  const menuBtn = document.querySelector('[data-menu]');
  const nav = document.querySelector('[data-nav]');
  if (menuBtn && nav) {
    menuBtn.addEventListener('click', () => nav.classList.toggle('open'));
    document.addEventListener('click', e => { if (!nav.contains(e.target) && !menuBtn.contains(e.target)) nav.classList.remove('open'); });
  }

  document.querySelectorAll('[data-dismiss]').forEach(btn => btn.addEventListener('click', () => btn.closest('.alert')?.remove()));

  document.querySelectorAll('[data-toggle-password]').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.parentElement.querySelector('[data-password]');
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
      btn.textContent = input.type === 'password' ? 'Show' : 'Hide';
    });
  });

  const formatSize = bytes => {
    if (bytes >= 1024 * 1024 * 1024) return `${(bytes / (1024 * 1024 * 1024)).toFixed(2)} GB`;
    if (bytes >= 1024 * 1024) return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    if (bytes >= 1024) return `${(bytes / 1024).toFixed(1)} KB`;
    return `${bytes} B`;
  };

  document.querySelectorAll('[data-dropzone]').forEach(zone => {
    const fileInput = zone.querySelector('[data-file-input]');
    const fileName = zone.querySelector('[data-file-name]');
    if (!fileInput) return;
    const update = () => {
      const f = fileInput.files?.[0];
      if (fileName) fileName.textContent = f ? `${f.name} · ${formatSize(f.size)}` : 'No file selected';
    };
    fileInput.addEventListener('change', update);
    ['dragenter','dragover'].forEach(evt => zone.addEventListener(evt, e => { e.preventDefault(); zone.classList.add('drag'); }));
    zone.addEventListener('dragleave', e => { e.preventDefault(); zone.classList.remove('drag'); });
    zone.addEventListener('drop', e => {
      e.preventDefault(); zone.classList.remove('drag');
      const files = e.dataTransfer?.files;
      if (!files?.length) return;
      try { fileInput.files = files; update(); } catch (_) { /* browser may block programmatic assignment */ }
    });
  });

  // Large-file uploads are owned by the Laravel backend bridge. The retired
  // chunk uploader was removed to prevent stale clients from calling a 410 endpoint.

  const tabButtons = document.querySelectorAll('[data-tab-btn]');
  const tabPanels = document.querySelectorAll('[data-tab-panel]');
  tabButtons.forEach(btn => btn.addEventListener('click', () => {
    tabButtons.forEach(b => b.classList.remove('active'));
    tabPanels.forEach(p => p.hidden = true);
    btn.classList.add('active');
    const panel = document.querySelector(`[data-tab-panel="${btn.dataset.tabBtn}"]`);
    if (panel) panel.hidden = false;
  }));
})();


// Paper Library rendering/search is owned by /assets/gpcs-backend-bridge.js.
// The retired legacy compatibility renderer was removed.

// v2.0 Smart Gallery — actual image-content classification in the browser.
// Manual category selection always wins; Smart Auto never uses filename/caption/OCR.
(() => {
  const panel = document.querySelector('#galleryUploadPanel');
  const form = panel?.querySelector('[data-gallery-ai-form]');
  if (!panel || !form) return;

  const select = form.querySelector('[data-gallery-category-select]');
  const fileInput = form.querySelector('[data-gallery-ai-files]');
  const aiJson = form.querySelector('[data-gallery-ai-json]');
  const status = form.querySelector('[data-gallery-ai-status]');
  const statusStrong = status?.querySelector('strong');
  const statusSmall = status?.querySelector('small');
  const submit = form.querySelector('button[type="submit"]');
  let modelPromise = null;
  let analysisRun = 0;

  const setStatus = (title, detail, state = '') => {
    if (!status) return;
    status.dataset.state = state;
    if (statusStrong) statusStrong.textContent = title;
    if (statusSmall) statusSmall.textContent = detail;
  };

  const loadScript = src => new Promise((resolve, reject) => {
    const existing = [...document.scripts].find(s => s.src === src);
    if (existing) { if (existing.dataset.loaded === '1') resolve(); else existing.addEventListener('load', resolve, { once: true }); return; }
    const script = document.createElement('script');
    script.src = src; script.async = true;
    script.onload = () => { script.dataset.loaded = '1'; resolve(); };
    script.onerror = () => reject(new Error('Visual AI library could not load.'));
    document.head.appendChild(script);
  });

  const loadModels = async () => {
    if (modelPromise) return modelPromise;
    modelPromise = (async () => {
      // Loaded only when Smart Add is used, so normal portal pages stay fast.
      await loadScript('https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.22.0/dist/tf.min.js');
      await Promise.all([
        loadScript('https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@2.1.1/dist/mobilenet.min.js'),
        loadScript('https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.3/dist/coco-ssd.min.js')
      ]);
      if (!window.mobilenet || !window.cocoSsd) throw new Error('Visual AI models are unavailable.');
      const [mobile, objects] = await Promise.all([
        window.mobilenet.load({ version: 2, alpha: 0.5 }),
        window.cocoSsd.load({ base: 'lite_mobilenet_v2' })
      ]);
      return { mobile, objects };
    })();
    try { return await modelPromise; } catch (err) { modelPromise = null; throw err; }
  };

  const makeImage = file => new Promise((resolve, reject) => {
    const url = URL.createObjectURL(file);
    const img = new Image();
    img.onload = () => { URL.revokeObjectURL(url); resolve(img); };
    img.onerror = () => { URL.revokeObjectURL(url); reject(new Error('Image could not be read.')); };
    img.src = url;
  });

  const labelRules = {
    campus: ['library','school','college','university','palace','monastery','building','hall','courtyard','patio','greenhouse','bookshop','bookstore'],
    events: ['stage','theater','theatre','curtain','spotlight','microphone','auditorium','banquet','ceremony','concert','performance'],
    labs: ['oscilloscope','microscope','computer','desktop computer','laptop','notebook computer','keyboard','monitor','printer','machine','workshop'],
    people: ['academic gown','suit','jersey','uniform','lab coat','maillot'],
    sports: ['soccer','football','basketball','volleyball','tennis','badminton','cricket','baseball','racket','sports ball','running shoe','swimming'],
    projects: ['robot','robotics','model','project','electronic','circuit','machine','engine','motor','drill','crane','tractor','solar','prototype']
  };

  const containsAny = (text, words) => words.some(w => text.includes(w));

  const categoryFromVisuals = (mobilePredictions, objectPredictions) => {
    const scores = { campus: 0, events: 0, labs: 0, people: 0, sports: 0, projects: 0 };
    const labels = mobilePredictions.map(p => `${p.className} (${Math.round(p.probability * 100)}%)`);
    const objectNames = objectPredictions.map(o => `${o.class} (${Math.round(o.score * 100)}%)`);

    for (const p of mobilePredictions) {
      const text = String(p.className || '').toLowerCase();
      for (const [cat, words] of Object.entries(labelRules)) {
        if (containsAny(text, words)) scores[cat] = Math.max(scores[cat], Math.min(.94, .34 + p.probability * .72));
      }
    }

    const count = name => objectPredictions.filter(o => o.class === name && o.score >= .45).length;
    const best = name => Math.max(0, ...objectPredictions.filter(o => o.class === name).map(o => o.score || 0));
    const people = count('person');
    const chairs = count('chair');
    const sportObjects = ['sports ball','baseball bat','baseball glove','tennis racket','frisbee','skateboard','skis','snowboard','surfboard'];
    const labObjects = ['laptop','keyboard','mouse','tv','cell phone'];

    if (people >= 2) scores.people = Math.max(scores.people, Math.min(.89, .72 + people * .025));
    if (people === 1) scores.people = Math.max(scores.people, .58 + best('person') * .12);
    if (people >= 6 && chairs >= 3) scores.events = Math.max(scores.events, .76 + Math.min(.12, people * .008));
    if (sportObjects.some(name => best(name) >= .50)) scores.sports = Math.max(scores.sports, .86);
    if (labObjects.some(name => best(name) >= .58)) scores.labs = Math.max(scores.labs, .76);

    const ordered = Object.entries(scores).sort((a,b) => b[1] - a[1]);
    const [category, confidence] = ordered[0];
    return { category, confidence: Number(confidence.toFixed(3)), labels, objects: objectNames, scores };
  };

  const classifyFile = async (file, index, models) => {
    const img = await makeImage(file);
    const [mobilePredictions, objectPredictions] = await Promise.all([
      models.mobile.classify(img, 8),
      models.objects.detect(img, 30, .42)
    ]);
    const result = categoryFromVisuals(mobilePredictions, objectPredictions);
    return { index, category: result.category, confidence: result.confidence, labels: result.labels, objects: result.objects, engine: 'tfjs-mobilenet+coco-ssd' };
  };

  const fallbackAnalysis = files => [...files].map((_, index) => ({
    index, category: 'college_activity', confidence: 0, labels: [], objects: [], engine: 'visual-ai-unavailable'
  }));

  const analyseSelected = async () => {
    const files = fileInput?.files;
    if (!files?.length) { aiJson.value = ''; setStatus('Visual AI ready on Smart Auto', 'Choose 1–10 images to analyse actual visual content.', ''); return; }
    if (select?.value !== 'auto') { aiJson.value = ''; form.dataset.aiReady = '1'; setStatus('Manual category selected', 'Auto-classification skipped. Your selected category has priority.', 'manual'); return; }

    const run = ++analysisRun;
    form.dataset.aiReady = '0';
    setStatus('Loading visual AI…', 'First Smart Add may download the browser AI models. Normal portal pages are not affected.', 'loading');
    try {
      const models = await loadModels();
      if (run !== analysisRun) return;
      const results = [];
      for (let i = 0; i < files.length; i++) {
        setStatus(`Analysing image ${i + 1} of ${files.length}…`, 'Reading actual pixels and objects — filename/caption are ignored.', 'loading');
        try { results.push(await classifyFile(files[i], i, models)); }
        catch (_) { results.push(fallbackAnalysis([files[i]])[0]); results[results.length - 1].index = i; }
      }
      if (run !== analysisRun) return;
      aiJson.value = JSON.stringify(results);
      form.dataset.aiReady = '1';
      const high = results.filter(r => r.confidence >= .70 && r.category !== 'college_activity').length;
      const low = results.length - high;
      setStatus('Images ready', low ? `${results.length} image(s) prepared. Some may be checked by Admin before publishing.` : `${results.length} image(s) prepared for upload.`, low ? 'review' : 'done');
    } catch (err) {
      const fallback = fallbackAnalysis(files);
      aiJson.value = JSON.stringify(fallback);
      form.dataset.aiReady = '1';
      setStatus('Automatic sorting will be checked', 'Your images can still be uploaded. The Admin can place them in the correct gallery section if needed.', 'review');
    }
  };

  const openPanel = category => {
    panel.hidden = false;
    if (select) select.value = category || 'auto';
    analysisRun++;
    form.dataset.aiReady = category && category !== 'auto' ? '1' : '0';
    if (aiJson) aiJson.value = '';
    if (category && category !== 'auto') setStatus('Manual category selected', 'Auto-classification will be skipped. Your category choice has priority.', 'manual');
    else setStatus('Smart Auto selected', 'Choose images and the portal will classify their actual visual content.', '');
    panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    setTimeout(() => fileInput?.focus(), 350);
  };

  document.querySelectorAll('[data-gallery-open]').forEach(button => button.addEventListener('click', () => openPanel(button.dataset.galleryOpen || 'auto')));
  document.querySelectorAll('[data-gallery-close]').forEach(button => button.addEventListener('click', () => { panel.hidden = true; }));

  select?.addEventListener('change', () => {
    analysisRun++;
    if (select.value === 'auto') { form.dataset.aiReady = '0'; analyseSelected(); }
    else { aiJson.value = ''; form.dataset.aiReady = '1'; setStatus('Manual category selected', 'Auto-classification skipped. Your selected category has priority.', 'manual'); }
  });
  fileInput?.addEventListener('change', () => {
    if ((fileInput.files?.length || 0) > 10) { alert('Please select a maximum of 10 images per upload.'); fileInput.value = ''; return; }
    form.dataset.aiReady = select?.value === 'auto' ? '0' : '1';
    if (select?.value === 'auto') analyseSelected();
  });

  form.addEventListener('submit', async event => {
    if (select?.value !== 'auto' || form.dataset.aiReady === '1') return;
    event.preventDefault();
    const original = submit?.textContent;
    if (submit) { submit.disabled = true; submit.textContent = 'Analysing images…'; }
    await analyseSelected();
    if (submit) { submit.disabled = false; submit.textContent = original || 'Upload Images'; }
    if (form.dataset.aiReady === '1') form.requestSubmit();
  });
})();

// v2.2.0 — lightweight sticky-header elevation. Visual only; no navigation behavior changed.
(() => {
  const header = document.querySelector('.site-header');
  if (!header) return;
  let ticking = false;
  const update = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 12);
    ticking = false;
  };
  update();
  window.addEventListener('scroll', () => {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  }, { passive: true });
})();

// v2.3.0 reference-style home: keep the visible media action useful without
// inventing an external video URL. It opens the approved college Gallery.
document.addEventListener('click', (event) => {
  const trigger = event.target.closest('[data-video-placeholder]');
  if (!trigger) return;
  window.location.href = 'index.php?page=gallery';
});
