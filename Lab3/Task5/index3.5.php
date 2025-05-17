<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Перевірка, чи папка вже існує
    if (!file_exists($username)) {
        mkdir($username);
        mkdir("$username/video");
        mkdir("$username/music");
        mkdir("$username/photo");
        
        echo "Папка для $username створена!";
    } else {
        echo "Папка з таким ім'ям вже існує!";
    }
}
?>

<form method="post">
    Логін: <input type="text" name="username" required><br>
    Пароль: <input type="password" name="password" required><br>
    <input type="submit" value="Створити папку">
</form>
