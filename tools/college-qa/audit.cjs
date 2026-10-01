const { chromium, firefox, webkit } = require('playwright');
const AxeBuilder = require('@axe-core/playwright').default;
const fs = require('node:fs');
const assert = require('node:assert/strict');
const origin = process.env.GPCS_QA_URL || 'http://127.0.0.1:8000';
const pages = ['/', '/about', '/departments', '/programmes/cs', '/admissions', '/faculty', '/facilities', '/placements', '/notices', '/gallery', '/contact', '/faq'];
(async () => {
  fs.mkdirSync('qa-artifacts', {recursive:true});
  const engines = process.env.GPCS_QA_CHROMIUM_PATH ? [['chromium', chromium]] : [['chromium',chromium],['firefox',firefox],['webkit',webkit]];
  const results = [];
  for (const [engine, type] of engines) {
    const browser = await type.launch(process.env.GPCS_QA_CHROMIUM_PATH ? {executablePath:process.env.GPCS_QA_CHROMIUM_PATH,args:['--no-sandbox']} : {});
    const context = await browser.newContext({reducedMotion:'reduce'});
    const page = await context.newPage(); const errors = [];
    page.on('pageerror', e => errors.push(e.message));
    page.on('console', m => { if (['error','warning'].includes(m.type())) errors.push(m.text()); });
    for (const width of [360,768,1024,1440]) {
      await page.setViewportSize({width,height:900});
      for (const path of pages) {
        const response = await page.goto(origin+path); assert.equal(response.status(),200,path);
        await page.waitForLoadState('networkidle');
        const overflow = await page.evaluate(() => document.documentElement.scrollWidth > innerWidth);
        assert.equal(overflow,false,`${engine} ${width} ${path}: overflow`);
        assert.equal(await page.locator('h1:visible').count(),1,`${path}: one visible H1`);
        assert.equal(await page.locator('img').evaluateAll(imgs=>imgs.some(img=>img.complete&&!img.naturalWidth)),false,`${path}: broken image`);
        if (width===1440 || width===360) {
          const axe = await new AxeBuilder({page}).withTags(['wcag2a','wcag2aa','wcag21aa']).analyze();
          assert.deepEqual(axe.violations.map(v=>({id:v.id,nodes:v.nodes.map(n=>n.target)})),[],`${engine} ${width} ${path}: accessibility`);
        }
        results.push({engine,width,path,status:'passed'});
      }
      await page.goto(origin+'/');
      await page.screenshot({path:`qa-artifacts/home-${engine}-${width}.png`,fullPage:true});
    }
    await page.goto(origin+'/');
    if (await page.locator('.college-menu-toggle').isVisible()) await page.locator('.college-menu-toggle').click();
    await page.locator('.college-search-trigger').click();
    await page.locator('#college-search-input').fill('fees');
    assert.equal(await page.locator('.college-search-results a').count(),1);
    await page.keyboard.press('Escape');
    assert.equal(await page.locator('.college-search-dialog').isVisible(),false,'Search closes with Escape');
    await page.goto(origin+'/#login');
    await page.waitForSelector('[data-auth-preview-panel="student"]');
    await page.locator('[data-auth-preview-toggle]').click();
    assert.equal(await page.locator('[data-auth-preview-panel="faculty"]').isVisible(),true);
    await page.goto(origin+'/');
    await page.locator('.reference-header .logo-interactive').click();
    await page.waitForSelector('#gpcsLogoLightbox.is-open');
    assert.ok((await page.locator('#gpcsLogoLightbox img').getAttribute('src')).includes('gpcs-embedded-628bb00a48b0.webp'));
    await page.keyboard.press('Escape');
    assert.equal(await page.locator('#gpcsLogoLightbox').getAttribute('aria-hidden'),'true');
    assert.deepEqual(errors,[],`${engine}: console`);
    await browser.close();
  }
  fs.writeFileSync('qa-artifacts/browser-results.json',JSON.stringify(results,null,2));
  console.log(`${results.length} browser/viewport/page checks passed.`);
})().catch(error=>{console.error(error);process.exit(1)});
