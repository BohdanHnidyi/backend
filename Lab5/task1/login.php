<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: userProfile.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login && $password) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=lab5;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: userProfile.php");
                exit;
            } else {
                $message = "Невірний логін або пароль!";
            }
        } catch (PDOException $e) {
            $message = "Помилка БД: " . $e->getMessage();
        }
    } else {
        $message = "Будь ласка, заповніть всі поля.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
</head>
<body>
<h2>Вхід</h2>
<form method="POST">
    <label>Логін: <input type="text" name="login" required></label><br>
    <label>Пароль: <input type="password" name="password" required></label><br>
    <button type="submit">Увійти</button>
</form>
<p>Немає акаунту? <a href="register.php">Зареєструватись</a></p>
<?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>
</body>
</html>
