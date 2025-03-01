<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: ../index.php");
    } else {
        echo "Noto‘g‘ri login yoki parol.";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Login" required><br>
    <input type="password" name="password" placeholder="Parol" required><br>
    <button type="submit">Kirish</button>
</form>
