<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require __DIR__ . '/config/config.php'; // Ma'lumotlar bazasi ulanishi

$client_id = getenv('GOOGLE_CLIENT_ID');
$client_secret = getenv('GOOGLE_CLIENT_SECRET');

$redirect_uri = "https://cyber.uzgpt.uz/google_callback.php";

// Google'dan kodni olish
if (isset($_GET['code'])) {
    $token_url = "https://oauth2.googleapis.com/token";
    $data = [
        "code" => $_GET['code'],
        "client_id" => $client_id,
        "client_secret" => $client_secret,
        "redirect_uri" => $redirect_uri,
        "grant_type" => "authorization_code"
    ];

    // Token olish uchun so‘rov yuborish
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);
    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Foydalanuvchi ma'lumotlarini olish
        $user_info_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=$access_token";
        $user_info = json_decode(file_get_contents($user_info_url), true);

        if (!empty($user_info['email'])) {
            $email = $user_info['email'];
            $name = $user_info['name'];
            $google_id = $user_info['id'];


            echo "<pre>";
print_r($user_info);
echo "</pre>";
exit();


            // Foydalanuvchini bazada qidiramiz (Google ID yoki email orqali)
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR google_id = ?");
            $stmt->bind_param("ss", $email, $google_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Foydalanuvchi mavjud bo‘lsa, sessiya ochamiz
                $user = $result->fetch_assoc();
                
                // Agar foydalanuvchining Google ID'si yo‘q bo‘lsa, uni yangilaymiz
                if (empty($user['google_id'])) {
                    $update_stmt = $conn->prepare("UPDATE users SET google_id = ? WHERE id = ?");
                    $update_stmt->bind_param("si", $google_id, $user['id']);
                    $update_stmt->execute();
                }

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
            } else {
                // Yangi foydalanuvchini bazaga qo‘shamiz
                $stmt = $conn->prepare("INSERT INTO users (name, email, google_id) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $google_id);
                $stmt->execute();

                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_name'] = $name;
            }

            // Kirish muvaffaqiyatli bo‘lsa, asosiy sahifaga yo‘naltirish
            header("Location: buy.php");
            exit();
        }
    }
}

// Agar xatolik bo‘lsa, asosiy sahifaga qaytarish
header("Location: index.php");
exit();
?>
