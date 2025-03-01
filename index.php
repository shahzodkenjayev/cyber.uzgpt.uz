<?php include "header.php"; ?>

<main>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $file = "pages/{$page}.php";
    
    if (file_exists($file)) {
        include $file;
    } else {
        echo "<h2>404 - Sahifa topilmadi</h2>";
    }
    ?>
</main>

<?php include "footer.php"; ?>
