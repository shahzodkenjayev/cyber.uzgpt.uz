<?php
require __DIR__ . "/../config/config.php";

$result = $conn->query("SELECT orders.id, users.name, orders.course_name, orders.order_date 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    ORDER BY orders.order_date DESC");

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
