<?php
require __DIR__ . "/config/config.php";

// Sessiyani boshlash
session_start();

// Agar foydalanuvchi allaqachon tizimga kirgan bo'lsa, buy.php sahifasiga yo'naltiring
if (isset($_SESSION['user_id'])) {
    header("Location: buy.php");
    exit();
}

// Telegram bot tokeni
$telegram_bot_token = '7075696868:AAHxIeNitjqCcgsuAPTMxYRzwRNp-BCGdh0';
$telegram_api_url = "https://api.telegram.org/bot$telegram_bot_token/getUpdates";

// API so'rovini yuborish
$response = file_get_contents($telegram_api_url);
$updates = json_decode($response, true);

// Foydalanuvchi telegramdan ma'lumotlarni olish
if (isset($updates['result'])) {
    foreach ($updates['result'] as $update) {
        // Foydalanuvchi telegram IDsi va ma'lumotlarini olish
        $telegram_id = $update['message']['chat']['id'];
        $username = $update['message']['chat']['username'] ?? ''; // Username mavjud bo'lsa
        $first_name = $update['message']['chat']['first_name'] ?? ''; // Foydalanuvchi ismi
        $last_name = $update['message']['chat']['last_name'] ?? '';  // Foydalanuvchi familiyasi
        $created_at = date('Y-m-d H:i:s'); // Yaratilgan vaqt

        // Foydalanuvchini bazaga saqlash
        $stmt = $conn->prepare("INSERT INTO users_telegram (telegram_id, username, first_name, last_name, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $telegram_id, $username, $first_name, $last_name, $created_at);
        $stmt->execute();  // Foydalanuvchini bazaga qo'shish

        // Foydalanuvchi muvaffaqiyatli qo'shilganini tekshirish
        if ($stmt->affected_rows > 0) {
            // Agar foydalanuvchi muvaffaqiyatli qo'shilgan bo'lsa, sessiya boshlaymiz
            $_SESSION['user_id'] = $conn->insert_id;  // Yangi foydalanuvchi ID sini saqlaymiz
            $_SESSION['user_name'] = $username;  // Foydalanuvchi nomini saqlaymiz

            // Foydalanuvchi tizimga kirganligini bildiramiz va buy.php sahifasiga yo'naltiramiz
            header("Location: buy.php");
            exit();
        } else {
            // Agar foydalanuvchi bazaga qo'shilmasa, xato xabari
            echo "<p style='color:red; text-align:center;'>Siz Telegramda tizimga kirishingiz kerak.</p>";
        }

        // Telegram guruhga xabar yuborish
        $chat_id = "-1002413004702"; // Guruh chat ID sini o'zgartiring
        $message = "Yangi foydalanuvchi tizimga kirdi:\n\n";
        $message .= "Telegram ID: $telegram_id\n";
        $message .= "Username: $username\n";
        $message .= "Ismi: $first_name\n";
        $message .= "Familiyasi: $last_name\n";
        $message .= "Yaratilgan sana: $created_at";

        // Xabar yuborish
        $url = "https://api.telegram.org/bot$telegram_bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
        file_get_contents($url);
    }
}
?>
