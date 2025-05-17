<?php
session_start();

$dsn = "mysql:host=localhost;dbname=lab5;charset=utf8";
$dbUser = "root";
$dbPass = "";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    exit("Помилка з'єднання з БД: " . $ex->getMessage());
}

$message = "";

function getPostValue($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : '';
}

// Реєстрація
if (isset($_POST['register'])) {
    $username = getPostValue('login');
    $password = getPostValue('password');

    if ($username && $password) {
        $query = $pdo->prepare("SELECT id FROM users WHERE login = ?");
        $query->execute([$username]);

        if ($query->fetch()) {
            $message = "Такий користувач вже існує.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)")->execute([$username, $passwordHash]);
            $message = "Успішна реєстрація.";
        }
    } else {
        $message = "Будь ласка, заповніть усі поля.";
    }
}

// Авторизація
if (isset($_POST['login_btn'])) {
    $username = getPostValue('login');
    $password = getPostValue('password');

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
    } else {
        $message = "Невірні дані для входу.";
    }
}

// Вихід
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Видалення акаунта
if (isset($_POST['delete'])) {
    $userId = $_SESSION['user']['id'];
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$userId]);
    session_destroy();
    header("Location: index.php");
    exit;
}

// Оновлення даних
if (isset($_POST['update'])) {
    $userId = $_SESSION['user']['id'];
    $newLogin = getPostValue('login');
    $newPassword = getPostValue('password');
    $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

    $pdo->prepare("UPDATE users SET login = ?, password = ? WHERE id = ?")
        ->execute([$newLogin, $newHash, $userId]);

    $_SESSION['user']['login'] = $newLogin;
    $message = "Дані успішно оновлено.";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Користувацька система</title>
</head>
<body>
<h2>Лабораторна робота №5</h2>

<?php if (isset($_SESSION['user'])): ?>
    <p>Привіт, <strong><?= htmlspecialchars($_SESSION['user']['login']) ?></strong>!</p>
    <form method="post">
        <label>Новий логін: <input type="text" name="login" required></label><br>
        <label>Новий пароль: <input type="password" name="password" required></label><br>
        <button type="submit" name="update">Оновити</button>
    </form>
    <form method="post">
        <button type="submit" name="delete">Видалити акаунт</button>
    </form>
    <p><a href="?logout">Вийти</a></p>
<?php else: ?>
    <h3>Вхід</h3>
    <form method="post">
        <label>Логін: <input type="text" name="login" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <button type="submit" name="login_btn">Увійти</button>
    </form>

    <h3>Реєстрація</h3>
    <form method="post">
        <label>Логін: <input type="text" name="login" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <button type="submit" name="register">Зареєструватися</button>
    </form>
<?php endif; ?>

<?php if (!empty($message)) echo "<p style='color: red;'>$message</p>"; ?>
</body>
</html>
