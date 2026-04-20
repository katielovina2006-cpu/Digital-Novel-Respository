<?php
include 'db.php';

$result = $conn->query("SELECT * FROM novels");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Novels</title>
</head>
<body>

<h2>All Novels</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Genre</th>
    <th>Author</th>
    <th>Description</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['title']."</td>
            <td>".$row['genre']."</td>
            <td>".$row['author']."</td>
            <td>".$row['description']."</td>
          </tr>";
}
?>

</table>

</body>
</html>