<?php
require __DIR__ . "/../config/config.php";

$result = $conn->query("SELECT * FROM courses WHERE category='cybersecurity'");
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Cyber Xavfsizlik Kurslari</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="header"><h1 style="color: white;">Cyber Xavfsizlik</h1></div>
    <div class="container">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="course-card">
                <h2><?= $row['title'] ?></h2>
                <p><?= $row['description'] ?></p>
                <p>Narx: $<?= $row['price'] ?></p>
                <a href="buy.php?id=<?= $row['id'] ?>" class="button">Sotib olish</a>
            </div>
        <?php endwhile; ?>
    </div>
    <script src="../assets/script.js"></script>
</body>
</html>
