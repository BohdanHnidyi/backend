<?php
session_start();

if (isset($_SESSION["logged"]) && $_SESSION["login"]) {
    header("Location: userProfile.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name && $login && $password) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=lab5;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT id FROM users WHERE login = ?");
            $stmt->execute([$login]);

            if ($stmt->rowCount() === 0) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare("INSERT INTO users (name, login, password) VALUES (?, ?, ?)");
                $insert->execute([$name, $login, $hashedPassword]);

                $_SESSION["logged"] = 1;
                $_SESSION["login"] = $login;
                header("Location: login.php");
                exit;
            } else {
                $message = "Такий логін вже існує.";
            }
        } catch (PDOException $e) {
            $message = "Помилка БД: " . $e->getMessage();
        }
    } else {
        $message = "Ви не ввели всі значення.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>
<body>
    <h2>Реєстрація</h2>
    <form method="post">
        <table>
            <tr>
                <td>Ім’я:</td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>"></td>
            </tr>
            <tr>
                <td>Логін:</td>
                <td><input type="text" name="login" value="<?= htmlspecialchars($login ?? '') ?>"></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Зареєструватися</button></td>
            </tr>
        </table>
    </form>
    <div>
        Вже є акаунт? <a href="login.php">Увійти</a>
    </div>
    <?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>
</body>
</html>
