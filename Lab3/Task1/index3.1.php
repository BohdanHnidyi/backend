<?php
// Перевірка, чи існує cookie для шрифту
if (isset($_COOKIE['font_size'])) {
    $font_size = $_COOKIE['font_size'];
} else {
    $font_size = '16px';  // за замовчуванням середній шрифт
}

if (isset($_GET['font'])) {
    $font_size = $_GET['font'];
    setcookie('font_size', $font_size, time() + (3600 * 24 * 30), "/");  // зберігаємо cookie на 30 днів
    header("Location: ".$_SERVER['PHP_SELF']);  // перезавантажуємо сторінку, щоб застосувати зміни
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір шрифту</title>
</head>
<body style="font-size: <?php echo $font_size; ?>;">
    <h1>Виберіть розмір шрифту</h1>
    <a href="?font=20px">Великий шрифт</a> | 
    <a href="?font=16px">Середній шрифт</a> | 
    <a href="?font=12px">Маленький шрифт</a>
</body>
</html>
