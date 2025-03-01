<?php
require __DIR__ . "/config/config.php";
session_start();

// Agar foydalanuvchi tizimga kirmagan bo'lsa, login sahifasiga yo'naltiramiz
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Mahsulotni sotib olish uchun IDni olish
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);  // Faqat raqamli ID olish

    // Kursni olish
    $result = $conn->query("SELECT * FROM courses WHERE id = '$course_id'");
    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        $course_name = $course['title'];
        $course_price = $course['price'];

        // Foydalanuvchi nomini olish
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];

        // Foydalanuvchi mavjudligini tekshirish

        $user_check = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
        if ($user_check->num_rows == 0) {
            die("<p style='color:red; text-align:center;'>Foydalanuvchi mavjud emas. Iltimos, tizimga qayta kirib ko'ring.</p>");
        }

        // Telegramga xabar yuborish
        $telegram_bot_token = "7075696868:AAHxIeNitjqCcgsuAPTMxYRzwRNp-BCGdh0";
        $chat_id = "-1002413004702"; // Telegram chat ID

        $message = "Sotib olish:\n\nFoydalanuvchi: $user_name\nKurs: $course_name\nNarx: $$course_price";

        // Telegramga xabar yuborish
        $url = "https://api.telegram.org/bot$telegram_bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
        $response = file_get_contents($url);

        if ($response === FALSE) {
            echo "<p style='color:red; text-align:center;'>Telegram xabari yuborishda xatolik yuz berdi.</p>";
        }

        // Foydalanuvchi va kurs ma'lumotlarini bazaga saqlash
        $stmt = $conn->prepare("INSERT INTO orders (user_id, course_id, course_name, course_price, order_date) VALUES (?, ?, ?, ?, ?)");
        $order_date = date('Y-m-d H:i:s');
        $stmt->bind_param("iisss", $user_id, $course_id, $course_name, $course_price, $order_date);

        if ($stmt->execute()) {
            echo "<p style='color:white; text-align:center;'>Buyurtma muvaffaqiyatli qabul qilindi! Tez orada to'lov ma'lumotlari va kurs yuboriladi.</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Buyurtma qo'shishda xatolik yuz berdi.</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Bu kurs mavjud emas!</p>";
    }
}
?>
