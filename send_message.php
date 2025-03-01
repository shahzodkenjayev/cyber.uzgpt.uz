<?php
// Konfiguratsiya faylini chaqirish
include __DIR__ . "/config/config.php";

// Bazaga ulanish
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bazaga ulanish muvaffaqiyatsiz: " . $conn->connect_error);
}

// POST orqali kelgan ma'lumotlarni olish
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']); // Email yoki telefon
    $message = $conn->real_escape_string($_POST['message']);

    // Email yoki telefon raqami tekshiriladi
    if (!empty($name) && !empty($contact) && !empty($message)) {
        
        // Agar foydalanuvchi **email** kiritgan bo‘lsa
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {

            $stmt = $conn->prepare("INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $name, $contact, $message);

            if ($stmt->execute()) {
                echo "<p style='color:white; text-align:center;'>Xabaringiz yuborildi!</p>";

            // Ma'lumotlarni bazaga yozish
            // $sql = "INSERT INTO messages (name, email, message, created_at) VALUES ('$name', '$contact', '$message', NOW())";
            
            // if ($conn->query($sql) === TRUE) {
            //     echo "<p style='color:white; text-align:center;'>Xabaringiz yuborildi!</p>";

                // Email yuborish
                $to = $contact;
                $subject = "Sizning xabaringiz qabul qilindi";
                $email_message = "Hurmatli $name,\n\nSizning xabaringiz qabul qilindi:\n\n$message\n\nRahmat!";
                $headers = "From: sh@uzgpt.uz"; // O'zgartiring

                mail($to, $subject, $email_message, $headers);
            } else {
                echo "<p style='color:red; text-align:center;'>Xatolik: " . $conn->error . "</p>";
            }
        } 
        // Agar foydalanuvchi **telefon raqami** kiritgan bo‘lsa
        elseif (preg_match('/^\+998\d{9}$/', $contact)        ) {
            $chat_id = "-1002413004702"; // Guruh chat ID
            $token = "7075696868:AAHxIeNitjqCcgsuAPTMxYRzwRNp-BCGdh0"; // Bot tokeni

            $telegram_message = "📌 Yangi xabar!\n👤 Ism: $name\n📞 Telefon: $contact\n✉️ Xabar: $message";

            $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($telegram_message);

            file_get_contents($url);

            echo "<p style='color:white; text-align:center;'>Xabaringiz mutahassislarimizga yuborildi!</p>";
        } 
        else {
            echo "<p style='color:red; text-align:center;'>Noto‘g‘ri email yoki telefon raqam!</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Iltimos, barcha maydonlarni to‘ldiring!</p>";
    }
}

// Ulanishni yopish
$conn->close();
?>
