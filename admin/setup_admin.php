<?php
require __DIR__ . "/../config/config.php";

// Yangi admin yaratish
$hash = password_hash("Amina2021.", PASSWORD_DEFAULT);
$sql = "INSERT INTO admins (username, password) VALUES ('root', '$hash')";

if ($conn->query($sql) === TRUE) {
    echo "Admin muvaffaqiyatli qo‘shildi!";
} else {
    echo "Xatolik: " . $conn->error;
}
?>
