<?php
session_start();
require __DIR__ . "/../config/config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM courses");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    $conn->query("DELETE FROM courses WHERE id = $delete_id");
    header("Location: courses.php");
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Kurslar</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Kurslarni boshqarish</h1>
        <a href="index.php">Bosh sahifa</a> | 
        <a href="logout.php">Chiqish</a>
    </div>

    <div class="container">
        <h2>Kurslar ro‘yxati</h2>
        <a href="add_course.php" class="button">+ Yangi kurs qo‘shish</a>
        <table border="1">
            <tr>
                <th>Nomi</th>
                <th>Tavsif</th>
                <th>Narx</th>
                <th>Amallar</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row["title"] ?></td>
                <td><?= $row["description"] ?></td>
                <td>$<?= $row["price"] ?></td>
                <td>
                    <a href="edit_course.php?id=<?= $row["id"] ?>">Tahrirlash</a>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $row["id"] ?>">
                        <button type="submit" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">O‘chirish</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
