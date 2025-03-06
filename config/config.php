<?php
$host = "localhost";
$dbname = "cyberdevops_db";
$username = "root";
$password = "newpassword";

// MySQL ulanish
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bazaga ulanish muvaffaqiyatsiz: " . $conn->connect_error);
}

// Sayt nomi
$site_name = "Cyber Security & DevOps  ";

// Sahifalar ro‘yxati
$pages = [
    "home" => "Bosh sahifa",
    "cyber" => "Cyber Xavfsizlik",
    "devops" => "DevOps",
    "contact" => "Aloqa",
    "courses" => "Sotib olish",
    "language" => "Til",
    "logout" => "Chiqish"
];
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site_name; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include_once "header.php"; ?> <!-- Bu yerda header.php faqat bir marta yuklanadi -->

</body>
</html>
