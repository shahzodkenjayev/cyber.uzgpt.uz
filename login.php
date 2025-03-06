<?php
require __DIR__ . "/config/config.php";
session_start();
session_regenerate_id(true); // Sessiya xavfsizligini oshirish

// Agar foydalanuvchi allaqachon tizimga kirgan bo'lsa, buy.php sahifasiga yo'naltiramiz
if (isset($_SESSION['user_id'])) {
    header("Location: buy.php");
    exit();
}

// Telegram Login orqali foydalanuvchi ma'lumotlarini olish
if (isset($_GET['hash']) && isset($_GET['id']) && isset($_GET['username'])) {
    $telegram_id = intval($_GET['id']); // Faqat sonlarni olish
    $username = htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8');

    // Telegram orqali kelgan imzoni tekshirish
    $secret_key = hash_hmac('sha256', '7075696868:AAHxIeNitjqCcgsuAPTMxYRzwRNp-BCGdh0', 'WebAppData', true);
    $hash_check = hash_hmac('sha256', json_encode($_GET), $secret_key);

    if (hash_equals($hash_check, $_GET['hash'])) {
        // Foydalanuvchi mavjudligini tekshiramiz
        $stmt = $conn->prepare("SELECT * FROM users WHERE telegram_id = ?");
        $stmt->bind_param("i", $telegram_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];

            header("Location: buy.php");
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>Foydalanuvchi topilmadi!</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Xavfsizlik tekshiruvi muvaffaqiyatsiz!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Telegram orqali tizimga kirish</title>
</head>
<body>
    <h1>Telegram orqali tizimga kirish</h1>

    <!-- Telegram Login tugmasi -->
    <script async src="https://telegram.org/js/telegram-widget.js?7"
        data-telegram-login="@cyber_devops_bot"
        data-size="large"
        data-auth-url="login.php"
        data-request-access="write">
    </script>
</body>
</html>
