<?php
require_once 'db.php';
try {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT COUNT(*) FROM novels");
    echo "✅ Connected! Total novels in DB: " . $stmt->fetchColumn();
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>