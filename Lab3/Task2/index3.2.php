<?php
session_start();

// Перевірка, чи користувач авторизований
if (isset($_SESSION['user'])) {
    echo "Добрий день, " . $_SESSION['user'] . "!";
} else {
    // Перевірка, чи форма була надіслана
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['username'] == "Admin" && $_POST['password'] == "password") {
            $_SESSION['user'] = "Admin";  // Зберігаємо логін в сесії
            echo "Добрий день, Admin!";
        } else {
            echo "Невірний логін або пароль!";
        }
    }
}
?>

<!-- Форма авторизації -->
<?php if (!isset($_SESSION['user'])): ?>
    <form method="post">
        Логін: <input type="text" name="username" required><br>
        Пароль: <input type="password" name="password" required><br>
        <input type="submit" value="Увійти">
    </form>
<?php endif; ?>
