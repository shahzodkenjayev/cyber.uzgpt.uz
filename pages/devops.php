    <?php
    require __DIR__ . "/../config/config.php";

    $result = $conn->query("SELECT * FROM courses WHERE category='devops'");
    ?>
    <!DOCTYPE html>
    <html lang="uz">
    <head>
        <meta charset="UTF-8">
        <title>DevOps Kurslari</title>
        <link rel="stylesheet" href="../assets/style.css">
    </head>
    <body>
        <div class="header"><h1 style="color: white; text-align: center; ">DevOps Kurslari</h1></div>
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
