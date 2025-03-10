<?php
require __DIR__ . "/../config/config.php";

// Foydalanuvchilar ro‘yxatini olish
$result = $conn->query("SELECT * FROM users_telegram");

?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Foydalanuvchilar</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
     <!-- Admin panel sarlavhasi -->
    <div class="admin-header">
        <h1>Admin Panel</h1>
        <a href="index.php">Asosiy</a> |
        <a href="courses.php">Kurslar</a> | 
        <a href="users.php">Foydalanuvchilar</a> | 
        <a href="orders.php">Buyurtmalar</a> | 
        <a href="logout.php">Chiqish</a>
    </div>
    
    <h1>Foydalanuvchilar ro'yxati</h1>
   <table border="1">
    <tr>
        <th>ID</th>
        <th>Telegram ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Created At</th>
        <th>Harakat</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['telegram_id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('O‘chirishni istaysizmi?')">O‘chirish</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
