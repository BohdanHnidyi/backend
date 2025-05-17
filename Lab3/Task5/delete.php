<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Перевірка, чи існує папка
    if (file_exists($username)) {
        // Видалення папки та її вмісту
        array_map('unlink', glob("$username/*"));
        rmdir($username);
        echo "Папка для $username була видалена!";
    } else {
        echo "Папка не знайдена!";
    }
}
?>

<form method="post">
    Логін: <input type="text" name="username" required><br>
    Пароль: <input type="password" name="password" required><br>
    <input type="submit" value="Видалити папку">
</form>
