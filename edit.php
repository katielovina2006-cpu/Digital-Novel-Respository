<?php
require_once __DIR__ . '/db.php';

$allowed_genres = ['Fantasy','Romance','Horror','Action','Biography'];
$pdo = getDB();

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare('SELECT id, title, author, genre, description FROM novels WHERE id = :id');
$stmt->execute([':id' => $id]);
$novel = $stmt->fetch();
if (!$novel) { header('Location: index.php'); exit; }

$back_keyword = $_GET['back_keyword'] ?? '';
$back_genre   = $_GET['back_genre']   ?? '';
$back_p       = $_GET['back_p']       ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title  = trim($_POST['title']  ?? '');
    $author = trim($_POST['author'] ?? '');
    $genre  = trim($_POST['genre']  ?? 'Fantasy');
    $desc   = trim($_POST['desc']   ?? '');
    if (!in_array($genre, $allowed_genres)) $genre = 'Fantasy';

    if ($title !== '') {
        $upd = $pdo->prepare('UPDATE novels SET title=:title, author=:author, genre=:genre, description=:desc WHERE id=:id');
        $upd->execute([':title'=>$title, ':author'=>$author, ':genre'=>$genre, ':desc'=>$desc, ':id'=>$id]);
    }

    $qs = http_build_query(['updated'=>1, 'keyword'=>$_POST['back_keyword']??'', 'genre'=>$_POST['back_genre']??'', 'p'=>$_POST['back_p']??1]);
    header('Location: index.php?' . $qs);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Novel</title>
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'Georgia',serif; background:#0d0a1a; color:#e8e0d0; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:40px 20px; }
        .orb { position:fixed; border-radius:50%; filter:blur(80px); animation:orbPulse ease-in-out infinite alternate; }
        .orb1 { width:400px; height:400px; background:rgba(120,60,180,0.15); top:-100px; left:-100px; animation-duration:8s; }
        .orb2 { width:300px; height:300px; background:rgba(180,100,40,0.12); bottom:10%; right:-50px; animation-duration:11s; }
        @keyframes orbPulse { 0%{transform:scale(1)} 100%{transform:scale(1.3)} }
        .card { position:relative; z-index:1; width:100%; max-width:560px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,220,150,0.12); border-radius:16px; backdrop-filter:blur(12px); padding:36px; }
        h2 { font-size:22px; color:#f5d78e; margin-bottom:24px; display:flex; align-items:center; gap:10px; }
        h2::after { content:''; flex:1; height:1px; background:linear-gradient(to right,rgba(245,215,142,0.3),transparent); }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .field { display:flex; flex-direction:column; gap:6px; }
        .field.full { grid-column:1/-1; }
        .field label { font-size:12px; color:rgba(245,215,142,0.7); letter-spacing:0.5px; text-transform:uppercase; font-family:Arial,sans-serif; }
        .field input, .field select, .field textarea { background:rgba(255,255,255,0.06); border:1px solid rgba(255,220,150,0.2); border-radius:8px; padding:10px 14px; font-size:14px; color:#e8e0d0; font-family:Arial,sans-serif; outline:none; transition:border-color 0.3s; }
        .field input:focus, .field select:focus, .field textarea:focus { border-color:rgba(245,215,142,0.6); background:rgba(255,255,255,0.09); }
        .field select option { background:#1a1230; color:#e8e0d0; }
        .field textarea { min-height:100px; resize:vertical; }
        .btn-row { display:flex; gap:12px; margin-top:8px; }
        .btn-save { background:linear-gradient(135deg,#c97b2a,#e8a84c); color:#0d0a1a; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; font-family:Arial,sans-serif; transition:transform 0.2s; }
        .btn-save:hover { transform:translateY(-2px); }
        .btn-cancel { padding:11px 20px; border:1px solid rgba(255,220,150,0.25); border-radius:8px; font-size:14px; color:rgba(245,215,142,0.8); background:transparent; text-decoration:none; font-family:Arial,sans-serif; }
        .btn-cancel:hover { background:rgba(255,220,150,0.08); }
    </style>
</head>
<body>
<div class="orb orb1"></div><div class="orb orb2"></div>
<div class="card">
    <h2>✏ Edit Novel</h2>
    <form action="edit.php?id=<?= $id ?>" method="POST">
        <input type="hidden" name="back_keyword" value="<?= htmlspecialchars($back_keyword) ?>">
        <input type="hidden" name="back_genre"   value="<?= htmlspecialchars($back_genre) ?>">
        <input type="hidden" name="back_p"       value="<?= htmlspecialchars($back_p) ?>">
        <div class="form-grid">
            <div class="field">
                <label>Title *</label>
                <input type="text" name="title" value="<?= htmlspecialchars($novel['title']) ?>" required>
            </div>
            <div class="field">
                <label>Author</label>
                <input type="text" name="author" value="<?= htmlspecialchars($novel['author']) ?>">
            </div>
            <div class="field">
                <label>Genre</label>
                <select name="genre">
                    <?php foreach ($allowed_genres as $g): ?>
                        <option value="<?= $g ?>" <?= ($novel['genre']===$g)?'selected':'' ?>><?= $g ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field full">
                <label>Description</label>
                <textarea name="desc"><?= htmlspecialchars($novel['description']) ?></textarea>
            </div>
        </div>
        <div class="btn-row">
            <button type="submit" class="btn-save">💾 Save Changes</button>
            <a href="index.php?<?= http_build_query(['keyword'=>$back_keyword,'genre'=>$back_genre,'p'=>$back_p]) ?>" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>