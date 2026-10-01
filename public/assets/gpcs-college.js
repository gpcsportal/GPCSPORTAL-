(() => {
  'use strict';
  const toggle = document.querySelector('.college-menu-toggle');
  const menu = document.getElementById('college-menu');
  const closeMenu = () => {
    menu?.classList.remove('is-open');
    toggle?.setAttribute('aria-expanded', 'false');
  };
  toggle?.addEventListener('click', () => {
    const open = toggle.getAttribute('aria-expanded') !== 'true';
    toggle.setAttribute('aria-expanded', String(open));
    menu?.classList.toggle('is-open', open);
  });
  document.addEventListener('keydown', event => {
    if (event.key !== 'Escape') return;
    if (toggle?.getAttribute('aria-expanded') === 'true') { closeMenu(); toggle.focus(); }
    document.querySelectorAll('.college-nav details[open]').forEach(details => { details.open = false; details.querySelector('summary')?.focus(); });
  });
  menu?.querySelectorAll('a').forEach(link => {
    if (new URL(link.href, location.href).pathname === location.pathname) link.setAttribute('aria-current', 'page');
    link.addEventListener('click', closeMenu);
  });
  const dialog = document.querySelector('.college-search-dialog');
  const search = document.getElementById('college-search-input');
  const results = document.querySelector('.college-search-results');
  const pages = [['Admissions & Fees','/admissions'],['Programmes & Departments','/departments'],['About the College','/about'],['Faculty','/faculty'],['Campus Facilities','/facilities'],['Placements & Careers','/placements'],['Notices & Timetable','/notices'],['Campus Gallery','/gallery'],['Contact & Campus Map','/contact'],['Frequently Asked Questions','/faq'],['Computer Science','/programmes/cs'],['Mechanical Engineering','/programmes/me'],['Electrical Engineering','/programmes/ee'],['Electronics & Telecommunication','/programmes/et']];
  const activeProgrammes = new Set((dialog?.dataset.activeProgrammes || '').split(','));
  function renderSearch() {
    if (!search || !results) return;
    results.replaceChildren();
    const matches = pages.filter(([title, href]) => (!href.startsWith('/programmes/') || activeProgrammes.has(href.split('/').pop())) && title.toLowerCase().includes(search.value.trim().toLowerCase()));
    if (!matches.length) { const p = document.createElement('p'); p.textContent = 'No matching pages. Try another term or contact the college.'; results.append(p); }
    matches.forEach(([title, href]) => { const a = document.createElement('a'); a.href = href; a.textContent = title; a.setAttribute('data-gpcs-public-link',''); results.append(a); });
  }
  document.querySelector('.college-search-trigger')?.addEventListener('click', () => { dialog?.showModal(); renderSearch(); search?.focus(); });
  document.querySelector('[data-college-search-close]')?.addEventListener('click', () => dialog?.close());
  search?.addEventListener('input', renderSearch);
  dialog?.addEventListener('keydown', event => { if (event.key === 'Escape') { event.preventDefault(); dialog.close(); } });
  dialog?.addEventListener('cancel', () => dialog.close());
  // Add sorting only to the currently rendered admin rows. Server pagination remains authoritative.
  document.querySelectorAll('body[data-college-admin] table').forEach(table => {
    const rows = [...table.rows];
    const heading = rows.shift();
    if (!heading || rows.length === 0 || rows[0].cells.length === 1) return;
    [...heading.cells].forEach((cell, index) => {
      if (['Actions','Moderation'].includes(cell.textContent.trim())) return;
      const button = document.createElement('button');
      button.className = 'college-table-sort'; button.type = 'button'; button.textContent = cell.textContent.trim();
      cell.replaceChildren(button); cell.setAttribute('scope', 'col'); cell.setAttribute('aria-sort', 'none');
      button.addEventListener('click', () => {
        const ascending = cell.getAttribute('aria-sort') !== 'ascending';
        [...heading.cells].forEach(c => c.setAttribute('aria-sort', 'none'));
        cell.setAttribute('aria-sort', ascending ? 'ascending' : 'descending');
        const sorted = rows.slice().sort((a,b) => a.cells[index].textContent.trim().localeCompare(b.cells[index].textContent.trim(), undefined, {numeric:true}) * (ascending ? 1 : -1));
        sorted.forEach(row => row.parentElement.appendChild(row));
      });
    });
    const field = document.createElement('input'); field.type = 'search'; field.placeholder = 'Filter rows on this page'; field.setAttribute('aria-label', 'Filter table rows on the current page'); field.className = 'college-table-filter';
    const status = document.createElement('p'); status.setAttribute('role','status'); status.className = 'muted';
    const dialog = document.createElement('dialog'); dialog.className = 'college-table-dialog';
    const close = document.createElement('button'); close.type = 'button'; close.textContent = 'Close filter';
    const trigger = document.createElement('button'); trigger.type = 'button'; trigger.className = 'college-table-sort'; trigger.textContent = ' · Filter'; trigger.setAttribute('aria-label', 'Filter table rows on this page');
    heading.lastElementChild.append(trigger);
    dialog.setAttribute('aria-label','Filter rows on the current page'); dialog.append(field,status,close); document.body.append(dialog);
    trigger.addEventListener('click', () => { dialog.showModal(); field.focus(); });
    close.addEventListener('click', () => dialog.close());
    field.addEventListener('input', () => {
      const query = field.value.trim().toLocaleLowerCase(); let visible = 0;
      rows.forEach(row => { row.hidden = !row.textContent.toLocaleLowerCase().includes(query); if (!row.hidden) visible++; });
      status.textContent = visible ? `${visible} matching rows on this page.` : 'No matching rows on this page. Clear the filter or use another page.';
    });
  });
})();
