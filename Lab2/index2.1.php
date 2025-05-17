<?php
// Завдання 1.1: Заміна символів
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['text'], $_POST['find'], $_POST['replace'])) {
    $text = $_POST['text'];
    $find = $_POST['find'];
    $replace = $_POST['replace'];
    $result = str_replace($find, $replace, $text);
    echo "Результат заміни: " . $result . "<br><br>";
}

// Завдання 1.2: Перестановка міст за алфавітним порядком
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cities'])) {
    $cities = explode(' ', $_POST['cities']);
    sort($cities);
    echo "Сортовані міста: " . implode(', ', $cities) . "<br><br>";
}

// Завдання 1.3: Виділення імені файлу без розширення
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['file'])) {
    $file = $_POST['file'];
    $filename = pathinfo($file, PATHINFO_FILENAME);
    echo "Ім'я файлу без розширення: " . $filename . "<br><br>";
}

// Завдання 1.4: Кількість днів між датами
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['date1'], $_POST['date2'])) {
    $date1 = DateTime::createFromFormat('d-m-Y', $_POST['date1']);
    $date2 = DateTime::createFromFormat('d-m-Y', $_POST['date2']);
    $interval = $date1->diff($date2);
    echo "Кількість днів між датами: " . $interval->days . "<br><br>";
}

// Завдання 1.5: Генератор паролів
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['passwordLength'])) {
    $length = $_POST['passwordLength'];
    function generatePassword($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        return substr(str_shuffle($chars), 0, $length);
    }
    echo "Згенерований пароль: " . generatePassword($length) . "<br><br>";
}

// Завдання 1.6: Перевірка пароля
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkPassword'])) {
    $password = $_POST['checkPassword'];
    function checkPasswordStrength($password) {
        if (strlen($password) >= 8 && preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[\W_]/', $password)) {
            return "Пароль міцний!";
        } else {
            return "Пароль не міцний!";
        }
    }
    echo checkPasswordStrength($password) . "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 1</title>
</head>
<body>
    <h2>Завдання 1: Робота з рядками</h2>
    <form method="POST">
        <label for="text">Текст:</label>
        <input type="text" name="text" id="text"><br><br>
        <label for="find">Знайти:</label>
        <input type="text" name="find" id="find"><br><br>
        <label for="replace">Замінити:</label>
        <input type="text" name="replace" id="replace"><br><br>
        <button type="submit">Заміна</button><br><br>

        <label for="cities">Міста (через пробіл):</label>
        <input type="text" name="cities" id="cities"><br><br>
        <button type="submit">Сортувати міста</button><br><br>

        <label for="file">Файл (повний шлях):</label>
        <input type="text" name="file" id="file"><br><br>
        <button type="submit">Виділити ім'я файлу</button><br><br>

        <label for="date1">Дата 1 (День-Місяць-Рік):</label>
        <input type="text" name="date1" id="date1"><br><br>
        <label for="date2">Дата 2 (День-Місяць-Рік):</label>
        <input type="text" name="date2" id="date2"><br><br>
        <button type="submit">Порахувати дні</button><br><br>

        <label for="passwordLength">Довжина пароля:</label>
        <input type="number" name="passwordLength" id="passwordLength"><br><br>
        <button type="submit">Згенерувати пароль</button><br><br>

        <label for="checkPassword">Перевірка пароля:</label>
        <input type="text" name="checkPassword" id="checkPassword"><br><br>
        <button type="submit">Перевірити пароль</button><br><br>
    </form>
</body>
</html>
