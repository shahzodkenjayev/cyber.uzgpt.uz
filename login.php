<?php
require __DIR__ . "/config/config.php";
session_start();

$client_id = "125498252761-k7tdlsv2dmu2dlrgamrvv7qhaf5ablmr.apps.googleusercontent.com";
$redirect_uri = "https://cyber.uzgpt.uz/google_callback.php";

$google_login_url = "https://accounts.google.com/o/oauth2/auth?" . http_build_query([
    "client_id" => $client_id,
    "redirect_uri" => $redirect_uri,
    "response_type" => "code",
    "scope" => "email profile",
    "access_type" => "offline"
]);

// Telegram orqali kirish
if (isset($_GET['id']) && isset($_GET['hash'])) {
    $telegram_id = $_GET['id'];
    $first_name = $_GET['first_name'] ?? '';
    $last_name = $_GET['last_name'] ?? '';
    $username = $_GET['username'] ?? '';
    
    // Foydalanuvchini bazada tekshiramiz
    $stmt = $conn->prepare("SELECT * FROM users WHERE telegram_id = ?");
    $stmt->bind_param("s", $telegram_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Foydalanuvchi bazada bor, sessiyani yaratamiz
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'] ?? $first_name;

        header("Location: buy.php");
        exit();
    } else {
        // Foydalanuvchini bazaga qo‘shamiz
        $stmt = $conn->prepare("INSERT INTO users (telegram_id, first_name, last_name, username) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $telegram_id, $first_name, $last_name, $username);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $username ?: $first_name;

            header("Location: buy.php");
            exit();
        } else {
            echo "<p style='color:red;'>Tizimga kirishda xatolik yuz berdi.</p>";
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Tizimga kirish</title>
</head>
<body>
    <h2 style="color: white;">Tizimga kirish</h2>

    <!-- Gmail orqali kirish tugmasi -->
    <div class="center-container">
    <a href="<?= $google_login_url ?>">
        <button style="background-color: #db4437; color: white; padding: 10px; border: none; cursor: pointer;" class="login-button">
            Gmail orqali kirish
        </button>
    </a>

    <br><br>

    <!-- Telegram orqali kirish tugmasi -->
    <script async src="https://telegram.org/js/telegram-widget.js?7"
        data-telegram-login="cyber_devops_bot"
        data-size="large"
        data-auth-url="login.php"
        data-request-access="write"></script>
        </div>
</body>
</html>
