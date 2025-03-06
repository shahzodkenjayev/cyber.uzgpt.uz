<?php
require __DIR__ . "/../config/config.php";

// Foydalanuvchilar ro‘yxatini olish
$result = $conn->query("SELECT * FROM users");

?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Foydalanuvchilar</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Foydalanuvchilar</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Ism</th>
            <th>Email</th>
            <th>Harakat</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('O‘chirishni istaysizmi?')">O‘chirish</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
