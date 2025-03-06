<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Admin Panel</h1>
        <a href="courses.php">Kurslar</a> | 
        <a href="users.php">Foydalanuvchilar</a> | 
        <a href="orders.php">Buyurtmalar</a> | 
        <a href="logout.php">Chiqish</a>
    </div>

    <div class="container">
        <h2>Xush kelibsiz, <?= $_SESSION["admin_name"]; ?>!</h2>
        <p>Admin panelga hush kelibsiz. Bu yerda kurslarni boshqarishingiz mumkin.</p>
    </div>
</body>
</html>
