<?php
require __DIR__ . "/../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM courses WHERE id=$id");
    $course = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql = "UPDATE courses SET title='$title', description='$description', price='$price', category='$category' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kurs muvaffaqiyatli yangilandi!";
    } else {
        echo "Xatolik: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Kursni tahrirlash</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="admin-header">
        <h1>Admin Panel</h1>
        <a href="courses.php">Kurslar</a> | 
        <a href="users.php">Foydalanuvchilar</a> | 
        <a href="orders.php">Buyurtmalar</a> | 
        <a href="logout.php">Chiqish</a>
    </div>
    <h1>Kursni tahrirlash</h1>
    <form method="POST">
        <label>Kurs nomi:</label>
        <input type="text" name="title" value="<?= $course['title'] ?>" required><br>
        <label>Tavsif:</label>
        <textarea name="description" required><?= $course['description'] ?></textarea><br>
        <label>Narx:</label>
        <input type="number" name="price" value="<?= $course['price'] ?>" required><br>
        <label>Toifa:</label>
        <select name="category">
            <option value="devops" <?= $course['category'] == 'devops' ? 'selected' : '' ?>>DevOps</option>
            <option value="cybersecurity" <?= $course['category'] == 'cybersecurity' ? 'selected' : '' ?>>Cybersecurity</option>
        </select><br>
        <button type="submit">Saqlash</button>
    </form>
</body>
</html>
