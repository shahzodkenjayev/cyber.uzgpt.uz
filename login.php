<?php
require __DIR__ . "/config/config.php";
session_start();

// Agar foydalanuvchi allaqachon tizimga kirgan bo'lsa, buy.php sahifasiga yo'naltiring
if (isset($_SESSION['user_id'])) {
    header("Location: buy.php");
    exit();
}

// Telegram orqali tizimga kirish tugmasi bosilganini tekshirish
if (isset($_GET['telegram_id'])) {
    $telegram_id = $_GET['telegram_id'];  // Telegram IDni URL orqali olamiz

    // Foydalanuvchi Telegram IDni webhook.php-ga yuborish
    header("Location: webhook.php?telegram_id=" . $telegram_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Telegram orqali tizimga kirish</h1>
    <form action="login.php" method="get">
        <input type="text" name="telegram_id" placeholder="Telegram ID" required>
        <button type="submit">Kirish</button>
    </form>
</body>
</html>
