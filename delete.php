<?php
require_once __DIR__ . '/db.php';

$pdo = getDB();
$id  = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM novels WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

$qs = http_build_query([
    'deleted' => 1,
    'keyword' => $_GET['back_keyword'] ?? '',
    'genre'   => $_GET['back_genre']   ?? '',
    'p'       => $_GET['back_p']       ?? 1,
]);
header('Location: index.php?' . $qs);
exit;