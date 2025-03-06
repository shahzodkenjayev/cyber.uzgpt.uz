<?php
require __DIR__ . "/../config/config.php";

$result = $conn->query("SELECT * FROM courses");
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Barcha Kurslar</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="header">
        <h1 style="color: white; text-align: center;">Barcha Kurslar</h1>
    </div>
    
    <div class="container">
        <h2 style="color: white;">DevOps Kurslari</h2>
        <?php
        $devops = $conn->query("SELECT * FROM courses WHERE category='devops'");
        while ($row = $devops->fetch_assoc()): ?>
            <div class="course-card">
                <h2><?= $row['title'] ?></h2>
                <p><?= $row['description'] ?></p>
                <p>Narx: $<?= $row['price'] ?></p>
                <a href="buy.php?id=<?= $row['id'] ?>" class="button">Sotib olish</a>
            </div>
        <?php endwhile; ?>

        <h2 style="color: white;">Cyber Xavfsizlik Kurslari</h2>
        <?php
        $cyber = $conn->query("SELECT * FROM courses WHERE category='cybersecurity'");
        while ($row = $cyber->fetch_assoc()): ?>
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
