<?php
require __DIR__ . "/../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql = "INSERT INTO courses (title, description, price, category) VALUES ('$title', '$description', '$price', '$category')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kurs muvaffaqiyatli qo‘shildi!";
    } else {
        echo "Xatolik: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Kurs qo‘shish</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Kurs qo‘shish</h1>
    <form method="POST">
        <label>Kurs nomi:</label>
        <input type="text" name="title" required><br>
        <label>Tavsif:</label>
        <textarea name="description" required></textarea><br>
        <label>Narx:</label>
        <input type="number" name="price" required><br>
        <label>Toifa:</label>
        <select name="category">
            <option value="devops">DevOps</option>
            <option value="cybersecurity">Cybersecurity</option>
        </select><br>
        <button type="submit">Qo‘shish</button>
    </form>
</body>
</html>
