<?php include __DIR__ . "/config/config.php"; ?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site_name; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1><?= $site_name; ?></h1>
    <nav>
        <ul>
            <?php foreach ($pages as $key => $title) : ?>
                <li><a href="index.php?page=<?= $key; ?>"><?= $title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
