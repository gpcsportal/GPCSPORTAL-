// Run from repository root after changing compatibility styles or portal selectors.
const fs = require('node:fs');
const { PurgeCSS } = require('purgecss');
const CleanCSS = require('clean-css');
(async () => {
  const [result] = await new PurgeCSS().purge({
    content: ['resources/views/**/*.blade.php', 'public/assets/*.js'],
    css: ['resources/css/gpcs-portal.css'],
    safelist: {
      standard: ['show','active','open','is-open','hidden','is-active','approved','pending','rejected','is-faculty','dark','light','system','pending-review','needs-review','is-loading','has-error','is-visible'],
      deep: [/data-theme/,/auth-preview/,/gpcs-signin/,/gpcs-hidden-admin/,/gpcs-logo/],
    },
  });
  const css = new CleanCSS({level:2}).minify(result.css);
  if (css.errors.length) throw new Error(css.errors.join('\n'));
  fs.writeFileSync('public/assets/gpcs-portal.css',css.styles);
})().catch(error => { console.error(error); process.exit(1); });
