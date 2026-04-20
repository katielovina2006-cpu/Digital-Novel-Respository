<?php
include 'db.php';

// Validate required fields
if (empty($_POST['title']) || empty($_POST['author'])) {
    echo "<p style='color:red;'>Error: Title and Author are required.</p>";
    echo "<a href='index.php'>Go Back</a>";
    exit;
}

// Sanitize inputs
$title       = $conn->real_escape_string(trim($_POST['title']));
$genre       = $conn->real_escape_string(trim($_POST['genre']));
$author      = $conn->real_escape_string(trim($_POST['author']));
$description = $conn->real_escape_string(trim($_POST['description']));

// Validate genre (only allow your 5 genres)
$allowed_genres = ['Fantasy', 'Romance', 'Horror', 'Action', 'Biography'];
if (!in_array($genre, $allowed_genres)) {
    echo "<p style='color:red;'>Error: Invalid genre selected.</p>";
    echo "<a href='index.php'>Go Back</a>";
    exit;
}

$sql = "INSERT INTO novels (title, genre, author, description)
        VALUES ('$title', '$genre', '$author', '$description')";

if ($conn->query($sql) === TRUE) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Added - Digital Novel Repository</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f4f6f9;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem 2.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 1rem;
        }
        h2 {
            font-size: 22px;
            margin-bottom: 0.5rem;
            color: #1a1a2e;
        }
        .details {
            background: #f4f6f9;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
            text-align: left;
            font-size: 14px;
            line-height: 1.8;
        }
        .details span {
            font-weight: 600;
            color: #444;
        }
        .badge {
            display: inline-block;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 6px;
            font-weight: 600;
        }
        .badge-Fantasy    { background:#E1F5EE; color:#0F6E56; }
        .badge-Romance    { background:#FBEAF0; color:#993556; }
        .badge-Horror     { background:#FCEBEB; color:#A32D2D; }
        .badge-Action     { background:#E6F1FB; color:#185FA5; }
        .badge-Biography  { background:#FAEEDA; color:#854F0B; }
        .btn-row {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 1.2rem;
        }
        .btn-primary {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-secondary {
            background: none;
            border: 1px solid #ccc;
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: #1a1a2e;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">✅</div>
    <h2>Novel Added!</h2>
    <p style="color:#666; font-size:14px;">The novel has been saved to the repository.</p>
    <div class="details">
        <span>Title:</span> <?= htmlspecialchars($title) ?><br>
        <span>Author:</span> <?= htmlspecialchars($author) ?><br>
        <span>Genre:</span> <span class="badge badge-<?= htmlspecialchars($genre) ?>"><?= htmlspecialchars($genre) ?></span><br>
        <?php if (!empty($description)): ?>
        <span>Description:</span> <?= htmlspecialchars($description) ?>
        <?php endif; ?>
    </div>
    <div class="btn-row">
        <a href="index.php" class="btn-primary">+ Add Another</a>
        <a href="view.php" class="btn-secondary">View All Novels</a>
    </div>
</div>
</body>
</html>

<?php
} else {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($conn->error) . "</p>";
    echo "<a href='index.php'>Go Back</a>";
}
?>