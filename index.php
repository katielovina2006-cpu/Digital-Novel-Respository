<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Digital Novel Repository</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #080a10;
  --bg2: #0d1018;
  --bg3: #141720;
  --card: #181c28;
  --card2: #1e2234;
  --border: rgba(255,255,255,0.07);
  --border2: rgba(255,255,255,0.14);
  --gold: #e8c547;
  --gold2: #d4a017;
  --gold-glow: rgba(232,197,71,0.18);
  --teal: #2dd4bf;
  --pink: #f472b6;
  --blue: #60a5fa;
  --purple: #a78bfa;
  --orange: #fb923c;
  --green: #34d399;
  --text: #eceef5;
  --text2: #8b91ab;
  --text3: #484e65;
  --sidebar-w: 80px;
  --sidebar-open: 260px;
  --radius: 14px;
  --radius-sm: 9px;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
  overflow-x: hidden;
}
::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.09); border-radius: 2px; }
::-webkit-scrollbar-thumb:hover { background: rgba(232,197,71,0.35); }

/* ── SPLASH ── */
#splashScreen {
  position: fixed; inset: 0; z-index: 9999;
  background: var(--bg);
  display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 0;
  transition: opacity 0.7s ease, transform 0.7s ease;
}
#splashScreen.fade-out { opacity: 0; pointer-events: none; transform: scale(1.04); }
.splash-books { display: flex; gap: 2px; align-items: flex-end; margin-bottom: 20px; }
.splash-book {
  width: 22px; border-radius: 3px 6px 6px 3px; position: relative;
  transform-origin: bottom center;
  animation: bookBounce 0.55s cubic-bezier(0.34,1.56,0.64,1) both;
}
.splash-book::after { content:''; position:absolute; left:0; top:0; bottom:0; width:3px; background:rgba(0,0,0,0.2); border-radius:3px 0 0 3px; }
.splash-book:nth-child(1){background:linear-gradient(160deg,#22c55e,#059669);animation-delay:.05s;height:46px;}
.splash-book:nth-child(2){background:linear-gradient(160deg,#f472b6,#db2777);animation-delay:.12s;height:38px;}
.splash-book:nth-child(3){background:linear-gradient(160deg,#ef4444,#b91c1c);animation-delay:.19s;height:52px;}
.splash-book:nth-child(4){background:linear-gradient(160deg,#60a5fa,#2563eb);animation-delay:.26s;height:34px;}
.splash-book:nth-child(5){background:linear-gradient(160deg,#e8c547,#d4a017);animation-delay:.33s;height:50px;}
.splash-book:nth-child(6){background:linear-gradient(160deg,#a78bfa,#7c3aed);animation-delay:.40s;height:42px;}
.splash-book:nth-child(7){background:linear-gradient(160deg,#fb923c,#c2410c);animation-delay:.47s;height:56px;}
@keyframes bookBounce {
  0%{opacity:0;transform:translateY(38px) rotate(-6deg);}
  60%{transform:translateY(-6px) rotate(1deg);}
  100%{opacity:1;transform:translateY(0) rotate(0);}
}
.splash-shelf {
  width:200px;height:3px;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  border-radius:3px;margin-bottom:26px;
  animation:shelfAppear 0.5s ease 0.7s both;
}
@keyframes shelfAppear{from{opacity:0;}to{opacity:1;}}
.splash-logo-wrap {
  text-align:center;display:flex;flex-direction:column;align-items:center;
  animation:splashIn 0.6s ease 0.85s both;
}
@keyframes splashIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.splash-title {
  font-family:'Playfair Display',serif;font-size:30px;font-weight:800;
  color:var(--text);letter-spacing:-0.5px;margin-bottom:5px;
}
.splash-title span { color:var(--gold); font-style:italic; }
.splash-tag { font-size:10px;color:var(--text3);letter-spacing:3.5px;text-transform:uppercase;margin-bottom:22px; }
.splash-bar-wrap { width:160px;height:2px;background:var(--bg3);border-radius:2px;overflow:hidden;animation:splashIn 0.4s ease 1.0s both; }
.splash-bar { height:100%;width:0%;background:linear-gradient(90deg,var(--teal),var(--gold));border-radius:2px;animation:splashLoad 1.4s cubic-bezier(0.4,0,0.2,1) 1.1s both; }
@keyframes splashLoad{0%{width:0%;}60%{width:78%;}100%{width:100%;}}

/* ── SIDEBAR ── */
.sidebar {
  width: var(--sidebar-w);
  background: var(--bg2);
  border-right: 1px solid var(--border);
  position: fixed; top:0; left:0; bottom:0; z-index:200;
  display: flex; flex-direction: column;
  transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
  overflow: hidden;
}
.sidebar:hover { width: var(--sidebar-open); }

.sidebar-logo {
  display: flex; align-items: center; gap: 12px;
  padding: 16px 14px; border-bottom: 1px solid var(--border);
  min-height: 70px; white-space: nowrap; overflow: hidden;
}
.logo-mark {
  width: 36px; height: 36px; min-width: 36px;
  background: var(--gold); border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; flex-shrink: 0;
  box-shadow: 0 0 22px var(--gold-glow);
}
.logo-text-wrap {
  opacity: 0; transition: opacity 0.18s 0.08s;
  white-space: nowrap; overflow: hidden; min-width: 0;
}
.sidebar:hover .logo-text-wrap { opacity: 1; }
.logo-main {
  font-family: 'Playfair Display', serif;
  font-size: 13.5px; font-weight: 700; color: var(--text);
  line-height: 1.2; white-space: nowrap;
}
.logo-main em { color: var(--gold); font-style: italic; }
.logo-sub-text { font-size: 9.5px; color: var(--text3); letter-spacing: 1px; margin-top: 1px; }

.nav-section { flex:1; padding: 10px 0; overflow-y:auto; overflow-x:hidden; display:flex; flex-direction:column; gap:1px; }
.nav-group-label {
  font-size: 8.5px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase;
  color: var(--text3); padding: 12px 20px 4px;
  white-space: nowrap; opacity:0; transition: opacity 0.18s;
}
.sidebar:hover .nav-group-label { opacity: 1; }
.nav-item {
  display: flex; align-items: center; gap: 11px;
  padding: 9px 14px; font-size: 12.5px; font-weight: 500;
  color: var(--text2); cursor: pointer; transition: all 0.2s;
  white-space: nowrap; overflow: hidden;
  border: none; background: none; font-family: 'Plus Jakarta Sans', sans-serif;
  width: 100%; text-align: left; border-radius: 0;
  position: relative;
}
.nav-item .nav-icon {
  min-width: 34px; height: 34px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 9px; background: var(--bg3);
  transition: all 0.22s; font-size: 15px; flex-shrink: 0;
}
.nav-item .nav-label { opacity:0; transition: opacity 0.12s 0.04s; flex:1; }
.sidebar:hover .nav-label { opacity:1; }
.nav-item .nav-badge {
  background: var(--gold); color: #000;
  font-size: 8.5px; font-weight: 800; border-radius: 10px;
  padding: 2px 6px; margin-left: auto;
  opacity: 0; transition: opacity 0.12s 0.04s; min-width: 18px; text-align: center;
}
.sidebar:hover .nav-badge { opacity:1; }
.nav-item:hover { color: var(--text); background: rgba(255,255,255,0.04); }
.nav-item:hover .nav-icon { background: var(--gold-glow); color: var(--gold); }
.nav-item.active { color: var(--gold); }
.nav-item.active .nav-icon { background: var(--gold); color: #000; box-shadow: 0 0 16px var(--gold-glow); }
.nav-item.active::after {
  content: ''; position: absolute; right: 0; top: 50%; transform: translateY(-50%);
  width: 3px; height: 22px; background: var(--gold);
  border-radius: 3px 0 0 3px; box-shadow: -2px 0 10px var(--gold-glow);
}
.sidebar-bottom { padding: 12px 10px; border-top: 1px solid var(--border); }
.sidebar-user {
  display: flex; align-items: center; gap: 10px; padding: 8px;
  border-radius: var(--radius-sm); cursor: pointer; transition: background 0.2s;
  white-space: nowrap; overflow: hidden;
}
.sidebar-user:hover { background: rgba(255,255,255,0.04); }
.user-avatar {
  width: 34px; height: 34px; min-width: 34px; border-radius: 50%;
  background: linear-gradient(135deg,var(--gold),var(--orange));
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700; color: #000;
}
.user-info { opacity: 0; transition: opacity 0.15s; min-width: 0; }
.sidebar:hover .user-info { opacity: 1; }
.user-name { font-size: 12px; font-weight: 600; color: var(--text); }
.user-role { font-size: 10px; color: var(--text3); }

/* ── LAYOUT ── */
.page-wrapper { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; }
.main-content { padding: 22px 28px 48px; }
@keyframes fadeSlideIn { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

/* ── BACK BREADCRUMB ── */
.back-bar {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 18px; padding: 10px 14px;
  background: var(--card); border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  animation: fadeSlideIn 0.35s ease both;
}
.back-btn {
  display: flex; align-items: center; gap: 7px;
  background: var(--bg3); border: 1px solid var(--border2);
  color: var(--text2); font-size: 11px; font-weight: 700;
  padding: 6px 13px; border-radius: 8px; cursor: pointer;
  font-family: 'Plus Jakarta Sans', sans-serif;
  transition: all 0.2s; flex-shrink: 0;
}
.back-btn:hover { background: var(--gold); color: #000; border-color: transparent; transform: translateX(-2px); }
.back-btn .back-arrow { font-size: 13px; }
.breadcrumb-trail { display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--text3); }
.breadcrumb-trail .bc-item { color: var(--text3); cursor: pointer; transition: color 0.2s; }
.breadcrumb-trail .bc-item:hover { color: var(--gold); text-decoration: underline; }
.breadcrumb-trail .bc-sep { color: var(--text3); opacity: 0.4; }
.breadcrumb-trail .bc-current { color: var(--text2); font-weight: 600; }

/* ── TOPBAR ── */
.topbar { display:flex; align-items:center; gap:10px; margin-bottom:22px; }
.search-box { flex:1; position:relative; }
.search-box input {
  width:100%; background: var(--card);
  border: 1px solid var(--border); border-radius: 12px;
  padding: 10px 14px 10px 40px;
  font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--text); outline: none; transition: all 0.25s;
}
.search-box input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(232,197,71,0.09); }
.search-box input::placeholder { color: var(--text3); }
.search-icon { position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text3);font-size:14px; }
.topbar-right { display:flex;align-items:center;gap:8px; }
.icon-btn {
  width:38px;height:38px;border-radius:9px;background:var(--card);
  border:1px solid var(--border);display:flex;align-items:center;justify-content:center;
  cursor:pointer;font-size:15px;transition:all 0.2s;color:var(--text2);position:relative;
}
.icon-btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text);}
.notif-dot{position:absolute;top:8px;right:8px;width:6px;height:6px;border-radius:50%;background:var(--gold);box-shadow:0 0 6px var(--gold);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{transform:scale(1);}50%{transform:scale(1.35);}}
.user-chip{display:flex;align-items:center;gap:8px;background:var(--card);border:1px solid var(--border);border-radius:9px;padding:5px 10px 5px 5px;cursor:pointer;transition:all 0.2s;}
.user-chip:hover{border-color:var(--border2);}
.chip-avatar{width:26px;height:26px;border-radius:7px;background:linear-gradient(135deg,var(--gold),var(--orange));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#000;}
.chip-name{font-size:12px;font-weight:600;color:var(--text);}

/* ── PAGE HEADER ── */
.page-head { margin-bottom: 20px; }
.page-head-title {
  font-family: 'Playfair Display', serif;
  font-size: 24px; font-weight: 800; color: var(--text);
  line-height: 1.2;
}
.page-head-title em { color: var(--gold); font-style: italic; }

/* ── HERO / SHELF ── */
.hero-section {
  background: var(--card); border-radius: 18px;
  padding: 20px; margin-bottom: 24px; border: 1px solid var(--border);
  position: relative; overflow: hidden;
}
.hero-section::before {
  content:''; position:absolute; top:-50px;right:-50px;
  width:180px;height:180px;border-radius:50%;
  background:radial-gradient(circle,rgba(232,197,71,0.07),transparent 70%);
  pointer-events:none;
}
.hero-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
.hero-label{font-family:'Playfair Display',serif;font-weight:700;font-size:14px;color:var(--text);}
.filter-chips{display:flex;gap:5px;}
.fchip{padding:4px 13px;border-radius:100px;font-size:11px;font-weight:600;background:var(--bg3);color:var(--text2);border:1px solid var(--border);cursor:pointer;transition:all 0.2s;}
.fchip.active,.fchip:hover{background:var(--gold);color:#000;border-color:transparent;}
.books-scroll{display:flex;gap:12px;overflow-x:auto;padding-bottom:4px;scrollbar-width:none;}
.books-scroll::-webkit-scrollbar{display:none;}
.book-thumb{flex-shrink:0;width:82px;cursor:pointer;}
.book-cover{width:82px;height:116px;border-radius:9px;overflow:hidden;position:relative;box-shadow:0 6px 20px rgba(0,0,0,0.45);transition:transform 0.3s cubic-bezier(0.34,1.56,0.64,1),box-shadow 0.3s;margin-bottom:5px;}
.book-thumb:hover .book-cover{transform:translateY(-7px) scale(1.04);box-shadow:0 16px 38px rgba(0,0,0,0.65);}
.book-cover img{width:100%;height:100%;object-fit:cover;}
.book-cover-bar{position:absolute;bottom:0;left:0;right:0;height:3px;background:rgba(0,0,0,0.3);}
.book-cover-progress{height:100%;background:var(--gold);border-radius:3px;transition:width 1.1s ease;}
.book-thumb-title{font-size:9px;font-weight:600;color:var(--text2);line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.book-thumb-author{font-size:8px;color:var(--text3);}

/* ── SEC HEADER ── */
.sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:13px;}
.sec-title{font-family:'Playfair Display',serif;font-weight:700;font-size:15px;color:var(--text);}
.sec-link{font-size:11px;font-weight:600;color:var(--gold);text-decoration:none;cursor:pointer;display:flex;align-items:center;gap:4px;transition:gap 0.2s;}
.sec-link:hover{gap:8px;}

/* ── POPULAR GRID ── */
.popular-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:11px;margin-bottom:24px;}
.pop-book-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);animation:fadeSlideIn 0.5s ease both;position:relative;}
.pop-book-card:hover{transform:translateY(-6px);box-shadow:0 16px 44px rgba(0,0,0,0.45);border-color:var(--border2);}
.pop-cover{height:115px;position:relative;overflow:hidden;}
.pop-cover img{width:100%;height:100%;object-fit:cover;}
.pop-cover-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:34px;}
.pop-body{padding:9px;}
.pop-title{font-size:10px;font-weight:700;color:var(--text);line-height:1.35;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.pop-author{font-size:9px;color:var(--text3);display:flex;align-items:center;gap:3px;}
.pop-genre-dot{display:inline-block;width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.read-btn{width:100%;padding:5px;background:rgba(232,197,71,0.1);border:1px solid rgba(232,197,71,0.2);border-radius:6px;color:var(--gold);font-size:9px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all 0.2s;margin-top:6px;}
.read-btn:hover{background:var(--gold);color:#000;}
.card-actions{position:absolute;top:7px;right:7px;display:flex;gap:3px;opacity:0;transform:translateY(-4px);transition:all 0.22s;z-index:10;}
.pop-book-card:hover .card-actions{opacity:1;transform:translateY(0);}
.ca-btn{width:24px;height:24px;border-radius:6px;border:none;cursor:pointer;font-size:11px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;backdrop-filter:blur(8px);}
.ca-edit{background:rgba(232,197,71,0.85);color:#000;}
.ca-edit:hover{background:var(--gold);transform:scale(1.15);}
.ca-delete{background:rgba(239,68,68,0.85);color:#fff;}
.ca-delete:hover{background:#ef4444;transform:scale(1.15);}

/* ── AUTHORS PAGE ── */
.authors-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.author-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;text-align:center;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);}
.author-card:hover{transform:translateY(-6px);border-color:var(--gold);box-shadow:0 14px 36px rgba(0,0,0,0.4);}
.author-big-avatar{width:60px;height:60px;border-radius:50%;margin:0 auto 10px;display:flex;align-items:center;justify-content:center;font-size:24px;border:2px solid var(--border);}
.author-name{font-family:'Playfair Display',serif;font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;}
.author-genre{font-size:10px;color:var(--text3);margin-bottom:8px;}
.author-stats{display:flex;justify-content:center;gap:16px;}
.astat{text-align:center;}
.astat-num{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:var(--gold);}
.astat-lbl{font-size:8px;color:var(--text3);}

/* ── AUTHOR BOOKS VIEW ── */
.author-books-header{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:20px;margin-bottom:20px;display:flex;align-items:center;gap:16px;}
.author-books-avatar{width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0;}
.author-books-info{flex:1;}
.author-books-name{font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:3px;}
.author-books-meta{font-size:11px;color:var(--text3);}

/* ── GENRES ── */
.genres-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.genre-big-card{border-radius:var(--radius);padding:22px;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);position:relative;overflow:hidden;min-height:130px;display:flex;flex-direction:column;justify-content:space-between;}
.genre-big-card:hover{transform:translateY(-5px) scale(1.01);box-shadow:0 22px 54px rgba(0,0,0,0.5);}
.genre-big-icon{font-size:34px;margin-bottom:9px;}
.genre-big-name{font-family:'Playfair Display',serif;font-size:18px;font-weight:800;color:#fff;}
.genre-big-count{font-size:10px;opacity:0.65;color:#fff;}
.genre-big-bg{position:absolute;right:-16px;bottom:-16px;font-size:66px;opacity:0.1;pointer-events:none;}

/* ── FAVORITES ── */
.fav-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.fav-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;cursor:pointer;transition:all 0.3s;position:relative;}
.fav-card:hover{transform:translateY(-5px);border-color:var(--gold);}
.fav-cover{height:138px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;font-size:40px;}
.fav-cover img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
.fav-heart{position:absolute;top:7px;right:7px;background:rgba(0,0,0,0.5);border-radius:50%;width:26px;height:26px;display:flex;align-items:center;justify-content:center;font-size:13px;cursor:pointer;transition:all 0.2s;z-index:5;}
.fav-heart:hover{transform:scale(1.2);}
.fav-body{padding:10px;}
.fav-title{font-size:11px;font-weight:700;color:var(--text);margin-bottom:2px;}
.fav-author{font-size:9px;color:var(--text3);}

/* ── SCHEDULE ── */
.schedule-day{margin-bottom:18px;}
.day-label{font-family:'Playfair Display',serif;font-size:13px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;align-items:center;gap:9px;}
.day-label::after{content:'';flex:1;height:1px;background:var(--border);}
.schedule-item{background:var(--card);border:1px solid var(--border);border-radius:var(--radius-sm);padding:10px 14px;display:flex;align-items:center;gap:12px;margin-bottom:7px;cursor:pointer;transition:all 0.2s;}
.schedule-item:hover{border-color:var(--border2);transform:translateX(4px);}
.sched-time{font-size:10px;font-weight:700;color:var(--gold);min-width:46px;}
.sched-icon{font-size:17px;width:32px;height:32px;border-radius:8px;background:var(--bg3);display:flex;align-items:center;justify-content:center;}
.sched-info{flex:1;}
.sched-title{font-size:11px;font-weight:700;color:var(--text);margin-bottom:1px;}
.sched-sub{font-size:9px;color:var(--text3);}
.sched-dur{font-size:9px;font-weight:600;background:var(--bg3);color:var(--text2);padding:2px 8px;border-radius:5px;}

/* ── REPORTS ── */
.report-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;margin-bottom:12px;}
.report-title{font-family:'Playfair Display',serif;font-size:14px;font-weight:700;color:var(--text);margin-bottom:14px;}
.bar-chart{display:flex;flex-direction:column;gap:9px;}
.bar-row{display:flex;align-items:center;gap:9px;}
.bar-label{font-size:10px;color:var(--text2);min-width:65px;}
.bar-track{flex:1;height:7px;background:var(--bg3);border-radius:4px;overflow:hidden;}
.bar-fill{height:100%;border-radius:4px;transition:width 1.2s ease;}
.bar-val{font-size:10px;font-weight:700;color:var(--text);min-width:22px;text-align:right;}

/* ── READING VIEW ── */
.reading-list{display:flex;flex-direction:column;gap:10px;}
.reading-item{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:14px;display:flex;gap:12px;align-items:center;cursor:pointer;transition:all 0.25px;}
.reading-item:hover{border-color:var(--border2);transform:translateX(4px);}
.reading-cover{width:50px;height:68px;border-radius:7px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px;}
.reading-cover img{width:100%;height:100%;object-fit:cover;}
.reading-info{flex:1;min-width:0;}
.reading-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:2px;}
.reading-author{font-size:10px;color:var(--text3);margin-bottom:8px;}
.reading-progress-bar{height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.reading-progress-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--gold));border-radius:2px;transition:width 1.5s ease;}
.reading-pct{font-size:9px;font-weight:700;color:var(--gold);margin-top:3px;}
.reading-status{font-size:9px;padding:3px 9px;border-radius:5px;font-weight:700;flex-shrink:0;}

/* ── LIBRARY ── */
.lib-item-actions{display:flex;gap:5px;margin-top:6px;}
.lib-action-btn{flex:1;padding:4px 0;border-radius:6px;border:none;font-size:9px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all 0.2s;}
.lib-action-edit{background:rgba(232,197,71,0.12);color:var(--gold);border:1px solid rgba(232,197,71,0.2);}
.lib-action-edit:hover{background:rgba(232,197,71,0.25);}
.lib-action-delete{background:rgba(239,68,68,0.1);color:#ef4444;border:1px solid rgba(239,68,68,0.2);}
.lib-action-delete:hover{background:rgba(239,68,68,0.2);}

/* ── READER MODE ── */
#readerOverlay{position:fixed;inset:0;z-index:5000;background:var(--bg);opacity:0;pointer-events:none;transition:opacity 0.4s ease;display:flex;flex-direction:column;font-family:'Lora',serif;}
#readerOverlay.open{opacity:1;pointer-events:all;}
.reader-topbar{display:flex;align-items:center;gap:14px;padding:12px 24px;background:var(--bg2);border-bottom:1px solid var(--border);flex-shrink:0;}
.reader-close-btn{width:36px;height:36px;border-radius:50%;background:var(--bg3);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:18px;color:var(--text2);transition:all 0.2s;font-family:monospace;flex-shrink:0;}
.reader-close-btn:hover{background:rgba(239,68,68,0.2);border-color:rgba(239,68,68,0.4);color:#ef4444;transform:rotate(90deg);}
.reader-book-title{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:var(--text);flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.reader-book-author{font-size:11px;color:var(--text3);}
.reader-controls{display:flex;align-items:center;gap:8px;}
.reader-ctrl-btn{padding:6px 13px;border-radius:7px;border:1px solid var(--border);background:var(--bg3);color:var(--text2);font-size:11px;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all 0.2s;}
.reader-ctrl-btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text);}
.reader-ctrl-btn.active{background:var(--gold);border-color:transparent;color:#000;}
.reader-font-btn{width:30px;height:30px;border-radius:7px;border:1px solid var(--border);background:var(--bg3);color:var(--text2);font-size:12px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all 0.2s;display:flex;align-items:center;justify-content:center;}
.reader-font-btn:hover{background:var(--card2);color:var(--text);}
.reader-body{display:flex;flex:1;overflow:hidden;}
.chapter-sidebar{width:210px;min-width:210px;background:var(--bg2);border-right:1px solid var(--border);overflow-y:auto;padding:18px 0;flex-shrink:0;}
.chap-sidebar-title{font-size:10px;font-weight:700;color:var(--text3);letter-spacing:2px;text-transform:uppercase;padding:0 16px 12px;}
.chap-item{padding:10px 16px;cursor:pointer;transition:all 0.2s;border-left:3px solid transparent;display:flex;align-items:center;gap:10px;}
.chap-item:hover{background:rgba(255,255,255,0.04);}
.chap-item.active{border-left-color:var(--gold);background:rgba(232,197,71,0.05);color:var(--gold);}
.chap-item-num{font-family:'Playfair Display',serif;font-size:10px;font-weight:700;color:var(--gold);min-width:22px;}
.chap-item-name{font-size:11px;font-weight:500;color:var(--text2);line-height:1.4;}
.chap-item.active .chap-item-name{color:var(--gold);}
.reader-content-wrap{flex:1;overflow-y:auto;display:flex;justify-content:center;padding:40px 24px;background:var(--bg);}
.reader-paper{max-width:680px;width:100%;font-family:'Lora',serif;transition:font-size 0.2s;}
.reader-chapter-header{margin-bottom:30px;border-bottom:1px solid var(--border);padding-bottom:22px;}
.reader-chapter-num{font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:7px;}
.reader-chapter-title{font-family:'Playfair Display',serif;font-size:28px;font-weight:800;color:var(--text);line-height:1.2;margin-bottom:7px;}
.reader-chapter-meta{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--text3);display:flex;align-items:center;gap:12px;}
.reader-content{line-height:1.95;color:var(--text2);}
.reader-content p{margin-bottom:1.5em;text-indent:2em;}
.reader-content p:first-child{text-indent:0;}
.reader-content p:first-child::first-letter{font-size:3.5em;font-weight:700;float:left;line-height:0.75;padding-right:8px;color:var(--gold);font-family:'Playfair Display',serif;margin-top:8px;}
.reader-content .scene-break{text-align:center;color:var(--text3);margin:2em 0;font-size:18px;letter-spacing:8px;user-select:none;}
.ai-generating{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 20px;gap:18px;}
.ai-gen-icon{font-size:46px;animation:genPulse 1.5s ease-in-out infinite;}
@keyframes genPulse{0%,100%{transform:scale(1);}50%{transform:scale(1.1);}}
.ai-gen-text{font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;color:var(--text2);text-align:center;}
.ai-gen-bar{width:190px;height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.ai-gen-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--gold));border-radius:2px;animation:genBar 2s ease-in-out infinite;}
@keyframes genBar{0%{width:0%;margin-left:0;}50%{width:80%;margin-left:10%;}100%{width:0%;margin-left:100%;}}
.ai-typing-dots{display:flex;gap:5px;align-items:center;}
.ai-typing-dot{width:6px;height:6px;border-radius:50%;background:var(--gold);animation:typingDot 1.2s ease-in-out infinite;}
.ai-typing-dot:nth-child(2){animation-delay:0.2s;}
.ai-typing-dot:nth-child(3){animation-delay:0.4s;}
@keyframes typingDot{0%,60%,100%{transform:translateY(0);}30%{transform:translateY(-8px);}}
.chapter-nav-footer{display:flex;align-items:center;justify-content:space-between;margin-top:48px;padding-top:24px;border-top:1px solid var(--border);}
.chap-nav-btn{padding:10px 20px;border-radius:10px;border:1px solid var(--border);background:var(--card);color:var(--text2);font-size:12px;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all 0.2s;display:flex;align-items:center;gap:7px;}
.chap-nav-btn:hover:not(:disabled){background:var(--card2);border-color:var(--border2);color:var(--text);transform:translateY(-2px);}
.chap-nav-btn:disabled{opacity:0.3;cursor:not-allowed;}
.chap-nav-btn.next-btn{background:var(--gold);border-color:transparent;color:#000;}
.chap-nav-btn.next-btn:hover:not(:disabled){background:var(--gold2);}
.chap-progress{font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;color:var(--text3);text-align:center;}
.chap-progress-frac{font-weight:700;color:var(--gold);}
.reader-progress-wrap{flex:1;max-width:200px;}
.reader-progress-bar{height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.reader-progress-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--gold));border-radius:2px;transition:width 0.5s ease;}
.reader-progress-text{font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;color:var(--text3);margin-top:3px;}

/* ── MODALS ── */
.modal-overlay{position:fixed;inset:0;z-index:999;background:rgba(0,0,0,0.75);backdrop-filter:blur(14px);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity 0.3s;}
.modal-overlay.open{opacity:1;pointer-events:all;}
.modal{background:var(--card);border:1px solid var(--border2);border-radius:20px;max-width:520px;width:100%;max-height:90vh;overflow-y:auto;transform:scale(0.85) translateY(28px);transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 40px 80px rgba(0,0,0,0.65);}
.modal-overlay.open .modal{transform:scale(1) translateY(0);}
.modal-cover{height:165px;position:relative;overflow:hidden;border-radius:20px 20px 0 0;display:flex;align-items:center;justify-content:center;font-size:54px;}
.modal-cover img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
.modal-cover-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,var(--card));}
.modal-body{padding:20px;}
.modal-genre{font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:4px;}
.modal-title{font-family:'Playfair Display',serif;font-size:21px;font-weight:800;color:var(--text);margin-bottom:2px;}
.modal-author{font-size:12px;color:var(--text2);margin-bottom:13px;}
.modal-divider{height:1px;background:var(--border);margin-bottom:13px;}
.modal-desc{font-size:12px;line-height:1.8;color:var(--text2);}
.modal-actions{display:flex;gap:7px;margin-top:16px;flex-wrap:wrap;}
.btn-modal{flex:1;padding:10px;border-radius:9px;font-size:11px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;cursor:pointer;transition:all 0.2s;border:none;min-width:90px;}
.btn-primary{background:var(--gold);color:#000;}
.btn-primary:hover{background:var(--gold2);transform:translateY(-2px);}
.btn-read{background:linear-gradient(135deg,#7c3aed,#2563eb);color:#fff;}
.btn-read:hover{opacity:0.9;transform:translateY(-2px);}
.btn-secondary{background:var(--bg3);color:var(--text2);border:1px solid var(--border)!important;}
.btn-secondary:hover{background:var(--card2);color:var(--text);transform:translateY(-2px);}
.btn-danger{background:rgba(239,68,68,0.15);color:#ef4444;border:1px solid rgba(239,68,68,0.25)!important;}
.btn-danger:hover{background:rgba(239,68,68,0.3);transform:translateY(-2px);}
.modal-close{position:absolute;top:12px;right:12px;width:29px;height:29px;border-radius:50%;background:rgba(0,0,0,0.4);border:1px solid var(--border);color:var(--text2);font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;font-family:monospace;z-index:2;}
.modal-close:hover{background:rgba(239,68,68,0.3);border-color:rgba(239,68,68,0.5);color:#ef4444;transform:rotate(90deg);}
.add-modal{max-width:450px;}
.modal-headline{font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:2px;}
.modal-sub{font-size:11px;color:var(--text3);margin-bottom:18px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:11px;}
.field{display:flex;flex-direction:column;gap:4px;}
.field.full{grid-column:1/-1;}
.field label{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--text3);}
.field input,.field select,.field textarea{background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:9px 11px;font-size:12px;font-family:'Plus Jakarta Sans',sans-serif;color:var(--text);outline:none;transition:all 0.2s;}
.field input::placeholder,.field textarea::placeholder{color:var(--text3);}
.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(232,197,71,0.08);}
.field select option{background:var(--card2);}
.field textarea{min-height:72px;resize:vertical;line-height:1.6;}
.confirm-modal{max-width:340px;}
.confirm-modal .modal-body{padding:26px;text-align:center;}
.confirm-icon{font-size:42px;margin-bottom:12px;}
.confirm-title{font-family:'Playfair Display',serif;font-size:17px;font-weight:800;color:var(--text);margin-bottom:6px;}
.confirm-sub{font-size:12px;color:var(--text3);line-height:1.7;margin-bottom:18px;}
.confirm-actions{display:flex;gap:8px;}

/* ── TOAST ── */
.toast{position:fixed;bottom:26px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--gold);color:#000;padding:9px 18px;border-radius:9px;font-size:12px;font-weight:700;z-index:99999;opacity:0;transition:all 0.38s;box-shadow:0 8px 24px var(--gold-glow);pointer-events:none;font-family:'Plus Jakarta Sans',sans-serif;}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}
.toast.error-toast{background:#ef4444;box-shadow:0 8px 24px rgba(239,68,68,0.3);color:#fff;}

/* ── NOTIFICATIONS ── */
.notif-wrap{position:relative;}
.notif-panel{position:absolute;top:46px;right:0;width:290px;background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;display:none;z-index:600;box-shadow:0 20px 60px rgba(0,0,0,0.6);}
.notif-panel.open{display:block;}
.notif-panel-header{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-bottom:1px solid var(--border);}
.notif-panel-title{font-family:'Playfair Display',serif;font-size:13px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:7px;}
.notif-count-badge{background:var(--gold);color:#000;font-size:9px;font-weight:800;border-radius:10px;padding:2px 6px;}
.notif-mark-all{font-size:10px;font-weight:600;color:var(--gold);cursor:pointer;border:none;background:none;font-family:'Plus Jakarta Sans',sans-serif;}
.notif-items{max-height:295px;overflow-y:auto;}
.notif-item{display:flex;gap:9px;padding:11px 14px;border-bottom:1px solid var(--border);cursor:pointer;transition:background 0.15s;}
.notif-item:last-child{border-bottom:none;}
.notif-item:hover{background:var(--bg3);}
.notif-item.unread{background:rgba(232,197,71,0.04);}
.notif-item-icon{width:34px;height:34px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:14px;background:var(--bg3);}
.notif-item-body{flex:1;min-width:0;}
.notif-item-text{font-size:11px;color:var(--text);line-height:1.5;margin-bottom:2px;}
.notif-item-time{font-size:9px;color:var(--text3);}
.notif-unread-pip{width:6px;height:6px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:5px;box-shadow:0 0 5px var(--gold);}
.notif-panel-footer{padding:9px 14px;border-top:1px solid var(--border);text-align:center;}
.notif-footer-link{font-size:10px;font-weight:600;color:var(--gold);cursor:pointer;}
@keyframes removeItem{0%{opacity:1;transform:scale(1);}50%{opacity:0.5;transform:scale(0.95) rotate(-1deg);}100%{opacity:0;transform:scale(0.7) rotate(-3deg);}}
.removing{animation:removeItem 0.4s ease forwards!important;pointer-events:none!important;}

/* ── PAGE VIEWS ── */
.page-view{display:none;animation:fadeSlideIn 0.4s ease both;}
.page-view.active{display:block;}

/* ── SETTINGS ── */
.settings-row{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid var(--border);}
.settings-row:last-child{border-bottom:none;}
.settings-row-label{font-size:13px;font-weight:600;color:var(--text);}
.settings-row-sub{font-size:10px;color:var(--text3);margin-top:1px;}
.settings-row-val{font-size:12px;color:var(--gold);font-weight:600;}
.toggle-btn{width:38px;height:20px;border-radius:10px;background:var(--gold);position:relative;cursor:pointer;}
.toggle-btn-dot{position:absolute;right:3px;top:3px;width:14px;height:14px;border-radius:50%;background:#000;}
.stat-box{flex:1;background:var(--bg3);border-radius:9px;padding:12px;text-align:center;}
.stat-box-num{font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:var(--gold);}
.stat-box-lbl{font-size:8.5px;color:var(--text3);margin-top:2px;}

/* ── GENRE FILTER RESULTS ── */
#genreFilterBanner {
  display: none; align-items: center; gap: 10px;
  background: rgba(232,197,71,0.06); border: 1px solid rgba(232,197,71,0.18);
  border-radius: var(--radius-sm); padding: 9px 14px; margin-bottom: 14px;
  font-size: 11px; color: var(--text2);
}
#genreFilterBanner.show { display: flex; }
#genreFilterBanner strong { color: var(--gold); }
.clear-filter-btn { margin-left: auto; background: var(--bg3); border: 1px solid var(--border2); color: var(--text3); font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 6px; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: all 0.2s; }
.clear-filter-btn:hover { background: var(--card2); color: var(--text); }

/* ── RESPONSIVE ── */
@media(max-width:1200px){.popular-grid{grid-template-columns:repeat(4,1fr);}}
@media(max-width:900px){.popular-grid{grid-template-columns:repeat(3,1fr);}.fav-grid{grid-template-columns:repeat(3,1fr);}.authors-grid{grid-template-columns:repeat(3,1fr);}.genres-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:600px){.popular-grid{grid-template-columns:repeat(2,1fr);}.genres-grid{grid-template-columns:1fr;}.chapter-sidebar{display:none;}.fav-grid{grid-template-columns:repeat(2,1fr);}}
</style>
</head>
<body>

<!-- SPLASH -->
<div id="splashScreen">
  <div class="splash-books">
    <div class="splash-book"></div><div class="splash-book"></div><div class="splash-book"></div>
    <div class="splash-book"></div><div class="splash-book"></div><div class="splash-book"></div>
    <div class="splash-book"></div>
  </div>
  <div class="splash-shelf"></div>
  <div class="splash-logo-wrap">
    <div class="splash-title">Digital Novel <em>Repository</em></div>
    <div class="splash-tag">Your Digital Library</div>
    <div class="splash-bar-wrap"><div class="splash-bar"></div></div>
  </div>
</div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">📚</div>
    <div class="logo-text-wrap">
      <div class="logo-main">Digital Novel <em>Repository</em></div>
      <div class="logo-sub-text">Your Digital Library</div>
    </div>
  </div>
  <nav class="nav-section">
    <div class="nav-group-label">Main</div>
    <button class="nav-item active" data-page="home"><div class="nav-icon">🏠</div><span class="nav-label">Home</span></button>
    <button class="nav-item" data-page="authors"><div class="nav-icon">👤</div><span class="nav-label">Authors</span></button>
    <button class="nav-item" data-page="genres"><div class="nav-icon">🏷️</div><span class="nav-label">Genres</span><span class="nav-badge">5</span></button>
    <button class="nav-item" data-page="reading"><div class="nav-icon">📖</div><span class="nav-label">Reading</span><span class="nav-badge">3</span></button>
    <button class="nav-item" data-page="favorites"><div class="nav-icon">⭐</div><span class="nav-label">Favorites</span></button>
    <div class="nav-group-label" style="margin-top:6px;">Manage</div>
    <button class="nav-item" data-page="schedule"><div class="nav-icon">📅</div><span class="nav-label">Schedule</span></button>
    <button class="nav-item" data-page="library"><div class="nav-icon">🗂️</div><span class="nav-label">Library</span></button>
    <button class="nav-item" data-page="reports"><div class="nav-icon">📊</div><span class="nav-label">Reports</span></button>
    <div class="nav-group-label" style="margin-top:6px;">Account</div>
    <button class="nav-item" data-page="settings"><div class="nav-icon">⚙️</div><span class="nav-label">Settings</span></button>
    <button class="nav-item" id="addNovelBtn"><div class="nav-icon">➕</div><span class="nav-label">Add Novel</span></button>
  </nav>
  <div class="sidebar-bottom">
    <div class="sidebar-user">
      <div class="user-avatar">M</div>
      <div class="user-info">
        <div class="user-name">Reader M</div>
        <div class="user-role">Pro Member</div>
      </div>
    </div>
  </div>
</aside>

<!-- PAGE WRAPPER -->
<div class="page-wrapper" id="pageWrapper">
<main class="main-content">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="search-box">
      <span class="search-icon">🔍</span>
      <input type="text" id="searchInput" placeholder="Search novels, authors, genres…" oninput="handleSearch(this.value)">
    </div>
    <div class="topbar-right">
      <div class="notif-wrap">
        <div class="icon-btn" id="notifBtn" onclick="toggleNotifPanel(event)">
          🔔<div class="notif-dot" id="notifDot"></div>
        </div>
        <div class="notif-panel" id="notifPanel">
          <div class="notif-panel-header">
            <div class="notif-panel-title">Notifications<span class="notif-count-badge" id="notifBadge">3</span></div>
            <button class="notif-mark-all" onclick="markAllNotifs()">Mark all read</button>
          </div>
          <div class="notif-items" id="notifItems"></div>
          <div class="notif-panel-footer"><span class="notif-footer-link" onclick="showToast('📬 No more notifications')">View all</span></div>
        </div>
      </div>
      <div class="icon-btn" onclick="showToast('🌙 Dark theme active!')">🌙</div>
      <div class="user-chip"><div class="chip-avatar">M</div><span class="chip-name">Reader M</span></div>
    </div>
  </div>

  <!-- HOME VIEW -->
  <div class="page-view active" id="view-home">
    <div class="sec-header"><div class="sec-title">Continue Reading</div><a class="sec-link" onclick="navigate('reading')">Show all →</a></div>
    <div class="hero-section">
      <div class="hero-top">
        <div class="hero-label">Your Bookshelf</div>
        <div class="filter-chips">
          <div class="fchip active" onclick="setFchip(this)">All</div>
          <div class="fchip" onclick="setFchip(this)">Fiction</div>
          <div class="fchip" onclick="setFchip(this)">Non-Fiction</div>
        </div>
      </div>
      <div class="books-scroll" id="prevReadingScroll"></div>
    </div>
    <div class="sec-header"><div class="sec-title">Popular Books</div><a class="sec-link" onclick="navigate('library')">Show all →</a></div>
    <div class="popular-grid" id="popularGrid"></div>
  </div>

  <!-- AUTHORS VIEW -->
  <div class="page-view" id="view-authors">
    <div id="authorsMainView">
      <div class="page-head"><div class="page-head-title">Writers & <em>Authors</em></div></div>
      <div class="authors-grid" id="authorsGrid"></div>
    </div>
    <div id="authorBooksView" style="display:none;">
      <div class="author-books-header" id="authorBooksHeader"></div>
      <div class="sec-header" style="margin-bottom:13px;">
        <div class="sec-title" id="authorBooksSectionTitle">Books by this Author</div>
        <span></span>
      </div>
      <div class="popular-grid" id="authorBooksGrid"></div>
    </div>
  </div>

  <!-- GENRES VIEW -->
  <div class="page-view" id="view-genres">
    <div class="page-head"><div class="page-head-title">Browse by <em>Genre</em></div></div>
    <div class="genres-grid" id="genresGrid"></div>
  </div>

  <!-- READING VIEW -->
  <div class="page-view" id="view-reading">
    <div class="page-head"><div class="page-head-title">Currently <em>Reading</em></div></div>
    <div class="reading-list" id="readingList"></div>
  </div>

  <!-- FAVORITES VIEW -->
  <div class="page-view" id="view-favorites">
    <div class="page-head"><div class="page-head-title">My <em>Favorites</em> ⭐</div></div>
    <div class="fav-grid" id="favGrid"></div>
  </div>

  <!-- SCHEDULE VIEW -->
  <div class="page-view" id="view-schedule">
    <div class="page-head"><div class="page-head-title">Reading <em>Schedule</em></div></div>
    <div id="scheduleList"></div>
  </div>

  <!-- LIBRARY VIEW -->
  <div class="page-view" id="view-library">
    <div class="sec-header" style="margin-bottom:10px;">
      <div class="page-head-title" style="margin:0;">Full <em>Library</em></div>
      <button onclick="openAddModal()" style="background:var(--gold);color:#000;border:none;padding:8px 16px;border-radius:9px;font-size:11px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;">+ Add Novel</button>
    </div>
    <div id="genreFilterBanner">
      <span>Showing: <strong id="genreFilterLabel"></strong></span>
      <button class="clear-filter-btn" onclick="clearGenreFilter()">✕ Show All</button>
    </div>
    <div class="popular-grid" id="libraryGrid"></div>
  </div>

  <!-- REPORTS VIEW -->
  <div class="page-view" id="view-reports">
    <div class="page-head"><div class="page-head-title">Reading <em>Reports</em></div></div>
    <div class="report-card"><div class="report-title">Books by Genre</div><div class="bar-chart" id="genreChart"></div></div>
    <div class="report-card"><div class="report-title">Monthly Activity</div><div class="bar-chart" id="monthChart"></div></div>
  </div>

  <!-- SETTINGS VIEW -->
  <div class="page-view" id="view-settings">
    <div class="page-head"><div class="page-head-title"><em>Settings</em></div></div>
    <div class="report-card">
      <div class="report-title">Account</div>
      <div class="settings-row"><div><div class="settings-row-label">Display Name</div><div class="settings-row-sub">Your reading identity</div></div><div class="settings-row-val">Reader M</div></div>
      <div class="settings-row"><div><div class="settings-row-label">Reading Goal</div><div class="settings-row-sub">Books per month</div></div><div class="settings-row-val">5 books</div></div>
      <div class="settings-row"><div><div class="settings-row-label">Theme</div><div class="settings-row-sub">Interface appearance</div></div><div class="settings-row-val">Dark 🌙</div></div>
      <div class="settings-row"><div><div class="settings-row-label">Notifications</div><div class="settings-row-sub">New releases & updates</div></div><div class="toggle-btn" onclick="showToast('🔔 Notifications toggled')"><div class="toggle-btn-dot"></div></div></div>
    </div>
    <div class="report-card">
      <div class="report-title">Library Statistics</div>
      <div style="display:flex;gap:8px;">
        <div class="stat-box"><div class="stat-box-num" id="settTotalBooks">25</div><div class="stat-box-lbl">Total Books</div></div>
        <div class="stat-box"><div class="stat-box-num">5</div><div class="stat-box-lbl">Genres</div></div>
        <div class="stat-box"><div class="stat-box-num">12</div><div class="stat-box-lbl">Authors</div></div>
      </div>
    </div>
  </div>

</main>
</div>

<!-- READER OVERLAY -->
<div id="readerOverlay">
  <div class="reader-topbar">
    <button class="reader-close-btn" onclick="closeReader()">×</button>
    <div style="display:flex;flex-direction:column;flex:1;min-width:0;">
      <div class="reader-book-title" id="readerTitle">Book Title</div>
      <div class="reader-book-author" id="readerAuthor">by Author</div>
    </div>
    <div class="reader-progress-wrap">
      <div class="reader-progress-bar"><div class="reader-progress-fill" id="readerProgressFill" style="width:0%"></div></div>
      <div class="reader-progress-text" id="readerProgressText">Chapter 1 of 5</div>
    </div>
    <div class="reader-controls">
      <button class="reader-font-btn" onclick="changeFontSize(-1)">A-</button>
      <button class="reader-font-btn" onclick="changeFontSize(1)">A+</button>
      <button class="reader-ctrl-btn active" id="fontToggleBtn" onclick="toggleFont()">Serif</button>
    </div>
  </div>
  <div class="reader-body">
    <div class="chapter-sidebar" id="chapterSidebar">
      <div class="chap-sidebar-title">Chapters</div>
      <div id="chapterList"></div>
    </div>
    <div class="reader-content-wrap" id="readerContentWrap">
      <div class="reader-paper" id="readerPaper">
        <div id="readerContentArea"></div>
      </div>
    </div>
  </div>
</div>

<!-- BOOK DETAIL MODAL -->
<div class="modal-overlay" id="detailModal">
  <div class="modal" style="position:relative;">
    <button class="modal-close" onclick="closeDetailModal()">×</button>
    <div class="modal-cover" id="modalCover">
      <div id="modalCoverContent" style="position:relative;z-index:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:54px;"></div>
      <img id="modalCoverImg" src="" alt="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
      <div class="modal-cover-overlay"></div>
    </div>
    <div class="modal-body">
      <div class="modal-genre" id="modalGenre"></div>
      <div class="modal-title" id="modalTitle"></div>
      <div class="modal-author" id="modalAuthor"></div>
      <div class="modal-divider"></div>
      <div class="modal-desc" id="modalDesc"></div>
      <div class="modal-actions">
        <button class="btn-modal btn-read" onclick="startReading()">📖 Read Now</button>
        <button class="btn-modal btn-primary" onclick="toggleFavModal()">★ Favorite</button>
        <button class="btn-modal btn-secondary" onclick="editCurrentBook()">✏️ Edit</button>
        <button class="btn-modal btn-danger" onclick="confirmDeleteCurrent()">🗑️</button>
      </div>
    </div>
  </div>
</div>

<!-- ADD/EDIT MODAL -->
<div class="modal-overlay" id="addModal">
  <div class="modal add-modal" style="position:relative;">
    <button class="modal-close" onclick="closeAddModal()">×</button>
    <div class="modal-body">
      <div class="modal-headline" id="addModalHeadline">Add a Novel</div>
      <div class="modal-sub" id="addModalSub">Expand your collection</div>
      <div class="form-grid">
        <div class="field"><label>Title *</label><input type="text" id="addTitle" placeholder="Novel title"></div>
        <div class="field"><label>Author</label><input type="text" id="addAuthor" placeholder="Author name"></div>
        <div class="field"><label>Genre</label>
          <select id="addGenre">
            <option value="" disabled selected>Select genre</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Romance">Romance</option>
            <option value="Horror">Horror</option>
            <option value="Action">Action</option>
            <option value="Biography">Biography</option>
          </select>
        </div>
        <div class="field full"><label>Synopsis</label><textarea id="addDesc" placeholder="Brief description…"></textarea></div>
      </div>
      <div class="modal-actions">
        <button class="btn-modal btn-secondary" onclick="closeAddModal()">Cancel</button>
        <button class="btn-modal btn-primary" id="addModalSubmitBtn" onclick="submitNovelForm()">+ Add Novel</button>
      </div>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM -->
<div class="modal-overlay" id="confirmModal">
  <div class="modal confirm-modal" style="position:relative;">
    <button class="modal-close" onclick="closeConfirmModal()">×</button>
    <div class="modal-body">
      <div class="confirm-icon">🗑️</div>
      <div class="confirm-title">Delete this novel?</div>
      <div class="confirm-sub" id="confirmSubText">This will permanently remove this book.</div>
      <div class="confirm-actions">
        <button class="btn-modal btn-secondary" onclick="closeConfirmModal()">Cancel</button>
        <button class="btn-modal btn-danger" onclick="executeDelete()">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
// ── NAVIGATION HISTORY STACK ──
const navHistory = [];
let currentPage = 'home';

const PAGE_LABELS = {
  home: '🏠 Home', authors: '👤 Authors', genres: '🏷️ Genres',
  reading: '📖 Reading', favorites: '⭐ Favorites', schedule: '📅 Schedule',
  library: '🗂️ Library', reports: '📊 Reports', settings: '⚙️ Settings'
};

// ── DATA ──
const BOOK_STORIES = {
  1: [
    `The morning Violet Sorrengail walked through the gates of Basgiath War College, the sky was the color of a fresh bruise. She had expected fear. She had expected doubt. What she had not expected was the way every rider candidate around her seemed born of steel and arrogance, shoulders thrown back, eyes scanning the grounds like they already owned them. Violet adjusted the strap of her satchel and reminded herself that her mother had not raised her to flinch.\n\nThe Parapet loomed ahead — a narrow stone bridge that crossed a canyon so deep the bottom existed only in rumor. All around her, candidates who had trained their whole lives for this moment were whispering prayers to gods who probably had better things to do. Violet was twenty feet from the edge when a hand shot out and grabbed her arm. "You don't belong here, scribe," said a voice like a drawn blade. She turned to find Xaden Riorson staring down at her with golden eyes that held all the warmth of a November storm.\n\n"Neither do you," she said, and stepped onto the Parapet.\n\nThe wind hit her like a physical thing. Below her, the canyon breathed cold air upward in slow, invisible waves, and for a moment the world tilted sideways. She thought of her sister Mira's advice: don't look down. She thought of her mother's command: don't fail. She made it across. Her hands were shaking too badly for triumph. But she made it, and when she turned around, Xaden Riorson was watching her with something in his expression that was not quite contempt and not quite respect and was somehow, inexplicably, more dangerous than either.`,
    `The dragons chose their riders at dawn, in a ceremony that looked from a distance like controlled chaos and felt up close like standing inside a thunderstorm. Violet had memorized every known account of the Bonding Ceremony. None of them had adequately prepared her for the reality.\n\nTairn landed in the center of the courtyard and scattered everyone within forty feet. He was enormous even by dragon standards, his scales the deep black-green of a forest seen through river water, his eyes the color of molten copper. Every rider nearby scrambled backward. Violet stood still, not out of bravery but because her legs had briefly forgotten how to work. The dragon lowered his enormous head until one copper eye was level with hers.\n\nShe heard his voice inside her skull like a bell struck at the base of her spine. "You will do," he said. It was not, she understood immediately, a compliment. It was an assessment. A decision. She exhaled slowly and thought back at him, as clearly as she could: "So will you." Something vast and ancient shifted behind those copper eyes, and for just a moment, Violet could have sworn the dragon was amused.`,
    `Rider training was nothing like the histories described. The histories spoke of glory. They did not mention that the first three weeks consisted primarily of being thrown, dragged, and occasionally dropped from increasingly alarming heights while an instructor shouted corrections from a safe distance below. Violet had bruises in shapes she couldn't explain and muscles she hadn't known she possessed.\n\nXaden was everywhere she didn't want him to be. He appeared at the training yard when she was struggling with the harness sequences. He appeared at the dining hall when she was trying to eat in peace. He never helped. He observed, with the focused attention of someone cataloguing weaknesses.\n\nThe war games changed things. Violet had grown up reading strategy manuals the way other children read fairy tales. "You're going to get us all killed with that plan," she told Ridoc. He blinked. "I haven't presented a plan yet." "I know," she said. "I'm preemptively saving us." They won. It was not graceful but they won, and afterward Xaden looked at her across the courtyard with an expression she still couldn't read.`,
    `The letter arrived on a Tuesday. Violet recognized her mother's seal and felt the familiar weight of dread that her mother's correspondence always carried. The letter was brief, as her mother's letters always were, and it said, in essence, that Violet needed to stop making herself conspicuous.\n\nShe burned it in the small hours of the morning, in the courtyard where the sentry rotation had a blind spot she had mapped in her second week. Tairn found her there, settling beside her with the careful deliberateness of something very large trying not to cause damage.\n\n"My mother thinks I'm going to get myself killed," she told him. "Your mother is not wrong," he said. "That's not helpful." "It was not intended to be helpful. It was intended to be accurate."\n\nShe leaned against his side, which was warm in the way that stone holds warmth — deep and slow and from within. She thought about the war that everyone insisted was over and the way the dragons flinched sometimes when they looked north. She thought: whatever is coming, I want to be ready. Tairn said: "Then sleep. Tomorrow I will teach you to fly."`,
    `She did not fly gracefully. She flew the way she did most things — with determination overcompensating for lack of innate talent, her knuckles white on the harness and her jaw set against the wind. Tairn was patient in the way that geological formations are patient: not warm, not encouraging, but present and enduring and very, very unlikely to let her fall.\n\nXaden appeared on her left, Sgaeyl matching pace with Tairn in that effortless way bonded pairs had. "You're overcorrecting on the turns," he said, without preamble. "I'm aware," she said. "Your left hand is three inches higher than your right when you bank." "Also aware." "You could just let Tairn handle it." "I could," she agreed, "but then I wouldn't learn."\n\nShe glanced across at him. This close, with the wind stripping away whatever careful arrangement he made of his expression on the ground, he looked something she couldn't name. Not younger exactly, but less armored. Below them, the war college turned in the morning light, full of its ordinary miracles and its hidden dangers, and Violet Sorrengail flew on into whatever came next.`
  ]
};

const genreColors = {
  Fantasy:  { bg:'linear-gradient(135deg,#064e3b,#065f46)', dot:'#22c55e', badge:'rgba(34,197,94,0.15)', btext:'#22c55e' },
  Romance:  { bg:'linear-gradient(135deg,#831843,#9d174d)', dot:'#f472b6', badge:'rgba(244,114,182,0.15)', btext:'#f472b6' },
  Horror:   { bg:'linear-gradient(135deg,#7f1d1d,#991b1b)', dot:'#ef4444', badge:'rgba(239,68,68,0.15)', btext:'#ef4444' },
  Action:   { bg:'linear-gradient(135deg,#1e3a5f,#1d4ed8)', dot:'#60a5fa', badge:'rgba(96,165,250,0.15)', btext:'#60a5fa' },
  Biography:{ bg:'linear-gradient(135deg,#78350f,#92400e)', dot:'#fb923c', badge:'rgba(251,146,60,0.15)', btext:'#fb923c' }
};

const NOTIFS = [
  {id:1,icon:'📚',text:'New book added — "The Familiar"',time:'2 min ago',unread:true},
  {id:2,icon:'⭐',text:'You reached your weekly reading goal!',time:'1 hour ago',unread:true},
  {id:3,icon:'🆕',text:'5 new Fantasy releases available this week',time:'3 hours ago',unread:true},
  {id:4,icon:'📖',text:'Reminder: Continue "Holly" — Chapter 8',time:'Yesterday',unread:false},
  {id:5,icon:'👤',text:'New author profile added: Emily Henry',time:'2 days ago',unread:false}
];

const coverCache = {};
let favorites = [1,3,6,11,16,21];
let novels = [
  {id:1,title:"Fourth Wing",author:"Rebecca Yarros",genre:"Fantasy",desc:"Violet Sorrengail is sent to a deadly dragon-rider war college in this epic enemies-to-lovers fantasy.",emoji:"🐉"},
  {id:2,title:"A Court of Thorns and Roses",author:"Sarah J. Maas",genre:"Fantasy",desc:"A huntress is taken to a magical fae land in this sweeping Beauty and the Beast retelling.",emoji:"🌹"},
  {id:3,title:"The Midnight Library",author:"Matt Haig",genre:"Fantasy",desc:"A library between life and death offers infinite chances to live a different life.",emoji:"📚"},
  {id:4,title:"The Familiar",author:"Leigh Bardugo",genre:"Fantasy",desc:"A servant in 1490s Spain makes a desperate magical bargain to survive the Inquisition.",emoji:"✨"},
  {id:5,title:"The Life Impossible",author:"Matt Haig",genre:"Fantasy",desc:"A retired teacher travels to Ibiza and uncovers a supernatural mystery tied to a missing friend.",emoji:"🌊"},
  {id:6,title:"Happy Place",author:"Emily Henry",genre:"Romance",desc:"A recently separated couple must pretend they are still together during their annual friend trip in Maine.",emoji:"💕"},
  {id:7,title:"Book Lovers",author:"Emily Henry",genre:"Romance",desc:"A cutthroat literary agent and a small-town editor keep crossing paths in this witty love story.",emoji:"📖"},
  {id:8,title:"Icebreaker",author:"Hannah Grace",genre:"Romance",desc:"A figure skater and a hockey captain are forced to share a rink and slowly fall for each other.",emoji:"⛸️"},
  {id:9,title:"Tomorrow and Tomorrow",author:"Gabrielle Zevin",genre:"Romance",desc:"Two childhood friends reunite to make video games and navigate love across three decades.",emoji:"🎮"},
  {id:10,title:"Intermezzo",author:"Sally Rooney",genre:"Romance",desc:"Two grieving brothers navigate very different love affairs after the death of their father.",emoji:"💔"},
  {id:11,title:"Holly",author:"Stephen King",genre:"Horror",desc:"PI Holly Gibney investigates disappearances and uncovers a shocking evil hiding in a college town.",emoji:"💀"},
  {id:12,title:"The Hollow Kind",author:"Andy Davidson",genre:"Horror",desc:"A woman inherits her grandfather's Georgia farm only to discover a monstrous ancient evil buried in the pines.",emoji:"🌲"},
  {id:13,title:"The Troop",author:"Nick Cutter",genre:"Horror",desc:"A scoutmaster leads five boys to an isolated island where a terrifying stranger arrives and spreads a nightmare.",emoji:"🔦"},
  {id:14,title:"Plain Bad Heroines",author:"Emily M. Danforth",genre:"Horror",desc:"A gothic horror weaving two timelines around a cursed all-girls school and a swarm of yellow jackets.",emoji:"🐝"},
  {id:15,title:"The Whisper Man",author:"Alex North",genre:"Horror",desc:"A grieving father moves to a new town only to find a killer from the past is still whispering to children.",emoji:"👻"},
  {id:16,title:"James",author:"Percival Everett",genre:"Action",desc:"A Pulitzer Prize-winning reimagining of Huckleberry Finn told through the eyes of Jim.",emoji:"⚡"},
  {id:17,title:"Demon Copperhead",author:"Barbara Kingsolver",genre:"Action",desc:"A Pulitzer Prize winner retelling David Copperfield set in Appalachian Virginia amid the opioid crisis.",emoji:"🔥"},
  {id:18,title:"The Accountant",author:"Nicholas Searle",genre:"Action",desc:"A man living a double life as a contract killer faces the collision of his two worlds.",emoji:"🎯"},
  {id:19,title:"Reaper",author:"Mark Greaney",genre:"Action",desc:"Court Gentry, the Gray Man, takes on a series of impossible assassinations across Europe.",emoji:"🗡️"},
  {id:20,title:"The Covenant",author:"James Patterson",genre:"Action",desc:"A team of elite operatives uncover a global conspiracy that threatens to ignite a world war.",emoji:"💥"},
  {id:21,title:"The Women",author:"Kristin Hannah",genre:"Biography",desc:"A young woman joins the Army Nurse Corps during Vietnam and confronts war, loss, and a difficult homecoming.",emoji:"📜"},
  {id:22,title:"The Covenant of Water",author:"Abraham Verghese",genre:"Biography",desc:"A 77-year saga of three generations of a South Indian family exploring love, loss, and medicine.",emoji:"💧"},
  {id:23,title:"Hello Beautiful",author:"Ann Napolitano",genre:"Biography",desc:"A multigenerational Chicago family saga tracing the echoes of one painful abandonment.",emoji:"🌸"},
  {id:24,title:"Educated",author:"Tara Westover",genre:"Biography",desc:"A woman raised by survivalists in rural Idaho educates herself and escapes to Cambridge against all odds.",emoji:"🎓"},
  {id:25,title:"Spare",author:"Prince Harry",genre:"Biography",desc:"Prince Harry recounts his life inside the royal family and his path to freedom.",emoji:"👑"}
];

let currentDetailId = null, editingId = null, deletingId = null;
let readerNovel = null, readerChapterIdx = 0, readerFontSize = 18, readerUseSerif = true;
let chapterCache = {}, isGenerating = false;
const CHAPTER_COUNT = 5;
let activeGenreFilter = null;

// ── BACK BAR ──
function injectBackBar(viewId, onBackFn, breadcrumbHTML) {
  const view = document.getElementById(viewId);
  if (!view) return;
  view.querySelectorAll('.back-bar').forEach(el => el.remove());
  const bar = document.createElement('div');
  bar.className = 'back-bar';
  bar.innerHTML = `
    <button class="back-btn" id="backBtn_${viewId}">
      <span class="back-arrow">←</span> Back
    </button>
    <div class="breadcrumb-trail">${breadcrumbHTML}</div>`;
  view.insertBefore(bar, view.firstChild);
  document.getElementById('backBtn_' + viewId).addEventListener('click', onBackFn);
}

// ── NAVIGATION ──
function navigate(page) {
  if (page === currentPage) return;
  navHistory.push(currentPage);
  _navigateTo(page);
}

function _navigateTo(page) {
  currentPage = page;
  document.querySelectorAll('.nav-item[data-page]').forEach(btn =>
    btn.classList.toggle('active', btn.dataset.page === page));
  document.querySelectorAll('.page-view').forEach(v => v.classList.remove('active'));
  const el = document.getElementById('view-' + page);
  if (el) el.classList.add('active');

  if (page === 'authors') {
    document.getElementById('authorsMainView').style.display = 'block';
    document.getElementById('authorBooksView').style.display = 'none';
  }

  if (page !== 'home' && navHistory.length > 0) {
    const fromPage = navHistory[navHistory.length - 1];
    const fromLabel = PAGE_LABELS[fromPage] || fromPage;
    const currentLabel = PAGE_LABELS[page] || page;
    const breadcrumb = `<span class="bc-item" id="bcFrom_${page}">${fromLabel}</span>
      <span class="bc-sep">›</span>
      <span class="bc-current">${currentLabel}</span>`;
    injectBackBar('view-' + page, navigateBack, breadcrumb);
  }

  const renders = {
    home: renderHome, authors: renderAuthors, genres: renderGenres,
    reading: renderReadingView, favorites: renderFavorites,
    schedule: renderSchedule, library: renderLibrary, reports: renderReports
  };
  if (renders[page]) renders[page]();
  window.scrollTo(0, 0);
}

function navigateBack() {
  if (navHistory.length === 0) return;
  const prev = navHistory.pop();
  currentPage = prev;
  document.querySelectorAll('.nav-item[data-page]').forEach(btn =>
    btn.classList.toggle('active', btn.dataset.page === prev));
  document.querySelectorAll('.page-view').forEach(v => v.classList.remove('active'));
  const el = document.getElementById('view-' + prev);
  if (el) el.classList.add('active');

  if (prev === 'authors') {
    document.getElementById('authorsMainView').style.display = 'block';
    document.getElementById('authorBooksView').style.display = 'none';
  }

  if (prev !== 'home' && navHistory.length > 0) {
    const fromPage = navHistory[navHistory.length - 1];
    const fromLabel = PAGE_LABELS[fromPage] || fromPage;
    const currentLabel = PAGE_LABELS[prev] || prev;
    const breadcrumb = `<span class="bc-item">${fromLabel}</span>
      <span class="bc-sep">›</span>
      <span class="bc-current">${currentLabel}</span>`;
    injectBackBar('view-' + prev, navigateBack, breadcrumb);
  } else if (prev !== 'home') {
    document.getElementById('view-' + prev)?.querySelectorAll('.back-bar').forEach(el => el.remove());
  }

  const renders = {
    home: renderHome, authors: renderAuthors, genres: renderGenres,
    reading: renderReadingView, favorites: renderFavorites,
    schedule: renderSchedule, library: renderLibrary, reports: renderReports
  };
  if (renders[prev]) renders[prev]();
  window.scrollTo(0, 0);
}

function setFchip(el) {
  document.querySelectorAll('.fchip').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
}

// ── AUTHOR BOOKS ──
const authorGrads = ['linear-gradient(135deg,#7c3aed,#db2777)','linear-gradient(135deg,#0ea5e9,#6366f1)','linear-gradient(135deg,#f59e0b,#ef4444)','linear-gradient(135deg,#10b981,#3b82f6)','linear-gradient(135deg,#f472b6,#fb923c)','linear-gradient(135deg,#22c55e,#0ea5e9)','linear-gradient(135deg,#a78bfa,#60a5fa)','linear-gradient(135deg,#f43f5e,#f97316)','linear-gradient(135deg,#34d399,#818cf8)','linear-gradient(135deg,#fbbf24,#f472b6)','linear-gradient(135deg,#818cf8,#f472b6)','linear-gradient(135deg,#fb923c,#22c55e)'];
const authorAvatars = ['😊','🧑‍💻','👩‍🎨','🧙‍♂️','👨‍🔬','👩‍🦰','🧔','👩‍🦳','🧕','👨‍🎤','🎭','🌟'];

function showAuthorBooks(authorName, authorIndex) {
  const authorNovels = novels.filter(n => n.author === authorName);
  const grad = authorGrads[authorIndex % authorGrads.length];
  const avatar = authorAvatars[authorIndex % authorAvatars.length];
  const gc = genreColors[authorNovels[0]?.genre] || genreColors.Fantasy;

  document.getElementById('authorBooksHeader').innerHTML = `
    <div class="author-books-avatar" style="background:${grad};">${avatar}</div>
    <div class="author-books-info">
      <div class="author-books-name">${authorName}</div>
      <div class="author-books-meta" style="color:${gc.dot};">${authorNovels.length} book${authorNovels.length !== 1 ? 's' : ''} in library · ${authorNovels[0]?.genre || ''}</div>
    </div>`;

  document.getElementById('authorBooksSectionTitle').textContent = `Books by ${authorName}`;

  const grid = document.getElementById('authorBooksGrid');
  grid.innerHTML = authorNovels.map((n, i) => {
    const ngc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="pop-book-card" id="ab_card_${n.id}" style="animation-delay:${i*0.06}s">
      <div class="card-actions">
        <button class="ca-btn ca-edit" onclick="event.stopPropagation();openEditModal(${n.id})">✏️</button>
        <button class="ca-btn ca-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button>
      </div>
      <div onclick="openDetail(${n.id})">
        <div class="pop-cover" style="background:${ngc.bg};">
          <img id="ab_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
          <div id="ab_ph_${n.id}" class="pop-cover-ph">${n.emoji}</div>
        </div>
        <div class="pop-body">
          <div class="pop-title">${n.title}</div>
          <div class="pop-author"><span class="pop-genre-dot" style="background:${ngc.dot};"></span>${n.genre}</div>
          <button class="read-btn" onclick="event.stopPropagation();currentDetailId=${n.id};startReading()">📖 Read Now</button>
        </div>
      </div>
    </div>`;
  }).join('');

  authorNovels.forEach(n => {
    getCover(n, 'M').then(url => applyImg(document.getElementById('ab_img_'+n.id), document.getElementById('ab_ph_'+n.id), url, n.emoji));
  });

  document.getElementById('authorsMainView').style.display = 'none';
  document.getElementById('authorBooksView').style.display = 'block';

  injectBackBar('view-authors', backToAuthors,
    `<span class="bc-item" onclick="backToAuthors()">👤 Authors</span>
     <span class="bc-sep">›</span>
     <span class="bc-current">📖 ${authorName}</span>`);

  window.scrollTo(0, 0);
}

function backToAuthors() {
  document.getElementById('authorsMainView').style.display = 'block';
  document.getElementById('authorBooksView').style.display = 'none';
  if (navHistory.length > 0) {
    const fromPage = navHistory[navHistory.length - 1];
    const fromLabel = PAGE_LABELS[fromPage] || fromPage;
    injectBackBar('view-authors', navigateBack,
      `<span class="bc-item">${fromLabel}</span><span class="bc-sep">›</span><span class="bc-current">👤 Authors</span>`);
  } else {
    document.getElementById('view-authors')?.querySelectorAll('.back-bar').forEach(el => el.remove());
  }
}

// ── CHAPTERS ──
function getChapterTitles(novel) {
  const t = {
    Fantasy:  ['The Call to Arms','Dragons and Destiny','The First Flight','Shadows of the Keep','Wings of Fate'],
    Romance:  ['Unexpected Meeting','Words Unsaid','Crossing Lines','Surrender','Ever After'],
    Horror:   ['Something in the Dark','The Neighbor','Doors That Shouldn\'t Open','Missing Hours','The Last Night'],
    Action:   ['The Assignment','First Blood','Double Cross','Point of No Return','Aftermath'],
    Biography:['Origins','The Early Years','A Turn of Fate','Rising','Legacy']
  };
  return t[novel.genre] || t.Fantasy;
}

function generateFallbackStory(novel, idx) {
  const titles = getChapterTitles(novel);
  const t = titles[idx];
  const opens = {
    Fantasy:'The kingdom had not seen magic in a thousand years, or so the histories claimed.',
    Romance:'She was not supposed to be here.',
    Horror:'The lights had been on for seventy-two consecutive hours. She had been counting.',
    Action:'The mission briefing lasted eleven minutes.',
    Biography:'The house she grew up in no longer exists.'
  };
  const o = opens[novel.genre] || opens.Fantasy;
  return `${o}\n\nThe chapter of ${novel.title} titled "${t}" finds its characters at a pivotal moment. ${novel.desc}\n\nFor ${novel.author}, the craft has always been in the specifics: the precise weight of a moment, the exact quality of light in a scene. This chapter exemplifies that approach, moving the story forward through accumulation rather than event.\n\nThe world of the novel presses close here. The ${novel.genre.toLowerCase()} elements are in full force — this is the genre's grammar being used fluently, its conventions honored and occasionally subverted.\n\nWhatever came next, it would come. She was not ready, but she had never been ready for the things that had mattered most, and she had survived them anyway.`;
}

// ── NOTIFICATIONS ──
function renderNotifs() {
  const u = NOTIFS.filter(n => n.unread);
  const badge = document.getElementById('notifBadge');
  const dot = document.getElementById('notifDot');
  const list = document.getElementById('notifItems');
  if (badge) { badge.textContent = u.length; badge.style.display = u.length ? '' : 'none'; }
  if (dot) dot.style.display = u.length ? '' : 'none';
  if (!list) return;
  list.innerHTML = NOTIFS.map(n => `
    <div class="notif-item${n.unread?' unread':''}" onclick="markNotifRead(${n.id})">
      <div class="notif-item-icon">${n.icon}</div>
      <div class="notif-item-body"><div class="notif-item-text">${n.text}</div><div class="notif-item-time">${n.time}</div></div>
      ${n.unread ? '<div class="notif-unread-pip"></div>' : ''}
    </div>`).join('');
}
function toggleNotifPanel(e) {
  e.stopPropagation();
  const p = document.getElementById('notifPanel');
  p.classList.toggle('open', !p.classList.contains('open'));
  if (p.classList.contains('open')) renderNotifs();
}
function markNotifRead(id) { const n = NOTIFS.find(x => x.id === id); if (n) n.unread = false; renderNotifs(); }
function markAllNotifs() { NOTIFS.forEach(n => n.unread = false); renderNotifs(); showToast('✅ All notifications marked as read'); }
document.addEventListener('click', e => {
  const w = document.getElementById('notifBtn')?.closest('.notif-wrap');
  const p = document.getElementById('notifPanel');
  if (p && w && !w.contains(e.target)) p.classList.remove('open');
});

// ── COVER FETCH ──
async function getCover(novel, size = 'M') {
  const key = novel.id + '-' + size;
  if (coverCache[key] !== undefined) return coverCache[key];
  try {
    const r = await fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(novel.title)}&author=${encodeURIComponent(novel.author||'')}&limit=1&fields=cover_i`);
    const d = await r.json();
    const cid = d?.docs?.[0]?.cover_i;
    if (!cid) { coverCache[key] = null; return null; }
    const url = `https://covers.openlibrary.org/b/id/${cid}-${size}.jpg`;
    return new Promise(res => {
      const img = new Image();
      img.onload = () => { if (img.naturalWidth < 10) { coverCache[key] = null; res(null); } else { coverCache[key] = url; res(url); } };
      img.onerror = () => { coverCache[key] = null; res(null); };
      img.src = url;
    });
  } catch { coverCache[key] = null; return null; }
}
function applyImg(imgEl, phEl, url, ph) {
  if (url) { if (imgEl) { imgEl.src = url; imgEl.style.display = 'block'; } if (phEl) phEl.style.display = 'none'; }
  else { if (imgEl) imgEl.style.display = 'none'; if (phEl) { phEl.style.display = 'flex'; phEl.innerHTML = ph || '📖'; } }
}

// ── HOME ──
function renderHome() { renderPrevReading(); renderPopular(); }

function renderPrevReading() {
  const cont = document.getElementById('prevReadingScroll');
  if (!cont) return;
  const reading = novels.slice(0, 7);
  const progresses = [45,80,30,65,15,90,55];
  cont.innerHTML = reading.map((n, i) => {
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="book-thumb" onclick="openDetail(${n.id})" style="animation-delay:${i*0.07}s">
      <div class="book-cover" style="background:${gc.bg};">
        <img id="prev_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
        <div id="prev_ph_${n.id}" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:24px;">${n.emoji}</div>
        <div class="book-cover-bar"><div class="book-cover-progress" id="prev_prog_${n.id}" style="width:0%"></div></div>
      </div>
      <div class="book-thumb-title">${n.title}</div>
      <div class="book-thumb-author">${n.author}</div>
    </div>`;
  }).join('');
  reading.forEach((n, i) => {
    setTimeout(() => { const b = document.getElementById('prev_prog_'+n.id); if (b) b.style.width = progresses[i]+'%'; }, 300 + i*80);
    getCover(n,'M').then(url => applyImg(document.getElementById('prev_img_'+n.id), document.getElementById('prev_ph_'+n.id), url, n.emoji));
  });
}

function renderPopular() {
  const cont = document.getElementById('popularGrid');
  if (!cont) return;
  cont.innerHTML = novels.slice(0,10).map((n,i) => {
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="pop-book-card" style="animation-delay:${i*0.06}s">
      <div class="card-actions">
        <button class="ca-btn ca-edit" onclick="event.stopPropagation();openEditModal(${n.id})">✏️</button>
        <button class="ca-btn ca-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button>
      </div>
      <div onclick="openDetail(${n.id})">
        <div class="pop-cover" style="background:${gc.bg};">
          <img id="pop_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
          <div id="pop_ph_${n.id}" class="pop-cover-ph">${n.emoji}</div>
        </div>
        <div class="pop-body">
          <div class="pop-title">${n.title}</div>
          <div class="pop-author"><span class="pop-genre-dot" style="background:${gc.dot};"></span>${n.author}</div>
          <button class="read-btn" onclick="event.stopPropagation();currentDetailId=${n.id};startReading()">📖 Read Now</button>
        </div>
      </div>
    </div>`;
  }).join('');
  novels.slice(0,10).forEach(n => {
    getCover(n,'M').then(url => applyImg(document.getElementById('pop_img_'+n.id), document.getElementById('pop_ph_'+n.id), url, n.emoji));
  });
}

// ── AUTHORS ──
function renderAuthors() {
  const cont = document.getElementById('authorsGrid');
  if (!cont) return;
  const authors = [...new Map(novels.map(n => [n.author, n])).values()];
  cont.innerHTML = authors.map((n, i) => {
    const cnt = novels.filter(b => b.author === n.author).length;
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="author-card" style="animation-delay:${i*0.06}s" onclick="showAuthorBooks('${n.author.replace(/'/g,"\\'")}',${i})">
      <div class="author-big-avatar" style="background:${authorGrads[i%authorGrads.length]};border-color:transparent;">${authorAvatars[i]}</div>
      <div class="author-name">${n.author}</div>
      <div class="author-genre" style="color:${gc.dot};">${n.genre}</div>
      <div class="author-stats">
        <div class="astat"><div class="astat-num">${cnt}</div><div class="astat-lbl">Books</div></div>
        <div class="astat"><div class="astat-num">⭐4.${(7+i)%10}</div><div class="astat-lbl">Rating</div></div>
      </div>
    </div>`;
  }).join('');
}

// ── GENRES ──
function renderGenres() {
  const cont = document.getElementById('genresGrid');
  if (!cont) return;
  const genres = [
    {name:'Fantasy',emoji:'🐉',bg:'linear-gradient(135deg,#064e3b,#065f46,#047857)'},
    {name:'Romance',emoji:'💕',bg:'linear-gradient(135deg,#831843,#9d174d,#be185d)'},
    {name:'Horror',emoji:'💀',bg:'linear-gradient(135deg,#7f1d1d,#991b1b,#b91c1c)'},
    {name:'Action',emoji:'⚡',bg:'linear-gradient(135deg,#1e3a5f,#1d4ed8,#2563eb)'},
    {name:'Biography',emoji:'📜',bg:'linear-gradient(135deg,#78350f,#92400e,#b45309)'}
  ];
  cont.innerHTML = genres.map((g, i) => {
    const cnt = novels.filter(n => n.genre === g.name).length;
    return `<div class="genre-big-card" style="background:${g.bg};animation-delay:${i*0.08}s;" onclick="filterByGenre('${g.name}',null)">
      <div>
        <div class="genre-big-icon">${g.emoji}</div>
        <div class="genre-big-name">${g.name}</div>
        <div class="genre-big-count">${cnt} books</div>
      </div>
      <div class="genre-big-bg">${g.emoji}</div>
    </div>`;
  }).join('');
}

// ── READING VIEW ──
function renderReadingView() {
  const cont = document.getElementById('readingList');
  if (!cont) return;
  const progresses = [45,80,30];
  const statuses = [
    {label:'Reading',c:'rgba(232,197,71,0.15)',tc:'#e8c547'},
    {label:'Almost Done',c:'rgba(34,197,94,0.15)',tc:'#22c55e'},
    {label:'Just Started',c:'rgba(96,165,250,0.15)',tc:'#60a5fa'}
  ];
  const reading = novels.slice(2,5);
  cont.innerHTML = reading.map((n, i) => {
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    const s = statuses[i];
    return `<div class="reading-item" style="animation-delay:${i*0.1}s">
      <div class="reading-cover" style="background:${gc.bg};">
        <img id="read_img_${n.id}" src="" style="display:none;width:100%;height:100%;object-fit:cover;">
        <div id="read_ph_${n.id}" style="font-size:20px;">${n.emoji}</div>
      </div>
      <div class="reading-info">
        <div class="reading-title">${n.title}</div>
        <div class="reading-author">${n.author}</div>
        <div class="reading-progress-bar"><div class="reading-progress-fill" id="rp_${n.id}" style="width:0%"></div></div>
        <div class="reading-pct">${progresses[i]}% complete</div>
      </div>
      <div style="display:flex;flex-direction:column;gap:6px;align-items:flex-end;">
        <span class="reading-status" style="background:${s.c};color:${s.tc};">${s.label}</span>
        <button onclick="currentDetailId=${n.id};startReading()" style="padding:5px 12px;background:var(--gold);color:#000;border:none;border-radius:7px;font-size:10px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;">📖 Read</button>
      </div>
    </div>`;
  }).join('');
  reading.forEach((n, i) => {
    setTimeout(() => { const b = document.getElementById('rp_'+n.id); if (b) b.style.width = progresses[i]+'%'; }, 400+i*100);
    getCover(n,'M').then(url => applyImg(document.getElementById('read_img_'+n.id), document.getElementById('read_ph_'+n.id), url, n.emoji));
  });
}

// ── FAVORITES ──
function renderFavorites() {
  const cont = document.getElementById('favGrid');
  if (!cont) return;
  const favNovels = novels.filter(n => favorites.includes(n.id));
  if (!favNovels.length) { cont.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--text3);">No favorites yet. Click ★ on any book!</div>'; return; }
  cont.innerHTML = favNovels.map((n, i) => {
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="fav-card" style="animation-delay:${i*0.07}s" onclick="openDetail(${n.id})">
      <div class="fav-cover" style="background:${gc.bg};">
        <img id="fav_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
        <span id="fav_ph_${n.id}">${n.emoji}</span>
        <div class="fav-heart" onclick="event.stopPropagation();removeFav(${n.id})">❤️</div>
      </div>
      <div class="fav-body">
        <div class="fav-title">${n.title}</div>
        <div class="fav-author">${n.author}</div>
        <button onclick="event.stopPropagation();currentDetailId=${n.id};startReading()" style="width:100%;margin-top:6px;padding:5px;background:rgba(232,197,71,0.12);border:1px solid rgba(232,197,71,0.2);border-radius:6px;color:var(--gold);font-size:10px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;" onmouseover="this.style.background='var(--gold)';this.style.color='#000'" onmouseout="this.style.background='rgba(232,197,71,0.12)';this.style.color='var(--gold)'">📖 Read Now</button>
      </div>
    </div>`;
  }).join('');
  favNovels.forEach(n => getCover(n,'M').then(url => applyImg(document.getElementById('fav_img_'+n.id), document.getElementById('fav_ph_'+n.id), url, n.emoji)));
}
function removeFav(id) { favorites = favorites.filter(f => f !== id); showToast('💔 Removed from favorites'); renderFavorites(); }
function toggleFavModal() {
  if (!currentDetailId) return;
  if (favorites.includes(currentDetailId)) {
    favorites = favorites.filter(f => f !== currentDetailId);
    showToast('💔 Removed from favorites');
  } else {
    favorites.push(currentDetailId);
    showToast('❤️ Added to favorites!');
  }
}

// ── SCHEDULE ──
function renderSchedule() {
  const cont = document.getElementById('scheduleList');
  if (!cont) return;
  const schedule = [
    {day:'Today — Mon',items:[{time:'7:00 AM',icon:'☀️',title:'Morning Read',sub:'Fourth Wing - Ch. 1',dur:'30 min'},{time:'12:00 PM',icon:'📖',title:'Lunch Break',sub:'The Midnight Library',dur:'20 min'},{time:'9:00 PM',icon:'🌙',title:'Night Read',sub:'Book Lovers - Ch. 1',dur:'45 min'}]},
    {day:'Tomorrow — Tue',items:[{time:'7:30 AM',icon:'🌅',title:'Morning Session',sub:'Holly - Chapter 1',dur:'30 min'},{time:'6:00 PM',icon:'🏠',title:'Evening Read',sub:'Educated - Ch. 1',dur:'60 min'}]},
    {day:'Wednesday',items:[{time:'8:00 AM',icon:'📚',title:'Deep Read',sub:'The Covenant of Water',dur:'45 min'},{time:'1:00 PM',icon:'☕',title:'Cafe Session',sub:'Intermezzo - Part 1',dur:'40 min'}]}
  ];
  cont.innerHTML = schedule.map(d => `
    <div class="schedule-day">
      <div class="day-label">${d.day}</div>
      ${d.items.map(item => `
        <div class="schedule-item">
          <div class="sched-time">${item.time}</div>
          <div class="sched-icon">${item.icon}</div>
          <div class="sched-info"><div class="sched-title">${item.title}</div><div class="sched-sub">${item.sub}</div></div>
          <div class="sched-dur">${item.dur}</div>
        </div>`).join('')}
    </div>`).join('');
}

// ── LIBRARY ──
function renderLibrary(list) {
  const cont = document.getElementById('libraryGrid');
  if (!cont) return;
  const src = list !== undefined ? list : (activeGenreFilter ? novels.filter(n => n.genre === activeGenreFilter) : novels);

  const banner = document.getElementById('genreFilterBanner');
  const label = document.getElementById('genreFilterLabel');
  if (activeGenreFilter && banner && label) {
    banner.classList.add('show');
    const gc = genreColors[activeGenreFilter] || genreColors.Fantasy;
    label.textContent = activeGenreFilter;
    label.style.color = gc.dot;
  } else if (banner) {
    banner.classList.remove('show');
  }

  cont.innerHTML = src.map((n,i) => {
    const gc = genreColors[n.genre] || genreColors.Fantasy;
    return `<div class="pop-book-card" id="lib_card_${n.id}" style="animation-delay:${i*0.03}s">
      <div class="card-actions">
        <button class="ca-btn ca-edit" onclick="event.stopPropagation();openEditModal(${n.id})">✏️</button>
        <button class="ca-btn ca-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button>
      </div>
      <div onclick="openDetail(${n.id})">
        <div class="pop-cover" style="background:${gc.bg};">
          <img id="lib_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
          <div id="lib_ph_${n.id}" class="pop-cover-ph">${n.emoji}</div>
        </div>
        <div class="pop-body">
          <div class="pop-title">${n.title}</div>
          <div class="pop-author"><span class="pop-genre-dot" style="background:${gc.dot};"></span>${n.author}</div>
          <div class="lib-item-actions">
            <button class="lib-action-btn lib-action-edit" onclick="event.stopPropagation();currentDetailId=${n.id};startReading()">📖 Read</button>
            <button class="lib-action-btn lib-action-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️ Delete</button>
          </div>
        </div>
      </div>
    </div>`;
  }).join('') || '<div style="text-align:center;padding:40px;color:var(--text3);grid-column:1/-1;">No results found 📭</div>';
  src.forEach(n => getCover(n,'M').then(url => applyImg(document.getElementById('lib_img_'+n.id), document.getElementById('lib_ph_'+n.id), url, n.emoji)));
  updateStats();
}

function clearGenreFilter() { activeGenreFilter = null; renderLibrary(novels); }

// ── REPORTS ──
function renderReports() {
  const gc2 = document.getElementById('genreChart');
  const mc = document.getElementById('monthChart');
  if (gc2) {
    const genres = ['Fantasy','Romance','Horror','Action','Biography'];
    const colors = ['#22c55e','#f472b6','#ef4444','#60a5fa','#fb923c'];
    const counts = genres.map(g => novels.filter(n => n.genre === g).length);
    const mx = Math.max(...counts);
    gc2.innerHTML = genres.map((g,i) => `<div class="bar-row"><div class="bar-label">${g}</div><div class="bar-track"><div class="bar-fill" id="gbar_${i}" style="width:0%;background:${colors[i]};"></div></div><div class="bar-val">${counts[i]}</div></div>`).join('');
    setTimeout(() => genres.forEach((_,i) => { const b = document.getElementById('gbar_'+i); if (b) b.style.width = (counts[i]/mx*100)+'%'; }), 200);
  }
  if (mc) {
    const months = ['Jan','Feb','Mar','Apr','May','Jun'];
    const vals = [2,4,3,5,3,4];
    const mx2 = Math.max(...vals);
    mc.innerHTML = months.map((m,i) => `<div class="bar-row"><div class="bar-label">${m} 2025</div><div class="bar-track"><div class="bar-fill" id="mbar_${i}" style="width:0%;background:linear-gradient(90deg,#818cf8,#e8c547);"></div></div><div class="bar-val">${vals[i]}</div></div>`).join('');
    setTimeout(() => months.forEach((_,i) => { const b = document.getElementById('mbar_'+i); if (b) b.style.width = (vals[i]/mx2*100)+'%'; }), 200);
  }
}

// ── FILTER / SEARCH ──
function filterByGenre(genre, el) {
  activeGenreFilter = genre;
  navigate('library');
}

function handleSearch(val) {
  if (!val.trim()) {
    if (currentPage === 'library') { activeGenreFilter = null; renderLibrary(novels); }
    else { navigate('home'); }
    return;
  }
  const q = val.toLowerCase();
  const found = novels.filter(n => n.title.toLowerCase().includes(q) || n.author.toLowerCase().includes(q) || n.genre.toLowerCase().includes(q));
  activeGenreFilter = null;
  navigate('library');
  setTimeout(() => renderLibrary(found), 50);
}

// ── DETAIL MODAL ──
function openDetail(id) {
  const n = novels.find(x => x.id === id);
  if (!n) return;
  currentDetailId = id;
  const gc = genreColors[n.genre] || genreColors.Fantasy;
  document.getElementById('modalGenre').textContent = n.genre;
  document.getElementById('modalTitle').textContent = n.title;
  document.getElementById('modalAuthor').textContent = 'by ' + n.author;
  document.getElementById('modalDesc').textContent = n.desc;
  document.getElementById('modalCover').style.background = gc.bg;
  document.getElementById('modalCoverContent').textContent = n.emoji;
  const mci = document.getElementById('modalCoverImg');
  mci.style.display = 'none';
  getCover(n,'L').then(url => { if (url) { mci.src = url; mci.style.display = 'block'; } });
  document.getElementById('detailModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeDetailModal() { document.getElementById('detailModal').classList.remove('open'); document.body.style.overflow = ''; }
function editCurrentBook() { closeDetailModal(); if (currentDetailId) setTimeout(() => openEditModal(currentDetailId), 200); }
function confirmDeleteCurrent() { closeDetailModal(); if (currentDetailId) setTimeout(() => confirmDelete(currentDetailId), 200); }

// ── READER ──
function startReading() {
  if (!currentDetailId) return;
  const novel = novels.find(n => n.id === currentDetailId);
  if (!novel) return;
  closeDetailModal();
  setTimeout(() => openReader(novel), 250);
}
function openReader(novel) {
  readerNovel = novel; readerChapterIdx = 0; chapterCache = {};
  document.getElementById('readerTitle').textContent = novel.title;
  document.getElementById('readerAuthor').textContent = 'by ' + novel.author;
  renderChapterList(); loadChapter(0);
  document.getElementById('readerOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeReader() { document.getElementById('readerOverlay').classList.remove('open'); document.body.style.overflow = ''; }
function renderChapterList() {
  const titles = getChapterTitles(readerNovel);
  document.getElementById('chapterList').innerHTML = titles.map((t, i) => `
    <div class="chap-item ${i===readerChapterIdx?'active':''}" id="chapItem_${i}" onclick="selectChapter(${i})">
      <span class="chap-item-num">${String(i+1).padStart(2,'0')}</span>
      <span class="chap-item-name">${t}</span>
    </div>`).join('');
}
function selectChapter(idx) {
  readerChapterIdx = idx; renderChapterList(); loadChapter(idx);
  document.getElementById('readerContentWrap').scrollTop = 0;
}
function updateReaderProgress() {
  const pct = Math.round(((readerChapterIdx+1)/CHAPTER_COUNT)*100);
  document.getElementById('readerProgressFill').style.width = pct+'%';
  document.getElementById('readerProgressText').textContent = `Chapter ${readerChapterIdx+1} of ${CHAPTER_COUNT}`;
}

async function loadChapter(idx) {
  if (!readerNovel || isGenerating) return;
  updateReaderProgress();
  const titles = getChapterTitles(readerNovel);
  const chapterTitle = titles[idx];
  const area = document.getElementById('readerContentArea');
  area.innerHTML = `
    <div class="reader-chapter-header">
      <div class="reader-chapter-num">Chapter ${idx+1}</div>
      <div class="reader-chapter-title">${chapterTitle}</div>
      <div class="reader-chapter-meta">
        <span>${readerNovel.author}</span>·<span>${readerNovel.genre}</span>·<span id="wordCountLabel">Loading…</span>
      </div>
    </div>
    <div class="reader-content" id="chapterTextArea"></div>
    <div id="chapterFooterNav"></div>`;

  const cacheKey = readerNovel.id + '_' + idx;
  if (chapterCache[cacheKey]) { renderChapterText(chapterCache[cacheKey], idx); return; }

  const prewritten = BOOK_STORIES[readerNovel.id];
  if (prewritten && prewritten[idx]) { chapterCache[cacheKey] = prewritten[idx]; renderChapterText(prewritten[idx], idx); return; }

  const textArea = document.getElementById('chapterTextArea');
  textArea.innerHTML = `<div class="ai-generating">
    <div class="ai-gen-icon">📖</div>
    <div class="ai-gen-text">Generating Chapter ${idx+1}<br><em style="font-size:12px;color:var(--text3);">"${chapterTitle}"</em></div>
    <div class="ai-gen-bar"><div class="ai-gen-fill"></div></div>
    <div class="ai-typing-dots"><div class="ai-typing-dot"></div><div class="ai-typing-dot"></div><div class="ai-typing-dot"></div></div>
  </div>`;
  isGenerating = true;
  try {
    const prompt = `Write Chapter ${idx+1} of a ${readerNovel.genre} novel called "${readerNovel.title}" by ${readerNovel.author}. Chapter title: "${chapterTitle}". Synopsis: ${readerNovel.desc}. Write exactly 4-5 immersive paragraphs of vivid prose. Output ONLY the story text, no chapter headings.`;
    const response = await fetch('https://api.anthropic.com/v1/messages', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ model:'claude-sonnet-4-5', max_tokens:1000, messages:[{role:'user',content:prompt}] })
    });
    const data = await response.json();
    const text = data?.content?.[0]?.text || '';
    if (text.trim()) { chapterCache[cacheKey] = text.trim(); renderChapterText(text.trim(), idx); return; }
  } catch(e) { console.error('AI gen error:', e); }
  finally { isGenerating = false; }
  const fallback = generateFallbackStory(readerNovel, idx);
  chapterCache[cacheKey] = fallback;
  renderChapterText(fallback, idx);
}

function renderChapterText(text, idx) {
  const textArea = document.getElementById('chapterTextArea');
  const wordCount = text.split(/\s+/).length;
  const readTime = Math.ceil(wordCount / 200);
  const wl = document.getElementById('wordCountLabel');
  if (wl) wl.textContent = `~${wordCount} words · ${readTime} min read`;
  const paragraphs = text.split(/\n\n+/).filter(p => p.trim());
  let html = '';
  paragraphs.forEach(p => {
    const t = p.trim();
    if (!t) return;
    if (t === '* * *' || t === '---') html += '<div class="scene-break">· · ·</div>';
    else html += `<p>${t}</p>`;
  });
  textArea.innerHTML = html || `<p>${text}</p>`;
  applyReaderFont();
  renderChapterFooterNav(idx);
}

function renderChapterFooterNav(idx) {
  const nav = document.getElementById('chapterFooterNav');
  if (!nav) return;
  nav.innerHTML = `
    <div class="chapter-nav-footer">
      <button class="chap-nav-btn" onclick="selectChapter(${idx-1})" ${idx===0?'disabled':''}>← Previous</button>
      <div class="chap-progress"><span class="chap-progress-frac">${idx+1}</span> / ${CHAPTER_COUNT} &nbsp;·&nbsp; ${Math.round(((idx+1)/CHAPTER_COUNT)*100)}% complete</div>
      <button class="chap-nav-btn next-btn" onclick="selectChapter(${idx+1})" ${idx===CHAPTER_COUNT-1?'disabled':''}>Next Chapter →</button>
    </div>`;
}
function changeFontSize(delta) { readerFontSize = Math.max(14, Math.min(26, readerFontSize+delta)); applyReaderFont(); }
function toggleFont() {
  readerUseSerif = !readerUseSerif;
  const btn = document.getElementById('fontToggleBtn');
  btn.textContent = readerUseSerif ? 'Serif' : 'Sans';
  btn.classList.toggle('active', readerUseSerif);
  applyReaderFont();
}
function applyReaderFont() {
  const p = document.getElementById('readerPaper');
  p.style.fontSize = readerFontSize + 'px';
  p.style.fontFamily = readerUseSerif ? '"Lora",serif' : '"Plus Jakarta Sans",sans-serif';
}

// ── ADD / EDIT MODAL ──
function openAddModal() {
  editingId = null;
  document.getElementById('addModalHeadline').textContent = 'Add a Novel';
  document.getElementById('addModalSub').textContent = 'Expand your collection';
  document.getElementById('addModalSubmitBtn').textContent = '+ Add Novel';
  ['addTitle','addAuthor','addDesc'].forEach(id => document.getElementById(id).value = '');
  document.getElementById('addGenre').value = '';
  document.getElementById('addModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeAddModal() { document.getElementById('addModal').classList.remove('open'); document.body.style.overflow = ''; }
function openEditModal(id) {
  const n = novels.find(x => x.id === id);
  if (!n) return;
  editingId = id;
  document.getElementById('addModalHeadline').textContent = 'Edit Novel';
  document.getElementById('addModalSub').textContent = 'Update book details';
  document.getElementById('addModalSubmitBtn').textContent = '💾 Save Changes';
  document.getElementById('addTitle').value = n.title;
  document.getElementById('addAuthor').value = n.author;
  document.getElementById('addDesc').value = n.desc;
  document.getElementById('addGenre').value = n.genre;
  document.getElementById('addModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function submitNovelForm() { if (editingId) saveEdit(); else addNovel(); }
function saveEdit() {
  const title = document.getElementById('addTitle').value.trim();
  const author = document.getElementById('addAuthor').value.trim();
  const genre = document.getElementById('addGenre').value;
  const desc = document.getElementById('addDesc').value.trim();
  if (!title || !genre) { showToast('⚠️ Title and genre are required!', 'error'); return; }
  const idx = novels.findIndex(n => n.id === editingId);
  if (idx === -1) return;
  const emoji = {Fantasy:'🐉',Romance:'💕',Horror:'💀',Action:'⚡',Biography:'📜'}[genre] || '📖';
  novels[idx] = {...novels[idx], title, author:author||'Unknown', genre, desc:desc||'No description.', emoji};
  ['S','M','L'].forEach(s => { delete coverCache[editingId+'-'+s]; });
  closeAddModal();
  showToast('✏️ Novel updated!');
  updateStats();
  const ap = document.querySelector('.nav-item.active')?.dataset?.page || 'home';
  navigate(ap);
  editingId = null;
}
function addNovel() {
  const title = document.getElementById('addTitle').value.trim();
  const author = document.getElementById('addAuthor').value.trim();
  const genre = document.getElementById('addGenre').value;
  const desc = document.getElementById('addDesc').value.trim();
  if (!title || !genre) { showToast('⚠️ Title and genre are required!', 'error'); return; }
  const emoji = {Fantasy:'🐉',Romance:'💕',Horror:'💀',Action:'⚡',Biography:'📜'}[genre] || '📖';
  novels.push({ id:Date.now(), title, author:author||'Unknown', genre, desc:desc||'No description.', emoji });
  closeAddModal();
  showToast('✅ Novel added to library!');
  updateStats();
}

// ── DELETE ──
function confirmDelete(id) {
  const n = novels.find(x => x.id === id);
  if (!n) return;
  deletingId = id;
  document.getElementById('confirmSubText').innerHTML = `Remove <strong style="color:var(--text);">"${n.title}"</strong>? This cannot be undone.`;
  document.getElementById('confirmModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeConfirmModal() { document.getElementById('confirmModal').classList.remove('open'); document.body.style.overflow = ''; deletingId = null; }
function executeDelete() {
  if (!deletingId) return;
  const id = deletingId;
  const card = document.getElementById('lib_card_'+id);
  const doDelete = () => {
    novels = novels.filter(n => n.id !== id);
    favorites = favorites.filter(f => f !== id);
    closeConfirmModal();
    showToast('🗑️ Novel deleted', 'error');
    updateStats();
    const ap = document.querySelector('.nav-item.active')?.dataset?.page || 'home';
    _navigateTo(ap);
  };
  if (card) { card.classList.add('removing'); setTimeout(doDelete, 400); }
  else doDelete();
}

// ── UTILS ──
function updateStats() {
  const el = document.getElementById('settTotalBooks');
  if (el) el.textContent = novels.length;
  const allcnt = document.getElementById('allcnt');
  if (allcnt) allcnt.textContent = novels.length;
}
function showToast(msg, type = '') {
  const t = document.getElementById('toast');
  t.textContent = msg; t.className = 'toast show';
  if (type === 'error') t.classList.add('error-toast');
  clearTimeout(t._timer);
  t._timer = setTimeout(() => { t.className = 'toast'; }, 2800);
}

// ── SPLASH ──
function initSplash() {
  setTimeout(() => {
    const s = document.getElementById('splashScreen');
    s.classList.add('fade-out');
    setTimeout(() => s.style.display = 'none', 700);
  }, 2900);
}

// ── EVENT LISTENERS ──
document.getElementById('detailModal').addEventListener('click', e => { if (e.target === document.getElementById('detailModal')) closeDetailModal(); });
document.getElementById('addModal').addEventListener('click', e => { if (e.target === document.getElementById('addModal')) closeAddModal(); });
document.getElementById('confirmModal').addEventListener('click', e => { if (e.target === document.getElementById('confirmModal')) closeConfirmModal(); });
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') {
    closeDetailModal(); closeAddModal(); closeConfirmModal();
    document.getElementById('notifPanel').classList.remove('open');
    if (document.getElementById('readerOverlay').classList.contains('open')) closeReader();
  }
  if (e.altKey && e.key === 'ArrowLeft' && navHistory.length > 0) navigateBack();
});
document.querySelectorAll('.nav-item[data-page]').forEach(btn => btn.addEventListener('click', () => navigate(btn.dataset.page)));
document.getElementById('addNovelBtn').addEventListener('click', openAddModal);

// ── INIT ──
document.addEventListener('DOMContentLoaded', () => {
  initSplash();
  renderHome();
  updateStats();
  renderNotifs();
  document.getElementById('fontToggleBtn').classList.add('active');
  applyReaderFont();
});
</script>
</body>
</html>