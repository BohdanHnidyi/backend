<?php
// Підключаємо файл з функціями
include '../Function/func.php';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Математичні операції</title>
</head>
<body>
    <h2>Вибір математичних операцій</h2>

    <form method="POST" action="calculate.php">
        <label for="x">Введіть x:</label>
        <input type="text" name="x" id="x" required>
        <br><br>
        
        <label for="y">Введіть y (для операцій x^y, факторіалу):</label>
        <input type="text" name="y" id="y" required>
        <br><br>

        <label for="operation">Виберіть операцію:</label>
        <select name="operation" id="operation" required>
            <option value="sin">sin(x)</option>
            <option value="cos">cos(x)</option>
            <option value="tg">tg(x)</option>
            <option value="xy">x^y</option>
            <option value="factorial">x!</option>
        </select>
        <br><br>

        <input type="submit" value="Обчислити">
    </form>
</body>
</html>
