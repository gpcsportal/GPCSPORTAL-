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
<title>Home — GPCS Portal</title>
<style>:root{
  --navy-950:#06142f;
  --navy-900:#081b3f;
  --navy-800:#0d2a5f;
  --blue-700:#1d4ed8;
  --blue-600:#2563eb;
  --blue-500:#3b82f6;
  --sky-500:#0ea5e9;
  --cyan-400:#22d3ee;
  --ink:#0d1b34;
  --ink-2:#34445f;
  --muted:#72809a;
  --bg:#f5f7fb;
  --surface:#ffffff;
  --surface-2:#f8faff;
  --surface-blue:#eef5ff;
  --line:#e4e9f2;
  --line-strong:#d3dcec;
  --ok:#0b8f68;
  --warn:#a86700;
  --bad:#c03a4a;
  --shadow-xs:0 1px 2px rgba(6,20,47,.04);
  --shadow-sm:0 8px 24px rgba(18,45,90,.07);
  --shadow-md:0 18px 48px rgba(13,42,95,.10);
  --shadow-lg:0 28px 80px rgba(8,27,63,.18);
  --radius-xs:12px;
  --radius-sm:16px;
  --radius:22px;
  --radius-lg:30px;
  --max:1240px;
}

*{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:110px}
body{
  margin:0;
  font-family:Inter,"SF Pro Display","Segoe UI",Roboto,system-ui,-apple-system,sans-serif;
  color:var(--ink);
  background:
    radial-gradient(circle at 8% 0%,rgba(59,130,246,.10),transparent 28rem),
    radial-gradient(circle at 92% 8%,rgba(34,211,238,.08),transparent 24rem),
    linear-gradient(180deg,#f9fbff 0,#f4f7fc 46%,#f7f9fd 100%);
  line-height:1.55;
  min-height:100vh;
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
}
body:before{
  content:"";position:fixed;inset:0;pointer-events:none;z-index:-2;opacity:.28;
  background-image:linear-gradient(rgba(19,58,123,.025) 1px,transparent 1px),linear-gradient(90deg,rgba(19,58,123,.025) 1px,transparent 1px);
  background-size:40px 40px;
  mask-image:linear-gradient(to bottom,black,transparent 76%);
}
a{color:inherit;text-decoration:none}
button,input,select,textarea{font:inherit}
button{cursor:pointer}
img{max-width:100%;display:block}
[hidden]{display:none!important}
.container{width:min(calc(100% - 32px),var(--max));margin-inline:auto}
.narrow{max-width:590px}

/* Ambient layers */
.bg-orb{position:fixed;border-radius:50%;filter:blur(95px);opacity:.12;pointer-events:none;z-index:-1}
.orb-a{width:420px;height:420px;background:#2563eb;top:70px;right:-170px}
.orb-b{width:360px;height:360px;background:#22d3ee;bottom:4%;left:-170px}

/* Premium floating header */
.site-header{position:sticky;top:0;z-index:80;padding:14px 0 0;background:linear-gradient(180deg,rgba(248,250,255,.94),rgba(248,250,255,.72) 65%,transparent);backdrop-filter:blur(10px)}
.header-row{
  min-height:70px;display:flex;align-items:center;gap:18px;
  padding:10px 12px 10px 14px;border:1px solid rgba(211,220,236,.86);border-radius:22px;
  background:rgba(255,255,255,.88);box-shadow:0 12px 42px rgba(13,42,95,.09);backdrop-filter:blur(22px)
}
.brand{display:flex;align-items:center;gap:11px;min-width:0;margin-right:auto}
.brand-mark{width:46px;height:46px;display:grid;place-items:center;border-radius:15px;background:linear-gradient(145deg,var(--navy-900),var(--blue-600));box-shadow:0 12px 28px rgba(29,78,216,.23);flex:none;position:relative;overflow:hidden}
.brand-mark:after{content:"";position:absolute;inset:-35% 40% 45% -20%;background:linear-gradient(135deg,rgba(255,255,255,.48),transparent);transform:rotate(25deg)}
.brand-mark svg{width:27px;fill:#fff;position:relative;z-index:1}
.brand strong,.brand small{display:block}
.brand strong{font-size:1rem;letter-spacing:-.01em}
.brand small{font-size:.68rem;color:var(--muted);white-space:nowrap;max-width:255px;overflow:hidden;text-overflow:ellipsis;margin-top:1px}
.header-quick{display:flex;align-items:center;gap:4px;padding:4px;background:#f4f7fb;border:1px solid var(--line);border-radius:14px}
.header-quick a{padding:9px 12px;border-radius:10px;font-size:.78rem;font-weight:800;color:#44546f;transition:.2s}
.header-quick a:hover,.header-quick a.active{background:#fff;color:var(--blue-600);box-shadow:var(--shadow-xs)}
.menu-btn{display:grid;width:46px;height:46px;border:1px solid var(--line);background:#fff;border-radius:14px;padding:11px;place-content:center;gap:5px;box-shadow:var(--shadow-xs)}
.menu-btn span{display:block;width:20px;height:2px;background:var(--navy-900);border-radius:999px;transition:.2s}
.main-nav{
  position:fixed;right:20px;top:98px;width:min(390px,calc(100vw - 32px));max-height:calc(100vh - 118px);
  display:none;grid-template-columns:1fr 1fr;gap:6px;padding:12px;overflow:auto;
  background:rgba(255,255,255,.97);border:1px solid var(--line);border-radius:24px;box-shadow:var(--shadow-lg);backdrop-filter:blur(22px)
}
.main-nav.open{display:grid;animation:menuIn .2s ease-out}
@keyframes menuIn{from{opacity:0;transform:translateY(-8px) scale(.98)}to{opacity:1;transform:none}}
.nav-link,.nav-cta{padding:12px 13px;border-radius:13px;font-size:.82rem;font-weight:800;color:#42526c;transition:.18s;border:1px solid transparent}
.nav-link:hover,.nav-link.active{background:var(--surface-blue);color:var(--blue-700);border-color:#dce9ff}
.nav-link.logout{color:#a82e40;background:#fff7f8}
.nav-cta{grid-column:1/-1;background:linear-gradient(135deg,var(--navy-900),var(--blue-600));color:#fff;text-align:center;box-shadow:0 10px 25px rgba(37,99,235,.18)}

/* Type system */
.eyebrow{display:inline-flex;align-items:center;gap:8px;text-transform:uppercase;letter-spacing:.13em;font-size:.68rem;font-weight:900;color:var(--blue-600);margin-bottom:10px}
.eyebrow:before{content:"";width:22px;height:2px;border-radius:99px;background:currentColor}
h1,h2,h3{color:var(--ink)}

/* Home hero */
.hero{padding:58px 0 54px;position:relative}
.hero-grid{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(360px,.85fr);gap:42px;align-items:center}
.hero-copy{position:relative}
.hero h1,.page-hero h1{font-size:clamp(2.65rem,5.4vw,5.45rem);line-height:.96;letter-spacing:-.062em;margin:0 0 20px;max-width:920px}
.hero h1 span{background:linear-gradient(100deg,var(--blue-600),var(--sky-500));-webkit-background-clip:text;background-clip:text;color:transparent}
.hero p{font-size:1.05rem;color:#65748e;max-width:700px;margin:0 0 27px;line-height:1.75}
.hero-actions{display:flex;gap:11px;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:1px solid transparent;border-radius:14px;padding:12px 18px;font-weight:850;line-height:1.1;transition:transform .18s,box-shadow .18s,background .18s,border-color .18s;color:var(--ink);background:#fff;min-height:44px}
.btn:hover{transform:translateY(-2px)}
.btn.primary{background:linear-gradient(135deg,var(--navy-900),var(--blue-600));color:#fff;box-shadow:0 12px 30px rgba(37,99,235,.24)}
.btn.primary:hover{box-shadow:0 18px 36px rgba(37,99,235,.28)}
.btn.secondary{background:#edf4ff;color:var(--blue-700);border-color:#d9e8ff}
.btn.ghost{background:#fff;border-color:var(--line);color:#34445f}
.btn.danger{background:#fff2f4;color:var(--bad);border-color:#ffd8df}
.btn.full{width:100%}.btn.large{padding:15px 22px;font-size:1rem}.btn.small{padding:9px 13px;border-radius:11px;font-size:.8rem;min-height:38px}.btn.tiny{padding:7px 10px;border-radius:10px;font-size:.72rem;min-height:32px}
.branch-pills{display:flex;gap:8px;margin-top:27px;flex-wrap:wrap}
.branch-pills span{font-size:.7rem;font-weight:900;color:var(--navy-800);background:rgba(255,255,255,.72);border:1px solid var(--line);padding:7px 11px;border-radius:999px;box-shadow:var(--shadow-xs);backdrop-filter:blur(10px)}
.glass-card{background:linear-gradient(160deg,rgba(255,255,255,.94),rgba(248,251,255,.86));border:1px solid rgba(255,255,255,.95);box-shadow:var(--shadow-md);backdrop-filter:blur(18px)}
.hero-panel{padding:26px;border-radius:30px;position:relative;overflow:hidden;border-color:#dfe9f8}
.hero-panel:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 100% 0%,rgba(59,130,246,.12),transparent 42%),linear-gradient(145deg,transparent 50%,rgba(14,165,233,.05));pointer-events:none}
.hero-panel>*{position:relative}
.panel-top{display:flex;justify-content:space-between;align-items:center;gap:15px}
.panel-top small,.panel-top strong{display:block}.panel-top small{color:var(--muted);font-size:.7rem}.panel-top strong{font-size:1.45rem;letter-spacing:-.035em;margin-top:2px}
.live-dot{font-size:.67rem;font-weight:900;color:var(--ok);background:#e9faf4;border:1px solid #c8f0e2;border-radius:999px;padding:7px 10px;display:inline-flex;align-items:center;gap:6px}
.live-dot:before{content:"";width:7px;height:7px;background:#17b77f;border-radius:50%;box-shadow:0 0 0 4px rgba(23,183,127,.12)}
.hero-search{margin:26px 0 18px}.hero-search label{display:block;font-size:.74rem;font-weight:850;margin-bottom:8px;color:#3a4c68}
.search-row{display:flex;background:#f3f6fb;border:1px solid var(--line);padding:5px;border-radius:15px;transition:.18s}
.search-row:focus-within{background:#fff;border-color:#9ec3ff;box-shadow:0 0 0 4px rgba(37,99,235,.08)}
.search-row input{border:0;background:transparent;outline:0;min-width:0;flex:1;padding:10px 11px;margin:0;box-shadow:none}
.icon-btn{width:44px;border:0;border-radius:11px;color:#fff;background:linear-gradient(135deg,var(--blue-600),var(--sky-500));font-size:1.25rem;box-shadow:0 8px 18px rgba(37,99,235,.18)}
.mini-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}
.mini-stats div{background:rgba(245,248,253,.9);border:1px solid #e8edf5;border-radius:16px;padding:13px}
.mini-stats strong,.mini-stats span{display:block}.mini-stats strong{font-size:1.35rem;letter-spacing:-.03em}.mini-stats span{color:var(--muted);font-size:.67rem;margin-top:2px}

/* Sections & cards */
.section{padding:64px 0}.section.soft{background:linear-gradient(180deg,rgba(237,244,255,.72),rgba(248,250,254,.55));border-block:1px solid rgba(220,229,243,.7)}
.section-head{display:flex;align-items:end;justify-content:space-between;gap:24px;margin-bottom:26px}.section-head h2{font-size:clamp(1.9rem,3.2vw,2.85rem);line-height:1.05;letter-spacing:-.045em;margin:0;max-width:720px}
.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}.feature-grid.four{grid-template-columns:repeat(4,1fr)}
.feature-card{background:rgba(255,255,255,.92);border:1px solid var(--line);border-radius:24px;padding:22px;box-shadow:var(--shadow-sm);transition:.22s;min-height:226px;display:flex;flex-direction:column;position:relative;overflow:hidden}
.feature-card:after{content:"";position:absolute;width:120px;height:120px;border-radius:50%;right:-60px;top:-60px;background:radial-gradient(circle,rgba(59,130,246,.12),transparent 68%);transition:.22s}
.feature-card:not(.static):hover{transform:translateY(-5px);box-shadow:var(--shadow-md);border-color:#cbdcff}.feature-card:not(.static):hover:after{transform:scale(1.5)}
.feature-icon{width:50px;height:50px;border-radius:16px;display:grid;place-items:center;background:linear-gradient(145deg,#e9f2ff,#effbff);border:1px solid #dceaff;color:var(--blue-700);font-weight:900;font-size:1.15rem;box-shadow:inset 0 1px 0 #fff}
.feature-card h3{margin:18px 0 7px;font-size:1.08rem;letter-spacing:-.02em}.feature-card p{margin:0;color:var(--muted);font-size:.86rem;line-height:1.65}.feature-card b{margin-top:auto;padding-top:18px;color:var(--blue-600);font-size:.78rem}
.branch-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
.branch-card{display:flex;align-items:center;gap:15px;background:#fff;border:1px solid var(--line);padding:16px;border-radius:20px;box-shadow:var(--shadow-sm);transition:.2s}
.branch-card:hover{transform:translateY(-3px);border-color:#cbdcff;box-shadow:var(--shadow-md)}
.branch-card>span{width:52px;height:52px;display:grid;place-items:center;border-radius:16px;background:linear-gradient(145deg,var(--navy-900),var(--blue-600));color:#fff;font-weight:950;box-shadow:0 9px 20px rgba(37,99,235,.18)}
.branch-card h3{font-size:.94rem;margin:0 0 2px}.branch-card p{font-size:.72rem;color:var(--muted);margin:0}.branch-card b{margin-left:auto;color:var(--blue-600);font-size:1.15rem}

/* Internal page hero */
.page-hero{padding:62px 0 44px;position:relative;overflow:hidden;background:linear-gradient(145deg,#f1f6ff,#f9fbff 65%);border-bottom:1px solid #e4ebf7}
.page-hero:after{content:"";position:absolute;width:430px;height:430px;border-radius:50%;right:-160px;top:-260px;border:1px solid rgba(37,99,235,.10);box-shadow:0 0 0 58px rgba(37,99,235,.028),0 0 0 116px rgba(14,165,233,.02)}
.page-hero .container{position:relative;z-index:1}.page-hero.compact{padding:44px 0 30px}.page-hero h1{font-size:clamp(2.25rem,4.4vw,4.15rem);margin-bottom:12px}.page-hero p{max-width:780px;color:var(--muted);margin:0;font-size:.98rem;line-height:1.7}
.admin-hero{background:linear-gradient(135deg,var(--navy-950),#0d3475 65%,#1357b6);color:#fff;border:0}.admin-hero h1{color:#fff}.admin-hero .eyebrow{color:#7dd3fc}.admin-hero p{color:#c9d9f3}

/* Feedback */
.alert,.setup-banner,.notice{margin-top:14px;border-radius:15px;padding:13px 15px;display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:.84rem;box-shadow:var(--shadow-xs)}
.alert button{border:0;background:transparent;font-size:1.15rem}.alert.success{background:#eaf9f3;color:#087253;border:1px solid #c8ecdf}.alert.warning,.setup-banner{background:#fff8e8;color:#7d5705;border:1px solid #f2dfb2}.alert.error{background:#fff1f3;color:#9e2738;border:1px solid #f3cfd6}.setup-banner a{color:var(--blue-700);font-weight:900}.notice{background:#edf5ff;border:1px solid #d7e6ff;color:#31517f}.notice strong{color:var(--blue-700)}

/* Forms */
.form-shell{max-width:930px}.upload-form{padding:26px;border-radius:28px}.upload-zone{position:relative;border:1.5px dashed #9fb6d8;border-radius:22px;background:linear-gradient(180deg,#f9fbff,#f2f7ff);text-align:center;padding:42px 18px;transition:.2s;overflow:hidden}
.upload-zone:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 50% 0%,rgba(59,130,246,.09),transparent 45%);pointer-events:none}.upload-zone.drag{background:#eef6ff;border-color:var(--blue-600);transform:scale(1.003);box-shadow:0 0 0 5px rgba(37,99,235,.07)}
.upload-zone input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;margin:0}.upload-zone>*:not(input){position:relative;pointer-events:none}.upload-icon{width:62px;height:62px;border-radius:19px;background:linear-gradient(145deg,var(--navy-900),var(--blue-600));display:grid;place-items:center;margin:0 auto 12px;color:#fff;font-size:1.55rem;box-shadow:0 14px 30px rgba(37,99,235,.23)}
.upload-zone h3{margin:4px 0;font-size:1.05rem}.upload-zone p{margin:2px;color:var(--muted);font-size:.86rem}.upload-zone small{display:block;color:var(--blue-600);font-weight:800;margin-top:7px}
.optional-head{display:flex;justify-content:space-between;align-items:end;gap:14px;margin:28px 0 18px}.optional-head h2{margin:0;letter-spacing:-.03em}.auto-badge{background:#e9f9f3;color:var(--ok);font-size:.68rem;font-weight:900;padding:7px 10px;border-radius:999px;border:1px solid #c9eddf}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.form-grid.single{grid-template-columns:1fr}.span2{grid-column:span 2}
label{font-size:.74rem;font-weight:800;color:#42516b;letter-spacing:.005em}
input,select,textarea{display:block;width:100%;margin-top:7px;border:1px solid var(--line-strong);background:#fff;color:var(--ink);border-radius:13px;padding:12px 13px;outline:0;transition:.18s;box-shadow:inset 0 1px 0 rgba(6,20,47,.015)}
textarea{resize:vertical}input::placeholder,textarea::placeholder{color:#9aa6ba}input:focus,select:focus,textarea:focus{border-color:#7eabf8;box-shadow:0 0 0 4px rgba(37,99,235,.085)}
.info-box{margin:20px 0;border:1px solid #d6e4f8;border-left:4px solid var(--blue-600);background:#f3f8ff;padding:16px;border-radius:14px}.info-box.wide{margin-top:25px}.info-box strong{font-size:.86rem}.info-box p{margin:4px 0 0;color:var(--muted);font-size:.8rem;line-height:1.6}
.password-wrap{position:relative}.password-wrap input{padding-right:62px}.password-wrap button{position:absolute;right:8px;bottom:7px;border:0;background:#eff4fb;color:#51627d;border-radius:9px;padding:7px 9px;font-size:.68rem;font-weight:800}
.form-actions{display:flex;align-items:end;gap:8px;flex-wrap:wrap}

/* Authentication */
.auth-section{min-height:calc(100vh - 150px);display:grid;align-items:center;padding:52px 0}.auth-layout{display:grid;grid-template-columns:.92fr 1.08fr;gap:20px;max-width:980px;margin:auto}
.auth-visual{border-radius:30px;padding:34px;background:linear-gradient(145deg,var(--navy-950),#0d3475 62%,#1460ca);color:#fff;min-height:530px;position:relative;overflow:hidden;box-shadow:var(--shadow-lg)}
.auth-visual:before{content:"";position:absolute;width:300px;height:300px;border-radius:50%;right:-100px;top:-110px;border:1px solid rgba(255,255,255,.14);box-shadow:0 0 0 48px rgba(255,255,255,.035),0 0 0 96px rgba(255,255,255,.025)}
.auth-visual h1,.auth-visual h2{color:#fff}.auth-visual h2{font-size:2.45rem;line-height:1.03;letter-spacing:-.05em;margin:52px 0 14px}.auth-visual p{color:#c7d8f3;max-width:500px;line-height:1.7}.auth-points{display:grid;gap:10px;margin-top:28px}.auth-points div{display:flex;align-items:center;gap:10px;color:#e8f1ff;font-size:.82rem}.auth-points div:before{content:"✓";width:24px;height:24px;border-radius:8px;display:grid;place-items:center;background:rgba(255,255,255,.12);color:#7dd3fc;font-weight:900}
.auth-card{padding:30px;border-radius:30px;background:#fff;border:1px solid var(--line);box-shadow:var(--shadow-md)}.auth-card h1{font-size:2.15rem;letter-spacing:-.045em;margin:8px 0 8px}.auth-card>p{color:var(--muted);font-size:.88rem}.auth-badge{width:50px;height:50px;display:grid;place-items:center;border-radius:16px;background:linear-gradient(145deg,var(--navy-900),var(--blue-600));color:#fff;font-size:.68rem;font-weight:950;letter-spacing:.08em;box-shadow:0 12px 25px rgba(37,99,235,.2)}.auth-tabs{display:flex;gap:7px;background:#f2f5fa;border:1px solid var(--line);padding:5px;border-radius:14px;margin-bottom:20px}.auth-tabs a{flex:1;padding:9px;border-radius:10px;text-align:center;font-size:.76rem;font-weight:850;color:#68758a}.auth-tabs a.active{background:#fff;color:var(--blue-700);box-shadow:var(--shadow-xs)}

/* Search/resources */
.filter-bar{display:flex;gap:9px;align-items:end;flex-wrap:nowrap;background:#fff;border:1px solid var(--line);padding:12px;border-radius:19px;box-shadow:var(--shadow-sm);margin-bottom:18px}.filter-bar .grow{flex:1;min-width:260px}.filter-bar label{min-width:140px}
.results-meta{display:flex;justify-content:space-between;gap:15px;align-items:center;margin:20px 0 12px}.results-meta h2{margin:0;letter-spacing:-.03em}.results-meta span{font-size:.72rem;color:var(--muted)}
.resource-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:13px}.resource-card{background:#fff;border:1px solid var(--line);border-radius:21px;padding:18px;box-shadow:var(--shadow-sm);display:flex;flex-direction:column;min-height:220px;transition:.2s}.resource-card:hover{transform:translateY(-3px);border-color:#cbdcff;box-shadow:var(--shadow-md)}
.resource-top{display:flex;justify-content:space-between;gap:12px;align-items:start}.resource-card h3{font-size:1rem;line-height:1.35;margin:12px 0 7px;letter-spacing:-.02em}.resource-card p{font-size:.79rem;color:var(--muted);margin:0}.meta-list{display:flex;gap:6px;flex-wrap:wrap;margin:10px 0}.branch-chip,.file-chip{display:inline-flex;align-items:center;padding:5px 8px;border-radius:999px;background:#edf4ff;color:#2b5da9;font-size:.63rem;font-weight:900;border:1px solid #dce9ff}.file-chip{background:#f2f4f8;color:#667288;border-color:#e6e9ef}.resource-actions{display:flex;gap:7px;margin-top:auto;padding-top:15px}.pagination{display:flex;justify-content:center;gap:6px;margin-top:22px;flex-wrap:wrap}.pagination a,.pagination span{min-width:38px;height:38px;border-radius:11px;display:grid;place-items:center;border:1px solid var(--line);background:#fff;font-size:.75rem;font-weight:800}.pagination .active{background:var(--navy-900);color:#fff;border-color:var(--navy-900)}

/* Notes / management */
.two-col,.notes-layout{display:grid;grid-template-columns:minmax(0,1fr) 360px;gap:18px;align-items:start}.note-list,.stack-list{display:grid;gap:11px}.note-card,.manage-card,.admin-card,.message-card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:18px;box-shadow:var(--shadow-sm)}
.note-head{display:flex;justify-content:space-between;gap:14px;align-items:start}.note-head h3{margin:9px 0 4px}.note-head small{font-size:.66rem;color:var(--muted);white-space:nowrap}.note-card>p{color:#506079;font-size:.84rem;line-height:1.65}.note-card footer{font-size:.68rem;color:var(--muted);margin-top:12px}.subject-line{font-size:.72rem!important;color:var(--blue-600)!important;margin:0!important;font-weight:800}.side-form{padding:20px;border-radius:22px;display:grid;gap:12px;position:sticky;top:104px}.side-form h2,.side-form h3{margin:0}.side-form p{color:var(--muted);font-size:.82rem}
.tabs-row{display:flex;gap:7px;margin-bottom:16px;overflow:auto;padding-bottom:2px;scrollbar-width:none}.tabs-row::-webkit-scrollbar{display:none}.tab-btn{border:1px solid var(--line);background:#fff;border-radius:12px;padding:9px 13px;white-space:nowrap;font-weight:850;font-size:.76rem;color:#59677e}.tab-btn.active{background:linear-gradient(135deg,var(--navy-900),var(--blue-600));color:#fff;border-color:transparent;box-shadow:0 8px 18px rgba(37,99,235,.16)}
.manage-main{display:flex;justify-content:space-between;gap:15px;align-items:center}.manage-main h3{margin:6px 0 2px}.manage-main p{margin:0;color:var(--muted);font-size:.75rem}.status{display:inline-flex;align-items:center;padding:5px 8px;border-radius:999px;font-size:.62rem;font-weight:900;background:#eff2f7;color:#677187;border:1px solid #e5e9ef}.status.ok{background:#e9f8f2;color:var(--ok);border-color:#cfede2}.status.warn{background:#fff4dc;color:var(--warn);border-color:#f1dfb4}.status.bad{background:#ffedf0;color:var(--bad);border-color:#f4d3d9}.confirm-box{margin-top:16px;padding-top:16px;border-top:1px solid var(--line)}.candidate-list{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;margin:10px 0 12px}.candidate{display:flex;gap:9px;border:1px solid var(--line);border-radius:13px;padding:10px;background:#fafcff;cursor:pointer}.candidate:hover{border-color:#b9d3ff;background:#f3f8ff}.candidate input{width:auto;margin:3px 0}.candidate b,.candidate small{display:block}.candidate b{font-size:.75rem}.candidate small{font-size:.64rem;color:var(--muted)}

/* Gallery */
.gallery-upload{background:#fff;border:1px solid var(--line);border-radius:20px;margin-bottom:18px;box-shadow:var(--shadow-sm);overflow:hidden}.gallery-upload summary{padding:16px 18px;font-weight:900;color:var(--blue-700);cursor:pointer}.gallery-upload form{padding:0 18px 18px}.hint{color:var(--muted);font-size:.75rem;line-height:1.6}.masonry{columns:3 260px;column-gap:14px}.gallery-card{break-inside:avoid;background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;margin:0 0 14px;box-shadow:var(--shadow-sm);transition:.2s}.gallery-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-md)}.gallery-card img{width:100%;height:auto}.gallery-card figcaption{padding:11px 13px;font-size:.76rem;color:#42516b}

/* Contact */
.contact-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:20px;align-items:start}.contact-cards{display:grid;gap:11px}.contact-card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:18px;display:flex;gap:13px;align-items:center;box-shadow:var(--shadow-sm)}.contact-card>span{width:46px;height:46px;display:grid;place-items:center;border-radius:14px;background:linear-gradient(145deg,#e9f2ff,#eefcff);color:var(--blue-600);font-size:1.05rem;border:1px solid #dce9ff}.contact-card small,.contact-card strong{display:block}.contact-card small{color:var(--muted);font-size:.67rem}.contact-card strong{margin-top:2px;word-break:break-word;font-size:.9rem}

/* Admin */
.admin-layout{display:grid;grid-template-columns:220px minmax(0,1fr);gap:16px;align-items:start}.admin-nav{display:grid;gap:5px;position:sticky;top:104px;background:rgba(255,255,255,.94);border:1px solid var(--line);border-radius:20px;padding:8px;box-shadow:var(--shadow-sm);backdrop-filter:blur(16px)}.admin-nav a{padding:10px 11px;border-radius:11px;font-size:.76rem;font-weight:850;color:#58677f}.admin-nav a.active,.admin-nav a:hover{background:linear-gradient(135deg,#edf4ff,#f0fbff);color:var(--blue-700)}.admin-content{min-width:0}.admin-stats{display:grid;grid-template-columns:repeat(5,1fr);gap:9px;margin-bottom:13px}.admin-stats div{background:#fff;border:1px solid var(--line);border-radius:18px;padding:15px;box-shadow:var(--shadow-sm)}.admin-stats span,.admin-stats strong{display:block}.admin-stats span{font-size:.64rem;color:var(--muted);font-weight:800}.admin-stats strong{font-size:1.75rem;letter-spacing:-.045em;margin-top:2px}.admin-card h2{margin-top:0}.admin-card-head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:13px}.admin-card-head h2{margin:0;letter-spacing:-.03em}.admin-card-head>span{font-size:.7rem;color:var(--muted)}.health-list p{display:flex;align-items:center;gap:8px;border-bottom:1px solid #eef2f7;padding:10px 0;margin:0;font-size:.8rem}.health-list b{margin-left:auto}.dot{width:9px;height:9px;border-radius:50%;background:#9ca8ba}.dot.ok{background:#1eb47f}.dot.warn{background:#e4a62d}.dot.bad{background:#d24a57}
.table-wrap{overflow:auto;border:1px solid var(--line);border-radius:14px;background:#fff}table{border-collapse:collapse;width:100%;min-width:700px;font-size:.74rem}th,td{text-align:left;padding:11px 12px;border-bottom:1px solid #edf1f6;vertical-align:middle}th{background:#f6f8fc;color:#5a6981;font-size:.64rem;text-transform:uppercase;letter-spacing:.055em;position:sticky;top:0}.admin-detail{border:1px solid var(--line);border-radius:15px;background:#fbfcff;overflow:hidden}.admin-detail summary{list-style:none;display:flex;justify-content:space-between;align-items:center;padding:13px;cursor:pointer}.admin-detail[open] summary{background:#f2f7ff;border-bottom:1px solid var(--line)}.admin-detail summary::-webkit-details-marker{display:none}.admin-detail summary b,.admin-detail summary small{display:block}.admin-detail summary small{font-size:.65rem;color:var(--muted);margin-top:2px}.admin-detail summary>span:last-child{font-size:.69rem;color:var(--blue-600);font-weight:900}.admin-detail>form{margin:13px}.admin-gallery{display:grid;grid-template-columns:repeat(3,1fr);gap:11px}.admin-gallery article{border:1px solid var(--line);border-radius:16px;overflow:hidden;background:#fff}.admin-gallery img{width:100%;height:150px;object-fit:cover;background:#eef2f7}.admin-gallery article>div{padding:10px}.admin-gallery strong,.admin-gallery small{display:block}.admin-gallery strong{font-size:.74rem}.admin-gallery small{font-size:.63rem;color:var(--muted);margin:3px 0 8px}.inline-actions{display:flex;gap:5px;flex-wrap:wrap}.settings-form{display:grid;gap:15px}.settings-form h3{margin:4px 0 0}.message-card.unread{border-left:4px solid var(--blue-600)}.message-card strong,.message-card small{display:block}.message-card small{font-size:.65rem;color:var(--muted)}.message-card p{font-size:.79rem;margin-bottom:0;line-height:1.65}
.empty{padding:42px 20px;text-align:center;background:#fff;border:1px dashed #cad6e8;border-radius:22px;color:var(--muted)}.empty h1,.empty h2,.empty h3{color:var(--ink)}

/* Footer */
.site-footer{background:linear-gradient(145deg,var(--navy-950),#0a2452);color:#dce8fb;padding:36px 0 92px;margin-top:22px}.footer-grid{display:grid;grid-template-columns:1fr auto auto;align-items:center;gap:28px}.footer-brand .brand-mark{background:#fff}.footer-brand .brand-mark svg{fill:var(--navy-900)}.footer-brand strong{color:#fff}.footer-brand small{color:#91a6c7}.footer-links{display:flex;gap:16px;font-size:.75rem;font-weight:750}.site-footer p{font-size:.65rem;color:#89a0c3}.footer-brand .brand-mark{width:40px;height:40px}

/* Mobile app-style bottom navigation */
.mobile-bottom-nav{display:none;position:fixed;left:10px;right:10px;bottom:10px;z-index:90;padding:7px 8px;background:rgba(255,255,255,.94);border:1px solid rgba(208,218,233,.9);border-radius:20px;box-shadow:0 16px 45px rgba(8,27,63,.2);backdrop-filter:blur(20px);grid-template-columns:repeat(5,1fr)}
.mobile-bottom-nav a{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;min-height:49px;border-radius:14px;font-size:.58rem;font-weight:850;color:#6b7890}
.mobile-bottom-nav a.active{background:#edf4ff;color:var(--blue-700)}
.mobile-bottom-nav svg{width:19px;height:19px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.mobile-bottom-nav .upload-main{background:linear-gradient(135deg,var(--navy-900),var(--blue-600));color:#fff;box-shadow:0 8px 18px rgba(37,99,235,.22)}

button:disabled{opacity:.65;cursor:not-allowed}

/* Responsive */
@media(max-width:1100px){
  .hero-grid{grid-template-columns:1fr 400px;gap:28px}.feature-grid{grid-template-columns:repeat(2,1fr)}.feature-grid.four{grid-template-columns:repeat(2,1fr)}.resource-grid{grid-template-columns:repeat(2,1fr)}.admin-stats{grid-template-columns:repeat(3,1fr)}.header-quick a:nth-child(3){display:none}
}
@media(max-width:820px){
  .container{width:min(calc(100% - 24px),var(--max))}.site-header{padding-top:9px}.header-row{min-height:64px;border-radius:18px;padding:8px 9px 8px 11px}.brand-mark{width:42px;height:42px}.brand small{max-width:205px}.header-quick{display:none}.main-nav{right:12px;left:12px;top:82px;width:auto;grid-template-columns:1fr 1fr;max-height:calc(100vh - 100px)}
  .hero{padding:42px 0}.hero-grid,.auth-layout,.contact-grid,.two-col,.notes-layout,.admin-layout{grid-template-columns:1fr}.hero-grid{gap:24px}.hero h1{font-size:clamp(2.6rem,10vw,4.2rem)}.hero-panel{max-width:none}.feature-grid,.resource-grid{grid-template-columns:1fr 1fr}.branch-grid{grid-template-columns:1fr}.side-form,.admin-nav{position:static}.admin-nav{display:flex;overflow:auto;scrollbar-width:none}.admin-nav a{white-space:nowrap}.admin-gallery{grid-template-columns:repeat(2,1fr)}.footer-grid{grid-template-columns:1fr}.footer-links{flex-wrap:wrap}.site-footer p{margin:0}.filter-bar{flex-wrap:wrap}.filter-bar .grow{flex-basis:100%}.filter-bar label:not(.grow){flex:1}.auth-visual{display:none}.mobile-bottom-nav{display:grid}.site-footer{padding-bottom:96px}
}
@media(max-width:560px){
  .container{width:min(calc(100% - 18px),var(--max))}.site-header{padding-top:7px}.header-row{min-height:60px;border-radius:16px}.brand-mark{width:39px;height:39px;border-radius:13px}.brand-mark svg{width:23px}.brand strong{font-size:.9rem}.brand small{max-width:175px;font-size:.58rem}.menu-btn{width:42px;height:42px;border-radius:12px}.main-nav{top:75px;left:9px;right:9px;grid-template-columns:1fr;max-height:calc(100vh - 90px);border-radius:20px}.nav-cta{grid-column:auto}
  .hero{padding:32px 0 38px}.hero-grid{grid-template-columns:1fr;gap:22px}.hero h1{font-size:2.65rem;line-height:.98}.hero p{font-size:.9rem;line-height:1.68}.hero-actions .btn{flex:1}.hero-panel{padding:19px;border-radius:23px}.panel-top strong{font-size:1.25rem}.mini-stats{gap:6px}.mini-stats div{padding:10px}.mini-stats strong{font-size:1.1rem}.section{padding:44px 0}.section-head{align-items:start;flex-direction:column}.section-head h2{font-size:1.82rem}.feature-grid,.feature-grid.four,.resource-grid{grid-template-columns:1fr}.feature-card{min-height:auto;padding:19px}.form-grid{grid-template-columns:1fr}.span2{grid-column:auto}.optional-head{align-items:start;flex-direction:column}.filter-bar{display:grid;grid-template-columns:1fr 1fr;padding:10px}.filter-bar .grow{grid-column:1/-1;min-width:0}.filter-bar label{min-width:0}.filter-bar .btn{width:100%}.candidate-list{grid-template-columns:1fr}.manage-main{align-items:start}.page-hero.compact{padding:34px 0 24px}.page-hero h1{font-size:2.35rem}.admin-stats{grid-template-columns:1fr 1fr}.admin-gallery{grid-template-columns:1fr}.auth-section{padding:27px 0}.auth-card{padding:21px;border-radius:24px}.contact-card{padding:15px}.footer-links{gap:12px}.masonry{columns:2 140px}.admin-card{padding:14px}.upload-form{padding:16px}.upload-zone{padding:31px 10px}.results-meta{margin-top:18px}.resource-actions{flex-wrap:wrap}.mobile-bottom-nav{left:7px;right:7px;bottom:7px;border-radius:18px}
}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important;animation:none!important}}

/* ======================================================================
   GPCS Portal v1.3 — Blue Premium adaptive navigation + 3-mode themes
   Dedicated Desktop / Tablet / Mobile behavior.
   ====================================================================== */

/* Header + always-visible action bar */
.site-header{
  padding:10px 0 8px;
  background:linear-gradient(180deg,rgba(247,250,255,.94),rgba(247,250,255,.82));
  border-bottom:1px solid rgba(211,220,236,.62);
  backdrop-filter:blur(18px) saturate(1.15);
}
.header-row{
  min-height:64px;
  border-radius:20px;
  padding:8px 10px 8px 12px;
}
.topbar-shell{
  margin-top:8px;
  position:relative;
}
.main-nav.top-action-bar{
  position:static;
  width:100%;
  max-height:none;
  display:flex;
  align-items:center;
  gap:7px;
  padding:7px;
  overflow-x:auto;
  overflow-y:hidden;
  scrollbar-width:thin;
  scrollbar-color:rgba(37,99,235,.28) transparent;
  white-space:nowrap;
  border:1px solid rgba(211,220,236,.82);
  border-radius:18px;
  background:rgba(255,255,255,.86);
  box-shadow:0 9px 28px rgba(13,42,95,.07);
  backdrop-filter:blur(18px) saturate(1.18);
  -webkit-overflow-scrolling:touch;
}
.main-nav.top-action-bar::-webkit-scrollbar{height:4px}
.main-nav.top-action-bar::-webkit-scrollbar-thumb{background:rgba(37,99,235,.24);border-radius:999px}
.main-nav.top-action-bar .nav-link,
.main-nav.top-action-bar .nav-cta{
  flex:0 0 auto;
  min-height:39px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:9px 12px;
  border-radius:11px;
  font-size:.73rem;
  line-height:1;
}
.main-nav.top-action-bar .nav-cta{
  grid-column:auto;
  background:linear-gradient(135deg,var(--navy-900),var(--blue-600));
  padding-inline:16px;
}

/* Theme segmented control */
.theme-switcher{
  flex:0 0 auto;
  display:flex;
  align-items:center;
  gap:4px;
  padding:4px;
  border:1px solid var(--line);
  border-radius:14px;
  background:var(--surface-2);
  box-shadow:var(--shadow-xs);
}
.theme-option{
  border:0;
  min-height:38px;
  padding:8px 10px;
  border-radius:10px;
  background:transparent;
  color:var(--muted);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:6px;
  font-size:.7rem;
  font-weight:850;
  transition:background .18s ease,color .18s ease,transform .18s ease,box-shadow .18s ease;
}
.theme-option span{font-size:1rem;line-height:1}
.theme-option:hover{color:var(--blue-600);background:var(--surface-blue)}
.theme-option.active{
  color:var(--blue-700);
  background:var(--surface);
  box-shadow:0 3px 12px rgba(13,42,95,.10);
}
.theme-option:focus-visible,.nav-link:focus-visible,.nav-cta:focus-visible,.btn:focus-visible{
  outline:3px solid rgba(59,130,246,.28);
  outline-offset:2px;
}

/* DARK theme tokens */
html[data-theme="dark"]{
  color-scheme:dark;
  --ink:#edf4ff;
  --ink-2:#c1cee1;
  --muted:#8fa1bc;
  --bg:#07101f;
  --surface:#0d1a2e;
  --surface-2:#101f36;
  --surface-blue:#102b52;
  --line:#213451;
  --line-strong:#2d466b;
  --ok:#43d5a1;
  --warn:#f2b95f;
  --bad:#ff8090;
  --shadow-xs:0 1px 2px rgba(0,0,0,.22);
  --shadow-sm:0 10px 28px rgba(0,0,0,.20);
  --shadow-md:0 20px 52px rgba(0,0,0,.26);
  --shadow-lg:0 30px 84px rgba(0,0,0,.36);
}
html[data-theme="dark"] body{
  color:var(--ink);
  background:
    radial-gradient(circle at 8% 0%,rgba(37,99,235,.16),transparent 30rem),
    radial-gradient(circle at 92% 8%,rgba(14,165,233,.10),transparent 26rem),
    linear-gradient(180deg,#081323 0,#07101e 52%,#091321 100%);
}
html[data-theme="dark"] body:before{
  opacity:.22;
  background-image:linear-gradient(rgba(109,149,218,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(109,149,218,.06) 1px,transparent 1px);
}
html[data-theme="dark"] .site-header{
  background:linear-gradient(180deg,rgba(7,16,31,.96),rgba(7,16,31,.86));
  border-bottom-color:rgba(45,70,107,.55);
}
html[data-theme="dark"] .header-row,
html[data-theme="dark"] .main-nav.top-action-bar,
html[data-theme="dark"] .theme-switcher{
  background:rgba(13,26,46,.88);
  border-color:var(--line);
}
html[data-theme="dark"] .theme-option.active{background:#172946;color:#8fc0ff}
html[data-theme="dark"] .brand strong,
html[data-theme="dark"] h1,
html[data-theme="dark"] h2,
html[data-theme="dark"] h3{color:var(--ink)}
html[data-theme="dark"] .hero p,
html[data-theme="dark"] .page-hero p{color:#9caec7}
html[data-theme="dark"] .nav-link{color:#aebdd2}
html[data-theme="dark"] .nav-link:hover,
html[data-theme="dark"] .nav-link.active{background:#102b52;color:#9ec8ff;border-color:#244d82}
html[data-theme="dark"] .nav-link.logout{background:#2a1720;color:#ff9caa}
html[data-theme="dark"] .glass-card,
html[data-theme="dark"] .feature-card,
html[data-theme="dark"] .resource-card,
html[data-theme="dark"] .contact-card,
html[data-theme="dark"] .admin-card,
html[data-theme="dark"] .admin-stats div,
html[data-theme="dark"] .admin-nav,
html[data-theme="dark"] .auth-card,
html[data-theme="dark"] .side-form,
html[data-theme="dark"] .paper-card,
html[data-theme="dark"] .note-card,
html[data-theme="dark"] .manage-card,
html[data-theme="dark"] .empty,
html[data-theme="dark"] .table-wrap,
html[data-theme="dark"] .admin-gallery article{
  background:rgba(13,26,46,.92);
  border-color:var(--line);
  color:var(--ink-2);
}
html[data-theme="dark"] .glass-card{background:linear-gradient(160deg,rgba(17,33,57,.96),rgba(11,24,43,.92))}
html[data-theme="dark"] .feature-card:hover,
html[data-theme="dark"] .resource-card:hover{border-color:#315b91;background:#11233e}
html[data-theme="dark"] .branch-pills span,
html[data-theme="dark"] .tag,
html[data-theme="dark"] .chip,
html[data-theme="dark"] .badge{background:#10233e;border-color:#28466f;color:#bad5ff}
html[data-theme="dark"] input,
html[data-theme="dark"] select,
html[data-theme="dark"] textarea{
  color:#edf4ff;
  background:#0a1729;
  border-color:#29415f;
}
html[data-theme="dark"] input::placeholder,
html[data-theme="dark"] textarea::placeholder{color:#7185a3}
html[data-theme="dark"] input:focus,
html[data-theme="dark"] select:focus,
html[data-theme="dark"] textarea:focus{border-color:#4b83d4;box-shadow:0 0 0 4px rgba(59,130,246,.13)}
html[data-theme="dark"] .search-row,
html[data-theme="dark"] .filter-bar,
html[data-theme="dark"] .upload-zone,
html[data-theme="dark"] .optional-box,
html[data-theme="dark"] .info-box,
html[data-theme="dark"] .setup-banner,
html[data-theme="dark"] .notice{background:#0c1a2e;border-color:#29415f;color:#b6c7dc}
html[data-theme="dark"] .search-row:focus-within{background:#0c1b30;border-color:#4b83d4}
html[data-theme="dark"] .mini-stats div{background:#0b192c;border-color:#203653}
html[data-theme="dark"] .btn{background:#10213a;color:#dce9fb;border-color:#29415f}
html[data-theme="dark"] .btn.secondary{background:#102b52;color:#abd0ff;border-color:#244d82}
html[data-theme="dark"] .btn.ghost{background:#0d1a2e;color:#c5d3e7;border-color:#29415f}
html[data-theme="dark"] .btn.danger{background:#2a1720;color:#ff9baa;border-color:#56303b}
html[data-theme="dark"] .section.soft{background:linear-gradient(180deg,rgba(12,31,55,.74),rgba(7,16,30,.64));border-color:#1e3452}
html[data-theme="dark"] .admin-detail{background:#0b192c;border-color:#29415f}
html[data-theme="dark"] .admin-detail[open] summary{background:#10233e;border-color:#29415f}
html[data-theme="dark"] .health-list p{border-color:#203653}
html[data-theme="dark"] th{background:#10213a;color:#a9bbd4}
html[data-theme="dark"] td,html[data-theme="dark"] th{border-bottom-color:#203653}
html[data-theme="dark"] .mobile-bottom-nav{background:rgba(13,26,46,.95);border-color:#29415f}
html[data-theme="dark"] .mobile-bottom-nav a{color:#8ea0ba}
html[data-theme="dark"] .mobile-bottom-nav a.active{background:#102b52;color:#9ec8ff}
html[data-theme="dark"] .site-footer{background:linear-gradient(145deg,#040b15,#07162b)}
html[data-theme="dark"] .live-dot{background:#0c2b24;border-color:#17523f;color:#5ee0b2}
html[data-theme="dark"] .contact-card>span{background:#102b52;border-color:#244d82}

/* Keep native controls in the correct palette */
html[data-theme="light"]{color-scheme:light}

/* DESKTOP: all buttons remain visible in the top action bar */
@media (min-width:1024px){
  .top-action-bar{scrollbar-width:none!important}
  .top-action-bar::-webkit-scrollbar{display:none}
  .theme-option b{display:inline}
  .site-footer{padding-bottom:36px}
}

/* TABLET: dedicated layout — not a stretched mobile view */
@media (min-width:600px) and (max-width:1023px){
  html{scroll-padding-top:142px}
  .container{width:min(calc(100% - 28px),var(--max))}
  .site-header{padding-top:9px}
  .header-row{min-height:62px;border-radius:18px;padding:8px 10px}
  .brand-mark{width:43px;height:43px;border-radius:14px}
  .brand small{max-width:285px}
  .theme-option{min-width:42px;padding:8px 9px}
  .theme-option b{display:none}
  .topbar-shell{margin-top:7px}
  .main-nav.top-action-bar{
    min-height:54px;
    border-radius:16px;
    gap:6px;
    padding:7px 8px;
  }
  .main-nav.top-action-bar .nav-link,
  .main-nav.top-action-bar .nav-cta{min-height:40px;font-size:.72rem;padding:9px 12px}
  .mobile-bottom-nav{display:none!important}
  .site-footer{padding-bottom:40px}
  .feature-grid,.feature-grid.four,.resource-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
  .admin-nav{position:static;display:flex;overflow-x:auto;scrollbar-width:none}
  .admin-nav a{white-space:nowrap;flex:0 0 auto}
  .admin-stats{grid-template-columns:repeat(3,minmax(0,1fr))}
  .admin-gallery{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media (min-width:900px) and (max-width:1023px){
  .hero-grid{grid-template-columns:minmax(0,1.05fr) minmax(330px,.95fr);gap:26px}
  .hero h1{font-size:clamp(3rem,5.7vw,4.25rem)}
}
@media (min-width:600px) and (max-width:899px){
  .hero-grid,.auth-layout,.contact-grid,.two-col,.notes-layout,.admin-layout{grid-template-columns:1fr}
  .hero-grid{gap:24px}
  .hero-panel{max-width:none}
}

/* MOBILE: compact header + scrollable full top bar + quick bottom bar */
@media (max-width:599px){
  html{scroll-padding-top:128px}
  .container{width:min(calc(100% - 18px),var(--max))}
  .site-header{padding:7px 0 6px}
  .header-row{min-height:56px;border-radius:16px;padding:7px 8px 7px 9px;gap:7px}
  .brand{gap:8px}
  .brand-mark{width:39px;height:39px;border-radius:12px}
  .brand strong{font-size:.88rem}
  .brand small{max-width:142px;font-size:.56rem}
  .theme-switcher{gap:2px;padding:3px;border-radius:12px}
  .theme-option{width:34px;min-height:34px;padding:6px;border-radius:9px}
  .theme-option b{display:none}
  .theme-option span{font-size:.92rem}
  .topbar-shell{margin-top:6px}
  .main-nav.top-action-bar{
    position:static!important;
    left:auto!important;right:auto!important;top:auto!important;
    width:100%!important;
    display:flex!important;
    grid-template-columns:none!important;
    min-height:48px;
    max-height:none!important;
    gap:5px;
    padding:5px 6px;
    border-radius:14px;
  }
  .main-nav.top-action-bar .nav-link,
  .main-nav.top-action-bar .nav-cta{min-height:36px;font-size:.66rem;padding:8px 10px;border-radius:9px}
  .mobile-bottom-nav{display:grid!important}
  .site-footer{padding-bottom:96px}
}
@media (max-width:380px){
  .brand small{display:none}
  .brand strong{font-size:.82rem}
  .theme-option{width:32px}
}

/* ======================================================================
   GPCS Portal v1.4 — Student-friendly top navigation + single theme control
   ====================================================================== */
.header-tools{display:flex;align-items:center;gap:8px;flex:none}
.menu-btn{display:none!important}

/* One premium theme button: Light -> Dark -> System */
.theme-cycle-btn{
  position:relative;isolation:isolate;display:inline-flex;align-items:center;justify-content:center;gap:8px;
  min-height:44px;padding:6px 12px 6px 7px;border:1px solid #d9e3f2;border-radius:15px;
  background:linear-gradient(145deg,rgba(255,255,255,.98),rgba(240,246,255,.94));color:var(--navy-800);
  box-shadow:0 7px 20px rgba(13,42,95,.08),inset 0 1px 0 rgba(255,255,255,.9);
  font-weight:900;font-size:.72rem;letter-spacing:.01em;overflow:hidden;transition:.2s ease;
}
.theme-cycle-btn:hover{transform:translateY(-1px);border-color:#bdd3f5;box-shadow:0 11px 24px rgba(37,99,235,.13)}
.theme-cycle-btn:active{transform:translateY(0) scale(.98)}
.theme-cycle-btn:focus-visible{outline:3px solid rgba(59,130,246,.25);outline-offset:2px}
.theme-cycle-halo{position:absolute;z-index:-1;width:48px;height:48px;left:-10px;top:-11px;border-radius:50%;background:radial-gradient(circle,rgba(59,130,246,.2),transparent 68%);transition:.25s}
.theme-cycle-icon{width:31px;height:31px;display:none;place-items:center;border-radius:10px;background:linear-gradient(145deg,#e7f1ff,#f3f8ff);color:var(--blue-600);box-shadow:inset 0 0 0 1px #d7e7ff}
.theme-cycle-icon svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
html[data-theme-preference="light"] .theme-cycle-icon[data-theme-cycle-icon="light"],
html[data-theme-preference="dark"] .theme-cycle-icon[data-theme-cycle-icon="dark"],
html[data-theme-preference="system"] .theme-cycle-icon[data-theme-cycle-icon="system"]{display:grid}
.theme-cycle-label{min-width:41px;text-align:left}

/* Student-first college portal top bar */
.topbar-shell{margin-top:8px}
.main-nav.top-action-bar{
  position:static!important;display:flex!important;align-items:center;justify-content:flex-start;flex-wrap:wrap;
  width:100%!important;max-height:none!important;gap:6px;padding:8px;overflow:visible!important;
  border:1px solid rgba(211,220,236,.88);border-radius:18px;background:rgba(255,255,255,.91);
  box-shadow:0 8px 26px rgba(13,42,95,.07);white-space:normal;backdrop-filter:blur(18px) saturate(1.15);
  scrollbar-width:none!important;-ms-overflow-style:none!important;
}
.main-nav.top-action-bar::-webkit-scrollbar{display:none!important;width:0!important;height:0!important}
.main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{
  position:relative;flex:0 0 auto;display:inline-flex;align-items:center;justify-content:center;gap:7px;
  min-height:42px;padding:9px 12px;border-radius:12px;border:1px solid transparent;white-space:nowrap;
  font-size:.72rem;font-weight:900;line-height:1;color:#44536c;transition:transform .18s ease,background .18s ease,color .18s ease,border-color .18s ease,box-shadow .18s ease;
}
.main-nav.top-action-bar .nav-link:hover{transform:translateY(-1px);background:#f3f7fd;border-color:#dae6f6;color:var(--blue-700);box-shadow:0 5px 14px rgba(13,42,95,.06)}
.main-nav.top-action-bar .nav-link.active{background:linear-gradient(135deg,#e7f1ff,#f3f8ff);border-color:#bfd8ff;color:#174dbd;box-shadow:0 6px 17px rgba(37,99,235,.11)}
.nav-icon{width:18px;height:18px;display:grid;place-items:center;flex:none}
.nav-icon svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:1.85;stroke-linecap:round;stroke-linejoin:round}
.nav-divider{width:1px;height:25px;background:linear-gradient(transparent,#d8e1ef,transparent);margin:0 2px;flex:none}

/* Important student actions get hierarchy without looking noisy */
.main-nav.top-action-bar .nav-student{background:#f4f8ff;border-color:#dfeaff;color:#2057bf}
.main-nav.top-action-bar .nav-important{background:#f7faff;border-color:#e2ebf8}
.main-nav.top-action-bar .nav-upload{background:linear-gradient(135deg,#0d2a5f,#2563eb);border-color:transparent;color:#fff;box-shadow:0 8px 20px rgba(37,99,235,.18)}
.main-nav.top-action-bar .nav-upload:hover,.main-nav.top-action-bar .nav-upload.active{background:linear-gradient(135deg,#092454,#1d5be1);color:#fff;border-color:transparent;box-shadow:0 12px 25px rgba(37,99,235,.24)}
.main-nav.top-action-bar .nav-result{background:#f4f9ff;border-color:#deebfb;color:#225ca7}
.main-nav.top-action-bar .nav-external:after{content:"↗";font-size:.58rem;opacity:.5;margin-left:-2px;transform:translateY(-1px)}
.main-nav.top-action-bar .nav-cta{background:linear-gradient(135deg,var(--navy-900),var(--blue-600));color:#fff;border-color:transparent;padding-inline:14px;box-shadow:0 8px 20px rgba(37,99,235,.18)}
.main-nav.top-action-bar .nav-cta:hover{transform:translateY(-1px);box-shadow:0 12px 25px rgba(37,99,235,.24)}
.main-nav.top-action-bar .logout{background:#fff7f8;border-color:#ffe2e7;color:#a82e40}

html[data-theme="dark"] .theme-cycle-btn{background:linear-gradient(145deg,#12243e,#0c1b30);border-color:#294463;color:#d9e9ff;box-shadow:0 8px 24px rgba(0,0,0,.22),inset 0 1px 0 rgba(255,255,255,.04)}
html[data-theme="dark"] .theme-cycle-icon{background:#122c50;color:#9ac7ff;box-shadow:inset 0 0 0 1px #294e7d}
html[data-theme="dark"] .theme-cycle-halo{background:radial-gradient(circle,rgba(59,130,246,.3),transparent 68%)}
html[data-theme="dark"] .main-nav.top-action-bar{background:rgba(13,26,46,.92);border-color:#213451}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link{color:#adbed5}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link:hover{background:#10233e;border-color:#29496f;color:#a8d0ff}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link.active{background:#102b52;border-color:#2c5589;color:#a8d0ff}
html[data-theme="dark"] .main-nav.top-action-bar .nav-student,
html[data-theme="dark"] .main-nav.top-action-bar .nav-important,
html[data-theme="dark"] .main-nav.top-action-bar .nav-result{background:#0e213a;border-color:#24415f;color:#b8d5f8}
html[data-theme="dark"] .main-nav.top-action-bar .nav-upload{background:linear-gradient(135deg,#123e83,#2563eb);color:#fff;border-color:transparent}
html[data-theme="dark"] .main-nav.top-action-bar .logout{background:#2a1720;border-color:#56303b;color:#ff9caa}
html[data-theme="dark"] .nav-divider{background:linear-gradient(transparent,#2a4568,transparent)}

/* Desktop: all actions are visible; clean wrap replaces scrollbar UI */
@media (min-width:1024px){
  .main-nav.top-action-bar{row-gap:7px}
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{font-size:.71rem;padding-inline:11px}
}

/* Tablet: dedicated two-line friendly navigation; no horizontal scrollbar */
@media (min-width:600px) and (max-width:1023px){
  html{scroll-padding-top:165px}
  .header-row{gap:10px}
  .theme-cycle-btn{min-height:42px;padding:5px 10px 5px 6px}
  .theme-cycle-label{display:none}
  .theme-cycle-icon{width:31px;height:31px}
  .main-nav.top-action-bar{flex-wrap:wrap!important;overflow:visible!important;gap:6px;padding:7px}
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{min-height:39px;padding:8px 10px;font-size:.69rem}
  .nav-divider{height:22px}
}

/* Mobile: every top-bar button still works via swipe, but scrollbar/indicator is invisible */
@media (max-width:599px){
  html{scroll-padding-top:122px}
  .header-row{gap:8px}
  .brand{margin-right:auto}
  .theme-cycle-btn{width:42px;height:42px;min-height:42px;padding:5px;border-radius:13px}
  .theme-cycle-label{display:none}
  .theme-cycle-icon{width:30px;height:30px;border-radius:9px}
  .topbar-shell{margin-top:6px;overflow:hidden;border-radius:14px}
  .main-nav.top-action-bar{
    flex-wrap:nowrap!important;overflow-x:auto!important;overflow-y:hidden!important;white-space:nowrap!important;
    gap:5px;padding:5px 6px;scroll-snap-type:x proximity;overscroll-behavior-x:contain;
    scrollbar-width:none!important;-ms-overflow-style:none!important;
  }
  .main-nav.top-action-bar::-webkit-scrollbar{display:none!important;width:0!important;height:0!important}
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{scroll-snap-align:start;min-height:37px;padding:8px 10px;font-size:.65rem;border-radius:10px}
  .nav-icon{width:16px;height:16px}.nav-icon svg{width:15px;height:15px}
  .nav-divider{display:none}
  .nav-external:after{display:none}
}

/* ======================================================================
   GPCS Portal v1.5 — Single-line scrollable student navigation + utility sign-in
   ====================================================================== */
.gpcs-signin-btn{
  display:inline-flex;align-items:center;justify-content:center;gap:8px;flex:none;
  min-height:44px;padding:7px 13px 7px 11px;border-radius:14px;border:1px solid rgba(37,99,235,.18);
  background:linear-gradient(135deg,#0b2a63 0%,#1f5fe7 72%,#2f76ff 100%);color:#fff;
  box-shadow:0 8px 22px rgba(37,99,235,.20),inset 0 1px 0 rgba(255,255,255,.14);
  font-size:.73rem;font-weight:900;letter-spacing:.005em;white-space:nowrap;transition:.18s ease;
}
.gpcs-signin-btn:hover{transform:translateY(-1px);box-shadow:0 12px 28px rgba(37,99,235,.27);filter:saturate(1.05)}
.gpcs-signin-btn:active{transform:translateY(0) scale(.985)}
.gpcs-signin-btn:focus-visible{outline:3px solid rgba(59,130,246,.25);outline-offset:2px}
.gpcs-signin-btn .nav-icon{width:18px;height:18px}

/* All portal destinations stay on ONE line on mobile, tablet and desktop. */
.topbar-shell{overflow:hidden}
.main-nav.top-action-bar{
  flex-wrap:nowrap!important;overflow-x:auto!important;overflow-y:hidden!important;white-space:nowrap!important;
  max-width:100%;scroll-snap-type:x proximity;overscroll-behavior-x:contain;-webkit-overflow-scrolling:touch;
  scrollbar-width:none!important;-ms-overflow-style:none!important;
}
.main-nav.top-action-bar::-webkit-scrollbar{display:none!important;width:0!important;height:0!important}
.main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{scroll-snap-align:start;flex:0 0 auto}
.nav-divider{flex:0 0 1px}

/* Wheel/trackpad scrolling remains natural while the visual scrollbar stays hidden. */
@media (min-width:1024px){
  .main-nav.top-action-bar{flex-wrap:nowrap!important;overflow-x:auto!important;gap:6px;padding:7px 8px}
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{min-height:40px;padding:8px 10px;font-size:.69rem}
}
@media (min-width:600px) and (max-width:1023px){
  html{scroll-padding-top:128px}
  .main-nav.top-action-bar{flex-wrap:nowrap!important;overflow-x:auto!important;overflow-y:hidden!important;gap:6px;padding:6px 7px}
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{min-height:39px;padding:8px 10px;font-size:.68rem}
  .gpcs-signin-btn{min-height:42px;padding:6px 11px;font-size:.69rem}
  .gpcs-signin-btn span:last-child{display:inline}
}
@media (max-width:599px){
  .header-tools{gap:6px}
  .gpcs-signin-btn{min-height:42px;padding:6px 10px;border-radius:13px;font-size:.65rem}
  .gpcs-signin-btn .nav-icon{width:16px;height:16px}
  .gpcs-signin-btn .nav-icon svg{width:15px;height:15px}
  .main-nav.top-action-bar{flex-wrap:nowrap!important;overflow-x:auto!important;overflow-y:hidden!important}
}

html[data-theme="dark"] .gpcs-signin-btn{
  background:linear-gradient(135deg,#123c7d,#2563eb);border-color:#315b94;color:#fff;
  box-shadow:0 9px 24px rgba(0,0,0,.24),inset 0 1px 0 rgba(255,255,255,.08)
}
.signin-label-short{display:none}
@media(max-width:430px){
  .signin-label-full{display:none}
  .signin-label-short{display:inline}
  .gpcs-signin-btn{padding-inline:8px}
  .brand small{display:none}
}

/* ======================================================================
   GPCS Portal v1.6 — Simple student-first navigation + polished About page
   ====================================================================== */
.main-nav.top-action-bar{
  gap:5px;padding:6px 7px;border-radius:15px;
  background:rgba(255,255,255,.94);border-color:#dce4ef;
  box-shadow:0 7px 20px rgba(13,42,95,.055);
}
.main-nav.top-action-bar .nav-link,
.main-nav.top-action-bar .nav-cta{
  min-height:38px;padding:8px 11px;border-radius:9px;
  background:transparent;border:1px solid transparent;
  color:#46546a;font-size:.69rem;font-weight:800;box-shadow:none;
}
.main-nav.top-action-bar .nav-link:hover,
.main-nav.top-action-bar .nav-cta:hover{
  transform:none;background:#f1f5fb;border-color:#e1e8f1;color:#174dbd;box-shadow:none;
}
.main-nav.top-action-bar .nav-link.active{
  background:#eaf2ff;border-color:#cfe0fb;color:#174dbd;box-shadow:none;
}
.main-nav.top-action-bar .nav-external:after{content:"↗";font-size:.56rem;opacity:.48;margin-left:2px}
.main-nav.top-action-bar .logout{background:transparent;border-color:transparent;color:#a43a49}
.main-nav.top-action-bar .logout:hover{background:#fff4f5;border-color:#f7dadd;color:#952c3c}

/* Sign in remains a utility action next to the theme button, not part of academic nav. */
.gpcs-signin-btn{min-height:42px;border-radius:12px;padding:7px 12px;font-size:.7rem}
.theme-cycle-btn{min-height:42px;border-radius:12px;padding:5px 10px 5px 6px}
.theme-cycle-icon{width:30px;height:30px;border-radius:9px}

/* About content */
.about-story{padding:clamp(22px,4vw,42px);max-width:1000px;margin:0 auto 28px;line-height:1.75}
.about-story .about-title{text-align:center;margin:0 0 8px;font-size:clamp(1.65rem,3vw,2.55rem);letter-spacing:-.035em;color:var(--navy-900)}
.about-story .about-tagline{text-align:center;margin:0 auto 28px;color:var(--blue-700);font-weight:700;font-size:clamp(.95rem,1.8vw,1.12rem)}
.about-story .about-welcome{text-align:center;margin:28px 0 16px;font-size:clamp(1.2rem,2.2vw,1.6rem);color:var(--navy-800)}
.about-story .about-section-title{margin:30px 0 12px;padding-bottom:9px;border-bottom:1px solid var(--line);font-size:1.08rem;color:var(--navy-800)}
.about-story p{margin:0 0 16px;color:var(--muted);font-size:.95rem}
.about-list{display:grid;gap:10px;margin:12px 0 18px;padding:0;list-style:none}
.about-list li{padding:13px 15px;border:1px solid var(--line);border-radius:14px;background:var(--surface);color:var(--muted)}
.about-list li strong{color:var(--ink)}
.about-closing{margin:28px 0 0!important;padding:17px 18px;border-radius:16px;background:linear-gradient(135deg,#eef5ff,#f6fbff);border:1px solid #d6e7ff;color:var(--navy-800)!important;font-weight:700;text-align:center}
.about-branches{margin-top:24px}

html[data-theme="dark"] .main-nav.top-action-bar{background:rgba(13,26,46,.95);border-color:#213451}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link{background:transparent;border-color:transparent;color:#b5c3d6}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link:hover{background:#10233e;border-color:#29415f;color:#a8d0ff}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link.active{background:#102b52;border-color:#2b4d77;color:#a8d0ff}
html[data-theme="dark"] .main-nav.top-action-bar .logout{color:#ff9caa}
html[data-theme="dark"] .about-story .about-title,
html[data-theme="dark"] .about-story .about-welcome,
html[data-theme="dark"] .about-story .about-section-title{color:#dceaff}
html[data-theme="dark"] .about-story .about-tagline{color:#92c4ff}
html[data-theme="dark"] .about-list li{background:#0e1d32;border-color:#213754;color:#aebdd2}
html[data-theme="dark"] .about-list li strong{color:#e5efff}
html[data-theme="dark"] .about-closing{background:linear-gradient(135deg,#102443,#102d52);border-color:#284c78;color:#dceaff!important}

@media(max-width:599px){
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{min-height:36px;padding:7px 9px;font-size:.64rem;border-radius:8px}
  .about-story{padding:20px 16px;border-radius:18px}
  .about-list li{padding:12px}
}

/* ======================================================================
   GPCS Portal v1.7 — Premium academic navigation + theme orb
   ====================================================================== */
.main-nav.top-action-bar{
  gap:7px;padding:7px 8px;border-radius:17px;
  background:linear-gradient(180deg,rgba(255,255,255,.97),rgba(246,249,255,.95));
  border:1px solid #dbe6f4;box-shadow:0 9px 26px rgba(19,58,123,.075),inset 0 1px 0 rgba(255,255,255,.9);
}
.main-nav.top-action-bar .nav-link,
.main-nav.top-action-bar .nav-cta{
  position:relative;isolation:isolate;overflow:hidden;
  min-height:40px;padding:8px 13px;border-radius:12px;
  color:#314a70;font-size:.7rem;font-weight:850;letter-spacing:.002em;
  border:1px solid #dbe7f6;
  background:linear-gradient(180deg,#ffffff 0%,#f4f8fe 100%);
  box-shadow:0 3px 9px rgba(22,60,120,.07),inset 0 1px 0 #fff;
  transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease,color .18s ease,background .18s ease;
}
.main-nav.top-action-bar .nav-link::before{
  content:"";position:absolute;inset:0;z-index:-1;opacity:0;
  background:linear-gradient(135deg,rgba(37,99,235,.10),rgba(14,165,233,.07));transition:opacity .18s ease;
}
.main-nav.top-action-bar .nav-link:hover{
  transform:translateY(-1px);color:#174dbd;border-color:#bfd5f7;
  box-shadow:0 7px 16px rgba(37,99,235,.12),inset 0 1px 0 #fff;
}
.main-nav.top-action-bar .nav-link:hover::before{opacity:1}
.main-nav.top-action-bar .nav-link.active{
  color:#0f49b8;border-color:#b9d2f8;
  background:linear-gradient(180deg,#edf5ff,#e5f0ff);
  box-shadow:0 5px 14px rgba(37,99,235,.12),inset 0 1px 0 rgba(255,255,255,.9);
}
.main-nav.top-action-bar .nav-student,
.main-nav.top-action-bar .nav-academic,
.main-nav.top-action-bar .nav-library,
.main-nav.top-action-bar .nav-previous,
.main-nav.top-action-bar .nav-notes,
.main-nav.top-action-bar .nav-more,
.main-nav.top-action-bar .nav-result{
  background:linear-gradient(180deg,#ffffff,#f2f7ff);border-color:#d7e5f6;color:#2f4f79;
}
.main-nav.top-action-bar .nav-result{background:linear-gradient(180deg,#f7fbff,#eef8ff);color:#235d99;border-color:#d3e8f8}
.main-nav.top-action-bar .nav-upload{
  color:#fff!important;border-color:transparent!important;
  background:linear-gradient(135deg,#08265d 0%,#1755cc 50%,#2b70f5 100%)!important;
  box-shadow:0 8px 20px rgba(37,99,235,.24),inset 0 1px 0 rgba(255,255,255,.22)!important;
}
.main-nav.top-action-bar .nav-upload::before{
  opacity:1;background:linear-gradient(115deg,transparent 15%,rgba(255,255,255,.14) 43%,transparent 68%);transform:translateX(-105%);transition:transform .45s ease;
}
.main-nav.top-action-bar .nav-upload:hover{transform:translateY(-2px);box-shadow:0 12px 26px rgba(37,99,235,.31)!important;color:#fff!important}
.main-nav.top-action-bar .nav-upload:hover::before{transform:translateX(105%)}
.main-nav.top-action-bar .nav-external:after{content:"↗";font-size:.55rem;opacity:.5;margin-left:2px}

/* Attractive icon-only theme control beside GPCS Sign In. */
.theme-cycle-btn{
  position:relative;isolation:isolate;width:46px;height:46px;min-width:46px;min-height:46px;padding:5px;
  border:1px solid transparent;border-radius:15px;
  background:linear-gradient(#fff,#f5f9ff) padding-box,
             conic-gradient(from 215deg,#7fb4ff,#2563eb,#22d3ee,#7fb4ff) border-box;
  color:#174dbd;box-shadow:0 8px 22px rgba(37,99,235,.14),inset 0 1px 0 rgba(255,255,255,.9);
  overflow:visible;transition:transform .2s ease,box-shadow .2s ease,filter .2s ease;
}
.theme-cycle-btn:hover{transform:translateY(-2px) rotate(-1deg);box-shadow:0 13px 28px rgba(37,99,235,.22);filter:saturate(1.08)}
.theme-cycle-btn:active{transform:scale(.96)}
.theme-cycle-btn::after{
  content:"";position:absolute;right:4px;bottom:4px;width:7px;height:7px;border-radius:50%;
  background:#22c55e;border:2px solid #fff;box-shadow:0 1px 5px rgba(34,197,94,.35);
}
.theme-cycle-halo{width:54px;height:54px;left:-9px;top:-9px;opacity:.65;background:radial-gradient(circle,rgba(59,130,246,.22),transparent 66%)}
.theme-cycle-icon{
  width:34px;height:34px;border-radius:11px;
  background:linear-gradient(145deg,#eaf3ff,#ffffff);color:#1755cc;
  box-shadow:inset 0 0 0 1px #d5e6ff,0 3px 8px rgba(37,99,235,.10);
}
.theme-cycle-icon svg{width:18px;height:18px;stroke-width:2}
.theme-cycle-label{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important;border:0!important}
html[data-theme-preference="dark"] .theme-cycle-btn::after{background:#8b5cf6;box-shadow:0 1px 6px rgba(139,92,246,.45)}
html[data-theme-preference="system"] .theme-cycle-btn::after{background:#06b6d4;box-shadow:0 1px 6px rgba(6,182,212,.45)}

html[data-theme="dark"] .main-nav.top-action-bar{
  background:linear-gradient(180deg,rgba(15,30,52,.98),rgba(10,23,42,.97));border-color:#263d5c;box-shadow:0 10px 28px rgba(0,0,0,.22);
}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link,
html[data-theme="dark"] .main-nav.top-action-bar .nav-student,
html[data-theme="dark"] .main-nav.top-action-bar .nav-academic,
html[data-theme="dark"] .main-nav.top-action-bar .nav-library,
html[data-theme="dark"] .main-nav.top-action-bar .nav-previous,
html[data-theme="dark"] .main-nav.top-action-bar .nav-notes,
html[data-theme="dark"] .main-nav.top-action-bar .nav-more,
html[data-theme="dark"] .main-nav.top-action-bar .nav-result{
  background:linear-gradient(180deg,#132640,#0f2037);border-color:#294465;color:#c2d3ea;box-shadow:0 3px 10px rgba(0,0,0,.16),inset 0 1px 0 rgba(255,255,255,.035);
}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link:hover{background:linear-gradient(180deg,#173154,#122942);border-color:#37608f;color:#aad2ff}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link.active{background:linear-gradient(180deg,#16345d,#102c50);border-color:#3a6598;color:#a9d2ff}
html[data-theme="dark"] .main-nav.top-action-bar .nav-upload{background:linear-gradient(135deg,#12366f,#1d5be1,#3178ff)!important;color:#fff!important;border-color:transparent!important}
html[data-theme="dark"] .theme-cycle-btn{
  background:linear-gradient(#10233d,#0b1a2f) padding-box,
             conic-gradient(from 215deg,#315f9f,#60a5fa,#22d3ee,#315f9f) border-box;
  color:#a7ceff;box-shadow:0 9px 25px rgba(0,0,0,.28),0 0 18px rgba(37,99,235,.10);
}
html[data-theme="dark"] .theme-cycle-icon{background:linear-gradient(145deg,#17345a,#102746);color:#9dcbff;box-shadow:inset 0 0 0 1px #31547f}
html[data-theme="dark"] .theme-cycle-btn::after{border-color:#0c1b30}

@media(max-width:599px){
  .main-nav.top-action-bar .nav-link,.main-nav.top-action-bar .nav-cta{min-height:38px;padding:8px 11px;font-size:.65rem;border-radius:11px}
  .theme-cycle-btn{width:43px;height:43px;min-width:43px;min-height:43px;border-radius:14px;padding:4px}
  .theme-cycle-icon{width:33px;height:33px;border-radius:10px}
  .theme-cycle-halo{width:50px;height:50px;left:-8px;top:-8px}
}

/* ======================================================================
   GPCS Portal v1.8 — Animated GPCS Sign In + real Upload Paper arrows
   ====================================================================== */
.gpcs-signin-btn{
  position:relative;isolation:isolate;overflow:hidden;
  min-height:46px;padding:5px 10px 5px 6px;border-radius:15px;gap:8px;
  border:1px solid rgba(96,165,250,.42);
  background:linear-gradient(120deg,#071f4d 0%,#1246b8 42%,#2563eb 74%,#3b82f6 100%);
  box-shadow:0 10px 25px rgba(30,88,210,.24),inset 0 1px 0 rgba(255,255,255,.22),inset 0 -1px 0 rgba(2,20,58,.24);
}
.gpcs-signin-btn::before{
  content:"";position:absolute;z-index:-1;top:-45%;left:-38%;width:34%;height:190%;
  background:linear-gradient(90deg,transparent,rgba(255,255,255,.34),transparent);
  transform:rotate(15deg) translateX(-180%);transition:transform .65s cubic-bezier(.2,.8,.2,1);
}
.gpcs-signin-btn:hover::before{transform:rotate(15deg) translateX(520%)}
.gpcs-signin-btn:hover{transform:translateY(-2px);box-shadow:0 15px 34px rgba(30,88,210,.34),0 0 0 3px rgba(59,130,246,.08),inset 0 1px 0 rgba(255,255,255,.25)}
.signin-glow{
  position:absolute;z-index:-2;inset:-18px;border-radius:28px;opacity:.0;pointer-events:none;
  background:radial-gradient(circle at 45% 50%,rgba(96,165,250,.34),transparent 64%);transition:opacity .22s ease;
}
.gpcs-signin-btn:hover .signin-glow{opacity:1}
.signin-icon-shell{
  width:34px;height:34px;display:grid;place-items:center;flex:none;border-radius:11px;
  color:#fff;background:linear-gradient(145deg,rgba(255,255,255,.22),rgba(255,255,255,.08));
  border:1px solid rgba(255,255,255,.24);box-shadow:inset 0 1px 0 rgba(255,255,255,.2),0 4px 10px rgba(4,24,70,.16);
  transition:transform .22s ease,background .22s ease;
}
.signin-icon-shell svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
.gpcs-signin-btn:hover .signin-icon-shell{transform:rotate(-4deg) scale(1.06);background:rgba(255,255,255,.2)}
.signin-copy{display:flex;flex-direction:column;align-items:flex-start;line-height:1.02;min-width:0}
.signin-copy > span{font-weight:900;letter-spacing:.005em}
.signin-copy small{margin-top:3px;color:rgba(231,241,255,.78);font-size:.53rem;font-weight:700;letter-spacing:.035em;text-transform:uppercase}
.signin-arrow{display:grid;place-items:center;width:22px;height:22px;margin-left:1px;border-radius:999px;background:rgba(255,255,255,.12);font-size:.9rem;font-weight:900;transition:transform .2s ease,background .2s ease}
.gpcs-signin-btn:hover .signin-arrow{transform:translateX(3px);background:rgba(255,255,255,.2)}

/* Upload Paper now has an explicit upload icon + visible directional arrow. */
.main-nav.top-action-bar .nav-upload{display:inline-flex;align-items:center;gap:7px;padding-left:9px!important;padding-right:9px!important}
.nav-upload-icon{
  width:27px;height:27px;display:grid;place-items:center;flex:none;border-radius:9px;
  background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.18);
  box-shadow:inset 0 1px 0 rgba(255,255,255,.13);transition:transform .2s ease,background .2s ease;
}
.nav-upload-icon svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.nav-upload-arrow{
  width:22px;height:22px;display:grid;place-items:center;flex:none;border-radius:999px;
  background:rgba(255,255,255,.13);font-size:.82rem;line-height:1;font-weight:950;
  transition:transform .2s ease,background .2s ease;
}
.main-nav.top-action-bar .nav-upload:hover .nav-upload-icon{transform:translateY(-2px);background:rgba(255,255,255,.22)}
.main-nav.top-action-bar .nav-upload:hover .nav-upload-arrow{transform:translateX(3px);background:rgba(255,255,255,.22)}

html[data-theme="dark"] .gpcs-signin-btn{
  border-color:rgba(96,165,250,.36);background:linear-gradient(120deg,#0b2858,#164fc5 52%,#2c70ee);
  box-shadow:0 11px 29px rgba(0,0,0,.29),0 0 20px rgba(37,99,235,.08),inset 0 1px 0 rgba(255,255,255,.14)
}

@media(max-width:599px){
  .gpcs-signin-btn{min-height:43px;padding:4px 7px 4px 4px;gap:5px;border-radius:14px}
  .signin-icon-shell{width:33px;height:33px;border-radius:10px}
  .signin-copy small{display:none}
  .signin-arrow{width:19px;height:19px;font-size:.75rem}
  .main-nav.top-action-bar .nav-upload{padding-left:7px!important;padding-right:7px!important;gap:6px}
  .nav-upload-icon{width:25px;height:25px;border-radius:8px}.nav-upload-icon svg{width:15px;height:15px}
  .nav-upload-arrow{width:19px;height:19px;font-size:.74rem}
}
@media(max-width:390px){.signin-arrow{display:none}}
@media(prefers-reduced-motion:reduce){
  .gpcs-signin-btn::before,.signin-icon-shell,.signin-arrow,.nav-upload-icon,.nav-upload-arrow{transition:none!important}
}


/* ======================================================================
   GPCS Portal v1.8.1 — Complete dark-theme visibility & contrast QA
   ====================================================================== */
html[data-theme="dark"]{
  --blue-700:#8fc2ff;
  --blue-600:#69a8ff;
  --blue-500:#82b7ff;
  --sky-500:#4dc8ff;
  --cyan-400:#67e8f9;
  --ink:#f5f9ff;
  --ink-2:#d7e4f5;
  --muted:#aabbd2;
  --bg:#07101f;
  --surface:#0e1d32;
  --surface-2:#12243c;
  --surface-blue:#12335d;
  --line:#2d4666;
  --line-strong:#3b5a80;
  --ok:#6ee7b7;
  --warn:#ffd479;
  --bad:#ff9aab;
}
html[data-theme="dark"] body{color:#f5f9ff}
html[data-theme="dark"] a{color:inherit}
html[data-theme="dark"] :is(label,.hero-search label){color:#d6e3f5}
html[data-theme="dark"] :is(.feature-card p,.resource-card p,.note-card>p,.manage-main p,.side-form p,.message-card p,.gallery-card figcaption){color:#b4c4d9}
html[data-theme="dark"] :is(.feature-card b,.resource-card b,.subject-line,.gallery-upload summary,.admin-detail summary>span:last-child){color:#8fc2ff!important}
html[data-theme="dark"] :is(.feature-card,.resource-card,.branch-card,.filter-bar,.gallery-upload,.gallery-card,.contact-card,.note-card,.manage-card,.admin-card,.message-card,.auth-card,.paper-card,.empty,.table-wrap,.admin-gallery article){
  background:#0e1d32;border-color:#2d4666;color:#d7e4f5;
}
html[data-theme="dark"] :is(.feature-card,.resource-card,.branch-card,.gallery-card,.contact-card,.note-card,.manage-card,.admin-card,.auth-card){box-shadow:0 10px 28px rgba(0,0,0,.22)}
html[data-theme="dark"] :is(.feature-card:hover,.resource-card:hover,.branch-card:hover,.gallery-card:hover){background:#122640;border-color:#41658e;box-shadow:0 16px 36px rgba(0,0,0,.30)}
html[data-theme="dark"] .feature-icon{background:linear-gradient(145deg,#17365d,#102945);border-color:#31577f;color:#a7d2ff;box-shadow:inset 0 1px 0 rgba(255,255,255,.05)}
html[data-theme="dark"] .branch-card>span{background:linear-gradient(145deg,#12366f,#2563eb);color:#fff}
html[data-theme="dark"] .branch-card b{color:#8fc2ff}
html[data-theme="dark"] .branch-pills span{background:#10233e;border-color:#31506f;color:#c7dcf5;box-shadow:none}
html[data-theme="dark"] .page-hero:not(.admin-hero){background:linear-gradient(145deg,#0d1f36,#091726 67%);border-color:#263e5d}
html[data-theme="dark"] .page-hero:after{border-color:rgba(96,165,250,.16);box-shadow:0 0 0 58px rgba(37,99,235,.04),0 0 0 116px rgba(14,165,233,.025)}
html[data-theme="dark"] .hero-search label{color:#d9e6f6}
html[data-theme="dark"] .search-row{background:#0b192c;border-color:#365474}
html[data-theme="dark"] .search-row input{color:#f5f9ff}
html[data-theme="dark"] .mini-stats div{background:#0c1b30;border-color:#2b4362}
html[data-theme="dark"] .live-dot{background:#0c2b24;border-color:#236149;color:#7cf0c4}

/* Feedback states remain semantic and readable in dark mode. */
html[data-theme="dark"] .alert button{color:inherit}
html[data-theme="dark"] .alert.success{background:#0b2a24;color:#87f1cb;border-color:#21624f}
html[data-theme="dark"] .alert.warning,
html[data-theme="dark"] .setup-banner{background:#2d2512;color:#ffe09a;border-color:#66532b}
html[data-theme="dark"] .alert.error{background:#301820;color:#ffb1bd;border-color:#6d3542}
html[data-theme="dark"] .notice{background:#102945;border-color:#31567f;color:#c2d8f4}
html[data-theme="dark"] .notice strong,
html[data-theme="dark"] .setup-banner a{color:#9ccaff}

/* Forms and upload controls. */
html[data-theme="dark"] input,
html[data-theme="dark"] select,
html[data-theme="dark"] textarea{background:#091827;color:#f5f9ff;border-color:#3a587f;box-shadow:inset 0 1px 0 rgba(255,255,255,.025)}
html[data-theme="dark"] option{background:#091827;color:#f5f9ff}
html[data-theme="dark"] input::placeholder,
html[data-theme="dark"] textarea::placeholder{color:#8296b2;opacity:1}
html[data-theme="dark"] input:focus,
html[data-theme="dark"] select:focus,
html[data-theme="dark"] textarea:focus{border-color:#69a8ff;box-shadow:0 0 0 4px rgba(96,165,250,.16)}
html[data-theme="dark"] input[type="checkbox"],
html[data-theme="dark"] input[type="radio"]{accent-color:#60a5fa}
html[data-theme="dark"] .password-wrap button{background:#142840;color:#c8d8eb;border:1px solid #304b69}
html[data-theme="dark"] .password-wrap button:hover{background:#193452;color:#fff}
html[data-theme="dark"] .upload-zone{background:linear-gradient(180deg,#0d2038,#0a192c);border-color:#46688d;color:#eaf3ff}
html[data-theme="dark"] .upload-zone.drag{background:#102b4a;border-color:#69a8ff;box-shadow:0 0 0 5px rgba(96,165,250,.12)}
html[data-theme="dark"] .upload-zone small{color:#91c4ff}
html[data-theme="dark"] .upload-icon{background:linear-gradient(145deg,#12366f,#2563eb);color:#fff}
html[data-theme="dark"] .auto-badge{background:#0c2b24;color:#7cebc1;border-color:#26604e}
html[data-theme="dark"] .info-box{background:#102640;border-color:#31577f;border-left-color:#69a8ff;color:#d7e4f5}

/* Auth, filters, chips, pagination and selectable controls. */
html[data-theme="dark"] .auth-tabs{background:#0b192c;border-color:#2d4666}
html[data-theme="dark"] .auth-tabs a{color:#adbed3}
html[data-theme="dark"] .auth-tabs a:hover{background:#112743;color:#dbeaff}
html[data-theme="dark"] .auth-tabs a.active{background:#16345d;color:#b9daff;box-shadow:none}
html[data-theme="dark"] .filter-bar{background:#0e1d32;border-color:#2d4666}
html[data-theme="dark"] .branch-chip{background:#12335d;color:#b9d9ff;border-color:#315b88}
html[data-theme="dark"] .file-chip{background:#18283d;color:#c2cfe0;border-color:#344a65}
html[data-theme="dark"] .pagination a,
html[data-theme="dark"] .pagination span{background:#0e1d32;color:#c7d7ea;border-color:#2d4666}
html[data-theme="dark"] .pagination a:hover{background:#15345c;color:#fff;border-color:#4775aa}
html[data-theme="dark"] .pagination .active{background:linear-gradient(135deg,#17468f,#2563eb);color:#fff;border-color:#4b83d4}
html[data-theme="dark"] .tab-btn{background:#0e1d32;border-color:#2d4666;color:#b9c9dc}
html[data-theme="dark"] .tab-btn:hover{background:#132a47;color:#e9f3ff;border-color:#3d628d}
html[data-theme="dark"] .tab-btn.active{background:linear-gradient(135deg,#12366f,#2563eb);color:#fff;border-color:#4a80c8}
html[data-theme="dark"] .status{background:#172438;color:#c1cee0;border-color:#344a65}
html[data-theme="dark"] .status.ok{background:#0b2a24;color:#7cebc1;border-color:#26604e}
html[data-theme="dark"] .status.warn{background:#2d2512;color:#ffe09a;border-color:#66532b}
html[data-theme="dark"] .status.bad{background:#301820;color:#ffadba;border-color:#6d3542}
html[data-theme="dark"] .candidate{background:#0d1f36;border-color:#2d4666;color:#d7e4f5}
html[data-theme="dark"] .candidate:hover{background:#123154;border-color:#4b78a8}

/* Gallery, contact and admin surfaces. */
html[data-theme="dark"] .gallery-card figcaption{color:#c1d0e3}
html[data-theme="dark"] .contact-card>span{background:linear-gradient(145deg,#17365d,#102945);color:#9ccaff;border-color:#31577f}
html[data-theme="dark"] .admin-nav{background:#0d1c31;border-color:#2d4666}
html[data-theme="dark"] .admin-nav a{color:#b7c6d9}
html[data-theme="dark"] .admin-nav a:hover,
html[data-theme="dark"] .admin-nav a.active{background:linear-gradient(135deg,#14345d,#10304f);color:#acd4ff}
html[data-theme="dark"] .admin-stats div{background:#0e1d32;border-color:#2d4666;color:#dce8f8}
html[data-theme="dark"] .health-list p{border-color:#29425e;color:#c5d4e5}
html[data-theme="dark"] .table-wrap{background:#0c1a2e;border-color:#2d4666}
html[data-theme="dark"] table{color:#d7e4f5}
html[data-theme="dark"] th{background:#12243c;color:#c2d1e4;border-bottom-color:#36506f}
html[data-theme="dark"] td{border-bottom-color:#263d59}
html[data-theme="dark"] tbody tr:hover td{background:#102139}
html[data-theme="dark"] .admin-detail{background:#0c1b30;border-color:#2d4666;color:#d7e4f5}
html[data-theme="dark"] .admin-detail summary{color:#dbe7f6}
html[data-theme="dark"] .admin-detail[open] summary{background:#122943;border-color:#31506f}
html[data-theme="dark"] .admin-gallery article{background:#0e1d32;border-color:#2d4666}
html[data-theme="dark"] .admin-gallery img{background:#0a1728}
html[data-theme="dark"] .empty{background:#0d1d32;border-color:#3a5574;color:#aebfd3}

/* Buttons: keep every state legible, including disabled/focus. */
html[data-theme="dark"] .btn{background:#13243a;color:#e5eefb;border-color:#36506e}
html[data-theme="dark"] .btn:hover{background:#19304d;border-color:#46698f;color:#fff}
html[data-theme="dark"] .btn.primary{background:linear-gradient(135deg,#12366f,#2563eb);color:#fff;border-color:#4a80c8}
html[data-theme="dark"] .btn.secondary{background:#12335d;color:#b9daff;border-color:#315b88}
html[data-theme="dark"] .btn.ghost{background:#0d1d32;color:#d6e3f2;border-color:#36506e}
html[data-theme="dark"] .btn.danger{background:#301820;color:#ffb0bc;border-color:#6d3542}
html[data-theme="dark"] button:disabled,
html[data-theme="dark"] .btn:disabled{opacity:.62;color:#9cacc1}
html[data-theme="dark"] :is(a,button,input,select,textarea,summary):focus-visible{outline:3px solid rgba(105,168,255,.38);outline-offset:2px}

/* Premium header utilities stay crisp in dark mode. */
html[data-theme="dark"] .gpcs-signin-btn{color:#fff!important;border-color:#4c78ad;background:linear-gradient(120deg,#0c2e67,#1b57cb 52%,#337eff);box-shadow:0 12px 31px rgba(0,0,0,.34),0 0 22px rgba(59,130,246,.12),inset 0 1px 0 rgba(255,255,255,.18)}
html[data-theme="dark"] .signin-copy small{color:#d0e2fb}
html[data-theme="dark"] .signin-icon-shell{color:#fff;border-color:rgba(255,255,255,.25)}
html[data-theme="dark"] .signin-arrow{color:#fff}
html[data-theme="dark"] .nav-upload-icon,
html[data-theme="dark"] .nav-upload-arrow{color:#fff;border-color:rgba(255,255,255,.20)}
html[data-theme="dark"] .theme-cycle-btn{filter:none}

/* Native scrollbars used inside tables/admin areas also remain visible. */
html[data-theme="dark"] :is(.table-wrap,.admin-nav,.tabs-row){scrollbar-color:#46698f #0b192c}

/* ======================================================================
   GPCS Portal v1.9 — Notes upload/download + Smart college gallery
   ====================================================================== */
.page-quick-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px}
.resource-rule{font-size:.72rem;color:var(--muted);font-weight:750}
.note-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}
.upload-rule-line{padding:10px 12px;border-radius:12px;background:#f3f7ff;border:1px solid #dce8fa;color:#4f617b!important;font-size:.73rem!important;line-height:1.5!important}
.note-file-zone{position:relative;display:grid;place-items:center;text-align:center;gap:5px;padding:22px 12px;border:1.5px dashed #9fb6d8;border-radius:17px;background:linear-gradient(180deg,#f9fbff,#f2f7ff);overflow:hidden;transition:.2s}
.note-file-zone.drag{border-color:var(--blue-600);background:#edf5ff;box-shadow:0 0 0 4px rgba(37,99,235,.08)}
.note-file-zone input{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer}
.note-file-zone>*:not(input){pointer-events:none;position:relative}
.upload-icon.mini{width:42px;height:42px;border-radius:13px;margin:0;font-size:1.15rem}
.note-file-zone strong{font-size:.82rem;color:var(--ink)}
.note-file-zone small{font-size:.68rem;color:var(--muted);line-height:1.45}
.note-file-zone em{font-style:normal;font-size:.67rem;color:var(--blue-600);font-weight:850;max-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}

.gallery-category-head{display:flex;justify-content:space-between;gap:18px;align-items:end;margin-bottom:18px}
.gallery-category-head h2{margin:5px 0 0;font-size:clamp(1.35rem,2.3vw,2rem);letter-spacing:-.035em}
.gallery-all-link{display:inline-flex;align-items:center;gap:7px;padding:9px 12px;border-radius:12px;border:1px solid var(--line);background:#fff;color:var(--muted);font-size:.72rem;font-weight:850;white-space:nowrap;box-shadow:var(--shadow-sm)}
.gallery-all-link b{color:var(--blue-600)}.gallery-all-link.active{background:#eaf2ff;border-color:#c9dcff;color:#174dbd}
.gallery-category-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:20px}
.gallery-category-card{position:relative;display:grid;grid-template-columns:auto 1fr;gap:11px;padding:15px;border:1px solid var(--line);border-radius:19px;background:linear-gradient(155deg,#fff,#f7faff);box-shadow:var(--shadow-sm);transition:.2s;min-height:160px}
.gallery-category-card:hover{transform:translateY(-3px);border-color:#bdd4f7;box-shadow:var(--shadow-md)}
.gallery-category-card.active{border-color:#8db7f3;background:linear-gradient(155deg,#eef5ff,#fff);box-shadow:0 12px 30px rgba(37,99,235,.12)}
.gallery-category-icon{width:43px;height:43px;border-radius:13px;display:grid;place-items:center;background:linear-gradient(145deg,#e9f2ff,#f8fbff);border:1px solid #d8e7fc;font-size:1.18rem}
.gallery-category-card h3{margin:2px 0 5px;font-size:.86rem;letter-spacing:-.02em}.gallery-category-card p{margin:0;color:var(--muted);font-size:.69rem;line-height:1.5}.gallery-category-card>div:nth-child(2)>span{display:block;margin-top:8px;color:var(--blue-600);font-size:.65rem;font-weight:850}
.gallery-category-actions{grid-column:1/-1;display:flex;gap:7px;margin-top:auto}.gallery-category-actions .btn{flex:1}
.gallery-upload-panel{margin:20px 0 24px;padding:22px;border-radius:24px;scroll-margin-top:135px}.gallery-upload-panel[hidden]{display:none!important}
.gallery-upload-head{display:flex;justify-content:space-between;gap:20px;align-items:start;margin-bottom:16px}.gallery-upload-head h2{margin:4px 0 5px}.gallery-upload-head p{margin:0;color:var(--muted);font-size:.78rem;line-height:1.55;max-width:760px}
.gallery-close{width:38px;height:38px;display:grid;place-items:center;border:1px solid var(--line);border-radius:12px;background:#fff;color:var(--muted);font-size:1.35rem;cursor:pointer;transition:.2s}.gallery-close:hover{background:#f2f6fc;color:var(--ink)}
.gallery-smart-form{display:grid;grid-template-columns:1fr 1.3fr;gap:12px}.gallery-smart-form label{display:grid;gap:6px;font-size:.72rem;font-weight:800;color:var(--muted)}.gallery-smart-form label:nth-of-type(3){grid-column:1/-1}.gallery-smart-form .gallery-policy,.gallery-smart-form .hint,.gallery-smart-form .btn{grid-column:1/-1}
.gallery-policy{display:flex;gap:10px;align-items:center;padding:11px 13px;border-radius:13px;background:#eef6ff;border:1px solid #d7e8ff;font-size:.72rem}.gallery-policy strong{color:#174dbd;white-space:nowrap}.gallery-policy span{color:#52647e;line-height:1.45}
.gallery-filter-strip{display:flex;gap:7px;overflow:auto;scrollbar-width:none;margin:5px 0 16px;padding-bottom:2px;scroll-margin-top:130px}.gallery-filter-strip::-webkit-scrollbar{display:none}.gallery-filter-strip a{flex:none;padding:8px 11px;border-radius:999px;border:1px solid var(--line);background:#fff;color:var(--muted);font-size:.68rem;font-weight:800}.gallery-filter-strip a.active{background:var(--navy-900);color:#fff;border-color:var(--navy-900)}
.gallery-cat-badge{display:inline-flex;padding:5px 8px;border-radius:999px;background:#eaf2ff;color:#205bc8;font-size:.62rem;font-weight:850}.gallery-card figcaption p{margin:8px 0 0;color:#42516b;font-size:.75rem;line-height:1.45}
.gallery-admin-edit{display:grid;grid-template-columns:1fr 1fr;gap:7px;margin:8px 0}.gallery-admin-edit .btn{grid-column:1/-1;justify-self:start}

html[data-theme="dark"] .upload-rule-line{background:#0c213b;border-color:#244667;color:#b7c7da!important}
html[data-theme="dark"] .note-file-zone{background:linear-gradient(180deg,#0d2038,#09182a);border-color:#46688d}.note-file-zone.drag{border-color:#69a8ff}
html[data-theme="dark"] .note-file-zone strong{color:#e8f1ff}html[data-theme="dark"] .note-file-zone small{color:#afc0d5}html[data-theme="dark"] .note-file-zone em{color:#8fc2ff}
html[data-theme="dark"] .gallery-all-link,html[data-theme="dark"] .gallery-category-card,html[data-theme="dark"] .gallery-close,html[data-theme="dark"] .gallery-filter-strip a{background:#0d1d32;border-color:#243b59;color:#b8c7da}
html[data-theme="dark"] .gallery-all-link.active{background:#102d52;border-color:#315b8d;color:#9cc7ff}
html[data-theme="dark"] .gallery-category-card{background:linear-gradient(155deg,#0e2038,#0a192b)}html[data-theme="dark"] .gallery-category-card:hover,html[data-theme="dark"] .gallery-category-card.active{background:linear-gradient(155deg,#123052,#0d2037);border-color:#426f9f}
html[data-theme="dark"] .gallery-category-icon{background:#122b49;border-color:#2b5078}html[data-theme="dark"] .gallery-category-card h3{color:#e4efff}html[data-theme="dark"] .gallery-category-card p{color:#afc0d5}
html[data-theme="dark"] .gallery-upload-head p{color:#afc0d5}html[data-theme="dark"] .gallery-policy{background:#0c2541;border-color:#244a71}html[data-theme="dark"] .gallery-policy strong{color:#91c4ff}html[data-theme="dark"] .gallery-policy span{color:#b7c7da}
html[data-theme="dark"] .gallery-filter-strip a.active{background:#2e70dc;border-color:#2e70dc;color:#fff}html[data-theme="dark"] .gallery-cat-badge{background:#12355f;color:#9ccaff}html[data-theme="dark"] .gallery-card figcaption p{color:#c1d0e3}

@media(max-width:1023px){.gallery-category-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.gallery-category-card{min-height:145px}}
@media(max-width:599px){.page-quick-actions{display:grid;grid-template-columns:1fr 1fr}.page-quick-actions .btn{width:100%;font-size:.72rem;padding-inline:10px}.gallery-category-head{align-items:start;flex-direction:column}.gallery-category-grid{grid-template-columns:1fr}.gallery-category-card{min-height:auto}.gallery-smart-form{grid-template-columns:1fr}.gallery-smart-form label:nth-of-type(3),.gallery-smart-form .gallery-policy,.gallery-smart-form .hint,.gallery-smart-form .btn{grid-column:auto}.gallery-policy{align-items:start;flex-direction:column}.gallery-upload-panel{padding:16px}.gallery-upload-head{gap:10px}.gallery-admin-edit{grid-template-columns:1fr}}

/* ======================================================================
   GPCS Portal v2.0 — Visual AI gallery review + polished Notes workflow
   ====================================================================== */
.gallery-ai-status{grid-column:1/-1;display:flex;align-items:center;gap:11px;padding:12px 14px;border:1px solid #d7e5fa;border-radius:15px;background:linear-gradient(135deg,#f7fbff,#eef5ff);transition:.2s}
.gallery-ai-status .ai-dot{width:10px;height:10px;border-radius:999px;background:#4f8df7;box-shadow:0 0 0 5px rgba(79,141,247,.11);flex:none}
.gallery-ai-status>div{display:grid;gap:2px}.gallery-ai-status strong{font-size:.75rem;color:#173b70}.gallery-ai-status small{font-size:.66rem;line-height:1.45;color:#64748b}
.gallery-ai-status[data-state="loading"] .ai-dot{animation:aiPulse 1s ease-in-out infinite;background:#2563eb}.gallery-ai-status[data-state="done"]{border-color:#bbdfca;background:#f0fbf5}.gallery-ai-status[data-state="done"] .ai-dot{background:#16a34a}.gallery-ai-status[data-state="review"]{border-color:#f2d6a7;background:#fff8eb}.gallery-ai-status[data-state="review"] .ai-dot{background:#d97706}.gallery-ai-status[data-state="manual"]{border-color:#cddcff;background:#f3f7ff}.gallery-ai-status[data-state="manual"] .ai-dot{background:#7c3aed}
@keyframes aiPulse{50%{transform:scale(.65);opacity:.55}}
.review-queue-chip{display:inline-flex;align-items:center;gap:6px;padding:8px 11px;border-radius:999px;background:#fff4e5;border:1px solid #f2c987;color:#9a5708;font-size:.7rem;font-weight:900;white-space:nowrap}.nav-badge{display:inline-grid;place-items:center;min-width:19px;height:19px;padding:0 5px;border-radius:999px;background:#e44d4d;color:#fff;font-size:.6rem;font-weight:900;margin-left:5px}
.admin-gallery article.needs-review{border:1px solid #efc77f;background:linear-gradient(135deg,#fffdf7,#fff8e8);box-shadow:0 8px 24px rgba(181,114,17,.08)}.review-badge{display:inline-flex;width:max-content;padding:5px 8px;border-radius:999px;background:#fff0d6;color:#965706;font-size:.6rem;font-weight:900;margin-bottom:5px}.ai-meta{display:flex;gap:6px;flex-wrap:wrap;margin-top:7px}.ai-meta span{padding:4px 7px;border-radius:8px;background:#f3f6fb;border:1px solid #e2e9f3;color:#64748b;font-size:.58rem;line-height:1.35}
.results-meta span{color:var(--muted);font-size:.7rem}.drop-icon{width:42px;height:42px;border-radius:13px;display:grid;place-items:center;background:linear-gradient(145deg,#eaf2ff,#fff);border:1px solid #d5e4fb;color:#2563eb;font-size:1.25rem;font-weight:900;box-shadow:var(--shadow-sm)}

html[data-theme="dark"] .gallery-ai-status{background:linear-gradient(135deg,#0d223c,#102845);border-color:#2c4c70}html[data-theme="dark"] .gallery-ai-status strong{color:#dcecff}html[data-theme="dark"] .gallery-ai-status small{color:#aec0d6}html[data-theme="dark"] .gallery-ai-status[data-state="done"]{background:#0d2b24;border-color:#275a49}html[data-theme="dark"] .gallery-ai-status[data-state="review"]{background:#33240d;border-color:#705121}html[data-theme="dark"] .gallery-ai-status[data-state="manual"]{background:#171f43;border-color:#3a4c88}
html[data-theme="dark"] .review-queue-chip{background:#38260d;border-color:#795322;color:#f5c678}html[data-theme="dark"] .admin-gallery article.needs-review{background:linear-gradient(135deg,#2d220f,#221b10);border-color:#735423}html[data-theme="dark"] .review-badge{background:#4a310d;color:#ffd18c}html[data-theme="dark"] .ai-meta span{background:#10233c;border-color:#294766;color:#b8c9dd}html[data-theme="dark"] .drop-icon{background:#122d50;border-color:#2a527c;color:#9cc8ff}

@media(max-width:599px){.gallery-ai-status{align-items:flex-start}.admin-gallery article.needs-review{padding:10px}.review-queue-chip{font-size:.64rem}}

/* v2.0.3 — Paper Library: one universal search box */
.paper-library-search{max-width:980px;margin:0 auto 24px;padding:18px;border:1px solid var(--line);border-radius:22px;background:linear-gradient(160deg,rgba(255,255,255,.96),rgba(247,250,255,.92));box-shadow:0 12px 34px rgba(18,45,90,.08)}
.paper-library-search>label{display:block;margin:0 0 9px;font-size:.78rem;font-weight:900;color:#2c3f5f;letter-spacing:.01em}
.paper-library-search>small{display:block;margin-top:9px;color:var(--muted);font-size:.72rem;line-height:1.55}
.paper-library-search>small b{color:#315d9f}
.paper-search-box{display:flex;align-items:center;gap:8px;min-height:58px;padding:6px 7px 6px 14px;border:1px solid #cbd9ee;border-radius:17px;background:#f8fbff;transition:border-color .18s,box-shadow .18s,background .18s}
.paper-search-box:focus-within{background:#fff;border-color:#79a8f7;box-shadow:0 0 0 4px rgba(37,99,235,.09)}
.paper-search-icon{flex:0 0 auto;color:#3d72c4;font-size:1.35rem;font-weight:900;line-height:1}
.paper-search-box input{flex:1;min-width:0;border:0!important;background:transparent!important;box-shadow:none!important;padding:10px 4px!important;margin:0!important;font-size:.95rem;color:var(--ink)}
.paper-search-clear{flex:0 0 auto;width:34px;height:34px;display:grid;place-items:center;border-radius:999px;background:#eaf1fb;color:#52709c;font-size:1.2rem;font-weight:700;transition:.18s}
.paper-search-clear:hover{background:#dce9fb;color:#174ea6;transform:scale(1.04)}
.paper-search-submit{flex:0 0 auto;min-width:104px;min-height:44px;border-radius:12px}
html[data-theme="dark"] .paper-library-search{background:linear-gradient(160deg,rgba(13,29,51,.98),rgba(9,22,40,.96));border-color:#294665;box-shadow:0 16px 40px rgba(0,0,0,.22)}
html[data-theme="dark"] .paper-library-search>label{color:#e5eefb}
html[data-theme="dark"] .paper-library-search>small{color:#a9bdd8}
html[data-theme="dark"] .paper-library-search>small b{color:#83b6ff}
html[data-theme="dark"] .paper-search-box{background:#0b192c;border-color:#365474}
html[data-theme="dark"] .paper-search-box:focus-within{background:#0d1e34;border-color:#5f98ea;box-shadow:0 0 0 4px rgba(59,130,246,.14)}
html[data-theme="dark"] .paper-search-icon{color:#7cb2ff}
html[data-theme="dark"] .paper-search-clear{background:#18304e;color:#b9d3f5}
html[data-theme="dark"] .paper-search-clear:hover{background:#234264;color:#fff}
@media(max-width:640px){
  .paper-library-search{padding:13px;border-radius:18px;margin-bottom:18px}
  .paper-search-box{min-height:54px;padding-left:11px;gap:5px}
  .paper-search-box input{font-size:.84rem!important}
  .paper-search-submit{min-width:auto;padding-inline:13px;font-size:.76rem}
  .paper-library-search>small{font-size:.66rem}
}


/* v2.0.4 — Notes Library uses the same single universal search pattern as Paper Library. */
.notes-library-search{margin-bottom:28px}

/* ======================================================================
   GPCS Portal v2.0.5 — Trusted campus global background
   Uses the exact user-provided campus image without editing it.
   ====================================================================== */
body{
  background-color:#f5f7fb;
  background-image:
    linear-gradient(180deg,rgba(249,251,255,.78) 0%,rgba(246,249,254,.82) 42%,rgba(247,250,253,.88) 100%),
    url("/assets/gpcs-embedded-81b2403e96e1.png");
  background-size:cover,cover;
  background-position:center top,center top;
  background-repeat:no-repeat,no-repeat;
  background-attachment:fixed,fixed;
}
/* Keep large surfaces readable while still allowing the campus to remain visible. */
.page-hero{
  background:linear-gradient(145deg,rgba(241,246,255,.90),rgba(249,251,255,.86) 65%);
}
.section.soft{
  background:linear-gradient(180deg,rgba(237,244,255,.82),rgba(248,250,254,.76));
}
html[data-theme="dark"] body{
  background-color:#07101f;
  background-image:
    linear-gradient(180deg,rgba(5,14,29,.80) 0%,rgba(6,16,31,.86) 48%,rgba(7,16,30,.91) 100%),
    url("/assets/gpcs-embedded-81b2403e96e1.png");
  background-size:cover,cover;
  background-position:center top,center top;
  background-repeat:no-repeat,no-repeat;
  background-attachment:fixed,fixed;
}
html[data-theme="dark"] .page-hero{
  background:linear-gradient(145deg,rgba(9,24,43,.91),rgba(8,19,35,.88) 65%);
}
html[data-theme="dark"] .section.soft{
  background:linear-gradient(180deg,rgba(10,27,48,.86),rgba(8,20,36,.82));
}
/* Mobile browsers handle scroll-attached backgrounds more smoothly. */
@media(max-width:767px){
  body,
  html[data-theme="dark"] body{
    background-attachment:scroll,scroll;
    background-position:center top,center top;
  }
}

/* ======================================================================
   GPCS Portal v2.1 — Reference-style Paper Library data table
   One instant search box · Show entries · Year/Session · Pagination
   ====================================================================== */
.paper-data-card{overflow:hidden;border:1px solid rgba(164,185,216,.72);border-radius:22px;background:rgba(255,255,255,.94);box-shadow:0 16px 44px rgba(20,49,94,.11);backdrop-filter:blur(12px);transition:opacity .18s}
.paper-data-card.is-loading{opacity:.72}
.paper-table-toolbar{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:16px 18px 14px;border-bottom:1px solid #dce6f3;background:linear-gradient(180deg,#fff,#f9fbff)}
.paper-length-control,.paper-inline-search{display:flex;align-items:center;gap:8px;color:#172a49;font-size:.76rem;font-weight:800;white-space:nowrap}
.paper-length-control select{min-width:66px;padding:8px 28px 8px 10px;border:1px solid #b9cbe3;border-radius:9px;background:#fff;color:#10233f;font-weight:800}
.paper-inline-search input{width:min(270px,34vw);min-height:38px;padding:8px 11px;border:1.5px solid #9eb8da;border-radius:9px;background:#fff;color:#10233f;font-weight:700;outline:none;transition:.18s}
.paper-inline-search input:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.12)}
.paper-table-scroll{overflow:auto;scrollbar-width:thin;scrollbar-color:#9fbbe2 transparent}
.paper-data-table{width:100%;min-width:790px;border-collapse:collapse;background:rgba(255,255,255,.96);font-size:.78rem}
.paper-data-table th{padding:13px 12px;background:linear-gradient(180deg,#4b8ae8,#3978d8);color:#fff;border-right:1px solid rgba(255,255,255,.22);text-align:center;font-size:.73rem;font-weight:900;letter-spacing:.01em;position:sticky;top:0;z-index:2}
.paper-data-table th:last-child{border-right:0}
.paper-data-table td{padding:13px 12px;border-bottom:1px solid #dce5f1;border-right:1px solid #e5ebf4;text-align:center;color:#1a2a43;vertical-align:middle}
.paper-data-table td:last-child{border-right:0}.paper-data-table tbody tr{transition:background .16s}.paper-data-table tbody tr:nth-child(even){background:#f8fbff}.paper-data-table tbody tr:hover{background:#eef5ff}
.paper-data-table th:nth-child(1),.paper-data-table td:nth-child(1){width:76px}.paper-data-table th:nth-child(2),.paper-data-table td:nth-child(2){width:125px}.paper-data-table th:nth-child(4),.paper-data-table td:nth-child(4){width:92px}.paper-data-table th:nth-child(5),.paper-data-table td:nth-child(5){width:90px}.paper-data-table th:nth-child(6),.paper-data-table td:nth-child(6){width:150px}
.paper-title-cell{display:block;font-weight:850;color:#102b55;text-transform:uppercase;line-height:1.3}.paper-data-table td:nth-child(3) small{display:block;margin-top:4px;color:#667995;font-size:.64rem;font-weight:750}
.paper-link-actions{display:inline-flex;align-items:center;justify-content:center;gap:7px;white-space:nowrap}.paper-link-actions a{display:inline-flex;align-items:center;justify-content:center;padding:6px 9px;border-radius:8px;border:1px solid #bdd2ef;background:#f5f9ff;color:#2464c7;font-size:.67rem;font-weight:850;transition:.16s}.paper-link-actions a:last-child{background:#2468d7;border-color:#2468d7;color:#fff}.paper-link-actions a:hover{transform:translateY(-1px);box-shadow:0 5px 12px rgba(37,99,235,.14)}
.paper-empty{display:grid;place-items:center;gap:3px;padding:34px 18px;color:#64748b;text-align:center;background:#fbfdff}.paper-empty strong{color:#203451;font-size:.92rem}.paper-empty span{font-size:.72rem}
.paper-table-footer{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:13px 18px;background:#f9fbfe;border-top:1px solid #dce5f1}.paper-table-info{color:#54657e;font-size:.7rem;font-weight:700}
.paper-pagination{display:flex;align-items:center;gap:5px}.paper-pagination a,.paper-pagination button{appearance:none;border:1px solid #c7d5e8;background:#fff;color:#41536e;min-width:34px;height:34px;padding:0 10px;border-radius:8px;font-size:.68rem;font-weight:850;cursor:pointer;transition:.16s}.paper-pagination .paper-page-num.active{background:#2f72dc;border-color:#2f72dc;color:#fff;box-shadow:0 5px 14px rgba(47,114,220,.2)}.paper-pagination .disabled,.paper-pagination button:disabled{opacity:.42;cursor:not-allowed;pointer-events:none}.paper-pagination a:hover:not(.disabled),.paper-pagination button:hover:not(:disabled){border-color:#78a6e8;color:#1457b8;background:#f3f8ff}
.paper-library-bottom{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:14px;padding:0 4px}.paper-library-bottom p{margin:0;color:var(--muted);font-size:.68rem;line-height:1.5;max-width:760px}

html[data-theme="dark"] .paper-data-card{border-color:#294667;background:rgba(8,21,38,.95);box-shadow:0 18px 48px rgba(0,0,0,.28)}
html[data-theme="dark"] .paper-table-toolbar{background:linear-gradient(180deg,#0e2037,#0a192b);border-color:#28425f}
html[data-theme="dark"] .paper-length-control,html[data-theme="dark"] .paper-inline-search{color:#dce9fb}
html[data-theme="dark"] .paper-length-control select,html[data-theme="dark"] .paper-inline-search input{background:#0c1b2f;border-color:#3a5777;color:#e8f1ff}
html[data-theme="dark"] .paper-inline-search input:focus{border-color:#69a7ff;box-shadow:0 0 0 3px rgba(82,151,255,.14)}
html[data-theme="dark"] .paper-data-table{background:#09192c}html[data-theme="dark"] .paper-data-table th{background:linear-gradient(180deg,#225da8,#184985);color:#fff}
html[data-theme="dark"] .paper-data-table td{border-color:#243b57;color:#d8e5f5;background:#0b1c31}html[data-theme="dark"] .paper-data-table tbody tr:nth-child(even) td{background:#0d2138}html[data-theme="dark"] .paper-data-table tbody tr:hover td{background:#123052}
html[data-theme="dark"] .paper-title-cell{color:#eef6ff}html[data-theme="dark"] .paper-data-table td:nth-child(3) small{color:#9db3cf}
html[data-theme="dark"] .paper-link-actions a{background:#102946;border-color:#31587f;color:#a9ceff}html[data-theme="dark"] .paper-link-actions a:last-child{background:#2e6fd2;border-color:#2e6fd2;color:#fff}
html[data-theme="dark"] .paper-empty{background:#0a1a2e;color:#9fb2cb}html[data-theme="dark"] .paper-empty strong{color:#e7f0fc}
html[data-theme="dark"] .paper-table-footer{background:#0b1b2f;border-color:#28425f}html[data-theme="dark"] .paper-table-info{color:#a9bdd6}
html[data-theme="dark"] .paper-pagination a,html[data-theme="dark"] .paper-pagination button{background:#10233b;border-color:#345170;color:#c3d5e9}html[data-theme="dark"] .paper-pagination .paper-page-num.active{background:#3479df;border-color:#3479df;color:#fff}

@media(max-width:760px){
  .paper-data-card{border-radius:17px}.paper-table-toolbar{align-items:stretch;flex-direction:column;gap:10px;padding:13px}.paper-length-control{justify-content:flex-start}.paper-inline-search{width:100%;justify-content:space-between}.paper-inline-search input{width:min(100%,320px);flex:1}.paper-table-footer{align-items:flex-start;flex-direction:column;padding:12px 13px}.paper-pagination{width:100%;justify-content:flex-end;overflow:auto;scrollbar-width:none}.paper-pagination::-webkit-scrollbar{display:none}.paper-library-bottom{align-items:flex-start;flex-direction:column}.paper-library-bottom .btn{width:100%}.paper-data-table{min-width:700px}.paper-data-table th,.paper-data-table td{padding:11px 9px}
}

/* v2.1.1 — Paper Library real-file availability state */
.paper-unavailable{display:inline-flex;align-items:center;justify-content:center;min-height:30px;padding:6px 10px;border:1px solid #d7e0ec;border-radius:9px;background:#f4f7fb;color:#64748b;font-size:.68rem;font-weight:800;white-space:nowrap;letter-spacing:.01em}
html[data-theme="dark"] .paper-unavailable{border-color:#314963;background:#13263b;color:#c0cfe1}
@media(max-width:620px){.paper-unavailable{font-size:.64rem;padding:5px 8px}}

/* ======================================================================
   GPCS Portal v2.2.0 — Premium branding + site-wide interaction polish
   Styling-only upgrade. No routes, content, permissions or workflows changed.
   ====================================================================== */
:root{
  --gold-500:#d6a52f;
  --gold-400:#efc45a;
  --premium-blue:#1767e8;
  --premium-blue-2:#0f4fbe;
  --premium-cyan:#29b8e8;
  --focus-ring:0 0 0 4px rgba(37,99,235,.18);
  --button-shadow:0 10px 24px rgba(20,83,181,.18),0 2px 5px rgba(6,20,47,.08);
  --button-shadow-hover:0 15px 34px rgba(20,83,181,.25),0 4px 9px rgba(6,20,47,.10);
}

/* Correct GPCS emblem mark in header/footer. Only the mark crop is displayed;
   the source artwork's text/card is not part of the website lockup. */
.brand-logo-mark{
  width:60px;height:48px;padding:3px 4px;border-radius:15px;overflow:hidden;
  background:linear-gradient(145deg,#f5f6f8,#e8ebef);
  border:1px solid rgba(9,39,84,.10);
  box-shadow:0 9px 24px rgba(8,38,84,.13),inset 0 1px 0 rgba(255,255,255,.8);
  flex:none;display:grid;place-items:center;
}
.brand-logo-mark:after{display:none!important}
.brand-logo-mark img{width:100%;height:100%;object-fit:contain;display:block;border-radius:11px}
.brand strong{font-weight:900;letter-spacing:-.025em;font-size:1.05rem;color:var(--navy-900)}
.brand small{font-weight:650;letter-spacing:-.005em}

/* Premium sticky header: calm by default, stronger separation only after scroll. */
.site-header{transition:background .22s ease,box-shadow .22s ease,backdrop-filter .22s ease}
.site-header.is-scrolled{background:linear-gradient(180deg,rgba(248,250,255,.985),rgba(248,250,255,.91) 78%,transparent);backdrop-filter:blur(18px)}
.site-header.is-scrolled .header-row{box-shadow:0 16px 46px rgba(9,38,88,.14);border-color:rgba(174,194,224,.82)}
.header-row{transition:box-shadow .22s ease,border-color .22s ease,background .22s ease}

/* One consistent premium button language across the portal. */
.btn,
.paper-link-actions a,
.paper-search-submit,
.tab-btn,
.paper-pagination a,
.paper-pagination button{
  position:relative;isolation:isolate;overflow:hidden;
  border-radius:12px;
  font-weight:850;
  letter-spacing:-.005em;
  transform:translateZ(0);
  transition:transform .19s cubic-bezier(.2,.8,.2,1),box-shadow .19s ease,border-color .19s ease,background .19s ease,color .19s ease,filter .19s ease;
}
.btn:before,
.paper-search-submit:before,
.tab-btn:before{
  content:"";position:absolute;inset:0;z-index:-1;pointer-events:none;
  background:linear-gradient(115deg,transparent 12%,rgba(255,255,255,.22) 48%,transparent 72%);
  transform:translateX(-130%);transition:transform .48s ease;
}
.btn:hover:before,.paper-search-submit:hover:before,.tab-btn:hover:before{transform:translateX(130%)}
.btn:hover,.paper-link-actions a:hover,.paper-search-submit:hover,.tab-btn:hover{transform:translateY(-2px) scale(1.015)}
.btn:active,.paper-link-actions a:active,.paper-search-submit:active,.tab-btn:active{transform:translateY(0) scale(.98)}
.btn:focus-visible,.paper-link-actions a:focus-visible,.paper-search-submit:focus-visible,.tab-btn:focus-visible,.nav-link:focus-visible,.gpcs-signin-btn:focus-visible,.theme-cycle-btn:focus-visible{outline:0;box-shadow:var(--focus-ring)}

.btn.primary,
.paper-search-submit{
  color:#fff;border-color:rgba(255,255,255,.18);
  background:linear-gradient(135deg,#0b2f6f 0%,#155fd9 52%,#2187ef 100%);
  box-shadow:var(--button-shadow),inset 0 1px 0 rgba(255,255,255,.22);
}
.btn.primary:hover,.paper-search-submit:hover{box-shadow:var(--button-shadow-hover),inset 0 1px 0 rgba(255,255,255,.25);filter:saturate(1.07)}
.btn.secondary{
  color:#1557b5;border-color:#b8d0f2;
  background:linear-gradient(180deg,rgba(246,250,255,.98),rgba(232,242,255,.96));
  box-shadow:0 6px 17px rgba(29,78,216,.09),inset 0 1px 0 #fff;
}
.btn.secondary:hover{color:#fff;border-color:#2875de;background:linear-gradient(135deg,#1b67d6,#2f8aec);box-shadow:0 12px 25px rgba(37,99,235,.20)}
.btn.ghost{
  color:#30445f;border-color:#cbd8e9;
  background:rgba(255,255,255,.78);backdrop-filter:blur(10px);
  box-shadow:0 5px 14px rgba(15,48,92,.07),inset 0 1px 0 rgba(255,255,255,.9)
}
.btn.ghost:hover{color:#1557b5;border-color:#8fb8eb;background:#f6faff;box-shadow:0 10px 22px rgba(37,99,235,.12)}
.btn.danger{color:#b8273d;border-color:#f0bcc6;background:linear-gradient(180deg,#fff7f8,#ffecef);box-shadow:0 5px 14px rgba(192,58,74,.08)}
.btn.danger:hover{color:#fff;border-color:#cb3b50;background:linear-gradient(135deg,#c8374d,#e45165);box-shadow:0 12px 24px rgba(192,58,74,.20)}
.btn:disabled,.btn[aria-disabled="true"]{opacity:.5;filter:saturate(.45);transform:none!important;box-shadow:none!important;cursor:not-allowed}

/* Navigation: attractive academic pills without turning into a neon dashboard. */
.main-nav.top-action-bar{gap:7px;padding-block:7px}
.main-nav.top-action-bar .nav-link{
  min-height:41px;padding:9px 14px;border-radius:12px;
  background:linear-gradient(180deg,rgba(255,255,255,.82),rgba(245,249,255,.80));
  border:1px solid rgba(184,201,225,.70);
  color:#30445f;
  box-shadow:0 4px 12px rgba(20,49,94,.06),inset 0 1px 0 rgba(255,255,255,.92);
  transition:transform .18s ease,box-shadow .18s ease,background .18s ease,border-color .18s ease,color .18s ease;
}
.main-nav.top-action-bar .nav-link:hover{
  transform:translateY(-2px);color:#1458b9;border-color:#91b9ef;
  background:linear-gradient(180deg,#fff,#edf5ff);box-shadow:0 10px 22px rgba(37,99,235,.13)
}
.main-nav.top-action-bar .nav-link.active{
  color:#fff;border-color:transparent;
  background:linear-gradient(135deg,#0d397d,#1766dc 58%,#2788ef);
  box-shadow:0 10px 24px rgba(29,78,216,.22),inset 0 1px 0 rgba(255,255,255,.20)
}
.main-nav.top-action-bar .nav-upload{
  color:#fff!important;border-color:rgba(255,255,255,.15)!important;
  background:linear-gradient(135deg,#0a3378,#1768e4 54%,#2b8ef2)!important;
  box-shadow:0 11px 28px rgba(29,78,216,.26),inset 0 1px 0 rgba(255,255,255,.22)!important;
}
.main-nav.top-action-bar .nav-upload:hover{transform:translateY(-2px);box-shadow:0 15px 32px rgba(29,78,216,.31)!important;filter:saturate(1.08)}
.main-nav.top-action-bar .nav-upload:hover .nav-upload-icon{transform:translateY(-2px)}
.main-nav.top-action-bar .nav-upload:hover .nav-upload-arrow{transform:translateX(3px)}
.nav-upload-icon,.nav-upload-arrow{transition:transform .18s ease}
.main-nav.top-action-bar .logout{color:#a62f42;background:linear-gradient(180deg,#fff,#fff5f6);border-color:#f2d6dc}

/* Refine the premium utility controls already approved. */
.gpcs-signin-btn{border:1px solid rgba(255,255,255,.24);box-shadow:0 12px 28px rgba(27,82,177,.22),inset 0 1px 0 rgba(255,255,255,.20)}
.gpcs-signin-btn:hover{transform:translateY(-2px) scale(1.015);box-shadow:0 17px 36px rgba(27,82,177,.29),inset 0 1px 0 rgba(255,255,255,.24)}
.gpcs-signin-btn:active{transform:scale(.98)}
.theme-cycle-btn{box-shadow:0 8px 22px rgba(29,78,216,.14),inset 0 1px 0 rgba(255,255,255,.9)}
.theme-cycle-btn:hover{transform:translateY(-2px) rotate(-2deg);box-shadow:0 13px 28px rgba(37,99,235,.22)}

/* Paper Library action links inherit the same premium hierarchy. */
.paper-link-actions a{border-radius:10px;min-height:33px;padding:7px 11px;background:linear-gradient(180deg,#fff,#f1f6ff);border-color:#bfd2ec;color:#245da9;box-shadow:0 4px 12px rgba(31,77,141,.08)}
.paper-link-actions a:last-child{background:linear-gradient(135deg,#155fcf,#2785eb);border-color:transparent;color:#fff;box-shadow:0 7px 17px rgba(37,99,235,.19)}

/* Footer becomes a deliberate branded end-cap while retaining existing content. */
.site-footer{position:relative;margin-top:34px;padding:0 0 18px;background:transparent;border:0}
.site-footer:before{content:"";display:block;height:2px;background:linear-gradient(90deg,transparent,#2f7ce1 22%,#e4b83f 50%,#2ab8df 78%,transparent);opacity:.85}
.footer-panel{margin-top:16px;border:1px solid rgba(169,190,220,.56);border-radius:25px;overflow:hidden;background:linear-gradient(135deg,rgba(8,31,70,.97),rgba(12,65,132,.95));box-shadow:0 20px 48px rgba(5,25,59,.18);color:#fff;backdrop-filter:blur(16px)}
.footer-main{display:flex;align-items:center;justify-content:space-between;gap:28px;padding:25px 28px}
.footer-brand{margin:0;min-width:0}.footer-brand .brand-logo-mark{width:68px;height:54px;background:#eef0f2;border-color:rgba(255,255,255,.28);box-shadow:0 9px 23px rgba(0,0,0,.20)}
.footer-brand strong{color:#fff;font-size:1.15rem}.footer-brand small{color:#c8d7ee;font-size:.72rem}
.footer-links{display:flex;align-items:center;justify-content:flex-end;gap:8px;flex-wrap:wrap}
.footer-links a{padding:9px 12px;border-radius:11px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.07);color:#eaf3ff;font-size:.76rem;font-weight:800;transition:.18s}
.footer-links a:hover{transform:translateY(-1px);background:rgba(255,255,255,.14);border-color:rgba(255,255,255,.28);color:#fff}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:13px 28px;border-top:1px solid rgba(255,255,255,.13);background:rgba(4,20,48,.26)}
.footer-bottom p,.footer-bottom span{margin:0;color:#b9cbe4;font-size:.69rem;font-weight:700}.footer-bottom span{color:#e5b94b}

/* Dark mode: preserve premium depth and contrast. */
html[data-theme="dark"] .brand strong{color:#eef6ff}
html[data-theme="dark"] .brand-logo-mark{background:linear-gradient(145deg,#eef0f2,#dfe3e7);border-color:#36516e;box-shadow:0 10px 25px rgba(0,0,0,.30)}
html[data-theme="dark"] .site-header.is-scrolled{background:linear-gradient(180deg,rgba(6,16,31,.985),rgba(7,18,34,.94) 78%,transparent)}
html[data-theme="dark"] .site-header.is-scrolled .header-row{border-color:#29435f;box-shadow:0 16px 46px rgba(0,0,0,.34)}
html[data-theme="dark"] .btn.secondary{color:#abd1ff;border-color:#365f8b;background:linear-gradient(180deg,#122b49,#0f233c);box-shadow:0 6px 17px rgba(0,0,0,.18)}
html[data-theme="dark"] .btn.secondary:hover{color:#fff;background:linear-gradient(135deg,#1b5fbd,#2b7fe1);border-color:#3d7bd1}
html[data-theme="dark"] .btn.ghost{color:#c5d5e8;border-color:#36516e;background:rgba(14,32,54,.90);box-shadow:0 5px 14px rgba(0,0,0,.18)}
html[data-theme="dark"] .btn.ghost:hover{color:#fff;border-color:#5486bc;background:#153252}
html[data-theme="dark"] .btn.danger{color:#ffabb7;border-color:#673947;background:linear-gradient(180deg,#2c1720,#24141b)}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link{color:#c3d2e5;border-color:#2b4665;background:linear-gradient(180deg,#10253f,#0d2036);box-shadow:0 4px 12px rgba(0,0,0,.16),inset 0 1px 0 rgba(255,255,255,.04)}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link:hover{color:#fff;border-color:#4f7fb1;background:linear-gradient(180deg,#17395f,#12304f)}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link.active{color:#fff;border-color:#3c75bd;background:linear-gradient(135deg,#123d7c,#1d62c7 58%,#277bd9)}
html[data-theme="dark"] .footer-panel{border-color:#234765;background:linear-gradient(135deg,rgba(4,16,36,.985),rgba(8,46,92,.97));box-shadow:0 20px 52px rgba(0,0,0,.34)}

/* Touch/tablet/mobile balance. */
@media(max-width:900px){
  .brand-logo-mark{width:55px;height:45px}.footer-main{align-items:flex-start;flex-direction:column}.footer-links{justify-content:flex-start}
}
@media(max-width:620px){
  .brand{gap:8px}.brand-logo-mark{width:49px;height:41px;border-radius:12px;padding:2px}.brand strong{font-size:.94rem}.brand small{font-size:.62rem}
  .main-nav.top-action-bar .nav-link{min-height:38px;padding:8px 11px;border-radius:11px}
  .footer-panel{border-radius:20px}.footer-main{padding:21px 18px}.footer-brand .brand-logo-mark{width:60px;height:49px}.footer-links{gap:6px}.footer-links a{padding:8px 10px;font-size:.71rem}.footer-bottom{padding:12px 18px;align-items:flex-start;flex-direction:column;gap:4px}
}

@media(prefers-reduced-motion:reduce){
  *,*:before,*:after{scroll-behavior:auto!important;animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}
  .btn:hover,.nav-link:hover,.gpcs-signin-btn:hover,.theme-cycle-btn:hover,.paper-link-actions a:hover{transform:none!important}
}

/* Small utility controls also follow the premium interaction system. */
button[data-dismiss],button[data-toggle-password]{
  border:1px solid #cad8eb;background:linear-gradient(180deg,#fff,#f2f7ff);color:#315172;
  border-radius:10px;min-width:34px;min-height:34px;padding:6px 9px;font-weight:850;
  box-shadow:0 4px 12px rgba(23,61,112,.08);transition:.18s ease;
}
button[data-dismiss]:hover,button[data-toggle-password]:hover{transform:translateY(-1px);border-color:#8eb6e9;color:#1459bb;background:#eef6ff;box-shadow:0 8px 18px rgba(37,99,235,.13)}
button[data-dismiss]:active,button[data-toggle-password]:active{transform:scale(.97)}
button[data-dismiss]:focus-visible,button[data-toggle-password]:focus-visible{outline:0;box-shadow:var(--focus-ring)}
html[data-theme="dark"] button[data-dismiss],html[data-theme="dark"] button[data-toggle-password]{background:linear-gradient(180deg,#142b48,#0f223a);border-color:#355372;color:#c7dbf2}
html[data-theme="dark"] button[data-dismiss]:hover,html[data-theme="dark"] button[data-toggle-password]:hover{background:#173454;border-color:#5685b9;color:#fff}

/* ======================================================================
   GPCS Portal v2.2.1 — transparent logo-mark lockup refinement
   Branding + styling only. No routes, content or workflows changed.
   ====================================================================== */
.brand-logo-mark{
  width:62px;height:50px;padding:0;border:0;border-radius:0;overflow:visible;
  background:transparent!important;box-shadow:none!important;display:grid;place-items:center;
}
.brand-logo-mark img{
  width:100%;height:100%;object-fit:contain;display:block;border-radius:0;
  filter:drop-shadow(0 6px 9px rgba(8,35,76,.18));
}
.footer-brand .brand-logo-mark{
  width:76px;height:60px;padding:0;border:0;background:transparent!important;box-shadow:none!important;
}
.footer-brand .brand-logo-mark img{filter:drop-shadow(0 7px 11px rgba(0,0,0,.28))}

/* Slightly richer premium button finish while keeping approved hierarchy. */
.btn.primary,.paper-search-submit,.main-nav.top-action-bar .nav-upload{
  background:linear-gradient(135deg,#092c69 0%,#145bd1 46%,#268cf1 100%);
  box-shadow:0 11px 27px rgba(22,93,210,.24),0 2px 5px rgba(8,32,75,.10),inset 0 1px 0 rgba(255,255,255,.24);
}
.btn.primary:hover,.paper-search-submit:hover,.main-nav.top-action-bar .nav-upload:hover{
  box-shadow:0 16px 34px rgba(22,93,210,.30),0 4px 9px rgba(8,32,75,.12),inset 0 1px 0 rgba(255,255,255,.28);
}
.main-nav.top-action-bar .nav-link{
  box-shadow:0 5px 14px rgba(22,56,105,.07),inset 0 1px 0 rgba(255,255,255,.94);
}
.main-nav.top-action-bar .nav-link:hover{
  box-shadow:0 11px 25px rgba(37,99,235,.15),inset 0 1px 0 rgba(255,255,255,.98);
}
.gpcs-signin-btn{
  box-shadow:0 13px 30px rgba(27,82,177,.24),inset 0 1px 0 rgba(255,255,255,.23);
}

@media(max-width:599px){
  .brand-logo-mark{width:50px;height:41px}
  .footer-brand .brand-logo-mark{width:62px;height:50px}
}

/* ======================================================================
   GPCS Portal v2.2.2 — final premium interaction + branding polish
   Visual-only overrides. Existing structure, routes and workflows stay intact.
   ====================================================================== */
:root{
  --gpcs-gold:#d9ad3f;
  --gpcs-gold-soft:#f2d57d;
  --gpcs-blue:#1767e8;
  --gpcs-blue-deep:#0a347c;
  --gpcs-cyan:#25b7e6;
  --gpcs-control-shadow:0 9px 22px rgba(16,66,145,.13),0 2px 6px rgba(8,30,68,.06);
  --gpcs-control-shadow-hover:0 15px 34px rgba(22,93,210,.23),0 5px 12px rgba(8,30,68,.09);
}

/* Branding — exact logo mark only, never the source mockup/card. */
.brand-logo-mark{width:66px;height:54px;min-width:66px;filter:none}
.brand-logo-mark img{filter:drop-shadow(0 6px 10px rgba(9,48,103,.22));transform:translateZ(0)}
.brand>span:last-child{min-width:0}
.brand strong{font-size:1.11rem;line-height:1.05;letter-spacing:-.032em}
.brand small{margin-top:3px;color:#6d7f99;font-size:.69rem}

/* Header glass panel and brand/navigation separation. */
.header-row{
  min-height:72px;
  border:1px solid rgba(176,197,227,.72);
  background:linear-gradient(135deg,rgba(255,255,255,.94),rgba(244,249,255,.86));
  box-shadow:0 12px 34px rgba(15,48,94,.09),inset 0 1px 0 rgba(255,255,255,.95);
  backdrop-filter:blur(18px) saturate(1.12);
}
.header-row:after{
  content:"";position:absolute;left:24px;right:24px;bottom:-1px;height:1px;pointer-events:none;
  background:linear-gradient(90deg,transparent,rgba(37,99,235,.22) 22%,rgba(217,173,63,.38) 50%,rgba(37,99,235,.22) 78%,transparent);
}
.site-header.is-scrolled .header-row{box-shadow:0 18px 50px rgba(9,38,88,.16),inset 0 1px 0 rgba(255,255,255,.94)}
.topbar-shell{position:relative;margin-top:7px}
.topbar-shell:before,.topbar-shell:after{content:"";position:absolute;top:0;bottom:0;width:22px;z-index:2;pointer-events:none}
.topbar-shell:before{left:0;background:linear-gradient(90deg,rgba(248,250,255,.96),transparent)}
.topbar-shell:after{right:0;background:linear-gradient(270deg,rgba(248,250,255,.96),transparent)}

/* Student-friendly premium navigation — single line remains scrollable. */
.main-nav.top-action-bar{gap:8px;padding:8px 2px 10px;scroll-padding-inline:14px}
.main-nav.top-action-bar .nav-link{
  min-height:42px;padding:9px 15px;border-radius:13px;white-space:nowrap;
  border:1px solid rgba(171,194,226,.76);
  background:linear-gradient(180deg,rgba(255,255,255,.96),rgba(239,246,255,.91));
  color:#2c4566;box-shadow:var(--gpcs-control-shadow),inset 0 1px 0 #fff;
  font-weight:850;letter-spacing:-.012em;
}
.main-nav.top-action-bar .nav-link:before{
  content:"";position:absolute;inset:1px;border-radius:11px;pointer-events:none;opacity:0;
  background:linear-gradient(115deg,transparent 22%,rgba(255,255,255,.76) 48%,transparent 72%);
  transform:translateX(-45%);transition:transform .32s ease,opacity .18s ease;
}
.main-nav.top-action-bar .nav-link:hover:before{opacity:.58;transform:translateX(45%)}
.main-nav.top-action-bar .nav-link:hover{
  transform:translateY(-2px);color:#0f55b8;border-color:#7eaee9;
  background:linear-gradient(180deg,#fff,#eaf4ff);box-shadow:var(--gpcs-control-shadow-hover),inset 0 1px 0 #fff;
}
.main-nav.top-action-bar .nav-link.active{
  color:#fff;border-color:rgba(255,255,255,.17);
  background:linear-gradient(135deg,#092f70 0%,#155fd8 55%,#2a8ef1 100%);
  box-shadow:0 12px 28px rgba(22,93,210,.27),inset 0 1px 0 rgba(255,255,255,.25);
}
.main-nav.top-action-bar .nav-link.active:after{
  content:"";position:absolute;left:18px;right:18px;bottom:4px;height:2px;border-radius:99px;
  background:linear-gradient(90deg,transparent,var(--gpcs-gold-soft),transparent);opacity:.95;
}
.main-nav.top-action-bar .nav-upload{
  padding-inline:13px 15px!important;gap:8px!important;
  background:linear-gradient(135deg,#082e70 0%,#155fd7 47%,#2a90f2 100%)!important;
  box-shadow:0 13px 30px rgba(22,93,210,.29),0 0 0 1px rgba(255,255,255,.06) inset!important;
}
.nav-upload-icon{display:grid!important;place-items:center!important;width:25px!important;height:25px!important;border-radius:8px!important;background:rgba(255,255,255,.14)!important}
.nav-upload-icon svg{width:15px!important;height:15px!important;stroke-width:2.05!important}
.nav-upload-arrow{display:grid;place-items:center;width:21px;height:21px;border-radius:7px;background:rgba(255,255,255,.11);font-size:.9rem}

/* Site-wide premium button hierarchy. */
.btn,.paper-link-actions a,.paper-search-submit,.tab-btn{
  border-radius:13px;box-shadow:var(--gpcs-control-shadow);font-weight:850;
}
.btn.primary,.paper-search-submit{
  background:linear-gradient(135deg,#082f70 0%,#145fd8 47%,#2b91f2 100%);
  border-color:rgba(255,255,255,.18);box-shadow:0 12px 29px rgba(22,93,210,.26),inset 0 1px 0 rgba(255,255,255,.25);
}
.btn.primary:hover,.paper-search-submit:hover{box-shadow:0 17px 36px rgba(22,93,210,.32),inset 0 1px 0 rgba(255,255,255,.28)}
.btn.secondary{border-color:#a9c8ee;background:linear-gradient(180deg,#fff,#eaf4ff);box-shadow:0 8px 20px rgba(29,78,216,.10),inset 0 1px 0 #fff}
.btn.ghost{background:rgba(255,255,255,.87);border-color:#c4d5ea;backdrop-filter:blur(12px);box-shadow:0 7px 17px rgba(15,48,92,.08),inset 0 1px 0 rgba(255,255,255,.95)}
.btn.danger{box-shadow:0 7px 17px rgba(192,58,74,.10),inset 0 1px 0 rgba(255,255,255,.8)}
.btn:hover,.paper-link-actions a:hover,.paper-search-submit:hover,.tab-btn:hover{transform:translateY(-2px) scale(1.018)}
.btn:active,.paper-link-actions a:active,.paper-search-submit:active,.tab-btn:active{transform:translateY(0) scale(.975)}

/* Utility buttons: polished but compact. */
.gpcs-signin-btn{
  border-radius:15px;min-height:46px;
  background:linear-gradient(120deg,#0a347b 0%,#1766dc 52%,#2e8ef0 100%);
  box-shadow:0 14px 32px rgba(26,88,195,.28),inset 0 1px 0 rgba(255,255,255,.24);
}
.gpcs-signin-btn:hover{box-shadow:0 19px 39px rgba(26,88,195,.34),0 0 0 3px rgba(37,99,235,.07),inset 0 1px 0 rgba(255,255,255,.28)}
.signin-icon-shell,.signin-arrow{border:1px solid rgba(255,255,255,.10)}
.theme-cycle-btn{border-radius:15px;background:linear-gradient(145deg,rgba(255,255,255,.96),rgba(235,244,255,.94));border-color:#b8cce9;box-shadow:0 10px 25px rgba(29,78,216,.16),inset 0 1px 0 #fff}
.theme-cycle-btn:hover{box-shadow:0 15px 31px rgba(37,99,235,.22),inset 0 1px 0 #fff}

/* Paper Library: keep reference-style mechanism, improve finish only. */
.paper-data-card{border-color:rgba(159,184,218,.72);box-shadow:0 16px 38px rgba(11,44,92,.10),inset 0 1px 0 rgba(255,255,255,.92)}
.paper-table-toolbar{background:linear-gradient(180deg,rgba(255,255,255,.98),rgba(241,247,255,.96))}
.paper-length-control select,.paper-inline-search input{border-color:#b8cbe6;box-shadow:inset 0 1px 2px rgba(24,61,110,.04),0 4px 12px rgba(20,58,112,.05)}
.paper-length-control select:focus,.paper-inline-search input:focus{border-color:#5a96df;box-shadow:0 0 0 4px rgba(37,99,235,.13)}
.paper-data-table thead th{background:linear-gradient(180deg,#2e78d7,#2368bd);color:#fff;border-color:#1d5fae;text-shadow:0 1px 0 rgba(0,0,0,.08)}
.paper-data-table tbody tr:hover{background:rgba(232,243,255,.78)}
.paper-link-actions a{font-weight:850}

/* Footer — stronger visual ending without inventing content. */
.site-footer:before{height:3px;background:linear-gradient(90deg,transparent,#2b8fe8 18%,#e4b83f 50%,#2ab8df 82%,transparent);box-shadow:0 0 18px rgba(43,143,232,.18)}
.footer-panel{border-radius:27px;background:linear-gradient(135deg,rgba(5,24,57,.985),rgba(8,51,111,.965) 58%,rgba(7,69,126,.96));box-shadow:0 24px 58px rgba(4,22,53,.24),inset 0 1px 0 rgba(255,255,255,.05)}
.footer-main{padding:27px 29px}
.footer-brand .brand-logo-mark{width:82px;height:64px;min-width:82px}
.footer-links a{border-radius:12px;background:rgba(255,255,255,.075);box-shadow:inset 0 1px 0 rgba(255,255,255,.04)}
.footer-links a:hover{transform:translateY(-2px);background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.31);box-shadow:0 9px 20px rgba(0,0,0,.12)}
.footer-bottom span{color:var(--gpcs-gold-soft)}

/* Dark theme — explicit contrast for every upgraded surface. */
html[data-theme="dark"] .header-row{background:linear-gradient(135deg,rgba(8,22,40,.96),rgba(9,31,55,.92));border-color:#284665;box-shadow:0 14px 37px rgba(0,0,0,.28),inset 0 1px 0 rgba(255,255,255,.04)}
html[data-theme="dark"] .header-row:after{background:linear-gradient(90deg,transparent,rgba(73,145,232,.25) 22%,rgba(225,181,70,.30) 50%,rgba(73,145,232,.25) 78%,transparent)}
html[data-theme="dark"] .brand small{color:#9db1c9}
html[data-theme="dark"] .topbar-shell:before{background:linear-gradient(90deg,rgba(5,15,29,.95),transparent)}
html[data-theme="dark"] .topbar-shell:after{background:linear-gradient(270deg,rgba(5,15,29,.95),transparent)}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link{color:#c7d6e7;border-color:#2d4a68;background:linear-gradient(180deg,#102943,#0c2138);box-shadow:0 7px 18px rgba(0,0,0,.20),inset 0 1px 0 rgba(255,255,255,.04)}
html[data-theme="dark"] .main-nav.top-action-bar .nav-link:hover{color:#fff;border-color:#4d83bb;background:linear-gradient(180deg,#173b62,#12314f);box-shadow:0 11px 24px rgba(0,0,0,.26)}
html[data-theme="dark"] .theme-cycle-btn{background:linear-gradient(145deg,#112c4b,#0c2037);border-color:#355372;box-shadow:0 10px 26px rgba(0,0,0,.27),inset 0 1px 0 rgba(255,255,255,.04)}
html[data-theme="dark"] .paper-data-card{border-color:#2e4a67;box-shadow:0 16px 42px rgba(0,0,0,.26)}
html[data-theme="dark"] .paper-table-toolbar{background:linear-gradient(180deg,#102741,#0b1d32)}
html[data-theme="dark"] .paper-data-table tbody tr:hover{background:#12304e}

@media(max-width:900px){
  .brand-logo-mark{width:59px;height:49px;min-width:59px}
  .header-row{min-height:68px}
  .main-nav.top-action-bar .nav-link{padding-inline:13px}
  .footer-brand .brand-logo-mark{width:72px;height:57px;min-width:72px}
}
@media(max-width:599px){
  .header-row{min-height:62px;border-radius:18px;padding-inline:10px}
  .brand-logo-mark{width:50px;height:42px;min-width:50px}
  .brand strong{font-size:.96rem}.brand small{font-size:.60rem;margin-top:2px}
  .main-nav.top-action-bar{gap:7px;padding-bottom:8px}
  .main-nav.top-action-bar .nav-link{min-height:39px;padding:8px 11px;border-radius:11px;font-size:.74rem}
  .main-nav.top-action-bar .nav-upload{padding-inline:9px 11px!important}
  .nav-upload-icon{width:23px!important;height:23px!important}.nav-upload-arrow{width:19px;height:19px}
  .gpcs-signin-btn{min-height:43px;border-radius:14px}
  .theme-cycle-btn{border-radius:14px}
  .footer-panel{border-radius:21px}.footer-main{padding:22px 18px}.footer-brand .brand-logo-mark{width:65px;height:52px;min-width:65px}
}
@media(prefers-reduced-motion:reduce){
  .main-nav.top-action-bar .nav-link:before{display:none!important}
}

/* ======================================================================
   GPCS Portal v2.3.0 — Reference-image visual system
   Very-close home-page composition while preserving all portal logic.
   ====================================================================== */
:root{
  --gold-500:#f4b41a;
  --gold-600:#d99600;
  --royal:#0c5bea;
  --royal-deep:#063eaf;
  --ref-navy:#03285f;
  --ref-navy-2:#061c49;
  --ref-panel:rgba(255,255,255,.94);
  --ref-stroke:rgba(152,184,226,.55);
}
.ui-svg{width:1.15em;height:1.15em;display:block;flex:none}

/* top information ribbon */
.portal-utility-strip{position:relative;z-index:90;background:linear-gradient(105deg,#063471,#0874cf 55%,#073b80);color:#eaf5ff;border-bottom:1px solid rgba(255,255,255,.14);box-shadow:0 8px 24px rgba(4,41,91,.12)}
.portal-utility-inner{min-height:32px;display:flex;align-items:center;gap:13px;font-size:.68rem;font-weight:650;letter-spacing:.01em}
.utility-item{display:inline-flex;align-items:center;gap:6px;white-space:nowrap}.utility-item .ui-svg{width:14px;height:14px;color:#74d9ff}.utility-motto{margin-left:3px}.utility-motto b{font-weight:900;opacity:.72}.utility-divider{width:1px;height:14px;background:rgba(255,255,255,.32)}.utility-spacer{flex:1}.utility-clock{font-variant-numeric:tabular-nums}.utility-socials{display:flex;gap:7px}.utility-socials span{width:23px;height:23px;border-radius:999px;display:grid;place-items:center;background:rgba(255,255,255,.13);border:1px solid rgba(255,255,255,.2);font-size:.61rem;font-weight:900;color:#fff}

/* reference header */
.site-header.reference-header{top:0;padding:0 0 10px;background:transparent;backdrop-filter:none}
.reference-header.is-scrolled{background:linear-gradient(180deg,rgba(242,248,255,.94),rgba(242,248,255,.80) 78%,transparent);backdrop-filter:blur(18px)}
.reference-header-row{min-height:82px;margin-top:0;border-radius:0 0 30px 30px;padding:10px 22px;background:linear-gradient(120deg,rgba(255,255,255,.97),rgba(237,246,255,.93));border:1px solid rgba(182,207,239,.86);border-top:0;box-shadow:0 18px 50px rgba(8,61,128,.15)}
.reference-brand{gap:13px}.reference-brand .brand-logo-mark{width:68px;height:62px;border-radius:0;background:transparent!important;box-shadow:none;overflow:visible;padding:0}.reference-brand .brand-logo-mark:after{display:none}.reference-brand .brand-logo-mark img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 5px 8px rgba(6,46,99,.14))}.reference-brand .brand-copy strong{font-size:1.7rem;line-height:1;color:#0b2e6b;letter-spacing:-.035em}.reference-brand .brand-copy small{font-size:.69rem;color:#173e75;font-weight:750;max-width:none;margin-top:4px}
.reference-header .header-tools{display:flex;align-items:center;gap:9px;margin-left:auto}.reference-theme-btn{width:54px;min-width:54px;height:46px;border-radius:999px;background:linear-gradient(145deg,#fff9e9,#eff6ff);border-color:#d7e5fb;box-shadow:0 8px 20px rgba(16,69,137,.10)}.reference-theme-btn .theme-cycle-label{display:none}.reference-signin{min-height:48px;padding:7px 14px 7px 8px;border-radius:999px;background:linear-gradient(135deg,#063fae,#0667ff 62%,#2a84ff);box-shadow:0 10px 25px rgba(12,91,234,.28),inset 0 1px 0 rgba(255,255,255,.35)}.reference-signin .signin-icon-shell{width:33px;height:33px;border-radius:999px}.reference-signin .signin-icon-shell .ui-svg{width:18px;height:18px}.reference-signin .signin-copy>span{font-size:.76rem}.reference-signin .signin-copy small{font-size:.54rem;letter-spacing:.06em;text-transform:uppercase;opacity:.78}
.gpcs-logout-form{margin:0;display:inline-flex;align-items:center;flex:none}.gpcs-logout-btn{appearance:none;-webkit-appearance:none;min-height:48px;padding:7px 14px 7px 8px;border-radius:999px;display:inline-flex;align-items:center;justify-content:center;gap:8px;border:1px solid #f2cbd1;color:#a92337;background:linear-gradient(180deg,#fff,#fff3f5);box-shadow:0 8px 20px rgba(151,36,55,.11),inset 0 1px 0 rgba(255,255,255,.9);font:inherit;font-size:.76rem;font-weight:900;line-height:1;cursor:pointer;white-space:nowrap;transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease,background .18s ease,color .18s ease}.gpcs-logout-btn .signin-icon-shell{width:33px;height:33px;border-radius:999px;color:#fff;background:linear-gradient(145deg,#d94b5e,#b42338);border-color:rgba(255,255,255,.38);box-shadow:inset 0 1px 0 rgba(255,255,255,.24),0 4px 10px rgba(125,25,44,.17)}.gpcs-logout-btn .signin-icon-shell .ui-svg{width:18px;height:18px}.gpcs-logout-btn:hover{transform:translateY(-2px);color:#fff;border-color:#bc263b;background:linear-gradient(135deg,#bd263b,#961d31);box-shadow:0 12px 26px rgba(151,36,55,.24),inset 0 1px 0 rgba(255,255,255,.16)}.gpcs-logout-btn:active{transform:scale(.98)}.gpcs-logout-btn:focus-visible{outline:3px solid rgba(220,38,67,.28);outline-offset:3px}.logout-label-short{display:none}html[data-theme="dark"] .gpcs-logout-btn{color:#ffb5c0;border-color:#63313b;background:linear-gradient(180deg,#2a1720,#21131a);box-shadow:0 9px 24px rgba(0,0,0,.26),inset 0 1px 0 rgba(255,255,255,.04)}html[data-theme="dark"] .gpcs-logout-btn .signin-icon-shell{background:linear-gradient(145deg,#bd3048,#8f2034);border-color:#70404a}html[data-theme="dark"] .gpcs-logout-btn:hover{color:#fff;border-color:#c7475b;background:linear-gradient(135deg,#b1263e,#7f1d31)}
.reference-nav-shell{margin-top:-2px}.main-nav.reference-nav{position:static!important;display:flex!important;width:100%!important;max-height:none!important;right:auto!important;top:auto!important;grid-template-columns:none!important;flex-wrap:nowrap!important;overflow-x:auto!important;overflow-y:hidden!important;gap:7px;padding:8px 12px;background:rgba(248,252,255,.97);border:1px solid rgba(179,204,236,.82);border-radius:0 0 24px 24px;box-shadow:0 12px 28px rgba(9,62,131,.10);scrollbar-width:none;scroll-snap-type:x proximity}.main-nav.reference-nav::-webkit-scrollbar{display:none}.main-nav.reference-nav .nav-link{min-height:38px;display:inline-flex;align-items:center;gap:7px;flex:0 0 auto;padding:8px 13px;border:1px solid #d8e5f5;border-radius:999px;background:linear-gradient(180deg,#fff,#edf5ff);box-shadow:0 4px 10px rgba(16,68,136,.08);color:#113b78;font-size:.69rem;font-weight:850;white-space:nowrap}.main-nav.reference-nav .nav-link:hover{transform:translateY(-2px);background:linear-gradient(180deg,#fff,#e5f0ff);border-color:#aac8ef;box-shadow:0 8px 18px rgba(16,68,136,.13)}.main-nav.reference-nav .nav-link.active{color:#fff;background:linear-gradient(135deg,#0750d8,#0a73ff);border-color:#2085ff;box-shadow:0 8px 20px rgba(10,103,239,.26),inset 0 1px 0 rgba(255,255,255,.4)}.main-nav.reference-nav .nav-ico{display:grid;place-items:center;width:22px;height:22px;border-radius:999px;color:currentColor}.main-nav.reference-nav .nav-ico .ui-svg{width:15px;height:15px}.main-nav.reference-nav .nav-upload{color:#0b4a92;background:linear-gradient(180deg,#fff,#eaf5ff);border-color:#c8def8;box-shadow:0 5px 14px rgba(13,79,156,.12)}.main-nav.reference-nav .nav-upload:hover,.main-nav.reference-nav .nav-upload.active{color:#fff;background:linear-gradient(135deg,#0752d6,#0a71ff);border-color:#2789ff}.main-nav.reference-nav .nav-external:after{display:none}.main-nav.reference-nav .logout{color:#b33043;background:#fff4f6;border-color:#ffd7de}

/* reference home hero */
.reference-home-hero{padding:10px 0 0;position:relative}
.reference-hero-shell{min-height:325px;position:relative;overflow:hidden;border-radius:28px;background-image:linear-gradient(90deg,rgba(2,37,87,.93) 0%,rgba(2,53,116,.78) 34%,rgba(4,56,117,.16) 64%,rgba(1,35,76,.14)),url("/assets/gpcs-embedded-81b2403e96e1.png");background-size:cover;background-position:center 42%;box-shadow:0 22px 55px rgba(5,54,113,.22);border:1px solid rgba(177,211,247,.7)}
.reference-hero-shell:before{content:"";position:absolute;inset:auto -8% -70px -6%;height:125px;background:linear-gradient(175deg,transparent 0 42%,rgba(14,105,221,.82) 43% 66%,rgba(255,255,255,.96) 67%);transform:rotate(-1deg);pointer-events:none}.reference-hero-shell:after{content:"";position:absolute;inset:0;background:radial-gradient(circle at 62% 8%,rgba(255,255,255,.22),transparent 24%),linear-gradient(180deg,rgba(255,255,255,.03),rgba(0,0,0,.03));pointer-events:none}.reference-hero-content{position:relative;z-index:2;max-width:690px;padding:30px 28px 55px;color:#fff}.reference-welcome-badge{display:inline-flex;align-items:center;gap:9px;padding:7px 13px;border-radius:999px;border:1px solid rgba(128,202,255,.72);background:rgba(3,68,145,.58);backdrop-filter:blur(10px);font-size:.77rem;font-weight:800}.reference-welcome-badge .ui-svg{color:#ffd34d}.reference-hero-content h1{margin:10px 0 2px;font-size:clamp(3rem,5vw,4.6rem);line-height:.95;letter-spacing:-.055em;color:#fff;text-shadow:0 4px 16px rgba(0,25,61,.16)}.reference-hero-content h1 strong{font-weight:900;color:#ffd037}.reference-hero-content h2{margin:0 0 8px;color:#fff;font-size:1.2rem;letter-spacing:-.015em}.reference-hero-content p{margin:0 0 17px;color:#e4f1ff;font-size:.84rem;line-height:1.55}.reference-hero-content p em{color:#fff;font-weight:600}.reference-hero-actions{display:flex;align-items:center;gap:12px;flex-wrap:wrap}.reference-cta{min-height:45px;display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:10px 17px;border-radius:999px;font-size:.82rem;font-weight:850;color:#fff;border:1px solid rgba(255,255,255,.66);background:rgba(7,50,107,.52);box-shadow:inset 0 1px 0 rgba(255,255,255,.15);backdrop-filter:blur(10px);transition:.2s}.reference-cta:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,30,77,.22),inset 0 1px 0 rgba(255,255,255,.22)}.reference-cta-primary{padding-inline:20px;background:linear-gradient(135deg,#0451da,#0b75ff);border-color:#70c6ff;box-shadow:0 0 0 3px rgba(38,139,255,.25),0 10px 26px rgba(0,63,165,.34)}.reference-cta b{font-size:1.05rem}.reference-quote-card{position:absolute;z-index:3;right:24px;top:65px;width:min(260px,27%);padding:22px;border-radius:22px;color:#fff;background:linear-gradient(145deg,rgba(8,64,139,.91),rgba(5,106,202,.78));border:1px solid rgba(125,215,255,.72);box-shadow:0 18px 38px rgba(1,35,89,.28);backdrop-filter:blur(13px)}.quote-mark{display:block;color:#ffd03a;font:900 3rem/1 Georgia,serif;height:30px}.reference-quote-card p{margin:6px 0 12px;font-size:.94rem;line-height:1.55}.reference-quote-card small{display:block;text-align:right;color:#d9efff;font-size:.65rem}

/* stats */
.reference-stat-wrap{position:relative;z-index:5;margin-top:-5px}.reference-stat-strip{display:grid;grid-template-columns:repeat(5,1fr);padding:8px 14px;border-radius:20px;background:rgba(255,255,255,.96);border:1px solid #cfe2f6;box-shadow:0 12px 30px rgba(4,58,125,.15);backdrop-filter:blur(14px)}.reference-stat-item{display:flex;align-items:center;justify-content:center;gap:12px;min-height:67px;padding:8px 16px;border-right:1px solid #bcd2ec}.reference-stat-item:last-child{border-right:0}.reference-stat-item .stat-icon{width:44px;height:44px;border-radius:999px;display:grid;place-items:center;color:#fff;box-shadow:0 8px 18px rgba(7,50,110,.18)}.reference-stat-item .stat-icon .ui-svg{width:22px;height:22px}.reference-stat-item strong,.reference-stat-item small{display:block}.reference-stat-item strong{font-size:1.2rem;color:#073887;letter-spacing:-.03em;line-height:1.05}.reference-stat-item small{color:#436793;font-size:.66rem;margin-top:3px}.stat-blue .stat-icon{background:linear-gradient(145deg,#0754de,#0d7cff)}.stat-green .stat-icon{background:linear-gradient(145deg,#087e45,#17b860)}.stat-orange .stat-icon{background:linear-gradient(145deg,#f36b00,#ff9d18)}.stat-purple .stat-icon{background:linear-gradient(145deg,#6b18df,#a42cff)}.stat-cyan .stat-icon{background:linear-gradient(145deg,#0c91ad,#16c0d8)}

/* reference three-column dashboard */
.reference-dashboard-section{padding:13px 0 18px}.reference-dashboard-grid{display:grid;grid-template-columns:1.16fr 1fr .9fr;gap:12px}.reference-panel{min-width:0;border:1px solid #cbdcf0;border-radius:18px;background:rgba(255,255,255,.95);box-shadow:0 10px 28px rgba(4,53,110,.11);padding:12px;backdrop-filter:blur(12px)}.reference-panel-head{display:flex;align-items:center;gap:9px;min-height:38px;margin-bottom:9px}.reference-panel-head>div{min-width:0}.reference-panel-head h2{font-size:1rem;margin:0;color:#0849b0;letter-spacing:-.025em}.reference-panel-head p{font-size:.61rem;color:#5e7ba5;margin:1px 0 0}.panel-icon{width:34px;height:34px;border-radius:11px;display:grid;place-items:center}.panel-icon .ui-svg{width:21px;height:21px}.panel-icon.rocket{color:#ff9a00;background:#fff4d6}.panel-icon.bell{color:#ff9a00;background:#fff4db}.panel-icon.link{color:#0874d7;background:#e5f5ff}.panel-view-all{margin-left:auto;padding:5px 10px;border-radius:999px;border:1px solid #c6daf4;color:#1554ac;background:#f7fbff;font-size:.6rem;font-weight:850}
.reference-quick-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}.reference-quick-card{min-width:0;min-height:76px;display:flex;align-items:center;gap:8px;padding:10px;border-radius:13px;border:1px solid rgba(164,190,226,.55);transition:.2s;position:relative;overflow:hidden}.reference-quick-card:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(10,68,137,.12)}.reference-quick-card>span{width:36px;height:36px;display:grid;place-items:center;border-radius:999px;color:#fff;flex:none}.reference-quick-card>span .ui-svg{width:19px;height:19px}.reference-quick-card>div{min-width:0}.reference-quick-card b,.reference-quick-card small{display:block}.reference-quick-card b{font-size:.66rem;color:#073a83}.reference-quick-card small{font-size:.54rem;color:#54749f;margin-top:2px}.reference-quick-card i{margin-left:auto;font-style:normal;font-size:.85rem;font-weight:900}.quick-blue{background:linear-gradient(135deg,#f1f8ff,#dff1ff)}.quick-blue>span{background:#0962e7}.quick-teal{background:linear-gradient(135deg,#f1fffb,#dff8f4)}.quick-teal>span{background:#119f9a}.quick-purple{background:linear-gradient(135deg,#faf5ff,#f0ddff)}.quick-purple>span{background:#7a22e7}.quick-red{background:linear-gradient(135deg,#fff5f4,#ffe7df)}.quick-red>span{background:#ff334d}.quick-green{background:linear-gradient(135deg,#f3fff9,#dff8ea)}.quick-green>span{background:#159f7f}.quick-gold{background:linear-gradient(135deg,#fffaf0,#ffefca)}.quick-gold>span{background:#ef8c09}.quick-violet{background:linear-gradient(135deg,#f8f5ff,#eee5ff)}.quick-violet>span{background:#7430dc}.quick-pink{background:linear-gradient(135deg,#fff5ff,#f7ddfa)}.quick-pink>span{background:#aa2be0}.quick-sky{background:linear-gradient(135deg,#f1f9ff,#dff1ff)}.quick-sky>span{background:#0d6fcf}
.reference-update-list,.reference-important-list{display:grid;gap:6px}.reference-update-item{min-height:49px;display:flex;align-items:center;gap:8px;padding:6px 8px;border:1px solid #d5e1ef;border-radius:11px;background:linear-gradient(180deg,#fff,#f9fbff)}.update-icon{width:31px;height:31px;border-radius:9px;display:grid;place-items:center;color:#0a68d9;background:#e5f3ff}.update-icon .ui-svg{width:17px;height:17px}.reference-update-item>div{min-width:0;flex:1}.reference-update-item b,.reference-update-item small{display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.reference-update-item b{font-size:.64rem;color:#0848a8}.reference-update-item small{font-size:.55rem;color:#516f99;margin-top:1px}.reference-update-item time{max-width:92px;text-align:right;font-size:.5rem;color:#6d83a3}.reference-update-empty{min-height:245px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;color:#6b83a5}.reference-update-empty>span{width:46px;height:46px;border-radius:999px;display:grid;place-items:center;background:#eff6ff;color:#2d72ce}.reference-update-empty strong{font-size:.78rem;color:#274c80;margin-top:8px}.reference-update-empty small{font-size:.58rem;max-width:220px;margin-top:3px}
.important-card{min-height:53px;display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:12px;border:1px solid #cddff0;transition:.2s}.important-card:hover{transform:translateX(2px);box-shadow:0 6px 14px rgba(6,64,131,.09)}.important-card>span{width:34px;height:34px;display:grid;place-items:center;border-radius:999px;color:#fff;flex:none}.important-card>span .ui-svg{width:18px;height:18px}.important-card>div{min-width:0;flex:1}.important-card b,.important-card small{display:block}.important-card b{font-size:.66rem;color:#073b84}.important-card small{font-size:.55rem;color:#5a759b}.important-card i{font-style:normal;color:#1768c6}.important-card i .ui-svg{width:15px;height:15px}.important-blue{background:linear-gradient(135deg,#f3f9ff,#e3f2ff)}.important-blue>span{background:#0861db}.important-green{background:linear-gradient(135deg,#f4fff9,#e2f7eb)}.important-green>span{background:#168d4c}.important-orange{background:linear-gradient(135deg,#fff9f1,#ffebd7)}.important-orange>span{background:#f47b0a}.important-purple{background:linear-gradient(135deg,#faf6ff,#eee2ff)}.important-purple>span{background:#7824e8}

/* internal pages inherit reference premium language */
.page-hero{margin-top:5px;border-radius:0 0 28px 28px;box-shadow:0 12px 30px rgba(7,55,119,.08)}
.page-hero.compact{background:linear-gradient(135deg,rgba(241,248,255,.94),rgba(255,255,255,.88));border-bottom:1px solid #cddff2}.paper-data-card,.auth-card,.admin-card,.contact-card,.note-card,.gallery-card,.upload-form{border-color:#c8dbef!important;box-shadow:0 12px 32px rgba(5,57,121,.10)!important}.btn{border-radius:999px!important}.btn.primary{background:linear-gradient(135deg,#0750d3,#0c74ff)!important;box-shadow:0 8px 22px rgba(12,91,234,.23)!important}.btn.secondary{background:linear-gradient(180deg,#f8fbff,#e7f2ff)!important;border-color:#c6dcf7!important}.btn.ghost{background:rgba(255,255,255,.88)!important;border-color:#d2e0ef!important}

/* reference footer */
.site-footer.reference-footer{position:relative;margin-top:12px;padding:0 0 0;background:linear-gradient(135deg,#062a62,#034db0 55%,#05265b);border-top:4px solid #e9ae18;color:#eaf4ff;box-shadow:0 -12px 34px rgba(4,47,104,.16)}.reference-footer:before{content:"";position:absolute;left:0;right:0;top:-8px;height:8px;background:linear-gradient(90deg,#f6c43a,#0e96ff,#f6c43a)}.reference-footer-shell{padding:18px 18px 8px}.reference-footer-grid{display:grid;grid-template-columns:1.05fr 1.35fr .72fr .7fr;gap:22px;align-items:center}.reference-footer-brand .footer-brand{gap:11px}.reference-footer-brand .brand-logo-mark{width:74px;height:62px;background:transparent!important;border-radius:0;box-shadow:none}.reference-footer-brand .brand-logo-mark:after{display:none}.reference-footer-brand .brand-logo-mark img{width:100%;height:100%;object-fit:contain}.reference-footer-brand strong{font-size:1.25rem;color:#fff}.reference-footer-brand small{font-size:.62rem;color:#cfe5ff}.reference-footer-brand>p{margin:7px 0 0 83px;font-size:.58rem;line-height:1.45;color:#ffd75d;font-weight:750}.reference-footer h3{font-size:.72rem;color:#fff;margin:0 0 8px}.footer-link-columns{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}.footer-link-columns div{display:grid;gap:4px}.footer-link-columns a{font-size:.57rem;color:#d4e8ff;transition:.18s}.footer-link-columns a:hover{color:#fff;transform:translateX(2px)}.footer-social-row{display:flex;gap:7px;align-items:center}.footer-social-row>*{width:34px;height:34px;border-radius:999px;display:grid;place-items:center;color:#fff;font-weight:900;border:1px solid rgba(255,255,255,.2);box-shadow:0 5px 14px rgba(0,0,0,.12)}.footer-contact-link{display:inline-block;margin-top:8px;font-size:.58rem;font-weight:800;color:#7edcff}.reference-footer-qr{display:flex;align-items:center;gap:9px;padding:8px;border-radius:12px;background:linear-gradient(135deg,#0a4fa3,#0a68c8);border:1px solid rgba(127,210,255,.42);box-shadow:inset 0 1px 0 rgba(255,255,255,.15)}.reference-footer-qr>div{min-width:0}.reference-footer-qr strong,.reference-footer-qr small{display:block}.reference-footer-qr strong{font-size:.62rem;color:#fff}.reference-footer-qr small{font-size:.51rem;color:#cde7ff;margin-top:2px}.reference-footer-qr img{width:62px;height:62px;background:#fff;border-radius:5px;padding:3px;flex:none}.reference-footer-bottom{margin-top:14px;padding-top:8px;border-top:1px solid rgba(255,255,255,.17);display:flex;align-items:center;justify-content:space-between;gap:16px}.reference-footer-bottom p{margin:0;color:#bed8f5;font-size:.52rem}.reference-footer-bottom span{margin:0 7px;color:#57b9ff}.reference-back-top{position:absolute;right:24px;bottom:24px;width:38px;height:38px;border-radius:999px;display:grid;place-items:center;color:#fff;background:linear-gradient(145deg,#0a67e4,#0d8bff);border:1px solid #7bc7ff;box-shadow:0 8px 18px rgba(0,38,100,.25);font-size:1rem;font-weight:900}

/* video placeholder simple student-facing modal effect via native dialog-like toast */
.reference-video-btn{cursor:pointer}

/* dark theme */
html[data-theme="dark"] .portal-utility-strip{background:linear-gradient(105deg,#03172e,#073c77 58%,#041c38)}
html[data-theme="dark"] .reference-header-row,html[data-theme="dark"] .main-nav.reference-nav{background:rgba(8,21,39,.96);border-color:#29445f;box-shadow:0 16px 45px rgba(0,0,0,.3)}html[data-theme="dark"] .reference-brand .brand-copy strong{color:#f0f6ff}html[data-theme="dark"] .reference-brand .brand-copy small{color:#9cb8d7}html[data-theme="dark"] .main-nav.reference-nav .nav-link{background:linear-gradient(180deg,#10233d,#0c1b31);border-color:#284662;color:#b9d3f2}html[data-theme="dark"] .main-nav.reference-nav .nav-link:hover{background:#15304f;border-color:#3d6489;color:#e8f5ff}html[data-theme="dark"] .main-nav.reference-nav .nav-link.active,html[data-theme="dark"] .main-nav.reference-nav .nav-upload:hover{background:linear-gradient(135deg,#0b4aba,#0b72ef);color:#fff;border-color:#288eff}.reference-theme-btn:focus-visible,.reference-signin:focus-visible,.reference-cta:focus-visible,.reference-quick-card:focus-visible,.important-card:focus-visible{outline:3px solid #69b9ff;outline-offset:3px}
html[data-theme="dark"] .reference-stat-strip,html[data-theme="dark"] .reference-panel{background:rgba(9,24,43,.94);border-color:#2a4968}html[data-theme="dark"] .reference-stat-item{border-color:#284561}html[data-theme="dark"] .reference-stat-item strong{color:#e4f1ff}html[data-theme="dark"] .reference-stat-item small{color:#94b3d5}html[data-theme="dark"] .reference-panel-head h2{color:#80b8ff}html[data-theme="dark"] .reference-panel-head p{color:#91aac8}html[data-theme="dark"] .reference-quick-card,html[data-theme="dark"] .important-card,html[data-theme="dark"] .reference-update-item{background:#0c1d33;border-color:#294965}html[data-theme="dark"] .reference-quick-card b,html[data-theme="dark"] .important-card b,html[data-theme="dark"] .reference-update-item b{color:#d9eaff}html[data-theme="dark"] .reference-quick-card small,html[data-theme="dark"] .important-card small,html[data-theme="dark"] .reference-update-item small,html[data-theme="dark"] .reference-update-item time{color:#91abc9}html[data-theme="dark"] .reference-update-empty{color:#9bb3d0}html[data-theme="dark"] .reference-update-empty strong{color:#dcecff}

/* Responsive: preserve the reference composition while remaining student friendly */
@media(max-width:1100px){
  .reference-dashboard-grid{grid-template-columns:1fr 1fr}.important-panel{grid-column:1/-1}.reference-important-list{grid-template-columns:repeat(4,1fr)}.reference-hero-content{max-width:64%}.reference-quote-card{width:29%;right:18px}.reference-footer-grid{grid-template-columns:1fr 1.35fr .9fr}.reference-footer-qr{grid-column:1/-1;justify-self:end;width:250px}
}
@media(max-width:820px){
  .portal-utility-inner{min-height:29px;font-size:.61rem}.utility-motto{display:none}.utility-socials{display:none}.reference-header-row{min-height:70px;padding:8px 12px;border-radius:0 0 22px 22px}.reference-brand .brand-logo-mark{width:53px;height:51px}.reference-brand .brand-copy strong{font-size:1.2rem}.reference-brand .brand-copy small{font-size:.58rem;max-width:225px}.reference-nav-shell{width:min(calc(100% - 20px),var(--max))}.main-nav.reference-nav{border-radius:0 0 18px 18px;padding:7px}.main-nav.reference-nav .nav-link{min-height:37px;padding:7px 11px;font-size:.65rem}.reference-hero-shell{min-height:390px;background-position:center 45%}.reference-hero-shell:before{display:none}.reference-hero-content{max-width:72%;padding:26px 20px 30px}.reference-quote-card{top:auto;right:16px;bottom:18px;width:32%;padding:15px}.reference-quote-card p{font-size:.75rem}.reference-stat-strip{grid-template-columns:repeat(5,minmax(140px,1fr));overflow-x:auto;scrollbar-width:none}.reference-stat-strip::-webkit-scrollbar{display:none}.reference-stat-item{min-width:140px}.reference-dashboard-grid{grid-template-columns:1fr}.important-panel{grid-column:auto}.reference-important-list{grid-template-columns:repeat(2,1fr)}.reference-footer-grid{grid-template-columns:1fr 1fr}.reference-footer-connect,.reference-footer-qr{grid-column:auto}.reference-footer-qr{justify-self:stretch;width:auto}.reference-footer-bottom{align-items:flex-start;flex-direction:column}
}
@media(max-width:560px){
  .portal-utility-inner{gap:6px}.utility-divider{display:none}.utility-clock{font-size:.55rem}.reference-header-row{min-height:61px;gap:6px;padding:6px 8px}.reference-brand{gap:7px}.reference-brand .brand-logo-mark{width:42px;height:42px}.reference-brand .brand-copy strong{font-size:.94rem}.reference-brand .brand-copy small{font-size:.48rem;max-width:150px}.reference-header .header-tools{gap:5px}.reference-theme-btn{width:40px;min-width:40px;height:40px}.reference-signin{min-height:40px;padding:5px 8px 5px 5px}.reference-signin .signin-icon-shell{width:29px;height:29px}.reference-signin .signin-copy small{display:none}.reference-signin .signin-copy>span{font-size:.61rem}.reference-signin .signin-arrow{display:none}.reference-nav-shell{width:100%}.main-nav.reference-nav{border-radius:0;padding:6px 8px}.main-nav.reference-nav .nav-link{min-height:35px;padding:7px 9px;font-size:.6rem}.main-nav.reference-nav .nav-ico{width:18px;height:18px}.main-nav.reference-nav .nav-ico .ui-svg{width:13px;height:13px}.reference-home-hero{padding-top:4px}.reference-hero-shell{width:100%;min-height:465px;border-radius:0;background-position:58% center}.reference-hero-content{max-width:100%;padding:25px 16px 20px;background:linear-gradient(90deg,rgba(3,43,99,.94),rgba(3,59,128,.78) 70%,transparent)}.reference-hero-content h1{font-size:2.9rem}.reference-hero-content h2{font-size:1rem}.reference-hero-content p{font-size:.75rem}.reference-hero-actions{gap:8px}.reference-cta{min-height:40px;padding:8px 12px;font-size:.7rem}.reference-quote-card{left:16px;right:16px;bottom:15px;width:auto;padding:13px}.quote-mark{font-size:2.2rem;height:22px}.reference-quote-card p{font-size:.7rem;margin:3px 0 6px}.reference-stat-wrap{margin-top:0}.reference-stat-strip{width:100%;border-radius:0;padding:6px 8px}.reference-stat-item{min-height:62px;padding:7px 10px}.reference-stat-item .stat-icon{width:38px;height:38px}.reference-stat-item strong{font-size:1rem}.reference-dashboard-section{padding-top:9px}.reference-dashboard-grid{width:min(calc(100% - 14px),var(--max));gap:9px}.reference-panel{padding:10px;border-radius:15px}.reference-quick-grid{grid-template-columns:repeat(2,1fr)}.reference-quick-card{min-height:69px;padding:8px}.reference-important-list{grid-template-columns:1fr}.reference-update-item time{display:none}.reference-footer-shell{padding:15px 10px 8px}.reference-footer-grid{grid-template-columns:1fr}.reference-footer-brand>p{margin-left:0}.footer-link-columns{grid-template-columns:repeat(2,1fr)}.reference-footer-qr{max-width:280px}.reference-back-top{right:12px;bottom:12px}
}
@media(prefers-reduced-motion:reduce){.reference-cta,.reference-quick-card,.important-card,.main-nav.reference-nav .nav-link{transition:none!important}.reference-cta:hover,.reference-quick-card:hover,.important-card:hover,.main-nav.reference-nav .nav-link:hover{transform:none!important}}

/* ======================================================================
   v2.3.1-dev — REFERENCE-LOCK HOME REBUILD
   Primary visual target: user-approved 1536×1024 reference screenshot.
   Backend, routes and data logic remain unchanged.
   ====================================================================== */

body.page-home{
  background:#edf6ff!important;
  background-image:none!important;
}
body.page-home:before,.page-home .bg-orb{display:none!important}
.page-home main{background:#eef7ff}
.page-home .container{width:min(calc(100% - 64px),1434px)}

/* 32px utility ribbon, like the reference image */
.page-home .portal-utility-strip{
  height:32px;min-height:32px;
  background:linear-gradient(110deg,#04377d 0%,#0878cf 55%,#074489 100%);
  border:0;box-shadow:none;
}
.page-home .portal-utility-inner{
  min-height:32px;height:32px;padding-inline:8px;
  font-size:12px;font-weight:650;letter-spacing:.005em;
}
.page-home .utility-item .ui-svg{width:14px;height:14px}
.page-home .utility-socials{gap:8px;margin-left:10px}
.page-home .utility-socials span{
  width:26px;height:26px;border-radius:999px;display:grid;place-items:center;
  color:#fff;border:1px solid rgba(255,255,255,.25);font-size:11px;
  box-shadow:0 4px 12px rgba(0,0,0,.12)
}
.page-home .utility-socials span:nth-child(1){background:#f52232}
.page-home .utility-socials span:nth-child(2){background:linear-gradient(135deg,#7c3aed,#f72585,#ff9a00)}
.page-home .utility-socials span:nth-child(3){background:#149bd7}

/* One large rounded header shell instead of separate floating cards */
.page-home .site-header.reference-header{
  position:relative;top:auto;z-index:80;
  width:calc(100% - 36px);margin:0 18px;
  padding:0 0 8px;
  background:linear-gradient(180deg,rgba(255,255,255,.985),rgba(242,248,255,.985));
  border:1px solid rgba(170,198,233,.72);
  border-top:0;
  border-radius:0 0 34px 34px;
  box-shadow:0 12px 34px rgba(14,70,141,.16),inset 0 1px 0 rgba(255,255,255,.92);
  backdrop-filter:blur(20px);
}
.page-home .reference-header-row{
  width:min(calc(100% - 48px),1400px);min-height:78px;margin:auto;
  padding:8px 12px 3px;
  background:transparent!important;border:0!important;border-radius:0!important;
  box-shadow:none!important;backdrop-filter:none!important;
}
.page-home .reference-brand{gap:13px}
.page-home .reference-brand .brand-logo-mark{
  width:72px;height:64px;min-width:72px;border-radius:0!important;
  background:transparent!important;box-shadow:none!important;overflow:visible!important;
}
.page-home .reference-brand .brand-logo-mark:after{display:none!important}
.page-home .reference-brand .brand-logo-mark img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 7px 9px rgba(0,32,75,.17))}
.page-home .reference-brand .brand-copy strong{
  color:#07275f;font-size:2rem;line-height:.98;letter-spacing:-.045em;font-weight:900;
}
.page-home .reference-brand .brand-copy small{
  margin-top:5px;color:#17396b;font-size:.72rem;font-weight:800;max-width:none;
}
.page-home .reference-header .header-tools{gap:10px}
.page-home .reference-theme-btn{
  width:138px;min-width:138px;height:44px;border-radius:999px;padding:4px 8px;
  background:linear-gradient(180deg,#fff,#edf5ff);border:1px solid #b9d0ef;
  box-shadow:0 7px 18px rgba(27,83,171,.13),inset 0 1px 0 #fff;
}
.page-home .reference-theme-btn .theme-cycle-label{font-size:.68rem;font-weight:850;color:#315681}
.page-home .reference-signin{
  min-height:46px;padding:5px 12px 5px 6px;border-radius:999px;
  background:linear-gradient(135deg,#103c8e 0%,#115fda 54%,#1688ff 100%);
  border:1px solid rgba(255,255,255,.38);
  box-shadow:0 10px 24px rgba(22,96,214,.3),0 0 0 3px rgba(30,117,238,.08);
}
.page-home .reference-signin .signin-icon-shell{width:34px;height:34px;border-radius:999px;background:rgba(255,255,255,.16)}
.page-home .reference-signin .signin-copy>span{font-size:.74rem}.page-home .reference-signin .signin-copy small{font-size:.48rem}

/* navigation lives inside the same white shell */
.page-home .reference-nav-shell{width:min(calc(100% - 80px),1374px);margin:auto}
.page-home .main-nav.reference-nav{
  position:static!important;display:flex!important;grid-template-columns:none!important;
  width:100%!important;max-height:none!important;overflow-x:auto;overflow-y:hidden;
  gap:8px;padding:2px 0 0!important;
  background:transparent!important;border:0!important;border-radius:0!important;
  box-shadow:none!important;backdrop-filter:none!important;scrollbar-width:none;
}
.page-home .main-nav.reference-nav::-webkit-scrollbar{display:none}
.page-home .main-nav.reference-nav .nav-link{
  min-height:37px;padding:7px 13px;border-radius:999px;gap:7px;
  font-size:.72rem;line-height:1;font-weight:850;letter-spacing:-.012em;
  color:#143a6f;background:linear-gradient(180deg,#fff,#edf5ff);
  border:1px solid #bfd2ec;
  box-shadow:0 5px 12px rgba(15,61,128,.08),inset 0 1px 0 #fff;
  flex:0 0 auto;
}
.page-home .main-nav.reference-nav .nav-link:before,.page-home .main-nav.reference-nav .nav-link.active:after{display:none!important}
.page-home .main-nav.reference-nav .nav-link:hover{transform:translateY(-1px);background:#fff;border-color:#8db4e8;color:#0e55c0;box-shadow:0 8px 16px rgba(17,76,158,.14)}
.page-home .main-nav.reference-nav .nav-link.active{
  color:#fff;background:linear-gradient(135deg,#0748bd,#0c6cf0 56%,#1d8eff);border-color:#4da3ff;
  box-shadow:0 9px 20px rgba(20,99,223,.28),inset 0 1px 0 rgba(255,255,255,.32);
}
.page-home .main-nav.reference-nav .nav-upload{
  color:#17437a!important;background:linear-gradient(180deg,#fff,#edf5ff)!important;
  border-color:#bfd2ec!important;box-shadow:0 5px 12px rgba(15,61,128,.08),inset 0 1px 0 #fff!important;
}
.page-home .main-nav.reference-nav .nav-upload:hover{color:#fff!important;background:linear-gradient(135deg,#0756ce,#1483ff)!important;border-color:#3c9cff!important}
.page-home .main-nav.reference-nav .nav-upload-arrow{display:none}
.page-home .main-nav.reference-nav .nav-ico{width:19px;height:19px;border-radius:7px;display:grid;place-items:center;color:currentColor;background:transparent}
.page-home .main-nav.reference-nav .nav-ico .ui-svg{width:15px;height:15px}

/* HERO: exact reference proportions at 1536 wide */
.page-home .reference-home-hero{padding:14px 0 0;background:transparent}
.page-home .reference-hero-shell{
  width:min(calc(100% - 64px),1434px);height:300px;min-height:300px;
  margin:auto;border-radius:30px;overflow:hidden;
  background-image:
    linear-gradient(90deg,rgba(1,35,84,.94) 0%,rgba(3,57,122,.85) 28%,rgba(3,61,129,.36) 52%,rgba(0,25,60,.05) 74%),
    url("/assets/gpcs-embedded-81b2403e96e1.png");
  background-size:cover;background-position:center 30%;
  border:1px solid rgba(146,199,247,.78);
  box-shadow:0 18px 42px rgba(4,54,116,.23),inset 0 0 0 1px rgba(255,255,255,.13);
}
.page-home .reference-hero-shell:before{
  content:"";position:absolute;inset:auto 0 0 0;height:36px;z-index:2;pointer-events:none;
  background:linear-gradient(176deg,transparent 0 43%,rgba(32,147,255,.94) 44% 54%,rgba(255,203,48,.98) 55% 61%,#eef7ff 62% 100%);
  clip-path:polygon(0 54%,20% 90%,48% 69%,76% 94%,100% 49%,100% 100%,0 100%);
}
.page-home .reference-hero-shell:after{
  content:"";position:absolute;inset:0;pointer-events:none;z-index:1;
  background:radial-gradient(circle at 42% 18%,rgba(98,197,255,.18),transparent 28%),linear-gradient(180deg,rgba(255,255,255,.02),rgba(0,0,0,.08));
}
.page-home .reference-hero-overlay{display:none}
.page-home .reference-hero-content{
  position:relative;z-index:3;max-width:58%;height:100%;
  padding:24px 28px 42px 30px;display:flex;flex-direction:column;justify-content:center;
  background:transparent;
}
.page-home .reference-welcome-badge{
  width:max-content;margin-bottom:8px;padding:7px 13px;border-radius:999px;
  color:#fff;background:linear-gradient(135deg,rgba(13,72,151,.76),rgba(24,107,204,.58));
  border:1px solid rgba(133,205,255,.7);box-shadow:inset 0 1px 0 rgba(255,255,255,.12);
  font-size:.72rem;font-weight:800;
}
.page-home .reference-welcome-badge .ui-svg{color:#ffd33d;width:20px;height:20px}
.page-home .reference-hero-content h1{
  margin:0;font-size:4rem;line-height:.91;letter-spacing:-.055em;color:#fff;font-weight:950;text-shadow:0 5px 18px rgba(0,26,76,.26)
}
.page-home .reference-hero-content h1 span{color:#fff}.page-home .reference-hero-content h1 strong{color:#ffd541;font-weight:950}
.page-home .reference-hero-content h2{
  margin:6px 0 4px;color:#fff;font-size:1.32rem;line-height:1.1;letter-spacing:-.02em;font-weight:850;text-shadow:0 2px 8px rgba(0,20,60,.2)
}
.page-home .reference-hero-content p{margin:4px 0 15px;color:#edf7ff;font-size:.82rem;line-height:1.5;max-width:590px}.page-home .reference-hero-content p em{color:#cce8ff}
.page-home .reference-hero-actions{display:flex;gap:12px;align-items:center;flex-wrap:nowrap}
.page-home .reference-cta{
  min-height:45px;padding:9px 19px;border-radius:999px;font-size:.76rem;font-weight:850;
  transition:.18s;border:1px solid rgba(190,225,255,.88);box-shadow:0 8px 20px rgba(0,42,105,.24);backdrop-filter:blur(8px)
}
.page-home .reference-cta .ui-svg{width:19px;height:19px}
.page-home .reference-cta-primary{background:linear-gradient(135deg,#0d58e5,#0b7af9);color:#fff;border-color:#81c7ff;box-shadow:0 0 0 3px rgba(63,176,255,.14),0 10px 25px rgba(3,64,157,.36)}
.page-home .reference-cta-outline{background:rgba(5,42,91,.54);color:#fff}
.page-home .reference-cta:hover{transform:translateY(-2px);box-shadow:0 13px 28px rgba(0,42,105,.31)}
.page-home .reference-quote-card{
  z-index:4;top:72px;right:20px;bottom:auto;width:250px;padding:18px 20px 17px;border-radius:24px;
  color:#fff;background:linear-gradient(145deg,rgba(7,55,123,.92),rgba(19,122,207,.82));
  border:1px solid rgba(107,206,255,.72);box-shadow:0 15px 32px rgba(0,48,112,.30),inset 0 1px 0 rgba(255,255,255,.14);backdrop-filter:blur(13px)
}
.page-home .quote-mark{color:#ffd23f;font-size:3.1rem;height:34px;line-height:.8;font-weight:900}
.page-home .reference-quote-card p{margin:6px 0 13px;color:#fff;font-size:.82rem;line-height:1.6}.page-home .reference-quote-card small{display:block;text-align:right;color:#deefff;font-size:.66rem}

/* Floating stats strip */
.page-home .reference-stat-wrap{position:relative;z-index:6;margin:-5px 0 0;background:transparent}
.page-home .reference-stat-strip{
  width:min(calc(100% - 108px),1384px);margin:auto;min-height:77px;padding:7px 18px;
  grid-template-columns:repeat(5,1fr);gap:0;
  background:linear-gradient(180deg,rgba(255,255,255,.985),rgba(245,251,255,.97));
  border:1px solid #c7dcef;border-radius:22px;
  box-shadow:0 11px 25px rgba(16,69,137,.13),inset 0 1px 0 #fff;
}
.page-home .reference-stat-item{min-height:62px;padding:6px 24px;gap:13px;border-right:1px solid #b8cee9;justify-content:center}
.page-home .reference-stat-item:last-child{border-right:0}
.page-home .reference-stat-item .stat-icon{width:47px;height:47px;border-radius:999px;color:#fff;box-shadow:0 8px 18px rgba(15,74,170,.16)}
.page-home .reference-stat-item .stat-icon .ui-svg{width:23px;height:23px}
.page-home .stat-blue .stat-icon{background:linear-gradient(145deg,#1462ef,#0754cc)}
.page-home .stat-green .stat-icon{background:linear-gradient(145deg,#16a24a,#087b36)}
.page-home .stat-orange .stat-icon{background:linear-gradient(145deg,#ff8c12,#f45c0a)}
.page-home .stat-purple .stat-icon{background:linear-gradient(145deg,#a923f2,#6b12d4)}
.page-home .stat-cyan .stat-icon{background:linear-gradient(145deg,#17b8cc,#0b8fa9)}
.page-home .reference-stat-item strong{font-size:1.18rem;line-height:1;color:#0a3a87;font-weight:950;letter-spacing:-.035em}.page-home .reference-stat-item small{margin-top:5px;font-size:.61rem;color:#52709b;font-weight:700}

/* Three equal white panels */
.page-home .reference-dashboard-section{padding:13px 0 12px;background:transparent}
.page-home .reference-dashboard-grid{
  width:min(calc(100% - 64px),1434px);margin:auto;
  display:grid;grid-template-columns:1.08fr .96fr .83fr;gap:14px;align-items:stretch
}
.page-home .reference-panel{
  min-height:292px;padding:12px 12px 13px;border-radius:17px;
  background:rgba(255,255,255,.96);border:1px solid #cfdeef;
  box-shadow:0 10px 24px rgba(16,66,128,.09),inset 0 1px 0 #fff;
}
.page-home .reference-panel-head{min-height:42px;display:flex;align-items:center;gap:9px;margin-bottom:8px}.page-home .reference-panel-head .panel-icon{width:35px;height:35px;border-radius:12px;display:grid;place-items:center}.page-home .reference-panel-head .panel-icon .ui-svg{width:21px;height:21px}
.page-home .reference-panel-head h2{margin:0;color:#0750c4;font-size:1.03rem;line-height:1.05;font-weight:900;letter-spacing:-.025em}.page-home .reference-panel-head p{margin:3px 0 0;color:#6983a6;font-size:.57rem}.page-home .panel-view-all{margin-left:auto;padding:5px 11px;border-radius:999px;border:1px solid #bfd4f0;background:#f5f9ff;color:#0e58bf;font-size:.56rem;font-weight:850}
.page-home .panel-icon.rocket{color:#fff;background:linear-gradient(145deg,#ffb20a,#ff8a00)}.page-home .panel-icon.bell{color:#fff;background:linear-gradient(145deg,#ffae00,#ff7d00)}.page-home .panel-icon.link{color:#fff;background:linear-gradient(145deg,#1197ef,#0969c7)}

.page-home .reference-quick-grid{grid-template-columns:repeat(3,1fr);gap:8px}
.page-home .reference-quick-card{
  min-height:70px;padding:9px 9px;border-radius:11px;display:grid;grid-template-columns:38px 1fr auto;gap:8px;align-items:center;
  border:1px solid rgba(158,185,222,.4);box-shadow:0 5px 11px rgba(18,74,144,.06);transition:.17s
}
.page-home .reference-quick-card>span{width:38px;height:38px;border-radius:999px;display:grid;place-items:center;color:#fff}.page-home .reference-quick-card>span .ui-svg{width:20px;height:20px}.page-home .reference-quick-card b{display:block;color:#0b3979;font-size:.62rem;line-height:1.1}.page-home .reference-quick-card small{display:block;color:#6881a1;font-size:.49rem;margin-top:4px}.page-home .reference-quick-card i{font-style:normal;font-size:.9rem;font-weight:900}.page-home .reference-quick-card:hover{transform:translateY(-2px);box-shadow:0 9px 17px rgba(18,74,144,.12)}
.page-home .quick-blue{background:linear-gradient(135deg,#eaf5ff,#d6ecff)}.page-home .quick-blue>span{background:linear-gradient(145deg,#2179f1,#0755cc)}
.page-home .quick-teal{background:linear-gradient(135deg,#ebfffb,#d6f5ef)}.page-home .quick-teal>span{background:linear-gradient(145deg,#19b6b5,#078984)}
.page-home .quick-purple{background:linear-gradient(135deg,#f6edff,#eddcff)}.page-home .quick-purple>span{background:linear-gradient(145deg,#a936f6,#6b10d9)}
.page-home .quick-red{background:linear-gradient(135deg,#fff0ec,#ffe1d6)}.page-home .quick-red>span{background:linear-gradient(145deg,#ff3c50,#ee152d)}
.page-home .quick-green{background:linear-gradient(135deg,#eafff4,#d8f5e8)}.page-home .quick-green>span{background:linear-gradient(145deg,#20b77e,#078f65)}
.page-home .quick-gold{background:linear-gradient(135deg,#fff9e5,#fff0c8)}.page-home .quick-gold>span{background:linear-gradient(145deg,#ffad18,#f17108)}
.page-home .quick-violet{background:linear-gradient(135deg,#f5edff,#e5ddff)}.page-home .quick-violet>span{background:linear-gradient(145deg,#7e31ef,#5a15d8)}
.page-home .quick-pink{background:linear-gradient(135deg,#fff0fd,#f8dcff)}.page-home .quick-pink>span{background:linear-gradient(145deg,#bf26f0,#8b16da)}
.page-home .quick-sky{background:linear-gradient(135deg,#eef9ff,#dbefff)}.page-home .quick-sky>span{background:linear-gradient(145deg,#1c7ee7,#075ab8)}

.page-home .reference-update-list{display:grid;gap:6px}.page-home .reference-update-item{min-height:44px;padding:6px 8px;border-radius:10px;background:linear-gradient(180deg,#fff,#f7fbff);border:1px solid #d2e0ef;display:grid;grid-template-columns:34px 1fr auto;gap:8px;align-items:center;box-shadow:0 3px 7px rgba(20,70,130,.04)}
.page-home .reference-update-item .update-icon{width:34px;height:34px;border-radius:9px;display:grid;place-items:center;color:#fff;background:linear-gradient(145deg,#1985ef,#0b5cc5)}.page-home .reference-update-item .update-icon .ui-svg{width:18px;height:18px}.page-home .reference-update-item b{display:block;color:#0751be;font-size:.62rem;line-height:1.08}.page-home .reference-update-item small{display:block;color:#526f98;font-size:.51rem;margin-top:3px}.page-home .reference-update-item time{font-size:.49rem;color:#5373a0;text-align:right;max-width:90px}.page-home .reference-update-empty{min-height:195px;display:grid;place-items:center;text-align:center;color:#6d85a4}.page-home .reference-update-empty span{width:44px;height:44px;border-radius:14px;background:#edf6ff;color:#1d71d7;display:grid;place-items:center}.page-home .reference-update-empty strong{color:#164e95}

.page-home .reference-important-list{display:grid;grid-template-columns:1fr;gap:8px}.page-home .important-card{min-height:48px;padding:8px 9px;border-radius:11px;display:grid;grid-template-columns:38px 1fr 22px;gap:8px;align-items:center;border:1px solid rgba(140,176,219,.45);box-shadow:0 4px 10px rgba(21,76,141,.05)}.page-home .important-card>span{width:38px;height:38px;border-radius:999px;display:grid;place-items:center;color:#fff}.page-home .important-card>span .ui-svg{width:20px;height:20px}.page-home .important-card b{display:block;color:#0a3979;font-size:.61rem}.page-home .important-card small{display:block;color:#647f9f;font-size:.5rem;margin-top:2px}.page-home .important-card i{color:#185cc3}.page-home .important-card i .ui-svg{width:17px;height:17px}.page-home .important-blue{background:linear-gradient(135deg,#edf6ff,#dcecff)}.page-home .important-blue>span{background:linear-gradient(145deg,#1476eb,#0758c4)}.page-home .important-green{background:linear-gradient(135deg,#effff7,#daf4e6)}.page-home .important-green>span{background:linear-gradient(145deg,#27a659,#0b7a38)}.page-home .important-orange{background:linear-gradient(135deg,#fff8e9,#ffe8c8)}.page-home .important-orange>span{background:linear-gradient(145deg,#ff8c14,#ef5a08)}.page-home .important-purple{background:linear-gradient(135deg,#f7efff,#e7ddff)}.page-home .important-purple>span{background:linear-gradient(145deg,#8c31ef,#5d15ce)}

/* Footer: reference-like deep navy panel */
.page-home .reference-footer{position:relative;margin:0;padding:0;background:linear-gradient(180deg,#073a83,#03245d);border-top:3px solid #f5bf20;box-shadow:0 -8px 26px rgba(8,46,102,.14)}
.page-home .reference-footer:before{content:"";position:absolute;top:-8px;left:0;right:0;height:8px;background:linear-gradient(90deg,#f3bf1e 0 12%,#0ca1ff 22% 78%,#f3bf1e 88% 100%);clip-path:polygon(0 70%,18% 10%,48% 54%,78% 8%,100% 68%,100% 100%,0 100%)}
.page-home .reference-footer-shell{width:min(calc(100% - 72px),1392px);padding:17px 6px 7px}.page-home .reference-footer-grid{grid-template-columns:1.1fr 1.5fr .78fr .76fr;gap:28px;align-items:center}.page-home .reference-footer-brand .brand-logo-mark{width:82px;height:66px}.page-home .reference-footer-brand strong{font-size:1.2rem}.page-home .reference-footer-brand small{font-size:.58rem}.page-home .reference-footer-brand>p{margin:7px 0 0 93px;color:#ffd148;font-size:.54rem;line-height:1.4}.page-home .reference-footer h3{font-size:.66rem}.page-home .footer-link-columns a{font-size:.53rem}.page-home .footer-social-row>*{width:32px;height:32px}.page-home .reference-footer-qr{padding:8px 9px;border-radius:11px}.page-home .reference-footer-qr img{width:58px;height:58px}.page-home .reference-footer-bottom{margin-top:10px;padding-top:7px}.page-home .reference-footer-bottom p{font-size:.48rem}.page-home .reference-back-top{width:38px;height:38px;right:24px;bottom:23px}

/* Desktop height balance: target the 1536×1024 approved screenshot */
@media(min-width:1180px){
  .page-home .reference-dashboard-section{min-height:309px}
}

/* Tablet */
@media(max-width:1100px){
  body.page-home{background:#eef7ff!important}
  .page-home .container{width:min(calc(100% - 28px),1040px)}
  .page-home .site-header.reference-header{width:calc(100% - 20px);margin-inline:10px;border-radius:0 0 26px 26px}
  .page-home .reference-header-row{width:calc(100% - 22px)}
  .page-home .reference-brand .brand-logo-mark{width:62px;height:56px;min-width:62px}.page-home .reference-brand .brand-copy strong{font-size:1.55rem}
  .page-home .reference-theme-btn{width:48px;min-width:48px}.page-home .reference-theme-btn .theme-cycle-label{display:none}
  .page-home .reference-nav-shell{width:calc(100% - 28px)}
  .page-home .reference-hero-shell{width:calc(100% - 28px);height:340px;min-height:340px;background-position:center 28%}.page-home .reference-hero-content{max-width:68%}.page-home .reference-quote-card{width:27%;right:15px}
  .page-home .reference-stat-strip{width:calc(100% - 40px);grid-template-columns:repeat(5,minmax(150px,1fr));overflow-x:auto;scrollbar-width:none}.page-home .reference-stat-strip::-webkit-scrollbar{display:none}
  .page-home .reference-dashboard-grid{width:calc(100% - 28px);grid-template-columns:1fr 1fr}.page-home .important-panel{grid-column:1/-1}.page-home .reference-important-list{grid-template-columns:repeat(4,1fr)}
  .page-home .reference-footer-shell{width:calc(100% - 28px)}.page-home .reference-footer-grid{grid-template-columns:1fr 1.3fr 1fr}.page-home .reference-footer-qr{grid-column:1/-1;justify-self:end;width:250px}
}

/* Mobile */
@media(max-width:680px){
  .page-home .portal-utility-inner{padding-inline:6px}.page-home .utility-motto,.page-home .utility-socials{display:none}.page-home .utility-clock{margin-left:auto;font-size:.52rem}
  .page-home .site-header.reference-header{width:100%;margin:0;border-radius:0 0 20px 20px}
  .page-home .reference-header-row{width:100%;min-height:64px;padding:6px 8px}.page-home .reference-brand{gap:7px}.page-home .reference-brand .brand-logo-mark{width:46px;height:43px;min-width:46px}.page-home .reference-brand .brand-copy strong{font-size:1rem}.page-home .reference-brand .brand-copy small{font-size:.46rem;max-width:150px}.page-home .reference-header .header-tools{gap:5px}.page-home .reference-theme-btn{width:40px;min-width:40px;height:40px}.page-home .reference-signin{min-height:40px;padding:4px 8px 4px 4px}.page-home .reference-signin .signin-icon-shell{width:30px;height:30px}.page-home .reference-signin .signin-copy small{display:none}.page-home .reference-signin .signin-copy>span{font-size:.59rem}.page-home .reference-signin .signin-arrow{display:none}
  .page-home .reference-nav-shell{width:100%;padding-inline:7px}.page-home .main-nav.reference-nav .nav-link{min-height:34px;padding:6px 9px;font-size:.58rem}.page-home .main-nav.reference-nav .nav-ico{width:17px;height:17px}.page-home .main-nav.reference-nav .nav-ico .ui-svg{width:13px;height:13px}
  .page-home .reference-home-hero{padding-top:7px}.page-home .reference-hero-shell{width:100%;height:475px;min-height:475px;border-radius:0;background-position:57% 25%}.page-home .reference-hero-shell:before{height:22px}.page-home .reference-hero-content{max-width:100%;padding:25px 16px 150px;background:linear-gradient(90deg,rgba(2,38,91,.96),rgba(4,63,132,.78) 74%,rgba(0,35,79,.18))}.page-home .reference-hero-content h1{font-size:3rem}.page-home .reference-hero-content h2{font-size:1rem}.page-home .reference-hero-content p{font-size:.72rem}.page-home .reference-hero-actions{flex-wrap:wrap;gap:7px}.page-home .reference-cta{min-height:39px;padding:7px 11px;font-size:.65rem}.page-home .reference-quote-card{left:14px;right:14px;top:auto;bottom:34px;width:auto;padding:12px 14px;border-radius:16px}.page-home .quote-mark{font-size:2.2rem;height:22px}.page-home .reference-quote-card p{font-size:.68rem;margin:3px 0 4px}.page-home .reference-quote-card small{font-size:.55rem}
  .page-home .reference-stat-wrap{margin-top:0}.page-home .reference-stat-strip{width:100%;border-radius:0;padding:5px 7px}.page-home .reference-stat-item{min-width:144px;padding:5px 10px}.page-home .reference-stat-item .stat-icon{width:39px;height:39px}.page-home .reference-stat-item strong{font-size:1rem}
  .page-home .reference-dashboard-section{padding:9px 0}.page-home .reference-dashboard-grid{width:calc(100% - 14px);grid-template-columns:1fr;gap:9px}.page-home .reference-panel{min-height:auto;padding:10px;border-radius:15px}.page-home .reference-quick-grid{grid-template-columns:repeat(2,1fr)}.page-home .reference-important-list{grid-template-columns:1fr}.page-home .reference-update-item time{display:none}
  .page-home .reference-footer-shell{width:calc(100% - 16px);padding:15px 3px 7px}.page-home .reference-footer-grid{grid-template-columns:1fr}.page-home .reference-footer-brand>p{margin-left:0}.page-home .footer-link-columns{grid-template-columns:repeat(2,1fr)}.page-home .reference-footer-qr{justify-self:stretch;width:auto;max-width:300px}.page-home .reference-footer-bottom{align-items:flex-start;flex-direction:column}
}

html[data-theme="dark"] body.page-home{background:#06101f!important;background-image:none!important}
html[data-theme="dark"] .page-home main{background:#071321}
html[data-theme="dark"] .page-home .site-header.reference-header{background:linear-gradient(180deg,rgba(8,23,42,.99),rgba(8,29,51,.98));border-color:#294965}
html[data-theme="dark"] .page-home .reference-brand .brand-copy strong{color:#f3f8ff}html[data-theme="dark"] .page-home .reference-brand .brand-copy small{color:#a9c2df}
html[data-theme="dark"] .page-home .main-nav.reference-nav .nav-link{color:#c7dcf3;background:linear-gradient(180deg,#102a45,#0b2138);border-color:#294d70;box-shadow:0 5px 12px rgba(0,0,0,.2)}
html[data-theme="dark"] .page-home .main-nav.reference-nav .nav-link:hover{background:#153858;color:#fff;border-color:#4b81b3}
html[data-theme="dark"] .page-home .main-nav.reference-nav .nav-upload{color:#c7dcf3!important;background:linear-gradient(180deg,#102a45,#0b2138)!important;border-color:#294d70!important}
html[data-theme="dark"] .page-home .reference-stat-strip,html[data-theme="dark"] .page-home .reference-panel{background:rgba(9,26,47,.97);border-color:#2e506f}
html[data-theme="dark"] .page-home .reference-stat-item{border-color:#2c4c68}html[data-theme="dark"] .page-home .reference-stat-item strong{color:#e4f2ff}html[data-theme="dark"] .page-home .reference-stat-item small{color:#9db7d4}
html[data-theme="dark"] .page-home .reference-panel-head h2{color:#7fb7ff}html[data-theme="dark"] .page-home .reference-panel-head p{color:#90aac8}
html[data-theme="dark"] .page-home .reference-update-item,html[data-theme="dark"] .page-home .reference-quick-card,html[data-theme="dark"] .page-home .important-card{border-color:#2b4b69;filter:saturate(.82) brightness(.83)}

/* v2.3.1-dev precision pass: desktop fit + compact theme orb */
@media(min-width:1101px){
  .page-home .reference-theme-btn{width:48px!important;min-width:48px!important;padding:4px!important}
  .page-home .reference-nav-shell{width:min(calc(100% - 32px),1442px)!important}
  .page-home .main-nav.reference-nav{gap:5px!important}
  .page-home .main-nav.reference-nav .nav-link{padding:7px 10px!important;font-size:.67rem!important;gap:6px!important}
  .page-home .main-nav.reference-nav .nav-ico{width:18px;height:18px}.page-home .main-nav.reference-nav .nav-ico .ui-svg{width:14px;height:14px}
  .page-home .reference-panel{min-height:282px}
  .page-home .reference-footer-shell{padding-top:13px}.page-home .reference-footer-grid{gap:24px}.page-home .reference-footer-bottom{margin-top:7px}
}
</style>
<style>
/* Development review: simplified approved home composition */
.reference-dashboard-grid{grid-template-columns:1fr!important;}
.quick-panel{grid-column:1/-1!important;}
.reference-footer-grid{grid-template-columns:minmax(260px,.85fr) minmax(0,1.65fr)!important;}
@media(max-width:900px){.reference-footer-grid{grid-template-columns:1fr!important;}}
</style><style>
/* Review cleanup: removed optional reference extras while preserving all core content */
.reference-dashboard-grid{grid-template-columns:1fr!important;}
.reference-dashboard-grid>.quick-panel{grid-column:1/-1!important;width:100%;}

/* ===== GPCS interactive logo treatment ===== */
.brand-logo-mark.logo-interactive{
  position:relative!important;
  display:grid!important;
  place-items:center!important;
  overflow:hidden!important;
  cursor:pointer!important;
  user-select:none;
  -webkit-user-select:none;
  touch-action:manipulation;
  isolation:isolate;
  border-radius:24px!important;
  padding:3px!important;
  background:
    linear-gradient(145deg,rgba(255,255,255,.98),rgba(233,244,255,.94)) padding-box,
    linear-gradient(135deg,#f4c74a 0%,#42b7ff 48%,#0752d6 100%) border-box!important;
  border:2px solid transparent!important;
  box-shadow:
    0 11px 24px rgba(10,56,122,.17),
    0 2px 6px rgba(7,48,110,.10),
    inset 0 1px 0 rgba(255,255,255,.9)!important;
  transition:transform .2s ease,box-shadow .2s ease,filter .2s ease!important;
}
.brand-logo-mark.logo-interactive::before{
  content:"";
  position:absolute;
  inset:-35%;
  z-index:0;
  background:linear-gradient(115deg,transparent 35%,rgba(255,255,255,.7) 50%,transparent 65%);
  transform:translateX(-75%) rotate(8deg);
  transition:transform .55s ease;
  pointer-events:none;
}
.brand-logo-mark.logo-interactive:hover{
  transform:translateY(-2px) scale(1.035);
  box-shadow:
    0 16px 31px rgba(10,70,160,.23),
    0 0 0 4px rgba(55,145,255,.08),
    inset 0 1px 0 rgba(255,255,255,.95)!important;
}
.brand-logo-mark.logo-interactive:hover::before{transform:translateX(75%) rotate(8deg)}
.brand-logo-mark.logo-interactive:active{transform:scale(.975)}
.brand-logo-mark.logo-interactive:focus-visible{
  outline:0!important;
  box-shadow:0 0 0 4px rgba(37,99,235,.2),0 13px 27px rgba(10,70,160,.2)!important;
}
.brand-logo-mark.logo-interactive img{
  position:relative;
  z-index:1;
  width:100%!important;
  height:100%!important;
  object-fit:cover!important;
  object-position:center!important;
  border-radius:19px!important;
  filter:saturate(1.04) contrast(1.02) drop-shadow(0 4px 7px rgba(15,49,89,.12))!important;
}
.footer-brand .brand-logo-mark.logo-interactive{
  border-radius:25px!important;
  background:
    linear-gradient(145deg,rgba(255,255,255,.98),rgba(224,239,255,.94)) padding-box,
    linear-gradient(135deg,#ffd65a,#42c0ff 48%,#0a5dde) border-box!important;
}
html[data-theme="dark"] .brand-logo-mark.logo-interactive{
  background:
    linear-gradient(145deg,rgba(15,35,67,.96),rgba(12,45,83,.95)) padding-box,
    linear-gradient(135deg,#eac655,#4ec4ff 48%,#347cff) border-box!important;
  box-shadow:0 14px 32px rgba(0,0,0,.35),0 0 0 1px rgba(103,174,255,.08)!important;
}

/* Full logo lightbox */
.gpcs-logo-lightbox{
  position:fixed;
  inset:0;
  z-index:99999;
  display:none;
  align-items:center;
  justify-content:center;
  padding:clamp(16px,4vw,44px);
  background:rgba(2,14,35,.78);
  backdrop-filter:blur(13px) saturate(1.12);
  -webkit-backdrop-filter:blur(13px) saturate(1.12);
}
.gpcs-logo-lightbox.is-open{display:flex}
.gpcs-logo-dialog{
  position:relative;
  width:min(94vw,980px);
  max-height:90vh;
  border-radius:28px;
  padding:10px;
  background:linear-gradient(145deg,rgba(255,255,255,.96),rgba(225,240,255,.93));
  border:1px solid rgba(255,255,255,.75);
  box-shadow:0 30px 90px rgba(0,0,0,.46),0 0 0 1px rgba(73,155,255,.18);
  animation:gpcsLogoIn .22s ease-out both;
}
.gpcs-logo-dialog::before{
  content:"";
  position:absolute;
  inset:-2px;
  z-index:-1;
  border-radius:30px;
  background:linear-gradient(135deg,#f5ca4c,#48c4ff,#125bea);
}
.gpcs-logo-dialog img{
  display:block;
  width:100%;
  max-height:calc(90vh - 20px);
  object-fit:contain;
  border-radius:21px;
  background:#f5ead3;
}
.gpcs-logo-close{
  position:absolute;
  top:18px;
  right:18px;
  z-index:2;
  width:44px;
  height:44px;
  display:grid;
  place-items:center;
  border:1px solid rgba(255,255,255,.45);
  border-radius:999px;
  color:#fff;
  background:rgba(4,27,63,.76);
  box-shadow:0 8px 22px rgba(0,0,0,.28);
  font-size:25px;
  line-height:1;
  cursor:pointer;
  transition:.18s ease;
}
.gpcs-logo-close:hover{transform:scale(1.06);background:#073c87}
.gpcs-logo-hint{
  position:absolute;
  left:50%;
  bottom:20px;
  transform:translateX(-50%);
  z-index:2;
  padding:8px 13px;
  border-radius:999px;
  color:#fff;
  background:rgba(4,27,63,.72);
  border:1px solid rgba(255,255,255,.25);
  font-size:.72rem;
  font-weight:750;
  white-space:nowrap;
  box-shadow:0 6px 18px rgba(0,0,0,.18);
}
@keyframes gpcsLogoIn{
  from{opacity:0;transform:translateY(10px) scale(.975)}
  to{opacity:1;transform:translateY(0) scale(1)}
}
@media(max-width:600px){
  .brand-logo-mark.logo-interactive{border-radius:18px!important;padding:2px!important}
  .brand-logo-mark.logo-interactive img{border-radius:14px!important}
  .gpcs-logo-dialog{border-radius:20px;padding:7px}
  .gpcs-logo-dialog img{border-radius:15px}
  .gpcs-logo-close{top:13px;right:13px;width:40px;height:40px}
  .gpcs-logo-hint{font-size:.62rem;bottom:14px}
}
@media(prefers-reduced-motion:reduce){
  .brand-logo-mark.logo-interactive,
  .brand-logo-mark.logo-interactive::before,
  .gpcs-logo-dialog,
  .gpcs-logo-close{transition:none!important;animation:none!important}
}


/* =========================================================
   GPCS Home spacing/alignment precision fix
   Scope: HERO -> STATS -> QUICK ACCESS only
   No color/content/button/function changes.
   ========================================================= */

/* Desktop: all three blocks share the exact same outer width. */
.page-home{
  --home-review-width:min(calc(100% - 64px),1434px);
  --home-section-gap:14px;
}
.page-home .reference-hero-shell,
.page-home .reference-stat-strip,
.page-home .reference-dashboard-grid{
  width:var(--home-review-width)!important;
  max-width:1434px;
  margin-left:auto!important;
  margin-right:auto!important;
}

/* Remove the old negative overlap and create equal visual breathing room. */
.page-home .reference-stat-wrap{
  margin:var(--home-section-gap) 0 0!important;
  padding:0!important;
}
.page-home .reference-dashboard-section{
  padding:var(--home-section-gap) 0 12px!important;
}

/* Keep all 5 stats optically equal and centered. */
.page-home .reference-stat-strip{
  grid-template-columns:repeat(5,minmax(0,1fr))!important;
  gap:0!important;
  padding:8px 14px!important;
  box-sizing:border-box;
}
.page-home .reference-stat-item{
  min-width:0!important;
  min-height:62px!important;
  padding:7px 16px!important;
  display:flex!important;
  align-items:center!important;
  justify-content:center!important;
  gap:12px!important;
  box-sizing:border-box;
}
.page-home .reference-stat-item > div{
  min-width:0;
}
.page-home .reference-stat-item strong,
.page-home .reference-stat-item small{
  white-space:nowrap;
}

/* Tablet: same left/right edges for hero, stats and content. */
@media (max-width:1100px){
  .page-home{
    --home-review-width:calc(100% - 28px);
    --home-section-gap:12px;
  }
  .page-home .reference-stat-strip{
    width:var(--home-review-width)!important;
    grid-template-columns:repeat(5,minmax(150px,1fr))!important;
    padding:7px 10px!important;
    overflow-x:auto!important;
    scrollbar-width:none;
  }
  .page-home .reference-stat-strip::-webkit-scrollbar{display:none}
  .page-home .reference-stat-item{
    padding:6px 13px!important;
  }
}

/* Mobile: equal inset and consistent vertical rhythm. */
@media (max-width:680px){
  .page-home{
    --home-review-width:calc(100% - 14px);
    --home-section-gap:10px;
  }
  .page-home .reference-hero-shell{
    width:var(--home-review-width)!important;
    border-radius:18px!important;
  }
  .page-home .reference-stat-strip{
    width:var(--home-review-width)!important;
    border-radius:18px!important;
    padding:6px 7px!important;
  }
  .page-home .reference-dashboard-grid{
    width:var(--home-review-width)!important;
  }
  .page-home .reference-stat-item{
    min-width:144px!important;
    padding:5px 10px!important;
  }
  .page-home .reference-dashboard-section{
    padding:var(--home-section-gap) 0 10px!important;
  }
}


/* =========================================================
   Header -> navigation tabs exact-width alignment fix
   Scope ONLY: top navigation strip under header.
   Footer and all other sections remain untouched.
   ========================================================= */

:root{
  --gpcs-header-shell-width:min(calc(100% - 40px),1434px);
}

/* Keep header and the navigation strip on the same exact width. */
.reference-header-row,
.reference-nav-shell{
  width:var(--gpcs-header-shell-width)!important;
  max-width:1434px!important;
  margin-left:auto!important;
  margin-right:auto!important;
  box-sizing:border-box;
}

/* Make the nav container itself fill that shell edge-to-edge. */
.reference-nav-shell .main-nav.reference-nav{
  width:100%!important;
  max-width:none!important;
  box-sizing:border-box;
  margin-left:0!important;
  margin-right:0!important;
}

/* Tablet */
@media (max-width:1100px){
  :root{
    --gpcs-header-shell-width:calc(100% - 20px);
  }
}

/* Mobile */
@media (max-width:680px){
  :root{
    --gpcs-header-shell-width:calc(100% - 12px);
  }
}


/* =========================================================
   FOOTER — ONLY 3 REQUESTED FIXES
   1) Bottom copyright/status overlap protection
   2) Quick Links width + equal column spacing
   3) Back-to-top button collision protection
   Nothing outside footer is changed.
   ========================================================= */

/* 1) Keep the copyright/design row safely above browser/status overlays
      and prevent any footer element from occupying the same visual line. */
.reference-footer-bottom{
  position:relative;
  box-sizing:border-box;
  min-height:38px;
  padding-bottom:10px!important;
  padding-right:72px!important;
  clear:both;
}
.reference-footer-bottom p{
  position:relative;
  z-index:1;
  max-width:100%;
  overflow-wrap:anywhere;
}

/* 2) Keep footer brand + Quick Links on one clean content width.
      Quick Links occupies all remaining space and its 3 groups are equal. */
.reference-footer-grid{
  width:100%;
  grid-template-columns:minmax(280px,.82fr) minmax(0,1.78fr)!important;
  column-gap:clamp(28px,4vw,68px)!important;
  align-items:start!important;
}
.reference-footer-links{
  width:100%!important;
  min-width:0;
}
.reference-footer-links > h3{
  width:100%;
}
.footer-link-columns{
  width:100%!important;
  grid-template-columns:repeat(3,minmax(0,1fr))!important;
  column-gap:clamp(24px,5vw,86px)!important;
  row-gap:4px!important;
  align-items:start;
}
.footer-link-columns > div{
  min-width:0;
  width:100%;
}
.footer-link-columns a{
  display:block;
  width:max-content;
  max-width:100%;
}

/* 3) Reserve an explicit safe zone for the floating back-to-top button. */
.reference-back-top{
  right:24px!important;
  bottom:18px!important;
  z-index:4!important;
}
.reference-footer-bottom p:last-child{
  padding-right:10px;
}

/* Tablet: preserve equal link groups; keep bottom row away from arrow. */
@media (max-width:900px){
  .reference-footer-grid{
    grid-template-columns:1fr!important;
    row-gap:20px!important;
  }
  .footer-link-columns{
    grid-template-columns:repeat(3,minmax(0,1fr))!important;
    column-gap:clamp(18px,5vw,54px)!important;
  }
  .reference-footer-bottom{
    padding-right:64px!important;
    padding-bottom:12px!important;
  }
  .reference-back-top{
    right:16px!important;
    bottom:16px!important;
  }
}

/* Mobile: stack link groups cleanly and guarantee no overlap with arrow. */
@media (max-width:600px){
  .footer-link-columns{
    grid-template-columns:repeat(2,minmax(0,1fr))!important;
    column-gap:22px!important;
    row-gap:10px!important;
  }
  .reference-footer-bottom{
    min-height:72px;
    padding-right:58px!important;
    padding-bottom:16px!important;
    gap:6px!important;
  }
  .reference-footer-bottom p{
    width:100%;
  }
  .reference-back-top{
    width:38px!important;
    height:38px!important;
    right:12px!important;
    bottom:14px!important;
  }
}


/* =========================================================
   Production Laravel functional-route layer
   Fixes broken internal preview links only.
   Existing Home visual design + footer remain unchanged.
   ========================================================= */
.gpcs-preview-view[hidden]{display:none!important}
.gpcs-route-view{width:min(calc(100% - 64px),1434px);margin:14px auto 16px;min-height:520px}
.gpcs-route-shell{border:1px solid rgba(181,207,238,.9);border-radius:26px;background:rgba(255,255,255,.94);box-shadow:0 18px 45px rgba(10,61,128,.12);backdrop-filter:blur(12px);overflow:hidden}
.route-hero{padding:26px 28px 20px;background:linear-gradient(135deg,#f9fcff,#eef6ff 62%,#e7f2ff);border-bottom:1px solid #d7e7f7;display:flex;justify-content:space-between;gap:20px;align-items:flex-start}
.route-kicker{display:inline-flex;align-items:center;gap:7px;font-size:.72rem;font-weight:900;color:#1764cf;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px}.route-hero h1{margin:0;color:#0b2f67;font-size:clamp(1.65rem,3vw,2.35rem);letter-spacing:-.035em}.route-hero p{margin:7px 0 0;color:#607794;max-width:760px;line-height:1.55}.route-badge{padding:8px 12px;border-radius:999px;background:#eaf4ff;border:1px solid #c8dff8;color:#1558b5;font-size:.7rem;font-weight:850;white-space:nowrap}
.route-content{padding:22px 28px 28px}.route-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.route-card{border:1px solid #dce9f7;border-radius:18px;background:#fff;padding:18px;box-shadow:0 8px 22px rgba(17,70,135,.06)}.route-card h2,.route-card h3{margin:0 0 8px;color:#133b72}.route-card p{margin:0;color:#6c7f99;line-height:1.55}.route-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:16px}.route-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:42px;padding:10px 16px;border-radius:12px;border:1px solid #c7dcf5;background:linear-gradient(180deg,#fff,#edf5ff);color:#114680;font-weight:850;cursor:pointer;transition:.18s}.route-btn:hover{transform:translateY(-1px);box-shadow:0 8px 18px rgba(20,86,168,.13)}.route-btn.primary{color:#fff;border-color:#1676ef;background:linear-gradient(135deg,#0753d6,#0b79ff);box-shadow:0 9px 20px rgba(8,97,224,.24)}.route-btn.danger{color:#a72f42;background:#fff5f7;border-color:#ffd5dc}.route-btn:active{transform:scale(.98)}
.route-form{display:grid;gap:13px}.route-form label{display:grid;gap:6px;color:#27486f;font-size:.78rem;font-weight:800}.route-form input,.route-form select,.route-form textarea{width:100%;box-sizing:border-box;border:1px solid #cfdff0;border-radius:12px;background:#fff;padding:11px 12px;color:#173252;outline:none}.route-form input:focus,.route-form select:focus,.route-form textarea:focus{border-color:#4c97f3;box-shadow:0 0 0 4px rgba(68,143,236,.12)}
.route-searchbar{display:flex;gap:10px;align-items:center;margin-bottom:14px}.route-searchbar input{flex:1;min-height:43px;border:1px solid #cbdff4;border-radius:12px;padding:0 13px;font:inherit}.route-table-wrap{overflow:auto;border:1px solid #cfdef0;border-radius:16px}.route-table{width:100%;border-collapse:collapse;min-width:760px;background:#fff}.route-table th{background:#7aaae7;color:#082d61;padding:12px 11px;text-align:left;font-size:.76rem}.route-table td{padding:11px;border-top:1px solid #e2eaf3;color:#294461;font-size:.76rem}.route-status{display:inline-flex;padding:5px 8px;border-radius:999px;background:#edf4fb;color:#58708c;font-size:.65rem;font-weight:800}.route-empty{padding:30px;text-align:center;color:#7890aa}
.route-gallery{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px}.route-gallery-card{min-height:135px;border:1px solid #d7e6f6;border-radius:17px;padding:16px;background:linear-gradient(145deg,#fff,#f1f7ff);display:flex;flex-direction:column;justify-content:flex-end}.route-gallery-card b{color:#153f77}.route-gallery-card small{color:#7287a2;margin-top:4px}.route-about-list{display:grid;gap:11px}.route-about-list div{padding:14px 15px;border:1px solid #dce9f7;border-radius:14px;background:#f9fcff}.route-about-list b{color:#123f79}.route-note-list{display:grid;gap:10px}.route-note{display:flex;justify-content:space-between;gap:16px;align-items:center;padding:13px 14px;border:1px solid #d9e7f6;border-radius:14px;background:#fff}.route-note b{display:block;color:#153c70}.route-note small{color:#7387a0}.route-toast{position:fixed;right:18px;bottom:18px;z-index:99998;padding:11px 14px;border-radius:12px;background:#0b3977;color:#fff;box-shadow:0 14px 34px rgba(0,0,0,.25);opacity:0;transform:translateY(8px);pointer-events:none;transition:.2s}.route-toast.show{opacity:1;transform:none}
html[data-theme="dark"] .gpcs-route-shell{background:rgba(9,24,42,.96);border-color:#294869}.route-view-placeholder{display:none}html[data-theme="dark"] .route-hero{background:linear-gradient(135deg,#0e223b,#0a1b2f);border-color:#29445f}html[data-theme="dark"] .route-hero h1,html[data-theme="dark"] .route-card h2,html[data-theme="dark"] .route-card h3{color:#e6f1ff}html[data-theme="dark"] .route-hero p,html[data-theme="dark"] .route-card p{color:#aebfd3}html[data-theme="dark"] .route-card,html[data-theme="dark"] .route-table,html[data-theme="dark"] .route-note{background:#0d2036;border-color:#2b4765}html[data-theme="dark"] .route-table td{border-color:#28435f;color:#d5e4f6}html[data-theme="dark"] .route-table th{background:#173f72;color:#ddecff}html[data-theme="dark"] .route-form input,html[data-theme="dark"] .route-form select,html[data-theme="dark"] .route-form textarea,html[data-theme="dark"] .route-searchbar input{background:#091828;border-color:#365676;color:#f3f8ff}html[data-theme="dark"] .route-form label{color:#ccddf0}html[data-theme="dark"] .route-gallery-card,html[data-theme="dark"] .route-about-list div{background:#0d2036;border-color:#2b4765}html[data-theme="dark"] .route-gallery-card b,html[data-theme="dark"] .route-about-list b,html[data-theme="dark"] .route-note b{color:#a8d1ff}
@media(max-width:900px){.gpcs-route-view{width:calc(100% - 28px)}.route-grid{grid-template-columns:1fr}.route-gallery{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:600px){.gpcs-route-view{width:calc(100% - 14px);margin-top:10px}.route-hero{padding:20px 17px;display:block}.route-badge{display:inline-flex;margin-top:12px}.route-content{padding:16px}.route-gallery{grid-template-columns:1fr}.route-note{align-items:flex-start;flex-direction:column}.route-searchbar{align-items:stretch;flex-direction:column}}


/* =========================================================
   FINAL QA FIX — Dark theme logo + utility clock
   Scope: visibility/contrast only. Layout/footer structure untouched.
   ========================================================= */

/* The GPCS emblem must remain clearly visible in Dark and System-Dark modes. */
html[data-theme="dark"] .brand-logo-mark.logo-interactive{
  background:
    linear-gradient(145deg,#fffdf8 0%,#eef7ff 72%,#e5f2ff 100%) padding-box,
    linear-gradient(135deg,#f3c94f 0%,#54c8ff 50%,#397cff 100%) border-box!important;
  border:2px solid transparent!important;
  box-shadow:
    0 12px 30px rgba(0,0,0,.42),
    0 0 0 1px rgba(115,196,255,.17),
    0 0 24px rgba(53,145,255,.14)!important;
  opacity:1!important;
  filter:none!important;
}
html[data-theme="dark"] .brand-logo-mark.logo-interactive img{
  opacity:1!important;
  visibility:visible!important;
  mix-blend-mode:normal!important;
  filter:saturate(1.06) contrast(1.04) brightness(1.04)
         drop-shadow(0 4px 8px rgba(4,28,66,.18))!important;
}
html[data-theme="dark"] .footer-brand .brand-logo-mark.logo-interactive{
  background:
    linear-gradient(145deg,#fffdf8,#edf7ff) padding-box,
    linear-gradient(135deg,#f2c64e,#4fc7ff 48%,#3f82ff) border-box!important;
}

/* Make the live clock stable and readable at every breakpoint/theme. */
.utility-clock{
  display:inline-flex!important;
  align-items:center!important;
  gap:6px!important;
  min-width:max-content;
  white-space:nowrap;
  font-variant-numeric:tabular-nums;
}
.live-portal-clock{
  display:inline-block;
  min-width:196px;
  text-align:right;
  letter-spacing:.01em;
}
html[data-theme="dark"] .live-portal-clock{color:#f2f8ff}
@media(max-width:680px){
  .live-portal-clock{
    min-width:0;
    font-size:inherit;
  }
}

/* Defensive theme visibility fixes for common controls. */
html[data-theme="dark"] .reference-theme-btn{
  color:#ddebff!important;
  border-color:#355a7c!important;
}
html[data-theme="dark"] .reference-theme-btn svg{
  stroke:currentColor!important;
}
html[data-theme="dark"] .reference-signin{
  color:#fff!important;
}

</style>
<link rel="dns-prefetch" href="//www.rgpvdiploma.in">
<link rel="preconnect" href="https://www.rgpvdiploma.in" crossorigin>
<link rel="dns-prefetch" href="//result.rgpv.ac.in">
<link rel="preconnect" href="https://result.rgpv.ac.in" crossorigin>
<link rel="dns-prefetch" href="//www.polygwalior.ac.in">
<link rel="preconnect" href="https://www.polygwalior.ac.in" crossorigin>

<style id="gpcs-footer-polish-v1">
/* =========================================================
   GPCS FOOTER POLISH — footer-only visual refinement
   Keeps markup, links, hidden admin trigger and site logic intact.
   ========================================================= */
.site-footer.reference-footer{
  margin-top:24px!important;
  padding:0!important;
  background:
    radial-gradient(circle at 12% 0%,rgba(26,111,224,.22),transparent 34%),
    linear-gradient(135deg,#082c63 0%,#063d86 48%,#05275c 100%)!important;
  border-top:3px solid #f4bd24!important;
  box-shadow:0 -10px 30px rgba(4,43,94,.14)!important;
  overflow:hidden;
}
.site-footer.reference-footer:before{
  top:-1px!important;
  height:3px!important;
  background:linear-gradient(90deg,#f6c43a 0 18%,#2aa7ff 38% 68%,#f6c43a 88% 100%)!important;
  clip-path:none!important;
}
.reference-footer-shell,
.page-home .reference-footer-shell{
  width:min(calc(100% - 56px),1280px)!important;
  max-width:1280px!important;
  margin:0 auto!important;
  padding:28px 0 14px!important;
  box-sizing:border-box;
}
.reference-footer-grid,
.page-home .reference-footer-grid{
  display:grid!important;
  grid-template-columns:minmax(285px,.78fr) minmax(0,1.72fr)!important;
  gap:clamp(42px,6vw,92px)!important;
  align-items:start!important;
  width:100%!important;
}
.reference-footer-brand{
  position:relative!important;
  min-width:0;
  padding-bottom:12px;
}
.reference-footer-brand .footer-brand,
.page-home .reference-footer-brand .footer-brand{
  display:flex!important;
  align-items:center!important;
  gap:14px!important;
}
.reference-footer-brand .brand-logo-mark,
.page-home .reference-footer-brand .brand-logo-mark{
  width:76px!important;
  height:68px!important;
  flex:0 0 76px!important;
}
.reference-footer-brand strong,
.page-home .reference-footer-brand strong{
  display:block;
  color:#fff!important;
  font-size:1.22rem!important;
  line-height:1.12!important;
  letter-spacing:-.015em;
}
.reference-footer-brand small,
.page-home .reference-footer-brand small{
  display:block;
  margin-top:4px;
  color:#cfe3ff!important;
  font-size:.66rem!important;
  line-height:1.45!important;
}
.reference-footer-brand>p,
.page-home .reference-footer-brand>p{
  margin:13px 0 0 90px!important;
  max-width:230px;
  color:#ffd75c!important;
  font-size:.64rem!important;
  line-height:1.55!important;
  font-weight:800!important;
}
/* Keep the standalone hidden-admin symbol visually below the logo. */
.gpcs-standalone-admin-trigger{
  position:absolute!important;
  left:22px!important;
  top:69px!important;
  width:32px!important;
  height:28px!important;
  margin:0!important;
  display:flex!important;
  align-items:center!important;
  justify-content:center!important;
  font-size:10px!important;
  opacity:.55!important;
  color:#d8e8fb!important;
}
.reference-footer-links{
  width:100%!important;
  min-width:0!important;
  padding-top:2px;
}
.reference-footer-links>h3,
.page-home .reference-footer h3{
  position:relative;
  display:inline-flex;
  align-items:center;
  margin:0 0 15px!important;
  padding-bottom:8px;
  color:#fff!important;
  font-size:.82rem!important;
  line-height:1!important;
  font-weight:900!important;
  letter-spacing:.01em;
}
.reference-footer-links>h3:after{
  content:"";
  position:absolute;
  left:0;
  bottom:0;
  width:36px;
  height:2px;
  border-radius:999px;
  background:#f4bd24;
}
.footer-link-columns,
.page-home .footer-link-columns{
  display:grid!important;
  grid-template-columns:repeat(3,minmax(0,1fr))!important;
  gap:8px clamp(28px,5vw,84px)!important;
  width:100%!important;
  align-items:start!important;
}
.footer-link-columns>div{
  display:grid!important;
  align-content:start!important;
  gap:3px!important;
  min-width:0!important;
}
.footer-link-columns a,
.page-home .footer-link-columns a{
  position:relative;
  display:inline-flex!important;
  align-items:center;
  width:max-content!important;
  max-width:100%!important;
  min-height:27px;
  padding:3px 0!important;
  color:#d9e9ff!important;
  font-size:.66rem!important;
  line-height:1.35!important;
  font-weight:650!important;
  text-decoration:none!important;
  transition:color .18s ease,transform .18s ease!important;
}
.footer-link-columns a:before{
  content:"";
  width:4px;
  height:4px;
  margin-right:8px;
  border-radius:999px;
  background:#5ab6ff;
  opacity:.8;
  flex:none;
}
.footer-link-columns a:hover,
.footer-link-columns a:focus-visible{
  color:#fff!important;
  transform:translateX(3px)!important;
}
.reference-footer-bottom,
.page-home .reference-footer-bottom{
  position:relative!important;
  display:flex!important;
  align-items:center!important;
  justify-content:space-between!important;
  gap:20px!important;
  min-height:46px!important;
  margin-top:22px!important;
  padding:13px 70px 8px 0!important;
  border-top:1px solid rgba(255,255,255,.16)!important;
  box-sizing:border-box!important;
}
.reference-footer-bottom p,
.page-home .reference-footer-bottom p{
  margin:0!important;
  color:#bcd5f3!important;
  font-size:.57rem!important;
  line-height:1.55!important;
  white-space:normal;
}
.reference-footer-bottom span{
  margin:0 7px!important;
  color:#64bdff!important;
}
.reference-footer-bottom p:last-child{
  padding-right:0!important;
  text-align:right;
  color:#9fc1e8!important;
}
.reference-back-top,
.page-home .reference-back-top{
  right:24px!important;
  bottom:14px!important;
  width:42px!important;
  height:42px!important;
  border:1px solid rgba(145,211,255,.9)!important;
  background:linear-gradient(145deg,#0a67e4,#118cff)!important;
  box-shadow:0 10px 24px rgba(0,35,91,.28)!important;
  font-size:1rem!important;
  transition:transform .18s ease,box-shadow .18s ease!important;
}
.reference-back-top:hover{
  transform:translateY(-2px);
  box-shadow:0 14px 28px rgba(0,35,91,.34)!important;
}
@media(max-width:900px){
  .reference-footer-shell,.page-home .reference-footer-shell{
    width:calc(100% - 32px)!important;
    padding:24px 0 16px!important;
  }
  .reference-footer-grid,.page-home .reference-footer-grid{
    grid-template-columns:1fr!important;
    gap:24px!important;
  }
  .reference-footer-brand{
    max-width:520px;
  }
  .footer-link-columns,.page-home .footer-link-columns{
    grid-template-columns:repeat(3,minmax(0,1fr))!important;
    gap:8px 24px!important;
  }
  .reference-footer-bottom,.page-home .reference-footer-bottom{
    flex-direction:column!important;
    align-items:flex-start!important;
    gap:4px!important;
    padding-right:58px!important;
    padding-bottom:6px!important;
  }
  .reference-footer-bottom p:last-child{
    text-align:left;
  }
  .reference-back-top,.page-home .reference-back-top{
    right:16px!important;
    bottom:15px!important;
  }
}
@media(max-width:600px){
  .reference-footer-shell,.page-home .reference-footer-shell{
    width:calc(100% - 24px)!important;
    padding:22px 0 14px!important;
  }
  .reference-footer-brand .brand-logo-mark,.page-home .reference-footer-brand .brand-logo-mark{
    width:66px!important;
    height:60px!important;
    flex-basis:66px!important;
  }
  .reference-footer-brand strong,.page-home .reference-footer-brand strong{font-size:1.05rem!important}
  .reference-footer-brand small,.page-home .reference-footer-brand small{font-size:.61rem!important}
  .reference-footer-brand>p,.page-home .reference-footer-brand>p{
    margin-left:0!important;
    margin-top:14px!important;
    max-width:100%;
  }
  .gpcs-standalone-admin-trigger{
    left:18px!important;
    top:61px!important;
  }
  .reference-footer-links>h3,.page-home .reference-footer h3{
    margin-bottom:12px!important;
  }
  .footer-link-columns,.page-home .footer-link-columns{
    grid-template-columns:repeat(2,minmax(0,1fr))!important;
    gap:6px 20px!important;
  }
  .footer-link-columns>div:last-child{
    grid-column:1/-1;
    grid-template-columns:repeat(2,minmax(0,1fr))!important;
    column-gap:20px!important;
  }
  .footer-link-columns a,.page-home .footer-link-columns a{
    min-height:30px;
    font-size:.68rem!important;
  }
  .reference-footer-bottom,.page-home .reference-footer-bottom{
    margin-top:18px!important;
    min-height:86px!important;
    padding:12px 52px 10px 0!important;
  }
  .reference-footer-bottom p,.page-home .reference-footer-bottom p{
    font-size:.58rem!important;
  }
  .reference-footer-bottom span{display:none}
  .reference-back-top,.page-home .reference-back-top{
    width:40px!important;
    height:40px!important;
    right:10px!important;
    bottom:13px!important;
  }
}
@media(max-width:390px){
  .footer-link-columns,.page-home .footer-link-columns{
    grid-template-columns:1fr!important;
  }
  .footer-link-columns>div:last-child{
    grid-column:auto!important;
    grid-template-columns:1fr!important;
  }
}
</style>


<style id="gpcs-header-footer-balance">

/* =========================================================
   FINAL HEADER ↔ FOOTER BALANCE
   Scope: header/footer sizing and alignment only.
   Uses one shared visual shell across desktop/tablet/mobile.
   ========================================================= */
:root{
  --gpcs-balanced-shell:min(calc(100% - 40px),1434px);
}

/* Same left/right edges for the main header, nav and footer content. */
.reference-header-row,
.reference-nav-shell,
.reference-footer-shell,
.page-home .reference-header-row,
.page-home .reference-nav-shell,
.page-home .reference-footer-shell{
  width:var(--gpcs-balanced-shell)!important;
  max-width:1434px!important;
  margin-left:auto!important;
  margin-right:auto!important;
  box-sizing:border-box!important;
}

/* Footer visual weight now matches the compact premium header. */
.reference-footer-shell,
.page-home .reference-footer-shell{
  padding:14px 18px 10px!important;
}
.reference-footer-grid,
.page-home .reference-footer-grid{
  align-items:center!important;
  row-gap:14px!important;
}

/* Keep footer branding at the same logo scale as the desktop header. */
.reference-footer-brand .brand-logo-mark,
.page-home .reference-footer-brand .brand-logo-mark{
  width:68px!important;
  height:62px!important;
  min-width:68px!important;
}
.reference-footer-brand .footer-brand,
.page-home .reference-footer-brand .footer-brand{
  align-items:center!important;
  gap:13px!important;
}
.reference-footer-brand strong,
.page-home .reference-footer-brand strong{
  font-size:1.18rem!important;
  line-height:1.05!important;
}
.reference-footer-brand small,
.page-home .reference-footer-brand small{
  font-size:.60rem!important;
}
.reference-footer-brand>p,
.page-home .reference-footer-brand>p{
  margin:6px 0 0 81px!important;
}

/* Bottom strip stays aligned with the same content shell. */
.reference-footer-bottom,
.page-home .reference-footer-bottom{
  margin-top:10px!important;
  padding-top:8px!important;
}

@media (max-width:1100px){
  :root{--gpcs-balanced-shell:calc(100% - 20px)}
  .reference-footer-shell,
  .page-home .reference-footer-shell{
    padding:13px 12px 9px!important;
  }
  .reference-footer-brand .brand-logo-mark,
  .page-home .reference-footer-brand .brand-logo-mark{
    width:53px!important;
    height:51px!important;
    min-width:53px!important;
  }
  .reference-footer-brand>p,
  .page-home .reference-footer-brand>p{
    margin-left:66px!important;
  }
}

@media (max-width:680px){
  :root{--gpcs-balanced-shell:calc(100% - 12px)}
  .reference-footer-shell,
  .page-home .reference-footer-shell{
    padding:12px 8px 9px!important;
  }
  .reference-footer-brand .brand-logo-mark,
  .page-home .reference-footer-brand .brand-logo-mark{
    width:42px!important;
    height:42px!important;
    min-width:42px!important;
  }
  .reference-footer-brand strong,
  .page-home .reference-footer-brand strong{
    font-size:.94rem!important;
  }
  .reference-footer-brand small,
  .page-home .reference-footer-brand small{
    font-size:.50rem!important;
  }
  .reference-footer-brand>p,
  .page-home .reference-footer-brand>p{
    margin:6px 0 0!important;
  }
}

</style>
<style id="gpcs-footer-classic-restore-v2">
/* =========================================================
   GPCS FOOTER — RESTORE PRE-STANDALONE-ADMIN VISUAL
   Visual source: the approved footer before the standalone ©
   admin trigger was introduced. Admin logic remains intact.
   ========================================================= */
.page-home .site-footer.reference-footer,
.site-footer.reference-footer{
  position:relative!important;
  margin:0!important;
  padding:0!important;
  background:linear-gradient(180deg,#073a83,#03245d)!important;
  border-top:3px solid #f5bf20!important;
  color:#eaf4ff!important;
  box-shadow:0 -8px 26px rgba(8,46,102,.14)!important;
  overflow:visible!important;
}
.page-home .site-footer.reference-footer:before,
.site-footer.reference-footer:before{
  content:""!important;
  position:absolute!important;
  top:-8px!important;
  left:0!important;
  right:0!important;
  height:8px!important;
  background:linear-gradient(90deg,#f3bf1e 0 12%,#0ca1ff 22% 78%,#f3bf1e 88% 100%)!important;
  clip-path:polygon(0 70%,18% 10%,48% 54%,78% 8%,100% 68%,100% 100%,0 100%)!important;
  box-shadow:none!important;
  opacity:1!important;
}
.page-home .reference-footer-shell,
.reference-footer-shell{
  width:min(calc(100% - 72px),1392px)!important;
  max-width:1392px!important;
  margin:0 auto!important;
  padding:13px 6px 7px!important;
  box-sizing:border-box!important;
}
.page-home .reference-footer-grid,
.reference-footer-grid{
  display:grid!important;
  width:100%!important;
  grid-template-columns:minmax(280px,.82fr) minmax(0,1.78fr)!important;
  column-gap:clamp(28px,4vw,68px)!important;
  row-gap:0!important;
  align-items:start!important;
}
.page-home .reference-footer-brand,
.reference-footer-brand{
  position:relative!important;
  min-width:0!important;
  padding:0!important;
}
.page-home .reference-footer-brand .footer-brand,
.reference-footer-brand .footer-brand{
  display:flex!important;
  align-items:center!important;
  gap:11px!important;
  margin:0!important;
}
.page-home .reference-footer-brand .brand-logo-mark,
.reference-footer-brand .brand-logo-mark{
  width:82px!important;
  height:66px!important;
  min-width:82px!important;
  flex:0 0 82px!important;
  background:transparent!important;
  border-radius:0!important;
  box-shadow:none!important;
}
.page-home .reference-footer-brand .brand-logo-mark:after,
.reference-footer-brand .brand-logo-mark:after{display:none!important}
.page-home .reference-footer-brand .brand-logo-mark img,
.reference-footer-brand .brand-logo-mark img{
  width:100%!important;
  height:100%!important;
  object-fit:contain!important;
}
.page-home .reference-footer-brand strong,
.reference-footer-brand strong{
  color:#fff!important;
  font-size:1.2rem!important;
  line-height:1.12!important;
  letter-spacing:normal!important;
}
.page-home .reference-footer-brand small,
.reference-footer-brand small{
  color:#cfe5ff!important;
  font-size:.58rem!important;
  line-height:normal!important;
  margin-top:0!important;
}
.page-home .reference-footer-brand>p,
.reference-footer-brand>p{
  margin:7px 0 0 93px!important;
  max-width:none!important;
  color:#ffd148!important;
  font-size:.54rem!important;
  line-height:1.4!important;
  font-weight:750!important;
}
.page-home .reference-footer-links,
.reference-footer-links{
  width:100%!important;
  min-width:0!important;
  padding-top:0!important;
}
.page-home .reference-footer-links>h3,
.reference-footer-links>h3,
.page-home .reference-footer h3{
  display:block!important;
  width:100%!important;
  margin:0 0 8px!important;
  padding:0!important;
  color:#fff!important;
  font-size:.66rem!important;
  line-height:normal!important;
  font-weight:700!important;
  letter-spacing:normal!important;
}
.page-home .reference-footer-links>h3:after,
.reference-footer-links>h3:after{display:none!important}
.page-home .footer-link-columns,
.footer-link-columns{
  display:grid!important;
  width:100%!important;
  grid-template-columns:repeat(3,minmax(0,1fr))!important;
  column-gap:clamp(24px,5vw,86px)!important;
  row-gap:4px!important;
  align-items:start!important;
}
.footer-link-columns>div{
  display:grid!important;
  gap:4px!important;
  width:100%!important;
  min-width:0!important;
  grid-template-columns:1fr!important;
}
.page-home .footer-link-columns a,
.footer-link-columns a{
  position:static!important;
  display:block!important;
  width:max-content!important;
  max-width:100%!important;
  min-height:0!important;
  padding:0!important;
  color:#d4e8ff!important;
  font-size:.53rem!important;
  line-height:normal!important;
  font-weight:400!important;
  text-decoration:none!important;
  transition:.18s!important;
}
.footer-link-columns a:before{display:none!important}
.footer-link-columns a:hover,
.footer-link-columns a:focus-visible{
  color:#fff!important;
  transform:translateX(2px)!important;
}
.page-home .reference-footer-bottom,
.reference-footer-bottom{
  position:relative!important;
  display:flex!important;
  align-items:center!important;
  justify-content:space-between!important;
  gap:16px!important;
  clear:both!important;
  box-sizing:border-box!important;
  min-height:38px!important;
  margin-top:7px!important;
  padding:7px 72px 10px 0!important;
  border-top:1px solid rgba(255,255,255,.17)!important;
}
.page-home .reference-footer-bottom p,
.reference-footer-bottom p{
  position:relative!important;
  z-index:1!important;
  width:auto!important;
  max-width:100%!important;
  margin:0!important;
  padding:0!important;
  color:#bed8f5!important;
  font-size:.48rem!important;
  line-height:normal!important;
  white-space:normal!important;
  overflow-wrap:anywhere!important;
}
.reference-footer-bottom p:last-child{
  padding-right:10px!important;
  text-align:right!important;
  color:#bed8f5!important;
}
.reference-footer-bottom span{
  display:inline!important;
  margin:0 7px!important;
  color:#57b9ff!important;
}
.page-home .reference-back-top,
.reference-back-top{
  position:absolute!important;
  right:24px!important;
  bottom:18px!important;
  width:38px!important;
  height:38px!important;
  border-radius:999px!important;
  display:grid!important;
  place-items:center!important;
  color:#fff!important;
  background:linear-gradient(145deg,#0a67e4,#0d8bff)!important;
  border:1px solid #7bc7ff!important;
  box-shadow:0 8px 18px rgba(0,38,100,.25)!important;
  font-size:1rem!important;
  font-weight:900!important;
  z-index:4!important;
  transform:none!important;
}
/* Hidden Admin trigger: separate standalone element, but removed from
   normal layout so the classic footer keeps exactly its old balance. */
.gpcs-standalone-admin-trigger{
  position:absolute!important;
  left:31px!important;
  top:61px!important;
  z-index:6!important;
  display:flex!important;
  align-items:center!important;
  justify-content:center!important;
  width:30px!important;
  height:26px!important;
  margin:0!important;
  padding:0!important;
  border:0!important;
  background:transparent!important;
  color:#cfe5ff!important;
  font:700 9px/1 system-ui,-apple-system,"Segoe UI",sans-serif!important;
  opacity:.46!important;
  text-decoration:none!important;
  cursor:default!important;
  user-select:none!important;
  -webkit-user-select:none!important;
  touch-action:manipulation!important;
}
.gpcs-standalone-admin-trigger:hover,
.gpcs-standalone-admin-trigger:focus,
.gpcs-standalone-admin-trigger:active{
  color:#cfe5ff!important;
  opacity:.46!important;
  background:transparent!important;
  outline:none!important;
  box-shadow:none!important;
  text-decoration:none!important;
  transform:none!important;
}
@media(max-width:900px){
  .page-home .reference-footer-shell,.reference-footer-shell{
    width:calc(100% - 28px)!important;
  }
  .page-home .reference-footer-grid,.reference-footer-grid{
    grid-template-columns:1fr!important;
    row-gap:20px!important;
  }
  .page-home .footer-link-columns,.footer-link-columns{
    grid-template-columns:repeat(3,minmax(0,1fr))!important;
    column-gap:clamp(18px,5vw,54px)!important;
  }
  .reference-footer-bottom,.page-home .reference-footer-bottom{
    padding-right:64px!important;
    padding-bottom:12px!important;
  }
  .reference-back-top,.page-home .reference-back-top{
    right:16px!important;
    bottom:16px!important;
  }
}
@media(max-width:680px){
  .page-home .reference-footer-shell,.reference-footer-shell{
    width:calc(100% - 16px)!important;
    padding:15px 3px 7px!important;
  }
  .page-home .reference-footer-grid,.reference-footer-grid{
    grid-template-columns:1fr!important;
  }
  .page-home .reference-footer-brand>p,.reference-footer-brand>p{
    margin-left:0!important;
  }
  /* On compact screens keep the symbol tucked into the logo/text seam,
     not in the tagline flow. */
  .gpcs-standalone-admin-trigger{
    left:66px!important;
    top:45px!important;
    width:30px!important;
    height:28px!important;
    font-size:9px!important;
  }
  .page-home .footer-link-columns,.footer-link-columns{
    grid-template-columns:repeat(2,minmax(0,1fr))!important;
    column-gap:22px!important;
    row-gap:10px!important;
  }
  .footer-link-columns>div:last-child{
    grid-column:auto!important;
    grid-template-columns:1fr!important;
  }
  .reference-footer-bottom,.page-home .reference-footer-bottom{
    align-items:flex-start!important;
    flex-direction:column!important;
    min-height:72px!important;
    gap:6px!important;
    padding:7px 58px 16px 0!important;
  }
  .reference-footer-bottom p,.page-home .reference-footer-bottom p{
    width:100%!important;
    text-align:left!important;
  }
  .reference-footer-bottom span{display:inline!important}
  .reference-back-top,.page-home .reference-back-top{
    width:38px!important;
    height:38px!important;
    right:12px!important;
    bottom:14px!important;
  }
}
@media(max-width:390px){
  .page-home .footer-link-columns,.footer-link-columns{
    grid-template-columns:1fr!important;
  }
}
</style>

</head>
<body class="page-home" id="top">
<div class="bg-orb orb-a"></div><div class="bg-orb orb-b"></div>
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
<a aria-label="GPCS Portal home" class="brand reference-brand" href="index.php?page=home">
<span class="brand-mark brand-logo-mark logo-interactive" role="button" tabindex="0" aria-label="View GPCS Portal logo. Double tap for GPCS Sign In." title="Tap to view logo • Double tap for GPCS Sign In"><img alt="" src="/assets/gpcs-embedded-ad9f7f204988.webp"/></span>
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
<a aria-label="GPCS Sign In" class="gpcs-signin-btn reference-signin" href="index.php?page=login">
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
<a class="nav-link nav-important active" href="index.php?page=home"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"></path><path d="M5.5 10.5V20h13v-9.5"></path><path d="M9.5 20v-5h5v5"></path></svg></span><span>Home</span></a>
<a class="nav-link nav-student nav-external" href="https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20a7 7 0 0 1 14 0"></path></svg></span><span>Student Login</span></a>
<a class="nav-link nav-academic nav-external" href="https://www.rgpvdiploma.in/Academics/AICTEBased.aspx" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"></path></svg></span><span>Syllabus</span></a>
<a class="nav-link nav-library" href="index.php?page=papers"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 4h11a3 3 0 0 1 3 3v12H8a3 3 0 0 1-3-3z"></path><path d="M8 19a3 3 0 0 0 0-6h11"></path><path d="M8 7h7M8 10h6"></path></svg></span><span>Paper Library</span></a>
<a class="nav-link nav-previous nav-external" href="https://www.polygwalior.ac.in/diploma_papers.php" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="15" rx="2" width="17" x="3.5" y="5"></rect><path d="M7 3v4M17 3v4M3.5 9.5h17"></path></svg></span><span>Previous Year Paper</span></a>
<a class="nav-link nav-upload" href="index.php?page=login"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><span>Upload Paper</span><span aria-hidden="true" class="nav-upload-arrow">→</span></a>
<a class="nav-link nav-result nav-external" href="https://result.rgpv.ac.in/Result/Diplomarslt.aspx" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M8 4h8v4a4 4 0 0 1-8 0z"></path><path d="M8 6H4v1a4 4 0 0 0 4 4M16 6h4v1a4 4 0 0 1-4 4M12 12v4M8.5 20h7M10 16h4"></path></svg></span><span>Main Result</span></a>
<a class="nav-link nav-result nav-external" href="https://result.rgpv.ac.in/Result/ProgramSelect.aspx" rel="noopener noreferrer" target="_blank"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 20V10M12 20V4M19 20v-7"></path></svg></span><span>All Result</span></a>
<a class="nav-link nav-notes" href="index.php?page=notes"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><span>Notes</span></a>
<a class="nav-link nav-more" href="index.php?page=gallery"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="4"></rect><circle cx="9" cy="9" r="2"></circle><path d="m5 18 5-5 3 3 2-2 4 4"></path></svg></span><span>Gallery</span></a>
<a class="nav-link nav-more" href="index.php?page=about"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 11v6M12 7h.01"></path></svg></span><span>About Us</span></a>
<a class="nav-link nav-more" href="index.php?page=contact"><span class="nav-ico"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="14" rx="2" width="18" x="3" y="5"></rect><path d="m4 7 8 6 8-6"></path></svg></span><span>Contact Us</span></a>
</nav>
</div>
</header>
<main>
<div class="gpcs-preview-view is-active" id="gpcsHomeView" data-route-view="home">
<section class="reference-home-hero">
<div class="container reference-hero-shell">
<div class="reference-hero-overlay"></div>
<div class="reference-hero-content">
<div class="reference-welcome-badge"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="m3 9 9-5 9 5-9 5z"></path><path d="M7 12v4c3 2 7 2 10 0v-4M21 9v6"></path></svg> <span>Welcome to</span></div>
<h1><span>GPCS</span> <strong>Portal</strong></h1>
<h2>Government Polytechnic College, Shivpuri</h2>
<p>Your one-stop destination for Syllabus, Question Papers, Results, Notes, Gallery and more.<br/><em>Empowering Students, Strengthening Education.</em></p>
<div class="reference-hero-actions">
<a class="reference-cta reference-cta-primary" href="index.php?page=login"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg> <span>Upload Paper</span><b>→</b></a>
<a class="reference-cta reference-cta-outline" href="index.php?page=papers"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"></path></svg> <span>Browse Library</span></a>
</div>
</div>
<aside aria-label="College message" class="reference-quote-card">
<span class="quote-mark">“</span>
<p>Dream, dream, dream. Dreams transform into thoughts and thoughts result in action.</p>
<small>— A. P. J. Abdul Kalam</small>
</aside>
</div>
</section>
<section class="reference-stat-wrap">
<div class="container reference-stat-strip">
<div class="reference-stat-item stat-blue"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><div><strong>0</strong><small>Question Papers</small></div></div>
<div class="reference-stat-item stat-green"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><ellipse cx="12" cy="5" rx="7" ry="3"></ellipse><path d="M5 5v6c0 1.7 3.1 3 7 3s7-1.3 7-3V5M5 11v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"></path></svg></span><div><strong>141</strong><small>Master Subjects</small></div></div>
<div class="reference-stat-item stat-orange"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><div><strong>100 MB</strong><small>Max Upload Size</small></div></div>
<div class="reference-stat-item stat-purple"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"></path><path d="M5.5 10.5V20h13v-9.5"></path><path d="M9.5 20v-5h5v5"></path></svg></span><div><strong>4</strong><small>Branches</small></div></div>
<div class="reference-stat-item stat-cyan"><span class="stat-icon"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 3 19 6v5c0 4.7-2.8 8-7 10-4.2-2-7-5.3-7-10V6z"></path><path d="m9 12 2 2 4-4"></path></svg></span><div><strong>Public</strong><small>Paper Access</small></div></div>
</div>
</section>
<section class="reference-dashboard-section">
<div class="container reference-dashboard-grid">
<section class="reference-panel quick-panel">
<div class="reference-panel-head"><span class="panel-icon rocket"><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M14 4c3-1 5-1 6-1 0 1 0 3-1 6l-5 5-4-4z"></path><path d="M10 10 5 9l-2 2 5 3M14 14l1 5-2 2-3-5M7 17l-3 3"></path></svg></span><div><h2>Quick Access</h2><p>Everything you need, just one click away</p></div></div>
<div class="reference-quick-grid">
<a class="reference-quick-card quick-blue" href="https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20a7 7 0 0 1 14 0"></path></svg></span><div><b>Student Login</b><small>Official portal</small></div><i>→</i></a>
<a class="reference-quick-card quick-teal" href="https://www.rgpvdiploma.in/Academics/AICTEBased.aspx" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5z"></path></svg></span><div><b>Syllabus</b><small>Official syllabus</small></div><i>→</i></a>
<a class="reference-quick-card quick-purple" href="index.php?page=papers"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 4h11a3 3 0 0 1 3 3v12H8a3 3 0 0 1-3-3z"></path><path d="M8 19a3 3 0 0 0 0-6h11"></path><path d="M8 7h7M8 10h6"></path></svg></span><div><b>Paper Library</b><small>Search papers</small></div><i>→</i></a>
<a class="reference-quick-card quick-red" href="https://www.polygwalior.ac.in/diploma_papers.php" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="15" rx="2" width="17" x="3.5" y="5"></rect><path d="M7 3v4M17 3v4M3.5 9.5h17"></path></svg></span><div><b>Previous Year</b><small>Question papers</small></div><i>→</i></a>
<a class="reference-quick-card quick-green" href="index.php?page=login"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M12 16V4"></path><path d="m7 9 5-5 5 5"></path><path d="M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4"></path></svg></span><div><b>Upload Paper</b><small>Share a paper</small></div><i>→</i></a>
<a class="reference-quick-card quick-gold" href="https://result.rgpv.ac.in/Result/Diplomarslt.aspx" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M8 4h8v4a4 4 0 0 1-8 0z"></path><path d="M8 6H4v1a4 4 0 0 0 4 4M16 6h4v1a4 4 0 0 1-4 4M12 12v4M8.5 20h7M10 16h4"></path></svg></span><div><b>Main Result</b><small>Official result</small></div><i>→</i></a>
<a class="reference-quick-card quick-violet" href="https://result.rgpv.ac.in/Result/ProgramSelect.aspx" rel="noopener noreferrer" target="_blank"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><path d="M5 20V10M12 20V4M19 20v-7"></path></svg></span><div><b>All Result</b><small>Complete results</small></div><i>→</i></a>
<a class="reference-quick-card quick-pink" href="index.php?page=notes"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="18" rx="2" width="14" x="5" y="3"></rect><path d="M8 8h8M8 12h8M8 16h5"></path></svg></span><div><b>Notes</b><small>Study resources</small></div><i>→</i></a>
<a class="reference-quick-card quick-sky" href="index.php?page=gallery"><span><svg aria-hidden="true" class="ui-svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="4"></rect><circle cx="9" cy="9" r="2"></circle><path d="m5 18 5-5 3 3 2-2 4 4"></path></svg></span><div><b>Gallery</b><small>College activities</small></div><i>→</i></a>
</div>
</section>

</div>
</section>
</main>

</div>

<section class="gpcs-preview-view gpcs-route-view" id="gpcsRouteView" aria-live="polite" hidden>
  <div class="gpcs-route-shell" id="gpcsRouteShell"></div>
</section>
<footer class="site-footer reference-footer">
<div class="container reference-footer-shell">
<div class="reference-footer-grid">
<div class="reference-footer-brand">
<div class="brand footer-brand">
<span class="brand-mark brand-logo-mark logo-interactive" role="button" tabindex="0" aria-label="View GPCS Portal logo. Double tap for GPCS Sign In." title="Tap to view logo • Double tap for GPCS Sign In"><img alt="" src="/assets/gpcs-embedded-ad9f7f204988.webp"/></span>
<span><strong>GPCS Portal<span id="gpcs-brand-admin-trigger" class="gpcs-brand-admin-trigger" aria-hidden="true">©</span></strong><small>Government Polytechnic College, Shivpuri</small></span>
</div>
<p>“Empowering Polytechnic Students,<br/>Building Better Futures.”</p>
</div>
<div class="reference-footer-links">
<h3>Quick Links</h3>
<div class="footer-link-columns">
<div><a href="index.php?page=home">Home</a><a href="index.php?page=papers">Paper Library</a><a href="index.php?page=login">Upload Paper</a><a href="index.php?page=notes">Notes</a></div>
<div><a href="https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx" rel="noopener noreferrer" target="_blank">Student Login</a><a href="https://www.polygwalior.ac.in/diploma_papers.php" rel="noopener noreferrer" target="_blank">Previous Year</a><a href="https://result.rgpv.ac.in/Result/Diplomarslt.aspx" rel="noopener noreferrer" target="_blank">Main Result</a><a href="index.php?page=gallery">Gallery</a></div>
<div><a href="https://www.rgpvdiploma.in/Academics/AICTEBased.aspx" rel="noopener noreferrer" target="_blank">Syllabus</a><a href="https://result.rgpv.ac.in/Result/ProgramSelect.aspx" rel="noopener noreferrer" target="_blank">All Result</a><a href="index.php?page=about">About Us</a><a href="index.php?page=contact">Contact Us</a></div>
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


<style id="gpcs-brand-admin-trigger-style">
/* Hidden Admin entry integrated into footer brand: GPCS Portal© */
.gpcs-brand-admin-trigger{
  position:relative!important;display:inline-block!important;margin-left:1px!important;padding:0!important;
  width:auto!important;height:auto!important;font:inherit!important;font-size:.72em!important;line-height:1!important;
  vertical-align:.18em!important;color:inherit!important;opacity:.82!important;background:transparent!important;
  border:0!important;text-decoration:none!important;cursor:default!important;user-select:none!important;
  -webkit-user-select:none!important;touch-action:manipulation!important;
}
.gpcs-brand-admin-trigger::before{content:"";position:absolute;inset:-9px -8px;}
.gpcs-brand-admin-trigger:hover,.gpcs-brand-admin-trigger:focus,.gpcs-brand-admin-trigger:active{
  color:inherit!important;opacity:.82!important;background:transparent!important;outline:none!important;
  box-shadow:none!important;text-decoration:none!important;
}
</style>

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
    <img src="/assets/gpcs-embedded-628bb00a48b0.webp" alt="GPCS Portal — Government Polytechnic College, Shivpuri logo">
    <div class="gpcs-logo-hint">Double tap the logo for GPCS Sign In</div>
  </div>
</div>

<script>(() => {
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
</script>
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


<style>
.auth-preview-shell{max-width:1120px}.auth-preview-toggle-wrap{display:flex;justify-content:center;margin:0 auto 18px}.auth-preview-toggle{width:min(430px,100%);min-height:54px;display:grid;grid-template-columns:minmax(92px,1fr) 66px minmax(120px,1fr);align-items:center;gap:12px;padding:7px 14px;border:1px solid #cbdff5;border-radius:16px;background:rgba(232,242,255,.92);color:#18406f;font:inherit;font-weight:900;cursor:pointer;box-shadow:0 7px 18px rgba(8,87,214,.09);touch-action:manipulation;-webkit-tap-highlight-color:transparent;transition:border-color .2s ease,box-shadow .2s ease,transform .14s ease}.auth-preview-toggle:hover{border-color:#9fc8f5;box-shadow:0 10px 24px rgba(8,87,214,.14)}.auth-preview-toggle:active{transform:scale(.99)}.auth-preview-toggle:focus-visible{outline:3px solid rgba(12,116,255,.25);outline-offset:3px}.auth-preview-toggle-state{color:#075ed8;text-align:right;transition:color .2s ease}.auth-preview-toggle-hint{color:#60758e;text-align:left;font-size:.84rem;line-height:1.15}.auth-preview-toggle-track{position:relative;width:62px;height:32px;border-radius:999px;background:linear-gradient(135deg,#0750d3,#0c74ff);box-shadow:inset 0 0 0 1px rgba(255,255,255,.18),0 5px 14px rgba(8,87,214,.22)}.auth-preview-toggle-thumb{position:absolute;top:4px;left:4px;width:24px;height:24px;border-radius:50%;background:#fff;box-shadow:0 3px 9px rgba(5,35,78,.28);transition:transform .24s cubic-bezier(.2,.8,.2,1)}.auth-preview-toggle.is-faculty .auth-preview-toggle-thumb{transform:translateX(30px)}.auth-preview-toggle.is-faculty .auth-preview-toggle-state{color:#7a4d00}.auth-preview-grid{align-items:start}.auth-preview-head h2{margin:8px 0 4px}.auth-preview-head p{margin:0 0 13px}.auth-preview-methods{display:flex;gap:7px;margin:12px 0}.auth-preview-methods .route-btn{flex:1}.auth-preview-register{text-align:center;margin:14px 0 0!important}.link-button{appearance:none;border:0;background:transparent;padding:0;color:#075ed8;font:inherit;font-weight:900;cursor:pointer}.auth-preview-linkrow{text-align:right;margin-top:-4px}.auth-preview-info{min-height:230px}.auth-preview-registration{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:11px}.auth-preview-registration>[data-student-fields],.auth-preview-registration>[data-faculty-fields]{display:contents}.auth-preview-registration .route-actions,.auth-preview-check{grid-column:1/-1}.auth-preview-check{display:flex!important;align-items:center;gap:8px;padding:10px;border:1px solid rgba(111,159,210,.28);border-radius:12px}.auth-preview-check input{width:auto!important}.otp-demo-field small{color:#6d829a}.auth-preview-admin{margin-top:14px}.auth-preview-admin summary{cursor:pointer;font-weight:900;color:#0b58c6}.auth-preview-role[hidden],.auth-preview-register-panel[hidden],.auth-preview-reset-panel[hidden],[data-auth-method-panel][hidden],[data-student-fields][hidden],[data-faculty-fields][hidden]{display:none!important}html[data-theme="dark"] .auth-preview-toggle{background:#0d1e33;border-color:#2d4b6c;color:#d8e6f5}html[data-theme="dark"] .auth-preview-toggle:hover{border-color:#41698f}html[data-theme="dark"] .auth-preview-toggle-state{color:#79b9ff}html[data-theme="dark"] .auth-preview-toggle.is-faculty .auth-preview-toggle-state{color:#f0bd66}html[data-theme="dark"] .auth-preview-toggle-hint{color:#b8c9dc}html[data-theme="dark"] .link-button{color:#79b9ff}@media(max-width:700px){.auth-preview-toggle{grid-template-columns:minmax(74px,1fr) 62px minmax(92px,1.1fr);gap:8px;padding:7px 10px}.auth-preview-toggle-hint{font-size:.76rem}.auth-preview-registration{grid-template-columns:1fr}.auth-preview-registration .route-actions,.auth-preview-check{grid-column:auto}.auth-preview-methods{flex-direction:column}}
</style>
<style id="gpcs-signin-ui-refinement">
/* =========================================================
   GPCS Sign In — UI/UX refinement
   Scope: Sign In / Registration / Reset panels only.
   ========================================================= */
.auth-preview-shell{
  width:min(100%,1080px);
  margin-inline:auto;
  position:relative;
}
.auth-preview-shell::before{
  content:"";
  position:absolute;
  inset:-10px -12px auto;
  height:180px;
  border-radius:28px;
  background:
    radial-gradient(circle at 20% 15%,rgba(12,116,255,.10),transparent 42%),
    radial-gradient(circle at 86% 12%,rgba(43,154,255,.08),transparent 38%);
  pointer-events:none;
  z-index:0;
}
.auth-preview-shell>*{position:relative;z-index:1}
.auth-preview-toggle-wrap{margin:0 auto 22px}
.auth-preview-toggle{
  width:min(410px,100%);
  min-height:58px;
  grid-template-columns:minmax(86px,1fr) 66px minmax(112px,1.15fr);
  gap:11px;
  padding:8px 14px;
  border-radius:999px;
  border:1px solid rgba(119,171,230,.48);
  background:linear-gradient(180deg,rgba(255,255,255,.98),rgba(239,247,255,.98));
  box-shadow:0 12px 30px rgba(14,75,150,.12),inset 0 1px 0 rgba(255,255,255,.9);
}
.auth-preview-toggle:hover{transform:translateY(-1px);box-shadow:0 16px 34px rgba(14,75,150,.17)}
.auth-preview-toggle-state{font-size:.92rem;letter-spacing:-.01em}
.auth-preview-toggle-hint{font-size:.75rem;font-weight:800;color:#6b8099}
.auth-preview-toggle-track{
  width:64px;height:34px;
  background:linear-gradient(135deg,#0757da,#0b7cff);
  box-shadow:inset 0 0 0 1px rgba(255,255,255,.24),0 7px 18px rgba(9,92,218,.25);
}
.auth-preview-toggle-thumb{top:4px;left:4px;width:26px;height:26px}
.auth-preview-toggle.is-faculty .auth-preview-toggle-thumb{transform:translateX(30px)}
.auth-preview-grid{
  grid-template-columns:minmax(0,1.12fr) minmax(290px,.88fr);
  gap:18px;
  align-items:stretch;
}
.auth-preview-grid>.route-card,
.auth-preview-register-panel>.route-card,
.auth-preview-reset-panel>.route-card,
.auth-preview-admin{
  border-radius:22px;
  border-color:#d4e5f7;
  box-shadow:0 14px 34px rgba(15,73,139,.08);
}
.auth-preview-grid>.route-card:first-child{
  padding:24px;
  background:linear-gradient(180deg,#ffffff 0%,#fbfdff 100%);
  border-color:#c7ddf5;
}
.auth-preview-head{padding-bottom:4px}
.auth-preview-head .route-status{font-size:.64rem;letter-spacing:.025em}
.auth-preview-head h2{font-size:1.45rem;letter-spacing:-.025em;color:#103c77}
.auth-preview-head p{font-size:.83rem;line-height:1.55;color:#6b819e}
.auth-preview-methods{
  gap:6px;
  padding:5px;
  margin:14px 0 17px;
  border:1px solid #d7e6f6;
  border-radius:15px;
  background:#f2f7fd;
}
.auth-preview-methods .route-btn{
  min-height:44px;
  border-radius:11px;
  box-shadow:none;
}
.auth-preview-methods .route-btn.primary{box-shadow:0 8px 20px rgba(8,99,226,.20)}
.auth-preview-shell .route-form{gap:14px}
.auth-preview-shell .route-form label{gap:7px;font-size:.76rem;color:#244a78}
.auth-preview-shell .route-form input,
.auth-preview-shell .route-form select,
.auth-preview-shell .route-form textarea{
  min-height:48px;
  border-radius:13px;
  border-color:#c8dbee;
  background:#fff;
  padding:12px 13px;
  font-size:.86rem;
  transition:border-color .18s ease,box-shadow .18s ease,background .18s ease;
}
.auth-preview-shell .route-form textarea{min-height:92px;resize:vertical}
.auth-preview-shell .route-form input:focus,
.auth-preview-shell .route-form select:focus,
.auth-preview-shell .route-form textarea:focus{
  border-color:#368df1;
  box-shadow:0 0 0 4px rgba(54,141,241,.12);
}
.auth-preview-linkrow{margin-top:-3px}
.auth-preview-linkrow .link-button,.auth-preview-register .link-button{text-underline-offset:3px}
.auth-preview-register{
  margin-top:17px!important;
  padding-top:15px;
  border-top:1px solid #e3edf7;
  color:#6d8098!important;
}
.auth-preview-info{
  min-height:100%;
  padding:24px;
  background:
    linear-gradient(145deg,rgba(240,247,255,.98),rgba(255,255,255,.98)),
    #fff;
  border-color:#d5e6f8!important;
}
.auth-preview-info h3{font-size:1.08rem;margin-bottom:10px!important}
.auth-preview-info p{font-size:.84rem;line-height:1.7}
.auth-preview-info .admin-security-note{margin-top:16px;border-radius:14px}
.auth-preview-register-panel>.route-card,.auth-preview-reset-panel>.route-card{padding:24px}
.auth-preview-registration{gap:14px 16px}
.auth-preview-registration .route-actions{padding-top:3px}
.auth-preview-registration .route-actions .route-btn{min-width:160px}
.auth-preview-check{
  min-height:48px;
  border-color:#d7e5f3;
  background:#f8fbff;
  padding:11px 13px;
  border-radius:13px;
}
.auth-preview-check>span{font-size:.78rem;font-weight:800;color:#355675}
.auth-field-required,.auth-field-optional{
  display:inline-flex;
  align-items:center;
  width:max-content;
  margin-left:4px;
  padding:2px 7px;
  border-radius:999px;
  font-size:.56rem;
  font-style:normal;
  font-weight:900;
  letter-spacing:.035em;
  text-transform:uppercase;
  vertical-align:middle;
}
.auth-field-required{background:#e9f3ff;color:#0759c8;border:1px solid #c9e0fb}
.auth-field-optional{background:#f2f5f8;color:#6d7d8d;border:1px solid #dce4ec}
.auth-preview-admin{overflow:hidden;background:linear-gradient(180deg,#fff,#f8fbff)}
.auth-preview-admin summary{padding:2px 0;color:#175ab6}
html[data-theme="dark"] .auth-preview-shell::before{
  background:radial-gradient(circle at 20% 15%,rgba(48,132,255,.12),transparent 42%),radial-gradient(circle at 86% 12%,rgba(80,177,255,.08),transparent 38%);
}
html[data-theme="dark"] .auth-preview-toggle{
  background:linear-gradient(180deg,#122942,#0d2035);
  border-color:#345675;
  box-shadow:0 14px 32px rgba(0,0,0,.24),inset 0 1px 0 rgba(255,255,255,.04);
}
html[data-theme="dark"] .auth-preview-grid>.route-card:first-child,
html[data-theme="dark"] .auth-preview-info,
html[data-theme="dark"] .auth-preview-register-panel>.route-card,
html[data-theme="dark"] .auth-preview-reset-panel>.route-card,
html[data-theme="dark"] .auth-preview-admin{background:linear-gradient(180deg,#0e2238,#0b1c30);border-color:#2d4c69}
html[data-theme="dark"] .auth-preview-methods{background:#091a2d;border-color:#294866}
html[data-theme="dark"] .auth-preview-register{border-color:#29445f;color:#9fb4ca!important}
html[data-theme="dark"] .auth-preview-check{background:#0a1c30;border-color:#2a4864}
html[data-theme="dark"] .auth-preview-check>span{color:#c9d9e9}
html[data-theme="dark"] .auth-field-required{background:#113c6c;color:#9fd0ff;border-color:#285c8c}
html[data-theme="dark"] .auth-field-optional{background:#16283a;color:#adbdcd;border-color:#30485f}
@media(max-width:900px){
  .auth-preview-grid{grid-template-columns:1fr;gap:14px}
  .auth-preview-info{min-height:auto}
}
@media(max-width:700px){
  .auth-preview-toggle{grid-template-columns:minmax(70px,1fr) 62px minmax(88px,1.1fr);min-height:54px;padding:7px 10px}
  .auth-preview-toggle-state{font-size:.82rem}
  .auth-preview-toggle-hint{font-size:.68rem}
  .auth-preview-grid>.route-card:first-child,.auth-preview-info,.auth-preview-register-panel>.route-card,.auth-preview-reset-panel>.route-card{padding:18px}
  .auth-preview-registration{grid-template-columns:1fr;gap:12px}
  .auth-preview-registration .route-actions,.auth-preview-check{grid-column:auto}
  .auth-preview-methods{flex-direction:row}
}
@media(max-width:460px){
  .auth-preview-toggle{grid-template-columns:1fr 56px 1fr;gap:7px}
  .auth-preview-toggle-track{width:56px;height:32px}
  .auth-preview-toggle-thumb{width:24px;height:24px}
  .auth-preview-toggle.is-faculty .auth-preview-toggle-thumb{transform:translateX(24px)}
  .auth-preview-toggle-hint{font-size:.61rem}
  .auth-preview-methods{flex-direction:column}
  .auth-preview-shell .route-btn{width:100%}
  .auth-preview-registration .route-actions{display:grid;grid-template-columns:1fr}
  .auth-preview-registration .route-actions .route-btn{min-width:0}
}
</style>

<style id="gpcs-auth-glass-v2">
/* GPCS Auth Glass v2 — scoped only to Sign In / Sign Up / Reset */
.auth-preview-shell{
  --auth-blue:#0b6ffb;
  --auth-blue-deep:#0758d6;
  --auth-ink:#113d72;
  --auth-muted:#6a819c;
  width:min(100%,920px)!important;
  padding:4px 10px 18px;
  isolation:isolate;
}
.auth-preview-shell::before{
  inset:-18px -10px auto!important;
  height:290px!important;
  border-radius:34px!important;
  background:
    radial-gradient(circle at 16% 18%,rgba(11,111,251,.16),transparent 38%),
    radial-gradient(circle at 84% 8%,rgba(84,191,255,.13),transparent 34%),
    linear-gradient(180deg,rgba(235,246,255,.72),rgba(255,255,255,0))!important;
  filter:saturate(112%);
}
.auth-role-selector-wrap{display:flex;justify-content:center;margin:2px auto 18px}
.auth-role-selector{
  width:min(500px,100%);
  min-height:66px;
  display:grid;
  grid-template-columns:46px minmax(0,1fr) auto;
  align-items:center;
  gap:12px;
  padding:10px 12px;
  border:1px solid rgba(143,185,233,.62);
  border-radius:21px;
  background:linear-gradient(135deg,rgba(255,255,255,.86),rgba(241,248,255,.70));
  color:var(--auth-ink);
  box-shadow:0 14px 38px rgba(20,80,150,.13),inset 0 1px 0 rgba(255,255,255,.95);
  backdrop-filter:blur(18px) saturate(145%);
  -webkit-backdrop-filter:blur(18px) saturate(145%);
  cursor:pointer;
  touch-action:manipulation;
  -webkit-tap-highlight-color:transparent;
  transition:transform .18s ease,border-color .2s ease,box-shadow .2s ease,background .25s ease;
}
.auth-role-selector:hover{transform:translateY(-2px);border-color:rgba(68,141,229,.72);box-shadow:0 18px 42px rgba(20,80,150,.17),inset 0 1px 0 rgba(255,255,255,.95)}
.auth-role-selector:active{transform:translateY(0) scale(.992)}
.auth-role-selector:focus-visible{outline:3px solid rgba(11,111,251,.24);outline-offset:3px}
.auth-role-icon{width:44px;height:44px;display:grid;place-items:center;border-radius:15px;background:linear-gradient(145deg,#0b72ff,#0759d9);box-shadow:0 8px 18px rgba(8,95,220,.25);color:#fff}
.auth-role-svg{width:24px;height:24px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.auth-role-svg-faculty{display:none}
.auth-role-copy{min-width:0;display:flex;flex-direction:column;align-items:flex-start;line-height:1.12;text-align:left}
.auth-role-copy small{font-size:.69rem;font-weight:800;color:#7890aa;letter-spacing:.02em}
.auth-role-copy strong{margin-top:3px;font-size:1.04rem;color:#0a57c9;letter-spacing:-.02em}
.auth-role-action{display:flex;align-items:center;gap:7px;justify-self:end;padding:9px 11px;border-radius:13px;background:rgba(11,111,251,.08);color:#2468b8;font-size:.74rem;font-weight:900;white-space:nowrap}
.auth-role-action svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;transition:transform .22s ease}
.auth-role-selector:hover .auth-role-action svg{transform:translateX(2px)}
.auth-role-selector.is-faculty{background:linear-gradient(135deg,rgba(255,255,255,.88),rgba(255,249,237,.74));border-color:rgba(225,183,111,.58)}
.auth-role-selector.is-faculty .auth-role-icon{background:linear-gradient(145deg,#b77a16,#8a5a0b);box-shadow:0 8px 18px rgba(145,92,12,.22)}
.auth-role-selector.is-faculty .auth-role-svg-student{display:none}
.auth-role-selector.is-faculty .auth-role-svg-faculty{display:block}
.auth-role-selector.is-faculty .auth-role-copy strong{color:#8a5909}
.auth-role-selector.is-faculty .auth-role-action{background:rgba(184,122,22,.09);color:#8a641f}

.auth-preview-role{display:flex;justify-content:center}
.auth-signin-card,.auth-register-card,.auth-reset-card{
  width:min(100%,720px);
  margin-inline:auto;
}
.auth-glass-card{
  position:relative;
  overflow:hidden;
  padding:26px!important;
  border:1px solid rgba(171,204,239,.70)!important;
  border-radius:26px!important;
  background:linear-gradient(145deg,rgba(255,255,255,.90),rgba(247,251,255,.78))!important;
  box-shadow:0 24px 58px rgba(22,76,137,.12),inset 0 1px 0 rgba(255,255,255,.96)!important;
  backdrop-filter:blur(20px) saturate(135%);
  -webkit-backdrop-filter:blur(20px) saturate(135%);
}
.auth-glass-card::before{
  content:"";
  position:absolute;
  width:190px;height:190px;border-radius:50%;
  right:-96px;top:-108px;
  background:radial-gradient(circle,rgba(68,166,255,.13),rgba(68,166,255,0) 68%);
  pointer-events:none;
}
.auth-preview-head{position:relative;z-index:1}
.auth-preview-head h2{font-size:1.55rem!important;margin-top:9px!important;color:#113f79!important}
.auth-preview-head p{font-size:.84rem!important;color:#7187a1!important}
.auth-inline-notice{display:flex;align-items:flex-start;gap:9px;margin:12px 0 2px;padding:10px 12px;border-radius:13px;background:rgba(184,122,22,.08);border:1px solid rgba(184,122,22,.16)}
.auth-inline-notice>span{flex:0 0 20px;width:20px;height:20px;display:grid;place-items:center;border-radius:50%;background:#9c6813;color:#fff;font-size:.72rem;font-weight:900}
.auth-inline-notice p{margin:1px 0 0!important;color:#6e5526!important;font-size:.75rem!important;line-height:1.45!important}
.auth-preview-methods{margin:16px 0 18px!important;padding:5px!important;border-radius:16px!important;background:rgba(235,244,254,.72)!important;border-color:rgba(166,199,236,.65)!important;backdrop-filter:blur(10px)}
.auth-preview-methods .route-btn{min-height:46px!important;border-radius:12px!important}
.auth-preview-shell .route-form{gap:13px}
.auth-preview-shell .route-form label{font-size:.74rem;font-weight:900;color:#21496f;letter-spacing:.005em}
.auth-preview-shell .route-form input,.auth-preview-shell .route-form select,.auth-preview-shell .route-form textarea{
  min-height:46px;
  border-radius:13px!important;
  border:1px solid rgba(160,196,234,.74)!important;
  background:rgba(255,255,255,.72)!important;
  color:#153c67!important;
  box-shadow:inset 0 1px 0 rgba(255,255,255,.82),0 3px 12px rgba(34,94,157,.035);
  backdrop-filter:blur(8px);
  transition:border-color .18s ease,box-shadow .18s ease,background .18s ease;
}
.auth-preview-shell .route-form textarea{min-height:92px}
.auth-preview-shell .route-form input:focus,.auth-preview-shell .route-form select:focus,.auth-preview-shell .route-form textarea:focus{
  outline:none!important;
  border-color:#3a96ff!important;
  background:rgba(255,255,255,.94)!important;
  box-shadow:0 0 0 4px rgba(11,111,251,.10),0 8px 20px rgba(24,90,165,.07)!important;
}
.auth-main-submit{min-height:48px!important;border-radius:13px!important;box-shadow:0 12px 25px rgba(8,95,222,.22)!important}
.auth-preview-register{padding-top:13px;margin-top:16px!important;border-top:1px solid rgba(176,204,234,.52)}
.auth-trust-row{display:flex;justify-content:center;flex-wrap:wrap;gap:8px;margin-top:14px}
.auth-trust-row span{padding:6px 9px;border-radius:999px;background:rgba(225,240,255,.7);border:1px solid rgba(166,201,237,.42);color:#69809a;font-size:.63rem;font-weight:850}
.auth-preview-registration{gap:13px!important}
.auth-register-card .auth-preview-head{padding-bottom:10px}
.auth-register-card .route-actions{margin-top:5px}
.auth-preview-check{border-radius:14px!important;background:rgba(239,247,255,.72)!important;border-color:rgba(174,205,238,.58)!important}
.auth-preview-admin{width:min(100%,720px);margin:14px auto 0;border-radius:18px!important;background:rgba(255,255,255,.65)!important;backdrop-filter:blur(12px)}

html[data-theme="dark"] .auth-preview-shell::before{background:radial-gradient(circle at 16% 18%,rgba(29,117,220,.20),transparent 38%),radial-gradient(circle at 84% 8%,rgba(56,149,215,.12),transparent 34%),linear-gradient(180deg,rgba(12,31,52,.74),rgba(7,19,33,0))!important}
html[data-theme="dark"] .auth-role-selector{background:linear-gradient(135deg,rgba(15,37,61,.88),rgba(10,29,49,.72));border-color:rgba(75,116,157,.62);color:#dbe9f7;box-shadow:0 16px 40px rgba(0,0,0,.25),inset 0 1px 0 rgba(255,255,255,.05)}
html[data-theme="dark"] .auth-role-copy small{color:#8fa8c0}html[data-theme="dark"] .auth-role-copy strong{color:#86bfff}html[data-theme="dark"] .auth-role-action{background:rgba(69,144,224,.12);color:#9ccaff}
html[data-theme="dark"] .auth-role-selector.is-faculty .auth-role-copy strong{color:#f0c374}html[data-theme="dark"] .auth-role-selector.is-faculty .auth-role-action{color:#e6bd72;background:rgba(190,126,25,.12)}
html[data-theme="dark"] .auth-glass-card{background:linear-gradient(145deg,rgba(13,34,56,.90),rgba(9,26,44,.80))!important;border-color:rgba(60,96,132,.72)!important;box-shadow:0 25px 60px rgba(0,0,0,.26),inset 0 1px 0 rgba(255,255,255,.04)!important}
html[data-theme="dark"] .auth-preview-head h2{color:#dcecff!important}html[data-theme="dark"] .auth-preview-head p{color:#9fb4c9!important}html[data-theme="dark"] .auth-preview-shell .route-form label{color:#bad0e5}
html[data-theme="dark"] .auth-preview-shell .route-form input,html[data-theme="dark"] .auth-preview-shell .route-form select,html[data-theme="dark"] .auth-preview-shell .route-form textarea{background:rgba(8,24,40,.72)!important;border-color:rgba(64,100,137,.8)!important;color:#e6f1fc!important}
html[data-theme="dark"] .auth-preview-shell .route-form input:focus,html[data-theme="dark"] .auth-preview-shell .route-form select:focus,html[data-theme="dark"] .auth-preview-shell .route-form textarea:focus{background:rgba(9,28,47,.95)!important;border-color:#4b9fff!important}
html[data-theme="dark"] .auth-preview-methods{background:rgba(11,31,51,.72)!important;border-color:rgba(60,95,131,.68)!important}
html[data-theme="dark"] .auth-trust-row span{background:rgba(19,47,75,.72);border-color:rgba(55,92,129,.55);color:#9db1c7}
html[data-theme="dark"] .auth-preview-check{background:rgba(10,29,48,.76)!important;border-color:rgba(59,95,132,.65)!important}
html[data-theme="dark"] .auth-inline-notice{background:rgba(169,111,20,.10);border-color:rgba(185,129,41,.24)}html[data-theme="dark"] .auth-inline-notice p{color:#d5b77d!important}
html[data-theme="dark"] .auth-preview-admin{background:rgba(11,29,47,.72)!important}

@media(max-width:700px){
  .auth-preview-shell{padding-inline:0!important}
  .auth-role-selector-wrap{margin-bottom:14px}
  .auth-role-selector{grid-template-columns:42px minmax(0,1fr) auto;min-height:62px;padding:9px 10px;border-radius:18px;gap:10px}
  .auth-role-icon{width:40px;height:40px;border-radius:13px}.auth-role-svg{width:22px;height:22px}
  .auth-role-action{padding:8px 9px;font-size:.68rem}.auth-role-action svg{width:14px;height:14px}
  .auth-glass-card{padding:19px!important;border-radius:21px!important}
  .auth-preview-head h2{font-size:1.35rem!important}
  .auth-preview-methods{flex-direction:row!important}
  .auth-trust-row{gap:6px}.auth-trust-row span{font-size:.59rem;padding:5px 8px}
}
@media(max-width:460px){
  .auth-role-selector{grid-template-columns:38px minmax(0,1fr) auto;gap:8px;padding:8px 9px}
  .auth-role-icon{width:38px;height:38px}.auth-role-copy strong{font-size:.94rem}.auth-role-copy small{font-size:.62rem}
  .auth-role-action{max-width:112px;white-space:normal;text-align:left;line-height:1.15}.auth-role-action svg{display:none}
  .auth-preview-methods{flex-direction:column!important}
  .auth-glass-card{padding:16px!important;border-radius:19px!important}
}
@media(prefers-reduced-motion:reduce){.auth-role-selector,.auth-role-action svg,.auth-preview-shell .route-form input,.auth-preview-shell .route-form select,.auth-preview-shell .route-form textarea{transition:none!important}}

/* Standalone hidden Admin entry: visual glyph stays subtle; transparent hit area improves touch reliability. */
.reference-footer-brand{position:relative}
.gpcs-standalone-admin-trigger{
  display:flex;align-items:center;justify-content:center;width:34px;height:28px;
  margin:-1px 0 0 24px;font:700 11px/1 system-ui,-apple-system,Segoe UI,sans-serif;
  color:inherit;opacity:.62;background:transparent;border:0;text-decoration:none;
  cursor:default;user-select:none;-webkit-user-select:none;touch-action:manipulation;
}
.gpcs-standalone-admin-trigger:hover,.gpcs-standalone-admin-trigger:focus,.gpcs-standalone-admin-trigger:active{
  color:inherit;opacity:.62;background:transparent;outline:none;box-shadow:none;text-decoration:none;
}
@media(max-width:600px){.gpcs-standalone-admin-trigger{margin-left:15px;width:32px;height:28px;font-size:10px}}
.gpcs-hidden-admin-dialog{border:0;border-radius:22px;padding:0;max-width:430px;width:min(92vw,430px);background:transparent;color:#102c57}
.gpcs-hidden-admin-dialog::backdrop{background:rgba(3,15,38,.58);backdrop-filter:blur(7px)}
.gpcs-hidden-admin-card{position:relative;padding:30px;border:1px solid rgba(255,255,255,.75);border-radius:22px;background:rgba(249,252,255,.96);box-shadow:0 28px 80px rgba(4,31,73,.28);backdrop-filter:blur(18px)}
.gpcs-hidden-admin-mark{width:48px;height:48px;border-radius:15px;display:grid;place-items:center;background:#1168e8;color:#fff;font-weight:900;margin-bottom:18px}
.gpcs-hidden-admin-dialog h2{margin:0 0 6px;font-size:1.4rem}.gpcs-hidden-admin-dialog p{margin:0 0 20px;color:#61728f}
.gpcs-hidden-admin-dialog label{display:block;font-weight:800;font-size:.84rem;margin:14px 0 7px}
.gpcs-hidden-admin-dialog input{width:100%;box-sizing:border-box;min-height:46px;border:1px solid #c6d8ef;border-radius:12px;padding:0 13px;background:#fff;color:#102c57;outline:none}
.gpcs-hidden-admin-dialog input:focus{border-color:#1673ee;box-shadow:0 0 0 3px rgba(22,115,238,.13)}
.gpcs-hidden-admin-submit{width:100%;margin-top:18px;min-height:46px;border:0;border-radius:12px;background:#1168e8;color:#fff;font-weight:900;cursor:pointer}
.gpcs-hidden-admin-close-form{position:absolute;z-index:3;right:10px;top:10px}.gpcs-hidden-admin-close{width:36px;height:36px;border:0;border-radius:50%;background:rgba(17,104,232,.08);font-size:24px;line-height:1;color:#24496f;cursor:pointer}
.gpcs-hidden-admin-error{padding:10px 12px;border-radius:10px;background:#fff0f0;color:#a42323;font-weight:700;font-size:.88rem}
html[data-theme="dark"] .gpcs-hidden-admin-card{background:rgba(9,26,55,.97);color:#eef7ff;border-color:rgba(125,190,255,.25)}
html[data-theme="dark"] .gpcs-hidden-admin-dialog p{color:#b8cae4}html[data-theme="dark"] .gpcs-hidden-admin-dialog input{background:#0b2347;color:#fff;border-color:#315c8e}
</style>
<script>
(() => {
  const homeView=document.getElementById('gpcsHomeView');
  const routeView=document.getElementById('gpcsRouteView');
  const routeShell=document.getElementById('gpcsRouteShell');
  if(!homeView||!routeView||!routeShell) return;

  const externalPages={
    student:'https://www.rgpvdiploma.in/StudentLife/StudentLogin.aspx',
    syllabus:'https://www.rgpvdiploma.in/Academics/AICTEBased.aspx',
    previous:'https://www.polygwalior.ac.in/diploma_papers.php',
    mainresult:'https://result.rgpv.ac.in/Result/Diplomarslt.aspx',
    allresult:'https://result.rgpv.ac.in/Result/ProgramSelect.aspx'
  };

  const escapeHtml=s=>String(s??'').replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));
  const toast=(msg)=>{let t=document.querySelector('.route-toast');if(!t){t=document.createElement('div');t.className='route-toast';document.body.appendChild(t)}t.textContent=msg;t.classList.add('show');clearTimeout(t._tm);t._tm=setTimeout(()=>t.classList.remove('show'),2200)};
  const hero=(k,t,d,b='GPCS Portal')=>`<div class="route-hero"><div><div class="route-kicker">${k}</div><h1>${t}</h1><p>${d}</p></div><span class="route-badge">${b}</span></div>`;

  const pages={
    papers:()=>hero('Academic Resources','Paper Library','Search question papers using one universal search box. Paper Code, Paper Name, Year, Session, Branch and Semester can all be searched.')+`<div class="route-content"><div class="route-searchbar"><input id="previewPaperSearch" placeholder="Search Paper Code, Paper Name, Year, Session…" aria-label="Search papers"><button class="route-btn primary" type="button" id="previewPaperSearchBtn">Search</button></div><div class="route-table-wrap"><table class="route-table"><thead><tr><th>S.No.</th><th>Paper Code</th><th>Paper Name</th><th>Year</th><th>Session</th><th>Paper</th></tr></thead><tbody id="previewPaperRows"><tr><td colspan="6">Loading approved papers…</td></tr></tbody></table></div><div class="route-actions"><span class="route-status">Approved papers are loaded from the portal database</span></div></div>`,
    upload:()=>hero('Paper Contribution','Upload Paper','Upload a genuine academic paper. All metadata is optional; blank fields are auto-filled using the GPCS Master Subject Database.','Up to 100 MB')+`<div class="route-content"><div class="route-grid"><div class="route-card"><h2>Upload Paper</h2><form class="route-form" id="previewUploadForm"><label>Choose Paper File<input id="previewPaperFile" type="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"></label><label>Paper Code <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. 7488"></label><label>Subject Code <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. 403"></label><label>Paper Name <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="Leave blank for auto-detect"></label><label>Subject Name <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="Leave blank for auto-detect"></label><label>Branch <span style="font-weight:500;color:#8295aa">(optional)</span><select><option value="">Auto-detect</option><option>CS</option><option>ME</option><option>EE</option><option>ET</option></select></label><label>Semester <span style="font-weight:500;color:#8295aa">(optional)</span><select><option value="">Auto-detect</option><option>Semester I</option><option>Semester II</option><option>Semester III</option><option>Semester IV</option><option>Semester V</option><option>Semester VI</option></select></label><label>Year <span style="font-weight:500;color:#8295aa">(optional)</span><input inputmode="numeric" placeholder="e.g. 2026"></label><label>Session <span style="font-weight:500;color:#8295aa">(optional)</span><input placeholder="e.g. F / S"></label><div class="route-actions"><button class="route-btn primary" type="submit">⇧ Upload Paper</button><button class="route-btn" type="button" data-preview-route="papers">Browse Library</button></div></form></div><div class="route-card"><h3>Automatic matching</h3><p>Paper Code, Subject Code, Paper Name, Subject Name, Branch and Semester are matched against the local 141-row Master Subject Database. Year and Session are also detected when available. Duplicate codes are resolved using full context instead of blindly selecting the first match.</p><div class="route-actions"><span class="route-status approved">Optional metadata</span><span class="route-status">100 MB chunk upload</span></div><div class="admin-security-note" style="margin-top:14px">A genuine paper is not rejected for a small metadata mismatch. The system auto-corrects recognized details from the Master Database and asks for confirmation only when multiple valid matches exist.</div></div></div></div>`,
    notes:()=>hero('Study Resources','Notes','Students, Teachers and Faculty can upload notes. New uploads become public only after Admin approval.','Admin Moderated')+`<div class="route-content"><div class="route-searchbar"><input id="previewNoteSearch" placeholder="Search notes by title, subject, code, branch, semester…"><button class="route-btn primary" type="button">Search</button></div><div class="route-grid"><div class="route-card"><h2>Upload Notes</h2><form class="route-form" id="previewNoteForm" data-gpcs-upload-autofill="note"><div class="admin-security-note" style="margin-bottom:4px"><b>Required academic details:</b> Branch Name, Semester, Year, Subject Name and Subject Code. Known values are auto-filled from existing Notes data; only missing values need manual entry.</div><label>Branch Name <span style="color:#c2410c;font-weight:900">*</span><select name="branch" required><option value="">Select / auto-fill</option><option value="CS">CS</option><option value="ME">ME</option><option value="EE">EE</option><option value="ET">ET</option></select></label><label>Semester <span style="color:#c2410c;font-weight:900">*</span><select name="semester" required><option value="">Select / auto-fill</option><option value="Semester I">Semester I</option><option value="Semester II">Semester II</option><option value="Semester III">Semester III</option><option value="Semester IV">Semester IV</option><option value="Semester V">Semester V</option><option value="Semester VI">Semester VI</option></select></label><label>Year <span style="color:#c2410c;font-weight:900">*</span><input name="year" required inputmode="numeric" pattern="[0-9]{4}" maxlength="4" placeholder="e.g. 2026"></label><label>Subject Name <span style="color:#c2410c;font-weight:900">*</span><input name="subject_name" required placeholder="Auto-fill when known"></label><label>Subject Code <span style="color:#c2410c;font-weight:900">*</span><input name="subject_code" required placeholder="Auto-fill when known"></label><label>Note Title <span style="font-weight:500;color:#8295aa">(optional)</span><input name="title" placeholder="e.g. Unit 1 Handwritten Notes"></label><label>Text / Description <span style="font-weight:500;color:#8295aa">(optional)</span><textarea name="description" rows="4" placeholder="Type notes or description"></textarea></label><label>Attachment <span style="font-weight:500;color:#8295aa">(optional, PDF/image up to 200 MB)</span><input name="attachment" type="file" accept=".pdf,.jpg,.jpeg,.png"></label><div data-preview-note-message role="status" aria-live="polite" style="display:none"></div><div class="route-actions"><button class="route-btn primary" type="submit">Submit Notes</button></div></form><div class="admin-security-note" style="margin-top:14px">After upload: <b>Pending Review</b> → Admin Approves → Note becomes public. Rejected notes stay hidden from the public library and remain marked for the uploader.</div></div><div class="route-card"><h2>Available Notes <span class="route-status approved">Approved only</span></h2><div class="route-note-list" id="previewNotes"><div class="route-note"><div><b>Loading approved notes…</b></div></div></div><div class="admin-section"><h3>Your Upload Status</h3><p>Sign in to upload notes. New submissions remain pending until Admin approval.</p></div></div></div></div></div>`,
    gallery:()=>hero('College Life','Image Gallery','Browse college-related images or add images through category-specific or Smart Add flows.')+`<div class="route-content"><div class="route-actions" style="margin-top:0;margin-bottom:15px"><button class="route-btn primary" type="button" id="previewAddImage">＋ Add Image</button></div><input id="previewGalleryInput" type="file" accept="image/*" multiple hidden><div class="route-gallery"><div class="route-gallery-card"><b>Campus & Infrastructure</b><small>View / Add</small></div><div class="route-gallery-card"><b>College Events</b><small>View / Add</small></div><div class="route-gallery-card"><b>Labs & Workshops</b><small>View / Add</small></div><div class="route-gallery-card"><b>Students & Staff</b><small>View / Add</small></div><div class="route-gallery-card"><b>Sports & Cultural</b><small>View / Add</small></div><div class="route-gallery-card"><b>Projects & Activities</b><small>View / Add</small></div><div class="route-gallery-card"><b>Other College Related</b><small>View / Add</small></div></div><div class="admin-section" style="margin-top:18px"><h3>Approved Gallery Images</h3><div id="previewGalleryLive" class="route-gallery" aria-live="polite"><div class="route-gallery-card"><b>Loading gallery…</b></div></div></div></div>`,
    about:()=>hero('About the Institution','About Us','Government Polytechnic College, Shivpuri — empowering future engineers through technical excellence.')+`<div class="route-content"><div class="route-card"><h2>Government Polytechnic College, Shivpuri</h2><p>Welcome to Government Polytechnic College, Shivpuri — a premier government technical institution dedicated to excellence in engineering education and skill development.</p><div class="route-about-list" style="margin-top:16px"><div><b>Accreditation & Affiliation</b><p>Approved by AICTE, New Delhi • Affiliated with Rajiv Gandhi Proudyogiki Vishwavidyalaya (RGPV), Bhopal.</p></div><div><b>Campus & Environment</b><p>Located on Chhatri Road, Shivpuri, with an academic environment focused on practical and industry-aligned diploma education.</p></div><div><b>Academic Highlights</b><p>Experienced faculty, laboratories and workshops, hands-on learning, career guidance and vibrant campus activities.</p></div></div></div></div>`,
    contact:()=>hero('Get in Touch','Contact Us','Contact information can be maintained by the Admin. Use the form below to send a message to the college portal team.')+`<div class="route-content"><div class="route-grid"><div class="route-card"><h2>Contact Details</h2><p>Phone, email and address will appear here when added by the Admin.</p><div class="route-actions"><span class="route-status">Admin-managed content</span></div></div><div class="route-card"><h2>Send a Message</h2><form class="route-form" id="previewContactForm"><label>Name<input required placeholder="Your name"></label><label>Email / Mobile<input required placeholder="Email or mobile"></label><label>Message<textarea required rows="5" placeholder="How can we help?"></textarea></label><button class="route-btn primary" type="submit">Send Message</button></form></div></div></div>`,
    login:()=>hero('Portal Access','GPCS Sign In','Choose Student or Faculty access, then sign in with Email ID + GPCS account password.','Secure Access')+`<div class="route-content auth-preview-shell">
      <div class="auth-role-selector-wrap"><button class="auth-role-selector" type="button" data-auth-preview-toggle aria-label="Student selected. Switch to Faculty"><span class="auth-role-icon" aria-hidden="true"><svg class="auth-role-svg auth-role-svg-student" viewBox="0 0 24 24"><path d="M3 10.2 12 5l9 5.2-9 5.2L3 10.2Z"></path><path d="M7 12.5v4.1c2.9 2 7.1 2 10 0v-4.1"></path><path d="M21 10.2v5"></path></svg><svg class="auth-role-svg auth-role-svg-faculty" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.2"></circle><path d="M5.5 19c.7-3.6 3.2-5.6 6.5-5.6s5.8 2 6.5 5.6"></path><path d="M18.5 5.2 21 6.7l-2.5 1.5"></path></svg></span><span class="auth-role-copy"><small data-auth-role-context>Sign in as</small><strong data-auth-toggle-state>Student</strong></span><span class="auth-role-action"><span data-auth-toggle-hint>Change to Faculty</span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M14 7l5 5-5 5"></path></svg></span></button></div>
      <div class="auth-preview-role" data-auth-preview-panel="student"><div class="route-card auth-glass-card auth-signin-card"><div class="auth-preview-head"><span class="route-status approved">Student</span><h2>Student Sign In</h2><p>Sign in with your Email ID and Password.</p></div><div data-auth-method-panel="password"><form class="route-form" id="previewStudentPassword"><label>Email ID<input type="email" required placeholder="student@example.com"></label><label>Password<input type="password" required minlength="8" placeholder="GPCS account password"></label><div class="auth-preview-linkrow"><button type="button" class="link-button" data-auth-reset="student">Forgot Password?</button></div><button class="route-btn primary auth-main-submit" type="submit">Student Sign In</button></form></div><p class="auth-preview-register">New user? <button type="button" class="link-button" data-auth-register="student">Register here</button></p><div class="auth-trust-row" aria-label="Secure sign in"><span>Secure access</span><span>Password protected</span><span>Responsive</span></div></div></div>
      <div class="auth-preview-role" data-auth-preview-panel="faculty" hidden><div class="route-card auth-glass-card auth-signin-card"><div class="auth-preview-head"><span class="route-status pending">Faculty</span><h2>Faculty Sign In</h2><p>Sign in with your Email ID and Password.</p></div><div data-auth-method-panel="password"><form class="route-form" id="previewFacultyPassword"><label>Email ID<input type="email" required placeholder="faculty@example.com"></label><label>Password<input type="password" required minlength="8" placeholder="GPCS account password"></label><div class="auth-preview-linkrow"><button type="button" class="link-button" data-auth-reset="faculty">Forgot Password?</button></div><button class="route-btn primary auth-main-submit" type="submit">Faculty Sign In</button></form></div><p class="auth-preview-register">New user? <button type="button" class="link-button" data-auth-register="faculty">Register here</button></p><div class="auth-trust-row" aria-label="Secure sign in"><span>Secure access</span><span>Password protected</span><span>Responsive</span></div></div></div>
      <div class="auth-preview-register-panel" data-register-panel hidden><div class="route-card auth-glass-card auth-register-card"><div class="auth-preview-head"><span class="route-status" data-register-role-badge>Student</span><h2 data-register-title>Student Registration</h2><p>Complete the required account details below.</p></div><form class="route-form auth-preview-registration" id="previewDynamicRegister"><div data-student-fields><label>Full Name<input required></label><label>Surname<input required></label><label>Gender<select required><option>Select</option><option>Male</option><option>Female</option><option>Other</option></select></label><label>College Name<input required></label><label>College Year<select required><option>1st Year</option><option>2nd Year</option><option>3rd Year</option></select></label><label>Branch<select required><option>CS</option><option>ME</option><option>EE</option><option>ET</option></select></label><label>Semester<select required><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option></select></label></div><div data-faculty-fields hidden><label>Full Name <span class="auth-field-required">Required</span><input required></label><label>Surname <span class="auth-field-required">Required</span><input required></label><label>Gender <span class="auth-field-required">Required</span><select required><option>Select</option><option>Male</option><option>Female</option><option>Other</option></select></label><label>College Name <span class="auth-field-required">Required</span><input required></label><label>Subject Name <span class="auth-field-required">Required</span><input required></label><label>Faculty / Employee ID <span class="auth-field-optional">Optional</span><input></label></div><label>Mobile Number <span class="auth-field-optional" data-faculty-optional-note hidden>Optional</span><input inputmode="numeric" maxlength="10" required data-faculty-optional></label><label>Email ID <span class="auth-field-required">Required</span><input type="email" required></label><label>Email Password <small>(GPCS account login)</small> <span class="auth-field-required">Required</span><input type="password" minlength="8" required></label><label>Confirm Password <span class="auth-field-required">Required</span><input type="password" minlength="8" required></label><label>Pin Code <span class="auth-field-optional" data-faculty-optional-note hidden>Optional</span><input inputmode="numeric" maxlength="6" required data-faculty-optional></label><label>Address <span class="auth-field-required" data-faculty-required-note hidden>Required</span><textarea rows="3" required></textarea></label><label data-profile-photo>Profile Photo <span class="auth-field-optional">Optional</span><input type="file" accept="image/*"></label><label class="auth-preview-check"><input type="checkbox" name="terms_accepted" value="1" required> <span>I agree to <a href="{{ route('portal.terms') }}" target="_blank" rel="noopener noreferrer" data-gpcs-public-link>Terms &amp; Conditions</a> and <a href="{{ route('portal.privacy') }}" target="_blank" rel="noopener noreferrer" data-gpcs-public-link>Privacy Policy</a></span></label><div class="route-actions"><button class="route-btn primary" type="submit" data-register-submit>Create Account</button><button class="route-btn" type="button" data-back-login>Back to Sign In</button></div></form></div></div>
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
    updateActive(route);document.title=(route==='home'?'GPCS Portal':`${route.charAt(0).toUpperCase()+route.slice(1)} — GPCS Portal`);if(push) history.replaceState(null,'','#'+route);window.scrollTo({top:0,behavior:'smooth'})
  }
  window.gpcsPreviewNavigate=navigate;

  document.addEventListener('click',e=>{
    if(e.target.closest('.logo-interactive')) return;
    const a=e.target.closest('a[href]'); if(!a) return;
    const href=a.getAttribute('href')||'';
    if(href.startsWith('index.php?page=')){
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


<style id="gpcs-final-functional-patch-styles">
/* Functional completion layer — additive only; preserves the approved GPCS visual design. */
.admin-phase1-nav{display:flex;gap:8px;flex-wrap:wrap;margin:0 0 18px}
.admin-phase1-nav .route-btn{white-space:nowrap}
.admin-extra-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
.admin-extra-grid .route-card{min-width:0}
.admin-notification-history,.admin-log-list{margin-top:14px}
.admin-empty{padding:18px;border:1px dashed var(--line,#dbe5f0);border-radius:12px;text-align:center;color:var(--muted,#64748b)}
.admin-field-list{display:flex;gap:7px;flex-wrap:wrap;margin-top:12px}
.admin-field-chip{display:inline-flex;align-items:center;padding:6px 9px;border-radius:999px;background:rgba(37,99,235,.08);border:1px solid rgba(37,99,235,.16);font-size:.78rem;font-weight:700}
.admin-report-actions{display:flex;gap:9px;flex-wrap:wrap;margin-top:14px}
.admin-report-stat{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid var(--line,#e2e8f0)}
.admin-report-stat:last-child{border-bottom:0}
.admin-report-stat strong{font-size:1.1rem}
.admin-log-filters{display:grid;grid-template-columns:minmax(180px,1fr) minmax(150px,.45fr);gap:10px}
.admin-log-table td,.admin-log-table th{vertical-align:top}
.gpcs-final-modal{position:fixed;inset:0;z-index:100000;display:none;place-items:center;padding:18px;background:rgba(3,11,25,.68);backdrop-filter:blur(7px)}
.gpcs-final-modal.open{display:grid}
.gpcs-final-modal-card{width:min(680px,96vw);max-height:min(78vh,720px);overflow:auto;background:var(--surface,#fff);color:var(--text,#172033);border:1px solid var(--line,#dbe5f0);border-radius:18px;box-shadow:0 22px 70px rgba(0,0,0,.28);padding:20px}
.gpcs-final-modal-head{display:flex;justify-content:space-between;align-items:center;gap:14px;margin-bottom:12px}
.gpcs-final-modal-head h2{margin:0}
.gpcs-final-modal-close{border:0;background:transparent;font-size:1.55rem;cursor:pointer;color:inherit;padding:4px 8px;border-radius:8px}
.gpcs-final-modal-content{white-space:pre-wrap;line-height:1.65}
.preview-download-btn{white-space:nowrap}
.route-gallery-card{cursor:pointer}
.route-gallery-card:focus{outline:3px solid rgba(37,99,235,.28);outline-offset:3px}
.preview-file-meta{display:block;margin-top:6px;font-size:.78rem;color:var(--muted,#64748b)}
@media (max-width:760px){
  .admin-extra-grid{grid-template-columns:1fr}
  .admin-log-filters{grid-template-columns:1fr}
  .admin-phase1-nav{overflow-x:auto;flex-wrap:nowrap;padding-bottom:4px}
}
</style>





<script>
window.GPCS_BACKEND = {
  csrf: document.querySelector('meta[name="csrf-token"]')?.content || '',
  routes: {
    login: @json(route('portal.login')),
    register: @json(route('portal.register')),
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
<script src="/assets/gpcs-backend-bridge.js" defer></script>

</body></html>
