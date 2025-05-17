<?php
session_start();

function checkLogged(): ?array
{
    if (!isset($_SESSION["logged"]) || !isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=lab5;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? LIMIT 1");
        $stmt->execute([$_SESSION["login"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: [];
    } catch (PDOException $e) {
        exit("Помилка БД: " . $e->getMessage());
    }
}

$accountData = checkLogged();
extract($accountData); // $id, $name, $login, $password

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=lab5;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['edit'])) {
            $newName = trim($_POST['name'] ?? '');
            $newLogin = trim($_POST['login'] ?? '');
            $newPassword = trim($_POST['password'] ?? '');

            if ($newName && $newLogin) {
                $set = "name = :name, login = :login";
                $params = [
                    ':name' => $newName,
                    ':login' => $newLogin,
                    ':id' => $id,
                ];

                if (!empty($newPassword)) {
                    $set .= ", password = :password";
                    $params[':password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                }

                $sql = "UPDATE users SET $set WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);

                $_SESSION['login'] = $newLogin;
                header("Location: userProfile.php");
                exit;
            }
        }

        if (isset($_POST['exit'])) {
            session_destroy();
            header('Location: login.php');
            exit;
        }

        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
            session_destroy();
            header('Location: login.php');
            exit;
        }
    } catch (PDOException $e) {
        exit("Помилка: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Профіль користувача</title>
</head>
<body>
<form method="POST">
    <table>
        <tr>
            <td>Привіт, <?= htmlspecialchars($name) ?>!</td>
            <td><input type="submit" value="Вийти" name="exit"></td>
        </tr>
        <tr>
            <td>Ім’я</td>
            <td>Логін</td>
            <td>Новий пароль</td>
        </tr>
        <tr>
            <td><input type="text" name="name" value="<?= htmlspecialchars($name) ?>"></td>
            <td><input type="text" name="login" value="<?= htmlspecialchars($login) ?>"></td>
            <td><input type="password" name="password" placeholder="Не змінювати"></td>
            <td><input type="submit" value="Оновити" name="edit"></td>
        </tr>
        <tr>
            <td><input style="color: red;" type="submit" value="Видалити акаунт" name="delete"></td>
        </tr>
    </table>
</form>
</body>
</html>
