<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Xatolik yuz berdi.";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Login" required><br>
    <input type="password" name="password" placeholder="Parol" required><br>
    <button type="submit">Ro‘yxatdan o‘tish</button>
</form>
