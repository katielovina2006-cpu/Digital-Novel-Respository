<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Digital Novel Repository</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=Lora:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0d0f14;--bg2:#12151c;--bg3:#181c26;--card:#1a1e2a;--card2:#1e2330;
  --border:rgba(255,255,255,0.06);--border2:rgba(255,255,255,0.1);
  --accent:#f5c842;--accent2:#e8b830;--accent-glow:rgba(245,200,66,0.18);
  --teal:#2dd4bf;--pink:#f472b6;--blue:#60a5fa;--purple:#a78bfa;--orange:#fb923c;
  --text:#e8eaf0;--text2:#8b90a8;--text3:#555b72;
  --sidebar-w:72px;--sidebar-expanded:260px;--radius:14px;--radius-sm:8px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;overflow-x:hidden;}
::-webkit-scrollbar{width:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:2px;}
::-webkit-scrollbar-thumb:hover{background:rgba(245,200,66,0.4);}

/* SPLASH */
#splashScreen{position:fixed;inset:0;z-index:9999;background:var(--bg);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:0;transition:opacity 0.7s ease,transform 0.7s ease;}
#splashScreen.fade-out{opacity:0;pointer-events:none;transform:scale(1.04);}
.splash-books{display:flex;gap:0;align-items:flex-end;margin-bottom:28px;}
.splash-book{width:26px;height:44px;border-radius:3px 6px 6px 3px;position:relative;transform-origin:bottom center;animation:bookBounce 0.6s cubic-bezier(0.34,1.56,0.64,1) both;}
.splash-book::after{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:rgba(0,0,0,0.25);border-radius:3px 0 0 3px;}
.splash-book:nth-child(1){background:linear-gradient(160deg,#22c55e,#059669);animation-delay:.05s;height:50px;}
.splash-book:nth-child(2){background:linear-gradient(160deg,#f472b6,#db2777);animation-delay:.15s;height:42px;}
.splash-book:nth-child(3){background:linear-gradient(160deg,#ef4444,#b91c1c);animation-delay:.25s;height:54px;}
.splash-book:nth-child(4){background:linear-gradient(160deg,#60a5fa,#2563eb);animation-delay:.35s;height:38px;}
.splash-book:nth-child(5){background:linear-gradient(160deg,#fb923c,#b45309);animation-delay:.45s;height:48px;}
.splash-book:nth-child(6){background:linear-gradient(160deg,#a78bfa,#7c3aed);animation-delay:.55s;height:44px;}
.splash-book:nth-child(7){background:linear-gradient(160deg,#f5c842,#d97706);animation-delay:.65s;height:52px;}
@keyframes bookBounce{0%{opacity:0;transform:translateY(40px) rotate(-8deg);}60%{transform:translateY(-8px) rotate(2deg);}100%{opacity:1;transform:translateY(0) rotate(0);}}
.splash-shelf{width:240px;height:4px;background:linear-gradient(90deg,transparent,rgba(245,200,66,0.4),transparent);border-radius:3px;margin-bottom:28px;animation:shelfAppear 0.5s ease 0.8s both;}
@keyframes shelfAppear{from{opacity:0;}to{opacity:1;}}
.splash-logo-wrap{text-align:center;display:flex;flex-direction:column;align-items:center;animation:splashLogoIn 0.6s ease 0.9s both;}
@keyframes splashLogoIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.splash-logo{font-family:'Syne',sans-serif;font-size:28px;font-weight:800;color:var(--text);letter-spacing:-1px;margin-bottom:4px;}
.splash-logo span{color:var(--accent);}
.splash-tagline{font-size:11px;color:var(--text3);letter-spacing:3px;text-transform:uppercase;margin-bottom:24px;}
.splash-bar-wrap{width:180px;height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;animation:splashLogoIn 0.4s ease 1.1s both;}
.splash-bar{height:100%;width:0%;background:linear-gradient(90deg,var(--teal),var(--accent));border-radius:2px;animation:splashLoad 1.4s cubic-bezier(0.4,0,0.2,1) 1.2s both;}
@keyframes splashLoad{0%{width:0%;}60%{width:80%;}100%{width:100%;}}

/* SIDEBAR */
.sidebar{width:var(--sidebar-w);min-width:var(--sidebar-w);background:var(--bg2);border-right:1px solid var(--border);position:fixed;top:0;left:0;bottom:0;z-index:200;display:flex;flex-direction:column;transition:width 0.35s cubic-bezier(0.4,0,0.2,1);overflow:hidden;}
.sidebar:hover{width:var(--sidebar-expanded);}
.sidebar-logo{display:flex;align-items:center;gap:12px;padding:18px;border-bottom:1px solid var(--border);white-space:nowrap;overflow:hidden;}
.logo-mark{width:32px;height:32px;min-width:32px;background:var(--accent);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;box-shadow:0 0 20px var(--accent-glow);flex-shrink:0;}
.logo-text{font-family:'Syne',sans-serif;font-weight:800;font-size:14px;letter-spacing:-0.3px;color:var(--text);opacity:0;transition:opacity 0.2s 0.1s;white-space:nowrap;line-height:1.2;}
.sidebar:hover .logo-text{opacity:1;}
.logo-text span{color:var(--accent);}
.logo-abbr{font-family:'Syne',sans-serif;font-weight:800;font-size:12px;color:var(--accent);white-space:nowrap;opacity:1;transition:opacity 0.2s;}
.sidebar:hover .logo-abbr{opacity:0;width:0;overflow:hidden;}
.nav-section{flex:1;padding:14px 0;overflow-y:auto;overflow-x:hidden;display:flex;flex-direction:column;gap:2px;}
.nav-group-label{font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--text3);padding:10px 20px 5px;white-space:nowrap;overflow:hidden;opacity:0;transition:opacity 0.2s;}
.sidebar:hover .nav-group-label{opacity:1;}
.nav-item{display:flex;align-items:center;gap:12px;padding:10px 18px;font-size:13px;font-weight:500;color:var(--text2);cursor:pointer;transition:all 0.2s;position:relative;white-space:nowrap;overflow:hidden;border-radius:0;text-decoration:none;border:none;background:none;font-family:'DM Sans',sans-serif;width:100%;text-align:left;}
.nav-item .nav-icon{min-width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:var(--bg3);transition:all 0.25s;font-size:14px;flex-shrink:0;}
.nav-item .nav-label{opacity:0;transition:opacity 0.15s 0.05s;flex:1;}
.sidebar:hover .nav-label{opacity:1;}
.nav-item .nav-badge{background:var(--accent);color:#000;font-size:9px;font-weight:800;border-radius:10px;padding:2px 6px;margin-left:auto;opacity:0;transition:opacity 0.15s 0.05s;min-width:18px;text-align:center;}
.sidebar:hover .nav-badge{opacity:1;}
.nav-item:hover{color:var(--text);background:rgba(255,255,255,0.04);}
.nav-item:hover .nav-icon{background:var(--accent-glow);color:var(--accent);}
.nav-item.active{color:var(--accent);}
.nav-item.active .nav-icon{background:var(--accent);color:#000;box-shadow:0 0 16px var(--accent-glow);}
.nav-item.active::after{content:'';position:absolute;right:0;top:50%;transform:translateY(-50%);width:3px;height:20px;background:var(--accent);border-radius:3px 0 0 3px;box-shadow:-2px 0 8px var(--accent-glow);}
.sidebar-bottom{padding:14px 10px;border-top:1px solid var(--border);}
.sidebar-user{display:flex;align-items:center;gap:10px;padding:8px;border-radius:var(--radius-sm);cursor:pointer;transition:background 0.2s;white-space:nowrap;overflow:hidden;}
.sidebar-user:hover{background:rgba(255,255,255,0.05);}
.user-avatar{width:32px;height:32px;min-width:32px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--orange));display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#000;}
.user-info{opacity:0;transition:opacity 0.15s;min-width:0;}
.sidebar:hover .user-info{opacity:1;}
.user-name{font-size:12px;font-weight:600;color:var(--text);}
.user-role{font-size:10px;color:var(--text3);}

/* LAYOUT */
.page-wrapper{margin-left:var(--sidebar-w);flex:1;display:grid;grid-template-columns:1fr 280px;min-height:100vh;}
.main-content{padding:24px 24px 40px;overflow-y:auto;max-height:100vh;animation:fadeSlideIn 0.5s ease both;}
@keyframes fadeSlideIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}

/* TOPBAR */
.topbar{display:flex;align-items:center;gap:12px;margin-bottom:24px;}
.search-box{flex:1;position:relative;}
.search-box input{width:100%;background:var(--card);border:1px solid var(--border);border-radius:12px;padding:10px 14px 10px 40px;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;transition:all 0.25s;}
.search-box input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(245,200,66,0.1);}
.search-box input::placeholder{color:var(--text3);}
.search-icon{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text3);font-size:14px;}
.topbar-right{display:flex;align-items:center;gap:8px;}
.icon-btn{width:38px;height:38px;border-radius:9px;background:var(--card);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:15px;transition:all 0.2s;color:var(--text2);position:relative;}
.icon-btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text);}
.notif-dot{position:absolute;top:8px;right:8px;width:6px;height:6px;border-radius:50%;background:var(--accent);box-shadow:0 0 6px var(--accent);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{transform:scale(1);}50%{transform:scale(1.3);}}
.user-chip{display:flex;align-items:center;gap:8px;background:var(--card);border:1px solid var(--border);border-radius:9px;padding:5px 10px 5px 5px;cursor:pointer;transition:all 0.2s;}
.user-chip:hover{border-color:var(--border2);}
.chip-avatar{width:26px;height:26px;border-radius:7px;background:linear-gradient(135deg,var(--accent),var(--orange));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#000;}
.chip-name{font-size:12px;font-weight:600;color:var(--text);}

/* HERO */
.hero-section{background:var(--card);border-radius:18px;padding:22px;margin-bottom:24px;border:1px solid var(--border);position:relative;overflow:hidden;}
.hero-section::before{content:'';position:absolute;top:-60px;right:-60px;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(245,200,66,0.06),transparent 70%);pointer-events:none;}
.hero-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.hero-label{font-family:'Syne',sans-serif;font-weight:700;font-size:13px;color:var(--text2);}
.filter-chips{display:flex;gap:5px;}
.fchip{padding:4px 12px;border-radius:100px;font-size:11px;font-weight:600;background:var(--bg3);color:var(--text2);border:1px solid var(--border);cursor:pointer;transition:all 0.2s;}
.fchip.active,.fchip:hover{background:var(--accent);color:#000;border-color:transparent;}
.books-scroll{display:flex;gap:12px;overflow-x:auto;padding-bottom:6px;scrollbar-width:none;}
.books-scroll::-webkit-scrollbar{display:none;}
.book-thumb{flex-shrink:0;width:90px;cursor:pointer;}
.book-cover{width:90px;height:126px;border-radius:9px;overflow:hidden;position:relative;box-shadow:0 6px 20px rgba(0,0,0,0.4);transition:transform 0.3s cubic-bezier(0.34,1.56,0.64,1),box-shadow 0.3s;margin-bottom:6px;}
.book-thumb:hover .book-cover{transform:translateY(-6px) scale(1.04);box-shadow:0 14px 36px rgba(0,0,0,0.6);}
.book-cover img{width:100%;height:100%;object-fit:cover;}
.book-cover-reading-bar{position:absolute;bottom:0;left:0;right:0;height:3px;background:rgba(0,0,0,0.3);}
.book-cover-reading-progress{height:100%;background:var(--accent);border-radius:3px;transition:width 1s ease;}
.book-thumb-title{font-size:9px;font-weight:600;color:var(--text2);line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.book-thumb-author{font-size:8px;color:var(--text3);}

/* SECTION HEADER */
.sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
.sec-title{font-family:'Syne',sans-serif;font-weight:700;font-size:14px;color:var(--text);}
.sec-link{font-size:11px;font-weight:600;color:var(--accent);text-decoration:none;cursor:pointer;display:flex;align-items:center;gap:4px;transition:gap 0.2s;}
.sec-link:hover{gap:8px;}

/* SUBJECTS */
.subjects-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:24px;}
.subject-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:12px 14px;cursor:pointer;transition:all 0.25s;display:flex;align-items:center;gap:8px;}
.subject-card:hover{border-color:var(--border2);transform:translateY(-2px);background:var(--card2);}
.subject-card.active{border-color:var(--accent);background:rgba(245,200,66,0.06);}
.subj-icon{font-size:20px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:9px;}
.subj-name{font-size:11px;font-weight:600;color:var(--text);margin-bottom:2px;}
.subj-count{font-size:10px;color:var(--text2);}
.subj-count span{color:var(--accent);font-weight:700;}

/* POPULAR GRID */
.popular-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:24px;}
.pop-book-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);animation:fadeSlideIn 0.5s ease both;position:relative;}
.pop-book-card:hover{transform:translateY(-5px);box-shadow:0 14px 40px rgba(0,0,0,0.4);border-color:var(--border2);}
.pop-cover{height:120px;position:relative;overflow:hidden;}
.pop-cover img{width:100%;height:100%;object-fit:cover;}
.pop-cover-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:36px;}
.pop-body{padding:10px;}
.pop-title{font-size:10px;font-weight:700;color:var(--text);line-height:1.3;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.pop-author{font-size:9px;color:var(--text3);}
.pop-genre-dot{display:inline-block;width:5px;height:5px;border-radius:50%;margin-right:3px;}
.read-btn{width:100%;padding:5px;background:rgba(245,200,66,0.1);border:1px solid rgba(245,200,66,0.2);border-radius:6px;color:var(--accent);font-size:9px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;margin-top:6px;}
.read-btn:hover{background:var(--accent);color:#000;}

/* CARD ACTIONS */
.card-actions{position:absolute;top:7px;right:7px;display:flex;gap:3px;opacity:0;transform:translateY(-4px);transition:all 0.25s;z-index:10;}
.pop-book-card:hover .card-actions{opacity:1;transform:translateY(0);}
.ca-btn{width:24px;height:24px;border-radius:6px;border:none;cursor:pointer;font-size:11px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;backdrop-filter:blur(8px);}
.ca-edit{background:rgba(245,200,66,0.85);color:#000;}
.ca-edit:hover{background:var(--accent);transform:scale(1.15);}
.ca-delete{background:rgba(239,68,68,0.85);color:#fff;}
.ca-delete:hover{background:#ef4444;transform:scale(1.15);}

/* NEW BOOKS SCROLL */
.new-books-scroll{display:flex;gap:12px;overflow-x:auto;padding-bottom:6px;scrollbar-width:none;margin-bottom:24px;}
.new-books-scroll::-webkit-scrollbar{display:none;}
.new-book-card{flex-shrink:0;width:110px;cursor:pointer;}
.new-book-cover{width:110px;height:155px;border-radius:11px;overflow:hidden;position:relative;box-shadow:0 8px 28px rgba(0,0,0,0.45);transition:transform 0.3s cubic-bezier(0.34,1.56,0.64,1),box-shadow 0.3s;margin-bottom:8px;}
.new-book-card:hover .new-book-cover{transform:translateY(-8px) rotate(-1deg);box-shadow:0 18px 46px rgba(0,0,0,0.6);}
.new-book-cover img{width:100%;height:100%;object-fit:cover;}
.new-book-cover-ph{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;font-size:34px;}
.new-book-label{position:absolute;top:7px;left:7px;background:var(--accent);color:#000;font-size:8px;font-weight:800;padding:2px 6px;border-radius:4px;letter-spacing:0.5px;}
.new-book-title{font-size:10px;font-weight:600;color:var(--text);line-height:1.3;margin-bottom:2px;}
.new-book-author{font-size:9px;color:var(--text3);}

/* WRITERS */
.writers-row{display:flex;gap:10px;overflow-x:auto;padding-bottom:6px;margin-bottom:24px;scrollbar-width:none;}
.writers-row::-webkit-scrollbar{display:none;}
.writer-card{flex-shrink:0;text-align:center;cursor:pointer;}
.writer-avatar{width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;margin:0 auto 6px;border:2px solid var(--border);transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);position:relative;}
.writer-card:hover .writer-avatar{transform:scale(1.12);border-color:var(--accent);box-shadow:0 0 20px var(--accent-glow);}
.writer-name{font-size:9px;font-weight:600;color:var(--text);white-space:nowrap;}
.writer-books{font-size:8px;color:var(--text3);}

/* RIGHT PANEL */
.right-panel{background:var(--bg2);border-left:1px solid var(--border);padding:24px 18px;overflow-y:auto;max-height:100vh;position:sticky;top:0;}

/* STATS */
.stats-widget{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:16px;margin-bottom:18px;}
.stats-title{font-family:'Syne',sans-serif;font-size:12px;font-weight:700;color:var(--text);margin-bottom:12px;}
.stats-row{display:flex;gap:7px;margin-bottom:7px;}
.stat-box{flex:1;background:var(--bg3);border-radius:9px;padding:10px;text-align:center;transition:all 0.3s;cursor:pointer;}
.stat-box:hover{transform:translateY(-3px);background:var(--card2);}
.stat-num{font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:var(--accent);}
.stat-lbl{font-size:8px;color:var(--text3);margin-top:1px;}
.reading-goal{margin-top:12px;}
.goal-label{display:flex;justify-content:space-between;font-size:10px;color:var(--text3);margin-bottom:5px;}
.goal-bar{height:4px;background:var(--bg3);border-radius:3px;overflow:hidden;}
.goal-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--accent));border-radius:3px;transition:width 1.5s ease;}
.genre-legend{display:flex;flex-direction:column;gap:7px;margin-top:12px;}
.legend-row{display:flex;align-items:center;gap:7px;}
.legend-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0;}
.legend-label{font-size:10px;color:var(--text2);flex:1;}
.legend-pct{font-size:10px;font-weight:600;color:var(--text);}

/* SPECIAL BOOKS */
.special-book-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:12px;margin-bottom:10px;display:flex;gap:10px;align-items:center;cursor:pointer;transition:all 0.25s;}
.special-book-card:hover{border-color:var(--border2);transform:translateX(3px);}
.spec-rank{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--border);min-width:28px;line-height:1;}
.special-book-card:hover .spec-rank{color:var(--accent);}
.spec-cover{width:40px;height:55px;border-radius:5px;overflow:hidden;flex-shrink:0;background:var(--bg3);}
.spec-cover img{width:100%;height:100%;object-fit:cover;}
.spec-cover-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:20px;}
.spec-info{flex:1;min-width:0;}
.spec-title{font-size:11px;font-weight:700;color:var(--text);margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.spec-author{font-size:9px;color:var(--text3);}
.spec-badge{font-size:8px;font-weight:700;padding:2px 6px;border-radius:4px;margin-top:3px;display:inline-block;}

/* PAGE VIEWS */
.page-view{display:none;animation:fadeSlideIn 0.4s ease both;}
.page-view.active{display:block;}

/* AUTHORS PAGE */
.authors-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.author-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;text-align:center;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);}
.author-card:hover{transform:translateY(-6px);border-color:var(--border2);box-shadow:0 14px 36px rgba(0,0,0,0.4);}
.author-big-avatar{width:62px;height:62px;border-radius:50%;margin:0 auto 10px;display:flex;align-items:center;justify-content:center;font-size:26px;border:2px solid var(--border);}
.author-name{font-family:'Syne',sans-serif;font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;}
.author-genre{font-size:10px;color:var(--text3);margin-bottom:8px;}
.author-stats{display:flex;justify-content:center;gap:14px;}
.astat{text-align:center;}
.astat-num{font-family:'Syne',sans-serif;font-size:15px;font-weight:800;color:var(--accent);}
.astat-lbl{font-size:8px;color:var(--text3);}

/* GENRES PAGE */
.genres-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;}
.genre-big-card{border-radius:var(--radius);padding:22px;cursor:pointer;transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);position:relative;overflow:hidden;min-height:130px;display:flex;flex-direction:column;justify-content:space-between;}
.genre-big-card:hover{transform:translateY(-5px) scale(1.01);box-shadow:0 20px 50px rgba(0,0,0,0.5);}
.genre-big-icon{font-size:36px;margin-bottom:10px;}
.genre-big-name{font-family:'Syne',sans-serif;font-size:17px;font-weight:800;color:#fff;}
.genre-big-count{font-size:10px;opacity:0.7;color:#fff;}
.genre-big-bg{position:absolute;right:-18px;bottom:-18px;font-size:70px;opacity:0.1;pointer-events:none;}

/* FAVORITES */
.fav-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.fav-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;cursor:pointer;transition:all 0.3s;position:relative;}
.fav-card:hover{transform:translateY(-5px);border-color:var(--accent);}
.fav-cover{height:140px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;font-size:40px;}
.fav-cover img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
.fav-heart{position:absolute;top:7px;right:7px;background:rgba(0,0,0,0.5);border-radius:50%;width:26px;height:26px;display:flex;align-items:center;justify-content:center;font-size:13px;cursor:pointer;transition:all 0.2s;z-index:5;}
.fav-heart:hover{transform:scale(1.2);}
.fav-body{padding:10px;}
.fav-title{font-size:11px;font-weight:700;color:var(--text);margin-bottom:2px;}
.fav-author{font-size:9px;color:var(--text3);}

/* SCHEDULE */
.schedule-day{margin-bottom:18px;}
.day-label{font-family:'Syne',sans-serif;font-size:12px;font-weight:700;color:var(--text);margin-bottom:8px;display:flex;align-items:center;gap:8px;}
.day-label::after{content:'';flex:1;height:1px;background:var(--border);}
.schedule-item{background:var(--card);border:1px solid var(--border);border-radius:var(--radius-sm);padding:10px 14px;display:flex;align-items:center;gap:12px;margin-bottom:7px;cursor:pointer;transition:all 0.2s;}
.schedule-item:hover{border-color:var(--border2);transform:translateX(4px);}
.sched-time{font-size:10px;font-weight:700;color:var(--accent);min-width:44px;}
.sched-icon{font-size:18px;width:32px;height:32px;border-radius:7px;background:var(--bg3);display:flex;align-items:center;justify-content:center;}
.sched-info{flex:1;}
.sched-title{font-size:11px;font-weight:700;color:var(--text);margin-bottom:2px;}
.sched-sub{font-size:9px;color:var(--text3);}
.sched-dur{font-size:9px;font-weight:600;background:var(--bg3);color:var(--text2);padding:2px 7px;border-radius:5px;}

/* REPORTS */
.report-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:18px;margin-bottom:12px;}
.report-title{font-family:'Syne',sans-serif;font-size:13px;font-weight:700;color:var(--text);margin-bottom:12px;}
.bar-chart{display:flex;flex-direction:column;gap:9px;}
.bar-row{display:flex;align-items:center;gap:9px;}
.bar-label{font-size:10px;color:var(--text2);min-width:65px;}
.bar-track{flex:1;height:7px;background:var(--bg3);border-radius:4px;overflow:hidden;}
.bar-fill{height:100%;border-radius:4px;transition:width 1.2s ease;}
.bar-val{font-size:10px;font-weight:700;color:var(--text);min-width:22px;text-align:right;}

/* READING VIEW */
.reading-list{display:flex;flex-direction:column;gap:10px;}
.reading-item{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:14px;display:flex;gap:12px;align-items:center;cursor:pointer;transition:all 0.25s;}
.reading-item:hover{border-color:var(--border2);transform:translateX(4px);}
.reading-cover{width:50px;height:68px;border-radius:7px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px;}
.reading-cover img{width:100%;height:100%;object-fit:cover;}
.reading-info{flex:1;min-width:0;}
.reading-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;}
.reading-author{font-size:10px;color:var(--text3);margin-bottom:8px;}
.reading-progress-bar{height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.reading-progress-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--accent));border-radius:2px;transition:width 1.5s ease;}
.reading-pct{font-size:9px;font-weight:700;color:var(--accent);margin-top:3px;}
.reading-status{font-size:9px;padding:3px 9px;border-radius:5px;font-weight:700;flex-shrink:0;}

/* LIBRARY VIEW */
.lib-item-actions{display:flex;gap:5px;margin-top:6px;}
.lib-action-btn{flex:1;padding:4px 0;border-radius:6px;border:none;font-size:9px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;}
.lib-action-edit{background:rgba(245,200,66,0.12);color:var(--accent);border:1px solid rgba(245,200,66,0.2);}
.lib-action-edit:hover{background:rgba(245,200,66,0.25);}
.lib-action-delete{background:rgba(239,68,68,0.1);color:#ef4444;border:1px solid rgba(239,68,68,0.2);}
.lib-action-delete:hover{background:rgba(239,68,68,0.2);}

/* READER MODE */
#readerOverlay{position:fixed;inset:0;z-index:5000;background:var(--bg);opacity:0;pointer-events:none;transition:opacity 0.5s ease;display:flex;flex-direction:column;font-family:'Lora',serif;}
#readerOverlay.open{opacity:1;pointer-events:all;}
.reader-topbar{display:flex;align-items:center;gap:14px;padding:14px 28px;background:var(--bg2);border-bottom:1px solid var(--border);flex-shrink:0;}
.reader-close-btn{width:36px;height:36px;border-radius:50%;background:var(--bg3);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:18px;color:var(--text2);transition:all 0.2s;font-family:monospace;flex-shrink:0;}
.reader-close-btn:hover{background:rgba(239,68,68,0.2);border-color:rgba(239,68,68,0.4);color:#ef4444;transform:rotate(90deg);}
.reader-book-title{font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text);flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.reader-book-author{font-size:12px;color:var(--text3);white-space:nowrap;}
.reader-controls{display:flex;align-items:center;gap:8px;}
.reader-ctrl-btn{padding:6px 14px;border-radius:8px;border:1px solid var(--border);background:var(--bg3);color:var(--text2);font-size:11px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;}
.reader-ctrl-btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text);}
.reader-ctrl-btn.active{background:var(--accent);border-color:transparent;color:#000;}
.reader-font-btn{width:30px;height:30px;border-radius:7px;border:1px solid var(--border);background:var(--bg3);color:var(--text2);font-size:12px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;display:flex;align-items:center;justify-content:center;}
.reader-font-btn:hover{background:var(--card2);color:var(--text);}
.reader-body{display:flex;flex:1;overflow:hidden;}
.chapter-sidebar{width:220px;min-width:220px;background:var(--bg2);border-right:1px solid var(--border);overflow-y:auto;padding:20px 0;flex-shrink:0;}
.chap-sidebar-title{font-family:'Syne',sans-serif;font-size:11px;font-weight:700;color:var(--text3);letter-spacing:2px;text-transform:uppercase;padding:0 18px 14px;}
.chap-item{padding:10px 18px;cursor:pointer;transition:all 0.2s;border-left:3px solid transparent;display:flex;align-items:center;gap:10px;}
.chap-item:hover{background:rgba(255,255,255,0.04);color:var(--text);}
.chap-item.active{border-left-color:var(--accent);background:rgba(245,200,66,0.05);color:var(--accent);}
.chap-item-num{font-family:'Syne',sans-serif;font-size:10px;font-weight:700;color:var(--accent);min-width:24px;}
.chap-item-name{font-size:11px;font-weight:500;color:var(--text2);line-height:1.4;}
.chap-item.active .chap-item-name{color:var(--accent);}
.reader-content-wrap{flex:1;overflow-y:auto;display:flex;justify-content:center;padding:40px 24px;background:var(--bg);}
.reader-paper{max-width:680px;width:100%;font-family:'Lora',serif;transition:font-size 0.2s;}
.reader-chapter-header{margin-bottom:32px;border-bottom:1px solid var(--border);padding-bottom:24px;}
.reader-chapter-num{font-family:'DM Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--accent);margin-bottom:8px;}
.reader-chapter-title{font-family:'Syne',sans-serif;font-size:28px;font-weight:800;color:var(--text);line-height:1.2;margin-bottom:8px;}
.reader-chapter-meta{font-family:'DM Sans',sans-serif;font-size:11px;color:var(--text3);display:flex;align-items:center;gap:12px;}
.reader-content{line-height:1.95;color:var(--text2);}
.reader-content p{margin-bottom:1.5em;text-indent:2em;}
.reader-content p:first-child{text-indent:0;}
.reader-content p:first-child::first-letter{font-size:3.5em;font-weight:700;float:left;line-height:0.75;padding-right:8px;color:var(--accent);font-family:'Syne',sans-serif;margin-top:8px;}
.reader-content .scene-break{text-align:center;color:var(--text3);margin:2em 0;font-size:20px;letter-spacing:8px;user-select:none;}
.ai-generating{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 20px;gap:20px;}
.ai-gen-icon{font-size:48px;animation:genPulse 1.5s ease-in-out infinite;}
@keyframes genPulse{0%,100%{transform:scale(1);}50%{transform:scale(1.1);}}
.ai-gen-text{font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text2);text-align:center;}
.ai-gen-bar{width:200px;height:3px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.ai-gen-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--accent));border-radius:2px;animation:genBar 2s ease-in-out infinite;}
@keyframes genBar{0%{width:0%;margin-left:0;}50%{width:80%;margin-left:10%;}100%{width:0%;margin-left:100%;}}
.ai-typing-dots{display:flex;gap:5px;align-items:center;margin-top:4px;}
.ai-typing-dot{width:6px;height:6px;border-radius:50%;background:var(--accent);animation:typingDot 1.2s ease-in-out infinite;}
.ai-typing-dot:nth-child(2){animation-delay:0.2s;}
.ai-typing-dot:nth-child(3){animation-delay:0.4s;}
@keyframes typingDot{0%,60%,100%{transform:translateY(0);}30%{transform:translateY(-8px);}}
.chapter-nav-footer{display:flex;align-items:center;justify-content:space-between;margin-top:48px;padding-top:24px;border-top:1px solid var(--border);}
.chap-nav-btn{padding:10px 22px;border-radius:10px;border:1px solid var(--border);background:var(--card);color:var(--text2);font-size:12px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;display:flex;align-items:center;gap:8px;}
.chap-nav-btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text);transform:translateY(-2px);}
.chap-nav-btn:disabled{opacity:0.3;cursor:not-allowed;transform:none !important;}
.chap-nav-btn.next-btn{background:var(--accent);border-color:transparent;color:#000;}
.chap-nav-btn.next-btn:hover{background:var(--accent2);}
.chap-progress{font-family:'DM Sans',sans-serif;font-size:11px;color:var(--text3);text-align:center;}
.chap-progress-frac{font-weight:700;color:var(--accent);}
.reader-progress-wrap{flex:1;max-width:200px;}
.reader-progress-bar{height:4px;background:var(--bg3);border-radius:2px;overflow:hidden;}
.reader-progress-fill{height:100%;background:linear-gradient(90deg,var(--teal),var(--accent));border-radius:2px;transition:width 0.5s ease;}
.reader-progress-text{font-family:'DM Sans',sans-serif;font-size:9px;color:var(--text3);margin-top:3px;}

/* MODAL */
.modal-overlay{position:fixed;inset:0;z-index:999;background:rgba(0,0,0,0.7);backdrop-filter:blur(12px);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity 0.3s;}
.modal-overlay.open{opacity:1;pointer-events:all;}
.modal{background:var(--card);border:1px solid var(--border2);border-radius:20px;max-width:540px;width:100%;max-height:90vh;overflow-y:auto;transform:scale(0.85) translateY(30px);transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);box-shadow:0 40px 80px rgba(0,0,0,0.6);}
.modal-overlay.open .modal{transform:scale(1) translateY(0);}
.modal-cover{height:170px;position:relative;overflow:hidden;border-radius:20px 20px 0 0;display:flex;align-items:center;justify-content:center;font-size:56px;}
.modal-cover img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
.modal-cover-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,var(--card));}
.modal-body{padding:22px;}
.modal-genre{font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--accent);margin-bottom:5px;}
.modal-title{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:3px;}
.modal-author{font-size:12px;color:var(--text2);margin-bottom:14px;}
.modal-divider{height:1px;background:var(--border);margin-bottom:14px;}
.modal-desc{font-size:12px;line-height:1.8;color:var(--text2);}
.modal-actions{display:flex;gap:8px;margin-top:18px;flex-wrap:wrap;}
.btn-modal{flex:1;padding:10px;border-radius:9px;font-size:11px;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all 0.2s;border:none;min-width:100px;}
.btn-primary{background:var(--accent);color:#000;}
.btn-primary:hover{background:var(--accent2);transform:translateY(-2px);}
.btn-read{background:linear-gradient(135deg,#7c3aed,#2563eb);color:#fff;}
.btn-read:hover{opacity:0.9;transform:translateY(-2px);}
.btn-secondary{background:var(--bg3);color:var(--text2);border:1px solid var(--border);}
.btn-secondary:hover{background:var(--card2);color:var(--text);transform:translateY(-2px);}
.btn-danger{background:rgba(239,68,68,0.15);color:#ef4444;border:1px solid rgba(239,68,68,0.25);}
.btn-danger:hover{background:rgba(239,68,68,0.3);transform:translateY(-2px);}
.modal-close{position:absolute;top:12px;right:12px;width:30px;height:30px;border-radius:50%;background:rgba(0,0,0,0.4);border:1px solid var(--border);color:var(--text2);font-size:17px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;font-family:monospace;z-index:2;}
.modal-close:hover{background:rgba(239,68,68,0.3);border-color:rgba(239,68,68,0.5);color:#ef4444;transform:rotate(90deg);}
.add-modal{max-width:460px;}
.add-modal .modal-body{padding:28px;}
.modal-headline{font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:3px;}
.modal-sub{font-size:11px;color:var(--text3);margin-bottom:20px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.field{display:flex;flex-direction:column;gap:5px;}
.field.full{grid-column:1/-1;}
.field label{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--text3);}
.field input,.field select,.field textarea{background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:9px 12px;font-size:12px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;transition:all 0.2s;}
.field input::placeholder,.field textarea::placeholder{color:var(--text3);}
.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(245,200,66,0.08);}
.field select option{background:var(--card2);}
.field textarea{min-height:75px;resize:vertical;line-height:1.6;}
.confirm-modal{max-width:360px;}
.confirm-modal .modal-body{padding:28px;text-align:center;}
.confirm-icon{font-size:44px;margin-bottom:14px;}
.confirm-title{font-family:'Syne',sans-serif;font-size:17px;font-weight:800;color:var(--text);margin-bottom:7px;}
.confirm-sub{font-size:12px;color:var(--text3);line-height:1.7;margin-bottom:20px;}
.confirm-actions{display:flex;gap:8px;}
.toast{position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--accent);color:#000;padding:9px 18px;border-radius:9px;font-size:12px;font-weight:700;z-index:99999;opacity:0;transition:all 0.4s;box-shadow:0 8px 24px var(--accent-glow);pointer-events:none;}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}
.toast.error-toast{background:#ef4444;box-shadow:0 8px 24px rgba(239,68,68,0.3);}
.notif-wrap{position:relative;}
.notif-panel{position:absolute;top:48px;right:0;width:295px;background:var(--card);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;display:none;z-index:600;box-shadow:0 20px 60px rgba(0,0,0,0.6);}
.notif-panel.open{display:block;}
.notif-panel-header{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-bottom:1px solid var(--border);}
.notif-panel-title{font-family:'Syne',sans-serif;font-size:12px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:7px;}
.notif-count-badge{background:var(--accent);color:#000;font-size:9px;font-weight:800;border-radius:10px;padding:2px 6px;}
.notif-mark-all{font-size:10px;font-weight:600;color:var(--accent);cursor:pointer;border:none;background:none;font-family:'DM Sans',sans-serif;}
.notif-items{max-height:300px;overflow-y:auto;}
.notif-item{display:flex;gap:9px;padding:11px 14px;border-bottom:1px solid var(--border);cursor:pointer;transition:background 0.15s;position:relative;}
.notif-item:last-child{border-bottom:none;}
.notif-item:hover{background:var(--bg3);}
.notif-item.unread{background:rgba(245,200,66,0.04);}
.notif-item-icon{width:34px;height:34px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:15px;background:var(--bg3);}
.notif-item-body{flex:1;min-width:0;}
.notif-item-text{font-size:11px;color:var(--text);line-height:1.5;margin-bottom:2px;}
.notif-item-time{font-size:9px;color:var(--text3);}
.notif-unread-pip{width:6px;height:6px;border-radius:50%;background:var(--accent);flex-shrink:0;margin-top:5px;box-shadow:0 0 6px var(--accent);}
.notif-panel-footer{padding:9px 14px;border-top:1px solid var(--border);text-align:center;}
.notif-footer-link{font-size:10px;font-weight:600;color:var(--accent);cursor:pointer;}
@keyframes removeItem{0%{opacity:1;transform:scale(1);}50%{opacity:0.5;transform:scale(0.95) rotate(-1deg);}100%{opacity:0;transform:scale(0.7) rotate(-3deg);}}
.removing{animation:removeItem 0.4s ease forwards !important;pointer-events:none !important;}
@media(max-width:900px){.popular-grid{grid-template-columns:repeat(2,1fr);}.subjects-grid{grid-template-columns:repeat(2,1fr);}.fav-grid{grid-template-columns:repeat(2,1fr);}.authors-grid{grid-template-columns:repeat(2,1fr);}.right-panel{display:none;}.page-wrapper{grid-template-columns:1fr;}.chapter-sidebar{width:180px;min-width:180px;}}
@media(max-width:600px){.popular-grid{grid-template-columns:repeat(2,1fr);}.genres-grid{grid-template-columns:1fr;}.chapter-sidebar{display:none;}}
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
    <div class="splash-logo">Digital Novel <span>Repository</span></div>
    <div class="splash-tagline">Your Digital Library</div>
    <div class="splash-bar-wrap"><div class="splash-bar"></div></div>
  </div>
</div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">📚</div>
    <div class="logo-abbr">DNR</div>
    <div class="logo-text">Digital Novel <span>Repository</span></div>
  </div>
  <nav class="nav-section">
    <div class="nav-group-label">Main</div>
    <button class="nav-item active" data-page="home"><div class="nav-icon">🏠</div><span class="nav-label">Home</span></button>
    <button class="nav-item" data-page="authors"><div class="nav-icon">👤</div><span class="nav-label">Authors</span></button>
    <button class="nav-item" data-page="genres"><div class="nav-icon">🏷️</div><span class="nav-label">Genres</span><span class="nav-badge">5</span></button>
    <button class="nav-item" data-page="reading"><div class="nav-icon">📖</div><span class="nav-label">Reading</span><span class="nav-badge">3</span></button>
    <button class="nav-item" data-page="favorites"><div class="nav-icon">⭐</div><span class="nav-label">Favorites</span></button>
    <div class="nav-group-label" style="margin-top:7px;">Manage</div>
    <button class="nav-item" data-page="schedule"><div class="nav-icon">📅</div><span class="nav-label">Schedule</span></button>
    <button class="nav-item" data-page="library"><div class="nav-icon">🗂️</div><span class="nav-label">Library</span></button>
    <button class="nav-item" data-page="reports"><div class="nav-icon">📊</div><span class="nav-label">Reports</span></button>
    <div class="nav-group-label" style="margin-top:7px;">Settings</div>
    <button class="nav-item" data-page="settings"><div class="nav-icon">⚙️</div><span class="nav-label">Settings</span></button>
    <button class="nav-item" id="addNovelBtn"><div class="nav-icon">➕</div><span class="nav-label">Add Novel</span></button>
  </nav>
  <div class="sidebar-bottom">
    <div class="sidebar-user">
      <div class="user-avatar">M</div>
      <div class="user-info"><div class="user-name">Reader M</div><div class="user-role">Pro Member</div></div>
    </div>
  </div>
</aside>

<!-- PAGE WRAPPER -->
<div class="page-wrapper" id="pageWrapper">
<main class="main-content">
  <div class="topbar">
    <div class="search-box">
      <span class="search-icon">🔍</span>
      <input type="text" id="searchInput" placeholder="Search novels, authors, genres…" oninput="handleSearch(this.value)">
    </div>
    <div class="topbar-right">
      <div class="notif-wrap">
        <div class="icon-btn" id="notifBtn" title="Notifications" onclick="toggleNotifPanel(event)">
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
      <div class="icon-btn" title="Dark Mode" onclick="showToast('🌙 Dark theme active!')">🌙</div>
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
    <div class="sec-header"><div class="sec-title">Browse Subjects</div><a class="sec-link" onclick="navigate('genres')">Show all →</a></div>
    <div class="subjects-grid">
      <div class="subject-card active" onclick="filterByGenre('Fantasy',this)"><div class="subj-icon" style="background:rgba(34,197,94,0.12);">🐉</div><div><div class="subj-name">Fantasy</div><div class="subj-count"><span id="fcnt">5</span> books</div></div></div>
      <div class="subject-card" onclick="filterByGenre('Romance',this)"><div class="subj-icon" style="background:rgba(244,114,182,0.12);">💕</div><div><div class="subj-name">Romance</div><div class="subj-count"><span id="rcnt">5</span> books</div></div></div>
      <div class="subject-card" onclick="filterByGenre('Horror',this)"><div class="subj-icon" style="background:rgba(239,68,68,0.12);">💀</div><div><div class="subj-name">Horror</div><div class="subj-count"><span id="hcnt">5</span> books</div></div></div>
      <div class="subject-card" onclick="filterByGenre('Action',this)"><div class="subj-icon" style="background:rgba(96,165,250,0.12);">⚡</div><div><div class="subj-name">Action</div><div class="subj-count"><span id="acnt">5</span> books</div></div></div>
      <div class="subject-card" onclick="filterByGenre('Biography',this)"><div class="subj-icon" style="background:rgba(251,146,60,0.12);">📜</div><div><div class="subj-name">Biography</div><div class="subj-count"><span id="bcnt">5</span> books</div></div></div>
      <div class="subject-card" onclick="filterByGenre('',this)"><div class="subj-icon" style="background:rgba(167,139,250,0.12);">🌐</div><div><div class="subj-name">Others</div><div class="subj-count"><span>25</span> books</div></div></div>
    </div>
    <div class="sec-header"><div class="sec-title">New Arrivals</div><a class="sec-link">Show all →</a></div>
    <div class="new-books-scroll" id="newBooksScroll"></div>
    <div class="sec-header"><div class="sec-title">Writers & Authors</div><a class="sec-link" onclick="navigate('authors')">Show all →</a></div>
    <div class="writers-row" id="writersRow"></div>
  </div>

  <!-- AUTHORS VIEW -->
  <div class="page-view" id="view-authors">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Writers & Authors</div></div>
    <div class="authors-grid" id="authorsGrid"></div>
  </div>

  <!-- GENRES VIEW -->
  <div class="page-view" id="view-genres">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Browse by Genre</div></div>
    <div class="genres-grid" id="genresGrid"></div>
  </div>

  <!-- READING VIEW -->
  <div class="page-view" id="view-reading">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Currently Reading</div></div>
    <div class="reading-list" id="readingList"></div>
  </div>

  <!-- FAVORITES VIEW -->
  <div class="page-view" id="view-favorites">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">My Favorites ⭐</div></div>
    <div class="fav-grid" id="favGrid"></div>
  </div>

  <!-- SCHEDULE VIEW -->
  <div class="page-view" id="view-schedule">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Reading Schedule</div></div>
    <div id="scheduleList"></div>
  </div>

  <!-- LIBRARY VIEW -->
  <div class="page-view" id="view-library">
    <div class="sec-header" style="margin-bottom:18px;">
      <div class="sec-title">Full Library</div>
      <button onclick="openAddModal()" style="background:var(--accent);color:#000;border:none;padding:7px 14px;border-radius:8px;font-size:11px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;">+ Add Novel</button>
    </div>
    <div class="popular-grid" id="libraryGrid"></div>
  </div>

  <!-- REPORTS VIEW -->
  <div class="page-view" id="view-reports">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Reading Reports</div></div>
    <div class="report-card"><div class="report-title">Books by Genre</div><div class="bar-chart" id="genreChart"></div></div>
    <div class="report-card"><div class="report-title">Monthly Activity</div><div class="bar-chart" id="monthChart"></div></div>
  </div>

  <!-- SETTINGS VIEW -->
  <div class="page-view" id="view-settings">
    <div class="sec-header" style="margin-bottom:18px;"><div class="sec-title">Settings</div></div>
    <div class="report-card">
      <div class="report-title">Account</div>
      <div style="display:flex;flex-direction:column;gap:0;">
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);"><div><div style="font-size:13px;font-weight:600;color:var(--text);">Display Name</div><div style="font-size:10px;color:var(--text3);">Your reading identity</div></div><div style="font-size:12px;color:var(--accent);">Reader M</div></div>
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);"><div><div style="font-size:13px;font-weight:600;color:var(--text);">Reading Goal</div><div style="font-size:10px;color:var(--text3);">Books per month</div></div><div style="font-size:12px;color:var(--accent);">5 books</div></div>
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);"><div><div style="font-size:13px;font-weight:600;color:var(--text);">Theme</div><div style="font-size:10px;color:var(--text3);">Interface appearance</div></div><div style="font-size:12px;color:var(--accent);">Dark 🌙</div></div>
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;"><div><div style="font-size:13px;font-weight:600;color:var(--text);">Notifications</div><div style="font-size:10px;color:var(--text3);">New releases & updates</div></div><div style="width:38px;height:20px;border-radius:10px;background:var(--accent);position:relative;cursor:pointer;"><div style="position:absolute;right:3px;top:3px;width:14px;height:14px;border-radius:50%;background:#000;"></div></div></div>
      </div>
    </div>
    <div class="report-card"><div class="report-title">Library Statistics</div><div class="stats-row"><div class="stat-box"><div class="stat-num" id="settTotalBooks">25</div><div class="stat-lbl">Total Books</div></div><div class="stat-box"><div class="stat-num">5</div><div class="stat-lbl">Genres</div></div><div class="stat-box"><div class="stat-num">12</div><div class="stat-lbl">Authors</div></div></div></div>
  </div>
</main>

<!-- RIGHT PANEL -->
<aside class="right-panel">
  <div class="stats-widget">
    <div class="stats-title">My Reading Stats</div>
    <div class="stats-row">
      <div class="stat-box"><div class="stat-num" id="totalBooksCount">25</div><div class="stat-lbl">Total Books</div></div>
      <div class="stat-box"><div class="stat-num">3</div><div class="stat-lbl">Reading</div></div>
    </div>
    <div class="stats-row">
      <div class="stat-box"><div class="stat-num">12</div><div class="stat-lbl">Authors</div></div>
      <div class="stat-box"><div class="stat-num">5</div><div class="stat-lbl">Genres</div></div>
    </div>
    <div class="reading-goal">
      <div class="goal-label"><span>Monthly Goal</span><span style="color:var(--accent);">3/5 books</span></div>
      <div class="goal-bar"><div class="goal-fill" style="width:60%"></div></div>
    </div>
  </div>
  <div style="margin-bottom:18px;">
    <div class="sec-header"><div class="sec-title" style="font-size:12px;">Genre Distribution</div></div>
    <div class="genre-legend">
      <div class="legend-row"><div class="legend-dot" style="background:#22c55e;"></div><span class="legend-label">Fantasy</span><span class="legend-pct">20%</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#f472b6;"></div><span class="legend-label">Romance</span><span class="legend-pct">20%</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#ef4444;"></div><span class="legend-label">Horror</span><span class="legend-pct">20%</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#60a5fa;"></div><span class="legend-label">Action</span><span class="legend-pct">20%</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#fb923c;"></div><span class="legend-label">Biography</span><span class="legend-pct">20%</span></div>
    </div>
  </div>
  <div class="sec-header"><div class="sec-title" style="font-size:12px;">Top Picks</div><a class="sec-link" style="font-size:10px;">All →</a></div>
  <div id="specialBooks"></div>
</aside>
</div>

<!-- IMMERSIVE READER OVERLAY -->
<div id="readerOverlay">
  <div class="reader-topbar">
    <button class="reader-close-btn" onclick="closeReader()" title="Close reader">×</button>
    <div style="display:flex;flex-direction:column;flex:1;min-width:0;">
      <div class="reader-book-title" id="readerTitle">Book Title</div>
      <div class="reader-book-author" id="readerAuthor">by Author</div>
    </div>
    <div class="reader-progress-wrap">
      <div class="reader-progress-bar"><div class="reader-progress-fill" id="readerProgressFill" style="width:0%"></div></div>
      <div class="reader-progress-text" id="readerProgressText">Chapter 1 of 8</div>
    </div>
    <div class="reader-controls">
      <button class="reader-font-btn" onclick="changeFontSize(-1)" title="Smaller text">A-</button>
      <button class="reader-font-btn" onclick="changeFontSize(1)" title="Larger text">A+</button>
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
      <div id="modalCoverContent" style="position:relative;z-index:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:56px;"></div>
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
        <button class="btn-modal btn-primary" onclick="showToast('⭐ Added to favorites!')">★ Favorite</button>
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
        <div class="field"><label>Genre</label><select id="addGenre"><option value="" disabled selected>Select genre</option><option value="Fantasy">Fantasy</option><option value="Romance">Romance</option><option value="Horror">Horror</option><option value="Action">Action</option><option value="Biography">Biography</option></select></div>
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
/* ═══════════════════════════════════════════════════
   PRE-WRITTEN CHAPTER STORIES — one full chapter
   per book so reading always works immediately.
═══════════════════════════════════════════════════ */
const BOOK_STORIES = {
  1: [ // Fourth Wing
    `The morning Violet Sorrengail walked through the gates of Basgiath War College, the sky was the color of a fresh bruise. She had expected fear. She had expected doubt. What she had not expected was the way every rider candidate around her seemed born of steel and arrogance, shoulders thrown back, eyes scanning the grounds like they already owned them. Violet adjusted the strap of her satchel and reminded herself that her mother had not raised her to flinch.\n\nThe Parapet loomed ahead — a narrow stone bridge that crossed a canyon so deep the bottom existed only in rumor. All around her, candidates who had trained their whole lives for this moment were whispering prayers to gods who probably had better things to do. Violet was twenty feet from the edge when a hand shot out and grabbed her arm. "You don't belong here, scribe," said a voice like a drawn blade. She turned to find Xaden Riorson — the most dangerous rider candidate in the college — staring down at her with golden eyes that held all the warmth of a November storm.\n\n"Neither do you," she said, and stepped onto the Parapet.\n\nThe wind hit her like a physical thing. Below her, the canyon breathed cold air upward in slow, invisible waves, and for a moment the world tilted sideways. She thought of her sister Mira's advice: don't look down. She thought of her mother's command: don't fail. She thought, with some bitterness, that neither piece of guidance was particularly useful when her boots were finding gaps between the stones that had no business being there.\n\nShe made it across. She did not look triumphant about it — her hands were shaking too badly for triumph. But she made it, and when she turned around, Xaden Riorson was watching her from the other side with something in his expression that was not quite contempt and not quite respect and was somehow, inexplicably, more dangerous than either.`,

    `The dragons chose their riders at dawn, in a ceremony that looked from a distance like controlled chaos and felt up close like standing inside a thunderstorm. Violet had memorized every known account of the Bonding Ceremony — the heat, the noise, the overwhelming psychic pressure of hundreds of draconic minds considering whether a human was worth their attention. None of the accounts had adequately prepared her for the reality.\n\nSgaeyl had already chosen Xaden. Three other dragons had already bonded to candidates Violet recognized from her barracks. The remaining students stood in the courtyard with the careful stillness of people trying not to draw predatory attention, which was, Violet reflected, exactly what they were doing. Then the ground shook. Not an earthquake — something more intentional than that, a deliberate percussion, like a heartbeat scaled up to the size of a mountain.\n\nTairn landed in the center of the courtyard and scattered everyone within forty feet. He was enormous even by dragon standards, his scales the deep black-green of a forest seen through river water, his eyes the color of molten copper. Every rider nearby scrambled backward. Violet stood still, not out of bravery but because her legs had briefly forgotten how to work. The dragon lowered his enormous head until one copper eye was level with hers.\n\nShe heard his voice inside her skull like a bell struck at the base of her spine. "You will do," he said. It was not, she understood immediately, a compliment. It was an assessment. A decision. She exhaled slowly and thought back at him, as clearly as she could: "So will you." Something vast and ancient shifted behind those copper eyes, and for just a moment, Violet could have sworn the dragon was amused.`,

    `Rider training was nothing like the histories described. The histories spoke of glory — the wind, the height, the communion between dragon and bonded rider. They did not mention that the first three weeks consisted primarily of being thrown, dragged, and occasionally dropped from increasingly alarming heights while an instructor shouted corrections from a safe distance below. Violet had bruises in shapes she couldn't explain and muscles she hadn't known she possessed.\n\nXaden was everywhere she didn't want him to be. He appeared at the training yard when she was struggling with the harness sequences. He appeared at the dining hall when she was trying to eat in peace. He appeared, most annoyingly, at the top of the wall run when she was three seconds behind everyone else and using every profanity she knew to push herself up the final ten feet. He never helped. He observed, with the focused attention of someone cataloguing weaknesses.\n\nThe war games changed things slightly. Violet had grown up reading strategy manuals the way other children read fairy tales, and when Professor Carr divided them into teams and explained the objective, she saw the shape of the solution before anyone else had finished reading the briefing. "You're going to get us all killed with that plan," she told Ridoc, who was technically her team leader. He blinked. "I haven't presented a plan yet." "I know," she said. "I'm preemptively saving us."\n\nThey won. It was not graceful and it was not clean and at one point Violet had to use a climbing technique her sister had taught her that involved a wall, a rope, and a complete disregard for the dignity of the situation. But they won, and afterward Xaden looked at her across the courtyard with an expression she still couldn't read, and Tairn rumbled in the back of her mind with what she was starting to recognize as approval.`,

    `The letter arrived on a Tuesday. Violet recognized her mother's seal — the formal press of the General's ring — and felt the familiar weight of dread that her mother's correspondence had always carried. The letter was brief, as her mother's letters always were, and it said, in essence, that Violet needed to stop making herself conspicuous. That her survival depended on invisibility. That she should remember why she was really at Basgiath, and who was watching.\n\nShe burned it in the small hours of the morning, in the courtyard where the sentry rotation had a blind spot she had mapped in her second week. Tairn found her there, which surprised her — dragons rarely came down to the lower courtyards. He settled beside her with the careful deliberateness of something very large trying not to cause damage, and she felt his presence in her mind, steady and warm and ancient.\n\n"My mother thinks I'm going to get myself killed," she told him.\n\n"Your mother is not wrong," he said.\n\n"That's not helpful."\n\n"It was not intended to be helpful. It was intended to be accurate."\n\nShe leaned against his side, which was warm in the way that stone holds warmth — deep and slow and from within. Around her the college slept. Above her the stars were indifferent. She thought about her sister in the eastern wing. She thought about Xaden and the secrets she could already see he was keeping. She thought about the war that everyone insisted was over and the way the dragons flinched sometimes when they looked north.\n\nShe thought: whatever is coming, I want to be ready.\n\nTairn said: "Then sleep. Tomorrow I will teach you to fly."`,

    `She did not fly gracefully. She flew the way she did most things — with determination overcompensating for lack of innate talent, her knuckles white on the harness and her jaw set against the wind. Tairn was patient in the way that geological formations are patient: not warm, not encouraging, but present and enduring and very, very unlikely to let her fall.\n\nThe view from above the war college was something no history book had prepared her for either. The mountains spread out in every direction like a lesson in humility. The college itself, which had seemed overwhelming from within, shrank to something almost comprehensible from above — a tangle of towers and training yards and secrets she hadn't uncovered yet. She thought she could see, on the far northern wall, the small figures of the second-years running the obstacle course she would face next month.\n\nXaden appeared on her left, Sgaeyl matching pace with Tairn in that effortless way bonded pairs had when their riders had given up pretending to direct them. "You're overcorrecting on the turns," he said, without preamble.\n\n"I'm aware," she said.\n\n"Your left hand is three inches higher than your right when you bank."\n\n"Also aware."\n\n"You could just let Tairn handle it."\n\n"I could," she agreed, "but then I wouldn't learn." She glanced across at him. This close, with the wind stripping away whatever careful arrangement he made of his expression on the ground, he looked something she couldn't name. Not younger exactly, but less armored. "Why are you here?" she asked.\n\nHe looked at her for a long moment before answering. "Tairn asked Sgaeyl to come," he said finally, which was clearly not the whole truth and which he knew she knew was not the whole truth, and which he seemed, for once, not to particularly care about.\n\nBelow them, the war college turned in the morning light, full of its ordinary miracles and its hidden dangers, and Violet Sorrengail flew on into whatever came next.`,
  ],

  2: [ // A Court of Thorns and Roses
    `The forest had been silent for three days before Feyre found the deer. She should have gone home. She knew she should have gone home — the cold was the killing kind, the kind that got into your bones and stayed there, and she had been out since before dawn. But the deer tracks were fresh and her family had not eaten in two days, and Feyre Archeron had learned years ago that want and should were two very different calculations.\n\nShe was lining up the shot when the wolf appeared.\n\nIt was enormous. Not wolf-enormous — not the regular kind of enormous that wild things achieved when they had enough food and enough space. This was something else. Something that made the word wolf feel like a drawer too small for what you were trying to put inside it. It stepped out of the tree line with the unhurried confidence of something that had never in its life needed to hurry, and it looked at her with eyes the color of wheat in autumn.\n\nFeyre's arrow was already nocked. The wolf looked at the arrow. The wolf looked at her. The wolf looked at the deer. And then, with a patience that felt deliberate and faintly insulting, the wolf sat down in the snow and waited.\n\nShe shot the wolf.\n\nThe pelt alone would keep them fed for a month.`,

    `She did not sleep well that night. The kill had been clean and practical and necessary, and she could not explain to herself why she kept seeing those amber eyes in the space behind her closed eyelids. She was not a sentimental person. Sentiment was a luxury, and Feyre had not been able to afford luxuries since she was eight years old and her father's merchant ships had sunk and taken their entire fortune with them.\n\nThe creature came to her door at midnight. She heard it before she saw it — a knock that was polite and somehow also absolutely certain of its welcome, the knock of something that had never been refused anything. Her sisters were sleeping. Her father was in his chair by the cold fireplace where he spent most of his hours now, lost in some private grief she had never been able to reach. Feyre was the one who answered the door.\n\nThe thing outside was enormous and it wore the shape of a man the way a river wears the shape of its banks — accommodating the form, but only technically. His face was all hard angles and controlled expression, and his eyes were the gold of old coins, and he said, very simply: "You killed my friend."\n\nBehind her, Feyre heard her father wake up.`,

    `The agreement was an old one. Her father knew of it — had known, apparently, for years, had perhaps even feared this night on some wordless level, which explained some portion of the gray in his hair and the depth of the sorrow in his eyes. The Treaty with the Fae said that the life of a Fae creature required a life in return, or a life spent in service.\n\nFeyre did not go quietly. She went with all the dignity she could assemble, which was considerable, because she had been assembling dignity out of nothing for a decade and was quite practiced at it. She packed one bag. She said goodbye to her sisters, who cried with the freedom of people who had never learned they couldn't afford to. She kissed her father's cheek, and he pressed something into her hand — a small knife, iron-handled, the kind that allegedly worked against faeries — and she tucked it into her boot because it was a comfort even if it was probably useless.\n\nPrythian was not what she had expected. The land beyond the wall was green in ways that made human green look like a rehearsal for color, and the air tasted like the moment before a thunderstorm, electric and full of something she had no name for. The creature — Tamlin, she would learn, his name was Tamlin — rode silently beside her, and she kept her eyes forward and her jaw set and told herself that this was just another hunt, and she would find a way to survive it.`,

    `She learned his name. She learned the names of the house — Spring Court, ancient and full of warmth that felt like it had been stored up over centuries. She learned that the mask he wore was not metaphor: the High Lords wore masks that had been cursed onto their faces, a punishment so old no one alive remembered the full particulars of the crime that had earned it. She learned that the servants who moved through the house were not entirely visible, their forms blurred at the edges in a way that made her head ache if she looked too long.\n\nShe also learned that she was an excellent rider, that the kitchens would give her food at any hour if she knocked and asked properly, and that Tamlin's library contained books in seventeen languages, three of which she recognized.\n\nShe read in the evenings because there was nothing else to do. She read, and occasionally she painted — Lucien found her charcoals and paper without being asked and left them outside her door, which she chose to interpret as a truce of some kind. She was filling a page with a careful rendering of the garden she could see from her window when Tamlin appeared in the doorway, watching her with an expression she was beginning to recognize: not unkindness, but something tangled up with it that she hadn't untangled yet.\n\n"You're staying," he said. It wasn't a question.\n\n"I don't have a choice," she said.\n\nHe was quiet for a long moment. "No," he agreed. "But you're not fleeing."\n\nShe looked at him over her sketchbook. "Give me time," she said, and he almost smiled.`,

    `The curse was in everything. She could feel it the way you feel weather before it arrives — in the quality of the air, in the particular stillness of the house at certain hours, in the way Tamlin moved through his own home as though it were a place he was visiting rather than a place he had always lived. She began to ask questions. Lucien, who had appointed himself her reluctant guide and unexpected something-like-friend, answered some of them and deflected others with a skill she had to admire.\n\n"Tell me about Amarantha," she said one afternoon, directly, the way she had learned directness could sometimes cut through the elaborate etiquette of evasion.\n\nLucien's easy expression went very still. "No," he said.\n\n"Is she the one who cursed you all?"\n\nThe pause before he answered was a full sentence by itself. "Yes."\n\n"And she can only be defeated by—"\n\n"Feyre." His voice had gone quiet and entirely serious, stripped of its usual performance. "There are things that are dangerous to know. Not because the knowing is forbidden, but because the knowing puts you in the path of something you cannot face. Do you understand?"\n\nShe thought about it honestly. She thought about the deer and the wolf and the knife in her boot and the ten years she had spent refusing to be beaten by something as impersonal as poverty. "No," she said. "I don't think I understand staying ignorant in order to stay safe. I've never had that option."\n\nLucien looked at her for a long moment, and then he said, very quietly, "Then may the Cauldron help you," and went to find something stronger than tea.`,
  ],

  3: [ // The Midnight Library
    `Between life and death there is a library. Nora Seed had not known this. She had known many things — had known disappointment in a very comprehensive way, had known the weight of roads not taken and the specific grief of potential unrealized — but she had not known about the library, and so she arrived in it the way most people arrive at important places: completely unprepared.\n\nThe library smelled of old paper and something like rain, and it was vast in the way that spaces are vast in dreams, its shelves receding in every direction toward a ceiling she couldn't find. The books on the shelves were green. All of them, every one, a particular shade of muted green that she had no word for. She was still wearing the clothes she had died in, which she found embarrassing in a way she couldn't entirely explain.\n\n"Hello, Nora," said a voice behind her.\n\nShe turned to find Mrs. Elm — not quite Mrs. Elm, or Mrs. Elm as she remembered her from childhood, the school librarian who had been her only reliable kindness at eleven years old. This version of Mrs. Elm was ageless in the way of libraries themselves, and she was sitting behind a desk that hadn't been there a moment ago, and she was watching Nora with the calm patience of someone with quite a lot of time.\n\n"Am I dead?" Nora asked.\n\n"That," said Mrs. Elm, "depends on what you decide to do next."`,

    `The Book of Regrets was heavier than it looked. Nora had expected this — she had accumulated, as far as she could tell, rather more regrets than the average person, or at least had given more concentrated attention to hers. But the physical weight of the book surprised her, the way the leather cover seemed to carry something dense and specific inside it. She opened it with the reluctance of opening an exam she knew she had failed.\n\nThe regrets were organized not alphabetically but chronologically, which was worse in its own way. There was the swimming. There was the band. There was Dan, and the way she had ended things on a Tuesday morning over a phone that crackled. There was her brother Joe, and the conversation she had avoided having for three years. There was the cat — she had a page and a half about Volts, which embarrassed her but seemed accurate.\n\nMrs. Elm watched her read without comment. When Nora finally closed the book, she said: "Each regret represents a life you could have lived. A path not taken. In this library, you can take those paths. You can try the lives and see."\n\n"And if one of them is right?" Nora said. "If one of them is the life I should have had?"\n\n"Then you stay in it," Mrs. Elm said. "The midnight library closes, and you live."\n\nNora looked at the shelves — at the thousands of green spines, each one a different version of her — and felt, for the first time in longer than she could remember, something that was not quite hope but was in the same family.`,

    `The Olympic life was nothing like she had imagined. The body was hers and wasn't hers — tuned to a different pitch, holding ten years of water and training in its muscles, moving with a confidence she had never quite managed in her original life. The pool was enormous. The crowd, when she surfaced from her heat, was making a sound like weather.\n\nShe had medaled. Third place, bronze, but the feeling in the chest of this body when the results appeared was not third-place feeling. It was the feeling of someone who had built something over a decade and had seen it hold. She stood on the podium and felt the weight of what she had not sacrificed for this — the music, the writing, the life she had constructed instead — and found she couldn't quite calculate the sum.\n\nIn her hotel room that evening she sat on the edge of the bed and tried to feel the answer. Was this it? Was this the life that fit? The body around her was strong and tired in a specific, satisfied way. Outside the window the Olympic village was still celebrating. She thought of the cat she would not have had. She thought of the bookshop she would not have worked in. She thought of the conversations she had not had in this life, the people who did not know her name.\n\nShe thought: a life is not a calculation. You cannot add up what you have and subtract what you don't have and find the number that tells you whether it's worth living. You can only live it or not live it.\n\nThe library pulled her back before she could decide if she had meant that as a reason to stay or a reason to return.`,

    `She tried twelve lives in what felt like a single evening: the pub landlady in Australia, the geologist in Iceland, the version of herself that had married Dan and moved to the suburbs and made the suburban life genuinely beautiful in ways she hadn't expected. She tried the rock star version — her band had made it, which explained something about the looks she had gotten when she had stopped believing it could — and found that fame was exactly as complicated as every account she had ever read.\n\nEach life had a center of gravity. Each one held something real. The problem, she was beginning to understand, was not that her original life lacked value. The problem was that she had looked at it with the particular vision of someone who believes they are the mistake in their own story — as if she were a variable that had failed to combine correctly with everything else, rather than a constant that the story had been built around.\n\nMrs. Elm was waiting for her each time she returned, with the patient expression of someone who had seen this realization happen before and had the courtesy not to rush it. "You're beginning to understand," she said, after the twelfth life.\n\n"I'm beginning to understand that I don't know enough," Nora said.\n\n"That," said Mrs. Elm, "is precisely the beginning of understanding."`,

    `The library was fading. She noticed it the way you notice weather changing — gradually, then all at once. The green spines were losing their color. The shelves were becoming transparent. Mrs. Elm was still at her desk but she was less there than she had been, her edges softer, her voice carrying a quality of goodbye.\n\n"You're running out of time," Mrs. Elm said.\n\n"Running out of time to do what?" Nora asked, though she understood.\n\n"To choose. The library exists at midnight — at the exact pivot between one day and the next, one life and the next. You have visited many lives. You have seen what you are and what you are not. Now you must decide whether you want to return to your original life or let the library close around you."\n\nNora thought about the swimming and the music and the cat and the dozen other versions of herself she had temporarily inhabited. She thought about what each life had given her and what each one had cost her and she thought about the root system that connected them all — her, at the center, the person who had made those choices, who had survived those choices, who was, if she was honest, more than the sum of her regrets.\n\nShe thought: I want to live.\n\nNot a different life. Not a corrected life. Her life — the one she had, with all its particular, irreversible, irreplaceable shape.\n\n"I want to go back," she said, and the library began to dissolve around her like morning, like waking, like the first breath after a very long time underwater.`,
  ],

  6: [ // Happy Place
    `The cottage on the coast of Maine had not changed. This was the problem. Harriet had been hoping, on some not-quite-conscious level, that the passage of time would have rearranged something — softened an angle, changed a color, done anything to make the next four days feel less like arriving at a scene of an accident she had caused. The weathervane on the roof was still the iron fish. The porch swing still had the slight list to the left. The window boxes were full of the same stubborn geraniums that had survived there every year since Sabrina had planted them the summer they all turned twenty-three.\n\nHarriet sat in the rental car and gave herself thirty seconds to feel whatever she was going to feel, which was a technique her therapist had given her that worked about forty percent of the time.\n\nInside the cottage, she could hear her friends. Cleo's laugh, which could be identified at significant distance. Parisa's lower voice threading underneath it. The particular thump-and-clatter of Wyn unpacking in the room they had shared every summer for seven years and would apparently share again this summer, because neither of them had told their friends the truth, which was that they had been broken up for four months, and Harriet, who was the most honest person she knew, had helped construct this lie through four months of silence, which told her something about how badly she was broken.\n\nThe thirty seconds ended. She got out of the car.`,

    `"You look like you've seen a ghost," Cleo said, hugging her.\n\n"I'm fine," Harriet said, which was something she had said so many times in the past four months that it had become phonetically interesting rather than meaningful.\n\nWyn was in the kitchen. He was making coffee, which was what Wyn did when he was anxious, which she knew because she had spent seven years learning the vocabulary of how Wyn moved through rooms. He had his back to her. The kitchen was small. There was no route to anywhere else that didn't pass within two feet of him, and so she passed within two feet of him, and she could feel the specific gravity of proximity — the way you can feel a held breath in a room.\n\n"Hey," he said, without turning around.\n\n"Hey," she said.\n\nCleo was watching them with the confused expression of someone who sensed a subtext she hadn't been given. Sabrina, who was better at reading rooms than anyone Harriet had ever met, said nothing but placed a glass of wine in Harriet's hand with the precision of a surgeon.\n\nThey had told everyone they were fine. They had told everyone the separation was temporary — a break, a breathing space, one of those decisions that couples sometimes make when they need perspective. This was mostly true, except for the part where it wasn't temporary and wasn't a break and was, specifically, over. The rest of it was technically accurate.`,

    `The first night was manageable. Dinner was good — Parisa had brought the good olive oil, Cleo had made the bread, Wyn grilled the fish the way he always had with the lemon and the herbs and the patience that was the most annoying thing about him when she was trying to be angry at him. They sat around the table and talked about the year and laughed about the things that were safe to laugh about, and Harriet monitored herself the way she monitored patients — looking for symptoms, looking for breaks in the surface.\n\nThe sleeping arrangements were the problem she had been not-solving for four months. The cottage had three bedrooms. Sabrina and Eli had one. Cleo and Parisa had one. She and Wyn had one, with the bed they had slept in every summer and the window that faced east and the specific sound of the ocean at night that she had learned to love because he loved it.\n\n"We can do this," he said, when the house had finally gone quiet and they were both standing in the doorway of the room.\n\n"We've survived harder things," she agreed, which was true and also, she realized as she said it, an argument for the other side.\n\nThey slept on opposite edges of the bed like a demonstration of something, and Harriet lay in the dark and listened to the ocean and thought about the particular cruelty of wishing things were different when you were the one who had made them this way.`,

    `She made it to Wednesday before it fell apart. Not catastrophically — not in a way their friends could see — but she caught Wyn watching her across the deck while the others were down at the water, and she made the mistake of holding his gaze, and then she made the second mistake of staying when everyone else went inside.\n\nThey hadn't been alone together in four months. She hadn't registered how thoroughly she had managed that until the deck emptied and there they were.\n\n"I miss you," he said. Just that.\n\nShe had prepared several responses to this. She had considered it as a possibility — had considered, honestly, most of the possibilities, because she was a planner by nature and planning was how she managed not to be overwhelmed. But she had not prepared adequately for the specific quality of how he looked when he said it — the absence of any performance in it, the way it was just true, stated plainly, without defense.\n\n"Wyn—"\n\n"I know," he said. "I know the reasons. I know what you decided and why. I'm not asking you to change anything." He was quiet for a moment. The ocean was doing what it always did, which was to be the kind of vast that puts everything else in proportion. "I just wanted you to know that it's true. That I miss you. Whatever we decide about the rest of it."\n\nShe sat down in the chair she always sat in, which still had the cushion with the faded pattern she had never liked, and she thought about honesty and what it cost and what it gave back.\n\n"I miss you too," she said finally. "I hate it, and I miss you too."`,

    `They told their friends on Thursday morning, over coffee, in the kitchen, with the particular morning light coming through the window that had always made the cottage feel like a place where difficult things could be said clearly. Cleo cried immediately. Parisa sat with her hands around her mug and asked three careful questions. Sabrina, who had known, or had suspected, or had been waiting — Harriet wasn't sure which, with Sabrina — said simply: "What do you need?"\n\nWhat Harriet needed was not simple and was also, she was beginning to understand, not the question she had been asking herself for four months. She had been asking herself what was right, what was reasonable, what was the correct decision for two people who loved each other but had wanted different things at different speeds. She had not been asking what she needed, because she had learned early that want was a variable you had to control for.\n\nBy Friday evening something had shifted. Not fixed — she was a doctor, she understood that healing was slow and nonlinear and full of setbacks. Not resolved. But shifted, the way weight redistributes when you stop holding yourself in a shape that hurts. Wyn found her on the porch at dusk, the ocean doing its endless patient work below them, and he sat beside her in the other chair, and she thought that whatever they decided next — whatever shape their lives took from here — she was glad to have had the years they had had. The cottage. The summers. This particular light.\n\n"I'd like to try again," she said. "If you want to. Differently. Honestly."\n\nHe exhaled slowly, and turned to look at her, and said: "I have been wanting nothing else."`,
  ],

  11: [ // Holly
    `The name on the file was Jacob Alderton, twenty-two years old, last seen leaving his apartment on the evening of March 14th. Missing persons. Holly Gibson did not, technically, investigate missing persons anymore — she ran her own private investigation firm out of a small office in a neighborhood that was in the process of becoming fashionable, which meant the rent went up every time something new opened on the block. But the mother had called twice, and something in the second call had made Holly set down her crossword and actually listen.\n\nThe mother said the police had decided Jacob had simply left. Young men in their twenties left all the time — left their apartments, left their routines, left the lives their families had understood them to be living. The police were not wrong that this happened. The police were also, in Holly's experience, occasionally wrong about which cases fit which pattern.\n\n"What makes you think it's not that?" Holly had asked.\n\nA silence. Then: "His cat. He left without making arrangements for his cat. Jacob loved that cat more than anything. He called her more than he called me." Another pause. "His name was Mr. President."\n\nHolly had written down the name, which told her something, and the name of the coffee shop where Jacob had been a regular, which told her something else, and the names of the professors he had been close to at the university, which told her a third thing. She had started making calls the next morning.`,

    `The university was the kind of place that looked modest from the outside and enormous from within — old stone buildings arranged around a quad, the kind of aesthetic that said serious work happens here and had been saying it for long enough that it had become true through repetition. Holly had visited many universities in her career and had never entirely shaken the feeling that they were designed to make you feel slightly diminished, which she suspected was intentional.\n\nProfessor Reginald Harriot had an office on the third floor of the humanities building, behind a door covered in the accumulated paper of many academic years. He was in his early sixties, trim, with the kind of face that held its expressions carefully, and he had agreed to meet with her with a speed that suggested either genuine concern or practiced willingness to appear concerned.\n\n"Jacob was a remarkable student," he said. "Truly. One of the best we've had in the program in years."\n\n"When did you last see him?"\n\nA pause that was perhaps a half-second too long. "The week before he disappeared. He came to office hours."\n\n"What did you discuss?"\n\n"His thesis. His future plans." Another precise pause. "He was excited about some research he'd been doing independently. Outside the normal curriculum." Harriot smiled, the smile of a patient man. "Students sometimes get very invested in these independent projects. They don't always lead anywhere productive."\n\nHolly wrote down independent research in her notebook and looked at the professor with the look she had developed over fifteen years of work, the look that said she was listening to what he wasn't saying.`,

    `The café was called The Second Chapter, which struck Holly as the kind of name you chose when you wanted people to feel safe. It was warm inside and smelled of ground coffee and something baked, and the barista who had known Jacob Alderton remembered him clearly in the way that people remember someone who was genuinely kind to them rather than just pleasant.\n\n"He came in every morning," she said. Her name was Destiny, she was twenty-four, and she had been pulling shots long enough that she did it without looking at her hands. "Same order, same table. He'd read for a while. Sometimes write in this notebook."\n\n"What kind of notebook?"\n\n"Black cover. Medium-sized. He was protective of it — like, not rude about it, but if you walked past he'd sort of shift it so you couldn't read." She began making Holly's coffee without being asked, which Holly found she didn't mind. "He came in twice the week before he went missing. Both times he seemed…" She searched for the word. "Watchful. Like he was aware of the room in a way he usually wasn't."\n\n"Did he talk to anyone?"\n\n"There was a woman. Came in both times. Older — sixties maybe, white hair, very well-dressed. They talked quietly. When she left the second time Jacob sat by himself for a long time not reading."\n\nHolly wrote: woman, sixties, well-dressed. She thought about Professor Harriot's half-second pauses and the independent research and the cat named Mr. President left behind without arrangements, and she felt the particular sensation she had learned to trust — the one that said: something happened here, and the people involved don't think it looks like what it was.`,

    `The body was found on a Thursday, in a wooded area behind a private property on the edge of the city, by a dog walker whose dog had been insistent in ways that overcame the walker's reluctance to investigate. Holly heard about it through her contact at the department — retired detective Pete Sablo, who owed her several favors and repaid them by occasionally answering his phone.\n\n"It's being treated as natural causes," Pete said, with the tone of a man who had not called Holly at eight in the morning to discuss natural causes.\n\n"How natural?"\n\n"Cardiac. Young man, no history of heart trouble. Very healthy otherwise." A pause. "Very healthy except for a level of a specific compound in his system that might explain the cardiac event but is only detectable if you're specifically looking for it."\n\n"Were they specifically looking for it?"\n\n"Initial tox screen wouldn't have caught it. Full comprehensive screen—" He let that trail off.\n\n"Who owns the property?"\n\nShe heard him shuffle something. "Corporation. Subsidiary of a subsidiary. Registered in Delaware." He read her a name that meant nothing, and then he read her a second name — a director, a board member, a piece of the ownership chain that had a face attached to it — and Holly wrote it down and stared at it for a moment.\n\nShe knew the name. She had been writing it in her notebook for four days. She put on her coat and called Jacob Alderton's mother and told her she had something.`,

    `She did not tell the mother everything. Not yet. Not until she had more of the shape of it, not until she understood what had been taken and why and who had decided that a twenty-two-year-old graduate student was a threat worth eliminating. She told the mother that she was close, and that was true, and that the police would need to be involved, which was also true and which the mother understood meant that the answer was bad.\n\nThe well-dressed woman with white hair was named Audrey El-Baz, and she had been a professor of biochemistry at the same university for twenty years, and she had retired eight months ago under circumstances that the university's official communications described as routine and that Holly's research described as significantly less routine. Holly found her on a Tuesday afternoon in a garden center on the east side of the city, choosing tomato plants with the focused attention of someone who had transferred all their professional intensity into horticulture.\n\nAudrey El-Baz looked at Holly's card and then looked at Holly and did not pretend. She was, Holly thought, not a good liar — or not a willing one, which was different.\n\n"He found out," Holly said, simply.\n\n"Yes."\n\n"And he told you."\n\n"He wanted to know what to do with it." Her voice was steady. Her hands were not. "He was a good person. He thought good people had somewhere to take things like this."\n\nHolly thought about Jacob Alderton, twenty-two years old, serious and kind and protective of his notebook, who had believed that evidence of wrongdoing was a problem that could be solved by bringing it to the right person.\n\n"Tell me everything," Holly said, and took out her notebook.`,
  ],

  24: [ // Educated
    `The mountain was the first fact of her life — a fact before memory, before language, present in everything. Buck's Peak, in southeastern Idaho, where the land made a particular shape against the sky that meant home in the part of the brain that forms before reasoning. Tara Westover had not always known its name; she had simply known it was there, and that everything else was arranged in relation to it.\n\nHer father believed the mountain would save them when the end came, which he believed was close. The provisions were in the barn — hundreds of pounds of wheat, kerosene, weapons, the particular architecture of a life organized around an expected catastrophe. Her mother made tinctures and salves in the kitchen, things that smelled of lavender and something older than medicine. Her brothers moved through the property with the self-sufficiency of people who had been taught that the world beyond it was the problem and the solution both.\n\nTara was seventeen years old and had never been to school.\n\nThis was not unusual in her family. None of her siblings had attended school, not properly — there had been some homeschooling, in the loosest sense of the word, dependent on whoever in the family had time and inclination. What Tara had instead of school was the mountain, and the junkyard her father ran, and the stories her family told about who they were and where they came from, which she had absorbed as children absorb air, without knowing she was doing it.`,

    `The first book was her brother Tyler's. He was the strange one — the one who had gone away, who had found something in the world beyond the mountain that was worth staying for. He had come back once with books, and he left them behind when he left, and Tara had read them the way you read things when no one has told you what reading is for: looking for something, not sure what.\n\nShe read late, after her parents were sleeping, by the window where the moonlight was clearest. She read haltingly and then more fluently and then, after enough weeks, with something that felt like hunger. Words she didn't know she stopped on and puzzled out, feeling for meaning the way you feel for a step in the dark. She had no framework for what she was reading — no teacher to explain context, no classroom to place it in — and so she read everything as fact, everything as equally true or untrue, a chaos of information that she was the only person organizing.\n\nShe understood, reading Tyler's books, that there were things she did not know. This sounds obvious. It was not obvious. She had lived seventeen years in a system of knowledge that was complete in itself — self-consistent, internally coherent, referring only to itself. To understand that there was more was to understand that the complete system was not complete. This was, she would think later, one of the most disorienting realizations a person can have. She had it alone, at night, by a window on a mountain.`,

    `The community college was a drive she made in silence the first time, rehearsing vocabulary that felt borrowed, concepts that belonged to other people's lives. She sat in the testing room and read the questions with the focus of someone translating from a foreign language — not the words, which she understood, but the assumptions behind them, the framework of education that the questions took for granted.\n\nShe did not do well. This she had expected. She did well enough, which she had not expected, because she did not yet have an accurate measure of what her unconventional education had given her — the capacity to read long and difficult things, the habit of independent reasoning, the specific intelligence of someone who has had to figure most things out for themselves.\n\nThe professor of mathematics told her she had an aptitude. She did not know how to receive this information — it arrived in her like a letter written in a language she was still learning. She had been told she was capable of physical work, capable of surviving, capable of enduring. She had not been told she had an aptitude for anything that looked like the future.\n\nShe started driving to the college every week, and then three times a week, and then every day, and the mountain receded in the rearview mirror each morning and reappeared in the evenings, and for a while she lived in both worlds simultaneously, which was the hardest part — the overlap, the way the two sets of truths contradicted each other and both demanded to be believed.`,

    `The scholarship letter arrived on a Tuesday. Cambridge University. The words meant something and didn't mean something — she knew the university's reputation in the abstract, the way you know facts about countries you've never intended to visit. She sat with the letter for a long time before showing anyone. She sat with it because once she showed it, the fact would become shared, and she had learned that shared facts are harder to hold onto when the people sharing them have different investments in what they mean.\n\nHer parents were proud in the way that contains ambivalence. Her father said something about vanity, which was his word for the kind of achievement that moved you away from your family, and she recognized the word from the many times he had used it before. Her mother said she was happy, and Tara believed her, and believed also that happy was not the only thing her mother was.\n\nShe packed her things with the same care she had learned packing anything fragile — the books she had accumulated, the notes, the folder of letters that had arrived over two years from professors who had found her unusual in ways that were useful. She did not pack the beliefs she was leaving behind; they were not the kind of thing you packed. They were the kind of thing that came with you whether you meant to bring them or not, and that you spent years discovering inside yourself, in the places where you had not thought to look.\n\nShe drove down the mountain in the morning, in the direction of an airport, in the direction of a future that she had built herself, out of other people's books and her own stubborn refusing to stop.`,

    `Cambridge was cold in October in the particular way of old places — a cold that had been there longer than the buildings, that lived in the stone and the air and came out in the evenings to remind you that you were new here and the cold was not. Tara walked through the town with the sensation of someone who has prepared for a country without having been to it: the preparation was thorough and the reality was still surprising.\n\nShe did not fit. This was not an accusation she leveled at herself but an observation, clinical and useful. She did not fit the way that anyone does not fit a place that was not designed for them — not badly, not fatally, but with the persistent friction of mismatched edges. The other students had vocabularies built from childhoods she had not had. They referenced things she had not read and experiences she had not had and assumptions that she had never shared. She wrote down the gaps and filled them methodically, the way she had always learned, by herself, by finding the source.\n\nShe called home less than she had planned to. The calls were difficult in a way she was still locating — not because her parents were unkind, but because the two versions of herself could not occupy the same conversation without creating a static she hadn't learned to talk through. She wrote instead, long careful letters, and her mother wrote back with news of the mountain and the seasons.\n\nYears later, she would write about all of it: the mountain, the father, the education that had been withheld and the one she had assembled from scraps. She would write about the brother, and the truth he carried and the damage it had done. She would write with the precision of someone who has spent a long time deciding what is true, and the book she wrote would reach people who read it in silence and found, in her story, the outline of something they had not had words for either.`,
  ],
};

// Generate fallback story for books without pre-written content
function generateFallbackStory(novel, chapterIdx) {
  const titles = getChapterTitles(novel);
  const chapterTitle = titles[chapterIdx];
  const isFirst = chapterIdx === 0;
  const isLast = chapterIdx === CHAPTER_COUNT - 1;

  const openings = {
    Fantasy: [`The kingdom had not seen magic in a thousand years, or so the histories claimed. But histories, as anyone who had spent time in a library could tell you, were written by people with reasons to claim things.`, `Dragons were considered myth. This was convenient for the dragons.`, `The sword chose its wielder at dawn, in a ceremony older than the kingdom, older than the language used to describe it.`],
    Romance: [`She was not supposed to be here. The party was for other people — people who had RSVP'd, people who knew the host, people who had not simply followed their friend through the wrong door and found themselves in the middle of someone else's evening.`, `The coffee shop closed at nine. It was nine-fifteen, and he was still at the counter, and she was technically no longer working.`, `The apartment above hers had been empty for two years. She had gotten used to the quiet.`],
    Horror: [`The lights in the house across the street had been on for seventy-two consecutive hours. Margaret Chen had been counting.`, `Children's laughter should not sound like that. It should not carry that particular harmonic, that subsonic frequency that made the fillings in your teeth resonate.`, `The new town was supposed to be a fresh start. That was the phrase everyone used: fresh start. As if the past were a document you could close without saving.`],
    Action: [`The mission briefing lasted eleven minutes. This was three minutes longer than he needed and eight minutes shorter than procedure required.`, `She had forty-five seconds to clear the building. She had done it in thirty-eight before, but that was with a different floor plan and a different extraction window.`, `The target was not where the intelligence said he would be. In his experience, they never were.`],
    Biography: [`The house she grew up in no longer exists. She drove past the lot once, years later, and found a parking structure in its place, which struck her as either ironic or appropriate, depending on what you believed about the relationship between the past and the present.`, `She was seven years old when she understood that the world was not arranged in her favor. This is a thing that most people understand eventually; the age at which you understand it shapes what you do next.`, `There are photographs from before. She keeps them in a box she does not open often, not because the images are painful but because they belong to a person she has spent years trying to understand.`],
  };

  const middles = [`The days that followed would be ones she returned to in memory many times — not for their drama, which was real enough, but for the quality of attention she had brought to them, the way she had been, for once, entirely present in what was happening around her.`, `There are moments that divide a life into before and after. She was in the middle of one and she could feel its edges, the way you can feel the edge of a continent when you're standing on it.`, `He understood, looking back, that he had been given all the information he needed. He simply hadn't known which pieces were information and which were noise.`];

  const endings = [`Later, much later, she would try to explain to someone why she had done it — why she had made the choice she made in the moment when it mattered — and she would find that the explanation required the whole story, not just the end of it.`, `Whatever came next, it would come. She was not ready, but she had never been ready for the things that had mattered most, and she had survived them anyway.`, `He did not know, driving away from everything he had known, whether he was running toward something or away from something. He decided this distinction was less important than he had always believed.`];

  const genreOpenings = openings[novel.genre] || openings.Fantasy;
  const opening = genreOpenings[chapterIdx % genreOpenings.length];
  const middle = middles[chapterIdx % middles.length];
  const ending = isLast ? endings[2] : endings[chapterIdx % endings.length];

  return `${opening}\n\nThe chapter of ${novel.title} titled "${chapterTitle}" finds its characters at a turning point. ${novel.desc} — this is the promise the story makes in its opening pages, and in this chapter, that promise begins to be paid.\n\n${middle}\n\nFor ${novel.author}, the craft has always been in the specifics: the precise weight of a moment, the exact quality of light in a scene, the way characters reveal themselves through small decisions that accumulate into lives. This chapter exemplifies that approach, moving the story forward through accumulation rather than event.\n\nThe world of the novel presses close here. The ${novel.genre.toLowerCase()} elements are in full force — this is the genre's grammar being used fluently, its conventions honored and occasionally subverted. The reader who has come this far feels the familiar pleasure of a story that knows where it is going.\n\n${ending}`;
}

/* ═══════════════════════════════════════════════════
   NOVELS DATA
═══════════════════════════════════════════════════ */
const NOVELS_DEFAULT=[
  {id:1,title:"Fourth Wing",author:"Rebecca Yarros",genre:"Fantasy",desc:"Violet Sorrengail is sent to a deadly dragon-rider war college in this epic enemies-to-lovers fantasy.",emoji:"🐉"},
  {id:2,title:"A Court of Thorns and Roses",author:"Sarah J. Maas",genre:"Fantasy",desc:"A huntress is taken to a magical fae land in this sweeping Beauty and the Beast retelling.",emoji:"🐉"},
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
  {id:25,title:"Spare",author:"Prince Harry",genre:"Biography",desc:"Prince Harry recounts his life inside the royal family and his path to freedom.",emoji:"👑"},
];

const genreColors={
  Fantasy:{bg:'linear-gradient(135deg,#064e3b,#065f46)',dot:'#22c55e',badge:'rgba(34,197,94,0.15)',btext:'#22c55e'},
  Romance:{bg:'linear-gradient(135deg,#831843,#9d174d)',dot:'#f472b6',badge:'rgba(244,114,182,0.15)',btext:'#f472b6'},
  Horror:{bg:'linear-gradient(135deg,#7f1d1d,#991b1b)',dot:'#ef4444',badge:'rgba(239,68,68,0.15)',btext:'#ef4444'},
  Action:{bg:'linear-gradient(135deg,#1e3a5f,#1d4ed8)',dot:'#60a5fa',badge:'rgba(96,165,250,0.15)',btext:'#60a5fa'},
  Biography:{bg:'linear-gradient(135deg,#78350f,#92400e)',dot:'#fb923c',badge:'rgba(251,146,60,0.15)',btext:'#fb923c'},
};

const NOTIFS=[
  {id:1,icon:'📚',text:'New book added — "The Familiar"',time:'2 min ago',unread:true},
  {id:2,icon:'⭐',text:'You reached your weekly reading goal!',time:'1 hour ago',unread:true},
  {id:3,icon:'🆕',text:'5 new Fantasy releases available this week',time:'3 hours ago',unread:true},
  {id:4,icon:'📖',text:'Reminder: Continue "Holly" — Chapter 8',time:'Yesterday',unread:false},
  {id:5,icon:'👤',text:'New author profile added: Emily Henry',time:'2 days ago',unread:false},
];

const coverCache={};
let favorites=[1,3,6,11,16,21];
let novels=[...NOVELS_DEFAULT];
let currentDetailId=null;
let editingId=null;
let deletingId=null;

/* ═══════════════════════════════════════════════════
   READER STATE
═══════════════════════════════════════════════════ */
let readerNovel=null;
let readerChapterIdx=0;
let readerFontSize=18;
let readerUseSerif=true;
let chapterCache={};
let isGenerating=false;

const CHAPTER_COUNT=5;

function getChapterTitles(novel){
  const templates={
    Fantasy:['The Call to Arms','Dragons and Destiny','The First Flight','Shadows of the Keep','Wings of Fate'],
    Romance:['Unexpected Meeting','Words Unsaid','Crossing Lines','Surrender','Ever After'],
    Horror:['Something in the Dark','The Neighbor','Doors That Shouldn\'t Open','Missing Hours','The Last Night'],
    Action:['The Assignment','First Blood','Double Cross','Point of No Return','Aftermath'],
    Biography:['Origins','The Early Years','A Turn of Fate','Rising','Legacy'],
  };
  return templates[novel.genre]||templates.Fantasy;
}

/* ═══════════════════════════════════════════════════
   OPEN / CLOSE READER
═══════════════════════════════════════════════════ */
function startReading(){
  if(!currentDetailId) return;
  const novel=novels.find(n=>n.id===currentDetailId);
  if(!novel) return;
  closeDetailModal();
  setTimeout(()=>openReader(novel),250);
}

function openReader(novel){
  readerNovel=novel;
  readerChapterIdx=0;
  chapterCache={};
  document.getElementById('readerTitle').textContent=novel.title;
  document.getElementById('readerAuthor').textContent='by '+novel.author;
  renderChapterList();
  loadChapter(0);
  document.getElementById('readerOverlay').classList.add('open');
  document.body.style.overflow='hidden';
}

function closeReader(){
  document.getElementById('readerOverlay').classList.remove('open');
  document.body.style.overflow='';
}

function renderChapterList(){
  const titles=getChapterTitles(readerNovel);
  const list=document.getElementById('chapterList');
  list.innerHTML=titles.map((t,i)=>`
    <div class="chap-item ${i===readerChapterIdx?'active':''}" id="chapItem_${i}" onclick="selectChapter(${i})">
      <span class="chap-item-num">${String(i+1).padStart(2,'0')}</span>
      <span class="chap-item-name">${t}</span>
    </div>`).join('');
}

function selectChapter(idx){
  readerChapterIdx=idx;
  renderChapterList();
  loadChapter(idx);
  document.getElementById('readerContentWrap').scrollTop=0;
}

function updateReaderProgress(){
  const pct=Math.round(((readerChapterIdx+1)/CHAPTER_COUNT)*100);
  document.getElementById('readerProgressFill').style.width=pct+'%';
  document.getElementById('readerProgressText').textContent=`Chapter ${readerChapterIdx+1} of ${CHAPTER_COUNT}`;
}

/* ═══════════════════════════════════════════════════
   CHAPTER LOADING — pre-written first, AI fallback
═══════════════════════════════════════════════════ */
async function loadChapter(idx){
  if(!readerNovel||isGenerating) return;
  updateReaderProgress();

  const titles=getChapterTitles(readerNovel);
  const chapterTitle=titles[idx];
  const area=document.getElementById('readerContentArea');

  area.innerHTML=`
    <div class="reader-chapter-header">
      <div class="reader-chapter-num">Chapter ${idx+1}</div>
      <div class="reader-chapter-title">${chapterTitle}</div>
      <div class="reader-chapter-meta">
        <span>${readerNovel.author}</span>·<span>${readerNovel.genre}</span>·<span id="wordCountLabel">Loading…</span>
      </div>
    </div>
    <div class="reader-content" id="chapterTextArea"></div>
    <div id="chapterFooterNav"></div>`;

  // Check cache first
  const cacheKey=readerNovel.id+'_'+idx;
  if(chapterCache[cacheKey]){
    renderChapterText(chapterCache[cacheKey],idx);
    return;
  }

  // Use pre-written story if available
  const prewritten = BOOK_STORIES[readerNovel.id];
  if(prewritten && prewritten[idx]){
    chapterCache[cacheKey]=prewritten[idx];
    renderChapterText(prewritten[idx],idx);
    return;
  }

  // Try AI generation via Anthropic API
  const textArea=document.getElementById('chapterTextArea');
  textArea.innerHTML=`<div class="ai-generating">
    <div class="ai-gen-icon">📖</div>
    <div class="ai-gen-text">Generating Chapter ${idx+1}<br><em style="font-size:12px;color:var(--text3);">"${chapterTitle}"</em></div>
    <div class="ai-gen-bar"><div class="ai-gen-fill"></div></div>
    <div class="ai-typing-dots"><div class="ai-typing-dot"></div><div class="ai-typing-dot"></div><div class="ai-typing-dot"></div></div>
  </div>`;

  isGenerating=true;
  try{
    const prompt=`Write Chapter ${idx+1} of a ${readerNovel.genre} novel called "${readerNovel.title}" by ${readerNovel.author}. Chapter title: "${chapterTitle}". Book synopsis: ${readerNovel.desc}. Write exactly 4-5 immersive paragraphs (4-6 sentences each) of vivid prose matching the ${readerNovel.genre} genre tone. Output ONLY the story text, no titles or meta-commentary.`;

    const response=await fetch('https://api.anthropic.com/v1/messages',{
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body:JSON.stringify({
        model:'claude-sonnet-4-5',
        max_tokens:1000,
        messages:[{role:'user',content:prompt}]
      })
    });
    const data=await response.json();
    const text=data?.content?.[0]?.text||'';
    if(text.trim()){
      chapterCache[cacheKey]=text.trim();
      renderChapterText(text.trim(),idx);
      return;
    }
  }catch(e){
    // API failed, use fallback
  }finally{
    isGenerating=false;
  }

  // Fallback: use generated story
  const fallback=generateFallbackStory(readerNovel,idx);
  chapterCache[cacheKey]=fallback;
  renderChapterText(fallback,idx);
}

function renderChapterText(text,idx){
  const textArea=document.getElementById('chapterTextArea');
  const wordCount=text.split(/\s+/).length;
  const readTime=Math.ceil(wordCount/200);
  const wl=document.getElementById('wordCountLabel');
  if(wl) wl.textContent=`~${wordCount} words · ${readTime} min read`;

  const paragraphs=text.split(/\n\n+/).filter(p=>p.trim());
  let html='';
  paragraphs.forEach(p=>{
    const t=p.trim();
    if(!t) return;
    if(t==='* * *'||t==='---') html+='<div class="scene-break">· · ·</div>';
    else html+=`<p>${t}</p>`;
  });
  textArea.innerHTML=html||`<p>${text}</p>`;
  applyReaderFont();
  renderChapterFooterNav(idx);
  const ci=document.getElementById('chapItem_'+idx);
  if(ci) ci.style.opacity='1';
}

function renderChapterFooterNav(idx){
  const nav=document.getElementById('chapterFooterNav');
  if(!nav) return;
  nav.innerHTML=`
    <div class="chapter-nav-footer">
      <button class="chap-nav-btn" onclick="selectChapter(${idx-1})" ${idx===0?'disabled':''}>← Previous</button>
      <div class="chap-progress"><span class="chap-progress-frac">${idx+1}</span> / ${CHAPTER_COUNT} &nbsp;·&nbsp; ${Math.round(((idx+1)/CHAPTER_COUNT)*100)}% complete</div>
      <button class="chap-nav-btn next-btn" onclick="selectChapter(${idx+1})" ${idx===CHAPTER_COUNT-1?'disabled':''}>Next Chapter →</button>
    </div>`;
}

function changeFontSize(delta){readerFontSize=Math.max(14,Math.min(26,readerFontSize+delta));applyReaderFont();}
function toggleFont(){readerUseSerif=!readerUseSerif;const btn=document.getElementById('fontToggleBtn');btn.textContent=readerUseSerif?'Serif':'Sans';btn.classList.toggle('active',readerUseSerif);applyReaderFont();}
function applyReaderFont(){const p=document.getElementById('readerPaper');p.style.fontSize=readerFontSize+'px';p.style.fontFamily=readerUseSerif?'"Lora",serif':'"DM Sans",sans-serif';}

/* ═══════════════════════════════════════════════════
   NOTIFICATIONS
═══════════════════════════════════════════════════ */
function renderNotifs(){
  const unread=NOTIFS.filter(n=>n.unread);
  const badge=document.getElementById('notifBadge');const dot=document.getElementById('notifDot');const list=document.getElementById('notifItems');
  if(badge){badge.textContent=unread.length;badge.style.display=unread.length?'':'none';}
  if(dot) dot.style.display=unread.length?'':'none';
  if(!list) return;
  list.innerHTML=NOTIFS.map(n=>`<div class="notif-item${n.unread?' unread':''}" onclick="markNotifRead(${n.id})"><div class="notif-item-icon">${n.icon}</div><div class="notif-item-body"><div class="notif-item-text">${n.text}</div><div class="notif-item-time">${n.time}</div></div>${n.unread?'<div class="notif-unread-pip"></div>':''}</div>`).join('');
}
function toggleNotifPanel(e){e.stopPropagation();const p=document.getElementById('notifPanel');const was=p.classList.contains('open');p.classList.toggle('open',!was);if(!was) renderNotifs();}
function markNotifRead(id){const n=NOTIFS.find(x=>x.id===id);if(n) n.unread=false;renderNotifs();}
function markAllNotifs(){NOTIFS.forEach(n=>n.unread=false);renderNotifs();showToast('✅ All notifications marked as read');}
document.addEventListener('click',e=>{const p=document.getElementById('notifPanel');const w=document.getElementById('notifBtn')?.closest('.notif-wrap');if(p&&w&&!w.contains(e.target)) p.classList.remove('open');});

/* ═══════════════════════════════════════════════════
   COVER FETCH
═══════════════════════════════════════════════════ */
async function getCover(novel,size='M'){
  const key=novel.id+'-'+size;
  if(coverCache[key]!==undefined) return coverCache[key];
  try{
    const r=await fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(novel.title)}&author=${encodeURIComponent(novel.author||'')}&limit=1&fields=cover_i`);
    const d=await r.json();
    const cid=d?.docs?.[0]?.cover_i;
    if(!cid){coverCache[key]=null;return null;}
    const url=`https://covers.openlibrary.org/b/id/${cid}-${size}.jpg`;
    return new Promise(res=>{
      const img=new Image();
      img.onload=()=>{if(img.naturalWidth<10){coverCache[key]=null;res(null);}else{coverCache[key]=url;res(url);}};
      img.onerror=()=>{coverCache[key]=null;res(null);};
      img.src=url;
    });
  }catch{coverCache[key]=null;return null;}
}
function applyImgToEl(imgEl,phEl,url,ph){
  if(url){if(imgEl) imgEl.src=url;if(imgEl) imgEl.style.display='block';if(phEl) phEl.style.display='none';}
  else{if(imgEl) imgEl.style.display='none';if(phEl){phEl.style.display='flex';phEl.innerHTML=ph||'📖';}}
}

/* ═══════════════════════════════════════════════════
   NAVIGATION
═══════════════════════════════════════════════════ */
function navigate(page){
  document.querySelectorAll('.nav-item[data-page]').forEach(btn=>btn.classList.toggle('active',btn.dataset.page===page));
  document.querySelectorAll('.page-view').forEach(v=>v.classList.remove('active'));
  const el=document.getElementById('view-'+page);
  if(el) el.classList.add('active');
  const renders={home:renderHome,authors:renderAuthors,genres:renderGenres,reading:renderReadingView,favorites:renderFavorites,schedule:renderSchedule,library:renderLibrary,reports:renderReports};
  if(renders[page]) renders[page]();
}
function setFchip(el){document.querySelectorAll('.fchip').forEach(c=>c.classList.remove('active'));el.classList.add('active');}

/* ═══════════════════════════════════════════════════
   HOME
═══════════════════════════════════════════════════ */
function renderHome(){renderPrevReading();renderPopular();renderNewBooks();renderWriters();renderSpecialBooks();}

function renderPrevReading(){
  const cont=document.getElementById('prevReadingScroll');if(!cont) return;
  const reading=novels.slice(0,7);
  const progresses=[45,80,30,65,15,90,55];
  cont.innerHTML=reading.map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
    return `<div class="book-thumb" onclick="openDetail(${n.id})" style="animation-delay:${i*0.07}s">
      <div class="book-cover" style="background:${gc.bg};">
        <img id="prev_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
        <div id="prev_ph_${n.id}" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:26px;">${n.emoji}</div>
        <div class="book-cover-reading-bar"><div class="book-cover-reading-progress" id="prev_prog_${n.id}" style="width:0%"></div></div>
      </div>
      <div class="book-thumb-title">${n.title}</div>
      <div class="book-thumb-author">${n.author}</div>
    </div>`;
  }).join('');
  reading.forEach((n,i)=>{
    setTimeout(()=>{const b=document.getElementById('prev_prog_'+n.id);if(b) b.style.width=progresses[i]+'%';},300+i*80);
    getCover(n,'M').then(url=>applyImgToEl(document.getElementById('prev_img_'+n.id),document.getElementById('prev_ph_'+n.id),url,n.emoji));
  });
}

function renderPopular(){
  const cont=document.getElementById('popularGrid');if(!cont) return;
  cont.innerHTML=novels.slice(0,8).map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
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
  novels.slice(0,8).forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('pop_img_'+n.id),document.getElementById('pop_ph_'+n.id),url,n.emoji));});
}

function renderNewBooks(){
  const cont=document.getElementById('newBooksScroll');if(!cont) return;
  const newb=novels.slice(-8);
  cont.innerHTML=newb.map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
    return `<div class="new-book-card" style="animation-delay:${i*0.07}s">
      <div onclick="openDetail(${n.id})">
        <div class="new-book-cover" style="background:${gc.bg};">
          <div class="new-book-label">NEW</div>
          <img id="new_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
          <div id="new_ph_${n.id}" class="new-book-cover-ph">${n.emoji}</div>
        </div>
        <div class="new-book-title">${n.title}</div>
        <div class="new-book-author">${n.author}</div>
      </div>
    </div>`;
  }).join('');
  newb.forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('new_img_'+n.id),document.getElementById('new_ph_'+n.id),url,n.emoji));});
}

function renderWriters(){
  const cont=document.getElementById('writersRow');if(!cont) return;
  const authors=[...new Map(novels.map(n=>[n.author,n])).values()].slice(0,10);
  const avatars=['😊','🧑‍💻','👩‍🎨','🧙‍♂️','👨‍🔬','👩‍🦰','🧔','👩‍🦳','🧕','👨‍🎤'];
  const grads=['linear-gradient(135deg,#7c3aed,#db2777)','linear-gradient(135deg,#0ea5e9,#6366f1)','linear-gradient(135deg,#f59e0b,#ef4444)','linear-gradient(135deg,#10b981,#3b82f6)','linear-gradient(135deg,#f472b6,#fb923c)','linear-gradient(135deg,#22c55e,#0ea5e9)','linear-gradient(135deg,#a78bfa,#60a5fa)','linear-gradient(135deg,#f43f5e,#f97316)','linear-gradient(135deg,#34d399,#818cf8)','linear-gradient(135deg,#fbbf24,#f472b6)'];
  cont.innerHTML=authors.map((n,i)=>{
    const cnt=novels.filter(b=>b.author===n.author).length;
    return `<div class="writer-card" style="animation-delay:${i*0.07}s" onclick="showToast('👤 ${n.author.replace(/'/g,"\\'")}')">
      <div class="writer-avatar" style="background:${grads[i%grads.length]};border-color:transparent;">${avatars[i]}</div>
      <div class="writer-name">${n.author.split(' ').slice(-1)[0]}</div>
      <div class="writer-books">${cnt} book${cnt>1?'s':''}</div>
    </div>`;
  }).join('');
}

function renderSpecialBooks(){
  const cont=document.getElementById('specialBooks');if(!cont) return;
  cont.innerHTML=novels.slice(0,5).map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
    return `<div class="special-book-card" onclick="openDetail(${n.id})" style="animation-delay:${i*0.08}s">
      <div class="spec-rank">${String(i+1).padStart(2,'0')}</div>
      <div class="spec-cover" style="background:${gc.bg};">
        <img id="spec_img_${n.id}" src="" style="display:none;width:100%;height:100%;object-fit:cover;">
        <div id="spec_ph_${n.id}" class="spec-cover-ph">${n.emoji}</div>
      </div>
      <div class="spec-info">
        <div class="spec-title">${n.title}</div>
        <div class="spec-author">${n.author}</div>
        <span class="spec-badge" style="background:${gc.badge};color:${gc.btext};">${n.genre}</span>
      </div>
    </div>`;
  }).join('');
  novels.slice(0,5).forEach(n=>{getCover(n,'S').then(url=>applyImgToEl(document.getElementById('spec_img_'+n.id),document.getElementById('spec_ph_'+n.id),url,n.emoji));});
}

/* AUTHORS */
function renderAuthors(){
  const cont=document.getElementById('authorsGrid');if(!cont) return;
  const authors=[...new Map(novels.map(n=>[n.author,n])).values()];
  const grads=['linear-gradient(135deg,#7c3aed,#db2777)','linear-gradient(135deg,#0ea5e9,#6366f1)','linear-gradient(135deg,#f59e0b,#ef4444)','linear-gradient(135deg,#10b981,#3b82f6)','linear-gradient(135deg,#f472b6,#fb923c)','linear-gradient(135deg,#22c55e,#0ea5e9)','linear-gradient(135deg,#a78bfa,#60a5fa)','linear-gradient(135deg,#f43f5e,#f97316)','linear-gradient(135deg,#34d399,#818cf8)','linear-gradient(135deg,#fbbf24,#f472b6)','linear-gradient(135deg,#818cf8,#f472b6)','linear-gradient(135deg,#fb923c,#22c55e)'];
  const avatars=['😊','🧑‍💻','👩‍🎨','🧙‍♂️','👨‍🔬','👩‍🦰','🧔','👩‍🦳','🧕','👨‍🎤','🎭','🌟'];
  cont.innerHTML=authors.map((n,i)=>{
    const cnt=novels.filter(b=>b.author===n.author).length;
    const gc=genreColors[n.genre]||genreColors.Fantasy;
    return `<div class="author-card" style="animation-delay:${i*0.06}s" onclick="showToast('📚 ${n.author.replace(/'/g,"\\'")} — ${cnt} book${cnt>1?'s':''}')">
      <div class="author-big-avatar" style="background:${grads[i%grads.length]};border-color:transparent;font-size:26px;">${avatars[i]}</div>
      <div class="author-name">${n.author}</div>
      <div class="author-genre" style="color:${gc.dot};">${n.genre}</div>
      <div class="author-stats">
        <div class="astat"><div class="astat-num">${cnt}</div><div class="astat-lbl">Books</div></div>
        <div class="astat"><div class="astat-num">⭐4.${(7+i)%10}</div><div class="astat-lbl">Rating</div></div>
      </div>
    </div>`;
  }).join('');
}

/* GENRES */
function renderGenres(){
  const cont=document.getElementById('genresGrid');if(!cont) return;
  const genres=[
    {name:'Fantasy',emoji:'🐉',bg:'linear-gradient(135deg,#064e3b,#065f46,#047857)'},
    {name:'Romance',emoji:'💕',bg:'linear-gradient(135deg,#831843,#9d174d,#be185d)'},
    {name:'Horror',emoji:'💀',bg:'linear-gradient(135deg,#7f1d1d,#991b1b,#b91c1c)'},
    {name:'Action',emoji:'⚡',bg:'linear-gradient(135deg,#1e3a5f,#1d4ed8,#2563eb)'},
    {name:'Biography',emoji:'📜',bg:'linear-gradient(135deg,#78350f,#92400e,#b45309)'},
  ];
  cont.innerHTML=genres.map((g,i)=>{
    const cnt=novels.filter(n=>n.genre===g.name).length;
    return `<div class="genre-big-card" style="background:${g.bg};animation-delay:${i*0.08}s;" onclick="filterByGenre('${g.name}',null)">
      <div><div class="genre-big-icon">${g.emoji}</div><div class="genre-big-name">${g.name}</div><div class="genre-big-count">${cnt} books</div></div>
      <div class="genre-big-bg">${g.emoji}</div>
    </div>`;
  }).join('');
}

/* READING VIEW */
function renderReadingView(){
  const cont=document.getElementById('readingList');if(!cont) return;
  const progresses=[45,80,30];
  const statuses=[{label:'Reading',c:'rgba(245,200,66,0.15)',tc:'#f5c842'},{label:'Almost Done',c:'rgba(34,197,94,0.15)',tc:'#22c55e'},{label:'Just Started',c:'rgba(96,165,250,0.15)',tc:'#60a5fa'}];
  const reading=novels.slice(2,5);
  cont.innerHTML=reading.map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;const s=statuses[i];
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
        <button onclick="currentDetailId=${n.id};startReading()" style="padding:5px 12px;background:var(--accent);color:#000;border:none;border-radius:7px;font-size:10px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;">📖 Read</button>
      </div>
    </div>`;
  }).join('');
  reading.forEach((n,i)=>{
    setTimeout(()=>{const b=document.getElementById('rp_'+n.id);if(b) b.style.width=progresses[i]+'%';},400+i*100);
    getCover(n,'M').then(url=>applyImgToEl(document.getElementById('read_img_'+n.id),document.getElementById('read_ph_'+n.id),url,n.emoji));
  });
}

/* FAVORITES */
function renderFavorites(){
  const cont=document.getElementById('favGrid');if(!cont) return;
  const favNovels=novels.filter(n=>favorites.includes(n.id));
  cont.innerHTML=favNovels.map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
    return `<div class="fav-card" style="animation-delay:${i*0.07}s">
      <div onclick="openDetail(${n.id})">
        <div class="fav-cover" style="background:${gc.bg};">
          <img id="fav_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
          <span id="fav_ph_${n.id}">${n.emoji}</span>
          <div class="fav-heart" onclick="event.stopPropagation();toggleFav(${n.id},this)">❤️</div>
        </div>
        <div class="fav-body">
          <div class="fav-title">${n.title}</div>
          <div class="fav-author">${n.author}</div>
          <button onclick="event.stopPropagation();currentDetailId=${n.id};startReading()" style="width:100%;margin-top:6px;padding:5px;background:rgba(245,200,66,0.12);border:1px solid rgba(245,200,66,0.2);border-radius:6px;color:var(--accent);font-size:10px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all 0.2s;" onmouseover="this.style.background='var(--accent)';this.style.color='#000'" onmouseout="this.style.background='rgba(245,200,66,0.12)';this.style.color='var(--accent)'">📖 Read Now</button>
        </div>
      </div>
    </div>`;
  }).join('');
  favNovels.forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('fav_img_'+n.id),document.getElementById('fav_ph_'+n.id),url,n.emoji));});
}
function toggleFav(id,el){const idx=favorites.indexOf(id);if(idx>-1){favorites.splice(idx,1);el.textContent='🤍';showToast('💔 Removed from favorites');}else{favorites.push(id);el.textContent='❤️';showToast('❤️ Added to favorites!');}renderFavorites();}

/* SCHEDULE */
function renderSchedule(){
  const cont=document.getElementById('scheduleList');if(!cont) return;
  const schedule=[
    {day:'Today — Mon',items:[{time:'7:00 AM',icon:'☀️',title:'Morning Read',sub:'Fourth Wing - Ch. 1',dur:'30 min'},{time:'12:00 PM',icon:'📖',title:'Lunch Break',sub:'The Midnight Library',dur:'20 min'},{time:'9:00 PM',icon:'🌙',title:'Night Read',sub:'Book Lovers - Ch. 1',dur:'45 min'}]},
    {day:'Tomorrow — Tue',items:[{time:'7:30 AM',icon:'🌅',title:'Morning Session',sub:'Holly - Chapter 1',dur:'30 min'},{time:'6:00 PM',icon:'🏠',title:'Evening Read',sub:'Educated - Ch. 1',dur:'60 min'}]},
    {day:'Wednesday',items:[{time:'8:00 AM',icon:'📚',title:'Deep Read',sub:'The Covenant of Water',dur:'45 min'},{time:'1:00 PM',icon:'☕',title:'Cafe Session',sub:'Intermezzo - Part 1',dur:'40 min'}]},
  ];
  cont.innerHTML=schedule.map(d=>`<div class="schedule-day"><div class="day-label">${d.day}</div>${d.items.map(item=>`<div class="schedule-item"><div class="sched-time">${item.time}</div><div class="sched-icon">${item.icon}</div><div class="sched-info"><div class="sched-title">${item.title}</div><div class="sched-sub">${item.sub}</div></div><div class="sched-dur">${item.dur}</div></div>`).join('')}</div>`).join('');
}

/* LIBRARY */
function renderLibrary(){
  const cont=document.getElementById('libraryGrid');if(!cont) return;
  cont.innerHTML=novels.map((n,i)=>{
    const gc=genreColors[n.genre]||genreColors.Fantasy;
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
            <button class="lib-action-btn lib-action-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button>
          </div>
        </div>
      </div>
    </div>`;
  }).join('');
  novels.forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('lib_img_'+n.id),document.getElementById('lib_ph_'+n.id),url,n.emoji));});
  updateStats();
}

/* REPORTS */
function renderReports(){
  const gc2=document.getElementById('genreChart');const mc=document.getElementById('monthChart');
  if(gc2){
    const genres=['Fantasy','Romance','Horror','Action','Biography'];
    const colors=['#22c55e','#f472b6','#ef4444','#60a5fa','#fb923c'];
    const counts=genres.map(g=>novels.filter(n=>n.genre===g).length);
    const mx=Math.max(...counts);
    gc2.innerHTML=genres.map((g,i)=>`<div class="bar-row"><div class="bar-label">${g}</div><div class="bar-track"><div class="bar-fill" id="gbar_${i}" style="width:0%;background:${colors[i]};"></div></div><div class="bar-val">${counts[i]}</div></div>`).join('');
    setTimeout(()=>genres.forEach((_,i)=>{const b=document.getElementById('gbar_'+i);if(b) b.style.width=(counts[i]/mx*100)+'%';}),200);
  }
  if(mc){
    const months=['Jan','Feb','Mar','Apr','May','Jun'];const vals=[2,4,3,5,3,4];const mx2=Math.max(...vals);
    mc.innerHTML=months.map((m,i)=>`<div class="bar-row"><div class="bar-label">${m} 2025</div><div class="bar-track"><div class="bar-fill" id="mbar_${i}" style="width:0%;background:linear-gradient(90deg,#818cf8,#f5c842);"></div></div><div class="bar-val">${vals[i]}</div></div>`).join('');
    setTimeout(()=>months.forEach((_,i)=>{const b=document.getElementById('mbar_'+i);if(b) b.style.width=(vals[i]/mx2*100)+'%';}),200);
  }
}

/* FILTER / SEARCH */
function filterByGenre(genre,el){
  if(el){document.querySelectorAll('.subject-card').forEach(c=>c.classList.remove('active'));el.classList.add('active');}
  navigate('library');
  setTimeout(()=>{
    const filtered=genre?novels.filter(n=>n.genre===genre):novels;
    const cont=document.getElementById('libraryGrid');if(!cont) return;
    cont.innerHTML=filtered.map((n,i)=>{
      const gc=genreColors[n.genre]||genreColors.Fantasy;
      return `<div class="pop-book-card" id="lib_card_${n.id}" style="animation-delay:${i*0.04}s">
        <div class="card-actions"><button class="ca-btn ca-edit" onclick="event.stopPropagation();openEditModal(${n.id})">✏️</button><button class="ca-btn ca-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button></div>
        <div onclick="openDetail(${n.id})">
          <div class="pop-cover" style="background:${gc.bg};">
            <img id="filt_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
            <div id="filt_ph_${n.id}" class="pop-cover-ph">${n.emoji}</div>
          </div>
          <div class="pop-body"><div class="pop-title">${n.title}</div><div class="pop-author"><span class="pop-genre-dot" style="background:${gc.dot};"></span>${n.author}</div>
          <div class="lib-item-actions"><button class="lib-action-btn lib-action-edit" onclick="event.stopPropagation();currentDetailId=${n.id};startReading()">📖 Read</button><button class="lib-action-btn lib-action-delete" onclick="event.stopPropagation();confirmDelete(${n.id})">🗑️</button></div></div>
        </div>
      </div>`;
    }).join('')||'<div style="text-align:center;padding:40px;color:var(--text3);grid-column:1/-1;">No results 📭</div>';
    filtered.forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('filt_img_'+n.id),document.getElementById('filt_ph_'+n.id),url,n.emoji));});
  },50);
}

function handleSearch(val){
  if(!val.trim()){navigate('home');return;}
  const q=val.toLowerCase();
  const found=novels.filter(n=>n.title.toLowerCase().includes(q)||n.author.toLowerCase().includes(q)||n.genre.toLowerCase().includes(q));
  navigate('library');
  setTimeout(()=>{
    const cont=document.getElementById('libraryGrid');if(!cont) return;
    cont.innerHTML=found.length?found.map((n,i)=>{
      const gc=genreColors[n.genre]||genreColors.Fantasy;
      return `<div class="pop-book-card" style="animation-delay:${i*0.04}s">
        <div onclick="openDetail(${n.id})">
          <div class="pop-cover" style="background:${gc.bg};">
            <img id="srch_img_${n.id}" src="" style="display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
            <div id="srch_ph_${n.id}" class="pop-cover-ph">${n.emoji}</div>
          </div>
          <div class="pop-body"><div class="pop-title">${n.title}</div><div class="pop-author"><span class="pop-genre-dot" style="background:${gc.dot};"></span>${n.author}</div>
          <button class="read-btn" onclick="event.stopPropagation();currentDetailId=${n.id};startReading()">📖 Read Now</button></div>
        </div>
      </div>`;
    }).join(''):'<div style="text-align:center;padding:40px;color:var(--text3);grid-column:1/-1;">No results 📭</div>';
    found.forEach(n=>{getCover(n,'M').then(url=>applyImgToEl(document.getElementById('srch_img_'+n.id),document.getElementById('srch_ph_'+n.id),url,n.emoji));});
  },50);
}

/* DETAIL MODAL */
function openDetail(id){
  const n=novels.find(x=>x.id===id);if(!n) return;
  currentDetailId=id;
  const gc=genreColors[n.genre]||genreColors.Fantasy;
  document.getElementById('modalGenre').textContent=n.genre;
  document.getElementById('modalTitle').textContent=n.title;
  document.getElementById('modalAuthor').textContent='by '+n.author;
  document.getElementById('modalDesc').textContent=n.desc;
  document.getElementById('modalCover').style.background=gc.bg;
  document.getElementById('modalCoverContent').textContent=n.emoji;
  const mci=document.getElementById('modalCoverImg');mci.style.display='none';
  getCover(n,'L').then(url=>{if(url){mci.src=url;mci.style.display='block';}});
  document.getElementById('detailModal').classList.add('open');
  document.body.style.overflow='hidden';
}
function closeDetailModal(){document.getElementById('detailModal').classList.remove('open');document.body.style.overflow='';}
function editCurrentBook(){closeDetailModal();if(currentDetailId) setTimeout(()=>openEditModal(currentDetailId),200);}
function confirmDeleteCurrent(){closeDetailModal();if(currentDetailId) setTimeout(()=>confirmDelete(currentDetailId),200);}

/* ADD/EDIT MODAL */
function openAddModal(){
  editingId=null;
  document.getElementById('addModalHeadline').textContent='Add a Novel';
  document.getElementById('addModalSub').textContent='Expand your collection';
  document.getElementById('addModalSubmitBtn').textContent='+ Add Novel';
  ['addTitle','addAuthor','addDesc'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('addGenre').value='';
  document.getElementById('addModal').classList.add('open');document.body.style.overflow='hidden';
}
function closeAddModal(){document.getElementById('addModal').classList.remove('open');document.body.style.overflow='';}
function openEditModal(id){
  const n=novels.find(x=>x.id===id);if(!n) return;
  editingId=id;
  document.getElementById('addModalHeadline').textContent='Edit Novel';
  document.getElementById('addModalSub').textContent='Update book details';
  document.getElementById('addModalSubmitBtn').textContent='💾 Save Changes';
  document.getElementById('addTitle').value=n.title;
  document.getElementById('addAuthor').value=n.author;
  document.getElementById('addDesc').value=n.desc;
  document.getElementById('addGenre').value=n.genre;
  document.getElementById('addModal').classList.add('open');document.body.style.overflow='hidden';
}
function submitNovelForm(){if(editingId) saveEdit(); else addNovel();}
function saveEdit(){
  const title=document.getElementById('addTitle').value.trim();const author=document.getElementById('addAuthor').value.trim();
  const genre=document.getElementById('addGenre').value;const desc=document.getElementById('addDesc').value.trim();
  if(!title||!genre){showToast('⚠️ Title and genre required!','error');return;}
  const idx=novels.findIndex(n=>n.id===editingId);if(idx===-1) return;
  const emoji={Fantasy:'🐉',Romance:'💕',Horror:'💀',Action:'⚡',Biography:'📜'}[genre]||'📖';
  novels[idx]={...novels[idx],title,author:author||'Unknown',genre,desc:desc||'No description.',emoji};
  ['S','M','L'].forEach(s=>{delete coverCache[editingId+'-'+s];});
  closeAddModal();showToast('✏️ Novel updated!');updateStats();updateCounts();
  const ap=document.querySelector('.nav-item.active')?.dataset?.page||'home';navigate(ap);editingId=null;
}
function addNovel(){
  const title=document.getElementById('addTitle').value.trim();const author=document.getElementById('addAuthor').value.trim();
  const genre=document.getElementById('addGenre').value;const desc=document.getElementById('addDesc').value.trim();
  if(!title||!genre){showToast('⚠️ Title and genre required!','error');return;}
  const emoji={Fantasy:'🐉',Romance:'💕',Horror:'💀',Action:'⚡',Biography:'📜'}[genre]||'📖';
  novels.push({id:Date.now(),title,author:author||'Unknown',genre,desc:desc||'No description.',emoji});
  closeAddModal();showToast('✅ Novel added!');updateStats();updateCounts();
}

/* DELETE */
function confirmDelete(id){
  const n=novels.find(x=>x.id===id);if(!n) return;
  deletingId=id;
  document.getElementById('confirmSubText').innerHTML=`Remove <strong style="color:var(--text);">"${n.title}"</strong>? This cannot be undone.`;
  document.getElementById('confirmModal').classList.add('open');document.body.style.overflow='hidden';
}
function closeConfirmModal(){document.getElementById('confirmModal').classList.remove('open');document.body.style.overflow='';deletingId=null;}
function executeDelete(){
  if(!deletingId) return;
  const id=deletingId;
  const card=document.getElementById('lib_card_'+id);
  const doDelete=()=>{novels=novels.filter(n=>n.id!==id);favorites=favorites.filter(f=>f!==id);closeConfirmModal();showToast('🗑️ Novel deleted','error');updateStats();updateCounts();const ap=document.querySelector('.nav-item.active')?.dataset?.page||'home';navigate(ap);};
  if(card){card.classList.add('removing');setTimeout(doDelete,400);}else doDelete();
}

/* UTILS */
function updateStats(){['totalBooksCount','settTotalBooks'].forEach(id=>{const el=document.getElementById(id);if(el) el.textContent=novels.length;});}
function updateCounts(){const map={Fantasy:'fcnt',Romance:'rcnt',Horror:'hcnt',Action:'acnt',Biography:'bcnt'};Object.entries(map).forEach(([g,id])=>{const el=document.getElementById(id);if(el) el.textContent=novels.filter(n=>n.genre===g).length;});}
function showToast(msg,type=''){const t=document.getElementById('toast');t.textContent=msg;t.className='toast show';if(type==='error') t.classList.add('error-toast');clearTimeout(t._timer);t._timer=setTimeout(()=>{t.className='toast';},2800);}
function initSplash(){setTimeout(()=>{const s=document.getElementById('splashScreen');s.classList.add('fade-out');setTimeout(()=>s.style.display='none',700);},2900);}

/* EVENT LISTENERS */
document.getElementById('detailModal').addEventListener('click',e=>{if(e.target===document.getElementById('detailModal')) closeDetailModal();});
document.getElementById('addModal').addEventListener('click',e=>{if(e.target===document.getElementById('addModal')) closeAddModal();});
document.getElementById('confirmModal').addEventListener('click',e=>{if(e.target===document.getElementById('confirmModal')) closeConfirmModal();});
document.addEventListener('keydown',e=>{
  if(e.key==='Escape'){closeDetailModal();closeAddModal();closeConfirmModal();document.getElementById('notifPanel').classList.remove('open');if(document.getElementById('readerOverlay').classList.contains('open')) closeReader();}
});
document.querySelectorAll('.nav-item[data-page]').forEach(btn=>btn.addEventListener('click',()=>navigate(btn.dataset.page)));
document.getElementById('addNovelBtn').addEventListener('click',openAddModal);

/* INIT */
document.addEventListener('DOMContentLoaded',()=>{
  initSplash();renderHome();updateCounts();updateStats();renderNotifs();
  document.getElementById('fontToggleBtn').classList.add('active');
  applyReaderFont();
});
</script>
</body>
</html>