<?php
require __DIR__ . "/../config/config.php";

// Ma'lumotlarni olish
$query = "
    SELECT 
        orders.id, 
        users_telegram.user_name, 
        courses.title AS course_name, 
        orders.order_date 
    FROM orders 
    JOIN users_telegram ON orders.user_id = users_telegram.telegram_id 
    JOIN courses ON orders.course_id = courses.id 
    ORDER BY orders.order_date DESC
";

$result = $conn->query($query);

// Xatolik tekshirish
if (!$result) {
    die("So‘rovda xatolik: " . $conn->error);
}
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
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= htmlspecialchars($row['course_name']) ?></td>
                <td><?= htmlspecialchars($row['order_date']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
