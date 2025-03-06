<?php
require __DIR__ . "/../config/config.php";

$result = $conn->query("SELECT orders.id, users.name, courses.title, orders.created_at 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    JOIN courses ON orders.course_id = courses.id
    ORDER BY orders.created_at DESC");
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Buyurtmalar</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Buyurtmalar</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Foydalanuvchi</th>
            <th>Kurs</th>
            <th>Sanasi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
