<?php
require '../config/config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Xush kelibsiz, Admin</h1>
    <ul>
        <li><a href="courses.php">Kurslar</a></li>
        <li><a href="users.php">Foydalanuvchilar</a></li>
        <li><a href="../auth/logout.php">Chiqish</a></li>
    </ul>
</body>
</html>
