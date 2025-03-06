<?php
require __DIR__ . "/config/config.php";
session_start();

// Telegramdan kelgan ma'lumotlarni tekshirish
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

        // Tizimga kirgandan keyin yo‘naltirish
        header("Location: buy.php"); // yoki "index.php"
        exit();
    } else {
        // Foydalanuvchini bazaga qo‘shamiz
        $stmt = $conn->prepare("INSERT INTO users (telegram_id, first_name, last_name, username) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $telegram_id, $first_name, $last_name, $username);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $username ?: $first_name;

            header("Location: buy.php"); // yoki "index.php"
            exit();
        } else {
            echo "<p style='color:red;'>Tizimga kirishda xatolik yuz berdi.</p>";
        }
    }
} else {
    echo "<p style='color:red;'>Telegram ma'lumotlari noto‘g‘ri!</p>";
}
?>
