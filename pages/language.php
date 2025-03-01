<?php
session_start();

$languages = ['uz', 'ru', 'en', 'tr', 'de', 'es', 'fr'];

// Tanlangan tilni o‘rnatish
if (isset($_GET['lang']) && in_array($_GET['lang'], $languages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Tanlangan tilni olish
$lang = $_SESSION['lang'] ?? 'uz';

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title>Tilni tanlash</title>
</head>
<body>
    <h2>Tilni tanlang</h2>
    <form method="get">
        <select name="lang" onchange="this.form.submit()">
            <?php foreach ($languages as $code): ?>
                <option value="<?= $code ?>" <?= ($code == $lang) ? 'selected' : '' ?>>
                    <?= strtoupper($code) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</body>
</html>
