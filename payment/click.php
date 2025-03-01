<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO payments (user_id, amount, method) VALUES (?, ?, 'Click')");
    $stmt->bind_param("id", $user_id, $amount);

    if ($stmt->execute()) {
        echo "To‘lov muvaffaqiyatli!";
    } else {
        echo "Xatolik yuz berdi!";
    }
}
?>

<form method="post">
    <input type="number" name="amount" placeholder="To‘lov summasi" required><br>
    <button type="submit">Click orqali to‘lash</button>
</form>
