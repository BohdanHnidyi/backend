<?php
// Підключаємо файл з функціями
include '../Function/func.php';

// Перевіряємо, чи були отримані дані через POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо значення x, y і операцію
    $x = $_POST['x'];
    $y = $_POST['y'];
    $operation = $_POST['operation'];

    // Перевірка на числові значення для x і y
    if (is_numeric($x) && is_numeric($y)) {
        // Виконуємо операції в залежності від вибору користувача
        switch ($operation) {
            case 'sin':
                $result = my_sin($x);
                break;
            case 'cos':
                $result = my_cos($x);
                break;
            case 'tg':
                $result = my_tg($x);
                break;
            case 'xy':
                $result = xy($x, $y);
                break;
            case 'factorial':
                $result = factorial($x);
                break;
            default:
                $result = "Операція не визначена.";
        }
    } else {
        $result = "Введіть правильні числові значення для x і y!";
    }
} else {
    $result = "Будь ласка, заповніть форму.";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат обчислення</title>
</head>
<body>
    <h2>Результат обчислення</h2>

    <!-- Виведення результату -->
    <p><strong>Число x:</strong> <?php echo htmlspecialchars($x); ?></p>
    <p><strong>Число y:</strong> <?php echo htmlspecialchars($y); ?></p>
    <p><strong>Операція:</strong> <?php echo htmlspecialchars($operation); ?></p>
    <p><strong>Результат:</strong> <?php echo $result; ?></p>

    <br><br>
    <a href="index.php">Повернутися на головну</a>
</body>
</html>
