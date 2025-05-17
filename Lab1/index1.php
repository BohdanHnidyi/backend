<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір завдання</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table-container { margin: 20px 0; }
        .cell { width: 30px; height: 30px; display: inline-block; }
        .canvas-container { position: relative; width: 100vw; height: 400px; background-color: black; overflow: hidden; }
        .square { position: absolute; background-color: red; }
    </style>
</head>
<body>

<h2>Виберіть завдання:</h2>
<form method="POST">
    <select name="task">
        <option value="2">2 - Вірш</option>
        <option value="3">3 - Конвертація 1500 грн у долари</option>
        <option value="4">4 - Визначення сезону </option>
        <option value="5">5 - Голосна чи приголосна буква</option>
        <option value="6">6 - Операції над тризначним числом</option>
        <option value="7">7 - Цикли: таблиця + квадрати</option>
    </select>
    <button type="submit">Виконати</button>
</form>

<?php
// Перевіряємо, чи була відправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    $task = $_POST["task"];
    
    // Завдання 2 - Вірш
    if ($task == "2") {
        echo "<h3>Вірш:</h3>";
        echo "<p>
            Полину в мріях в купель океану,<br>
            Відчую <b>шовковистість</b> глибини,<br>
            Чарівні мушлі з дна собі дістану,<br>
            Щоб <i>зимку</i><br>
            <u>тишіли</u><br>
            мене<br>
            вони…
        </p>";
    
    // Завдання 3 - Конвертація 1500 грн у долари
    } elseif ($task == "3") {
        $uah = 1500;
        $exchangeRate = 29.41; 
        $usd = round($uah / $exchangeRate, 2); // Конвертація та округлення
        echo "<h3>Конвертація 1500 грн у долари:</h3>";
        echo "<p>$uah грн. можна обміняти на $usd долар(ів).</p>";
    
    // Завдання 4 - Визначення сезону
    } elseif ($task == "4") {
        $month = 3; 
        // Визначення сезону за номером місяця
        $season = ($month >= 3 && $month <= 5) ? "Весна" : (($month >= 6 && $month <= 8) ? "Літо" : (($month >= 9 && $month <= 11) ? "Осінь" : "Зима"));
        echo "<h3>Визначення сезону:</h3><p>Місяць: $month</p><p>Це $season.</p>";
    
    // Завдання 5 - Голосна чи приголосна буква
    } elseif ($task == "5") {
        $char = 'о'; // Фіксована літера
        // Перевірка, чи є літера голосною
        $result = in_array($char, ['а', 'е', 'є', 'и', 'і', 'ї', 'о', 'у', 'ю', 'я']) ? "Голосна буква" : "Приголосна буква";
        echo "<h3>Перевірка букви:</h3><p>Буква: '$char'</p><p>Це $result.</p>";
    
    // Завдання 6 - Операції над тризначним числом
    } elseif ($task == "6") {
        $num = mt_rand(100, 999); // Генеруємо випадкове тризначне число
        $digits = str_split($num); // Розбиваємо число на цифри
        $sum = array_sum($digits); // Обчислення суми цифр
        $reverseNum = (int)implode(array_reverse($digits)); // Число у зворотному порядку
        rsort($digits); // Сортування цифр у порядку спадання
        $maxNum = (int)implode($digits); // Найбільше можливе число
        
        echo "<h3>Операції над числом $num:</h3>";
        echo "<p>Сума цифр: $sum</p>";
        echo "<p>Число у зворотному порядку: $reverseNum</p>";
        echo "<p>Найбільше можливе число: $maxNum</p>";
    
    // Завдання 7 - Робота з циклами
    } elseif ($task == "7") {
        echo "<h3>Таблиця:</h3>";
        echo "<div class='table-container'>";
        echo "<table border='1'>";
        for ($i = 0; $i < 5; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 5; $j++) {
                $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Випадковий колір
                echo "<td style='width:30px; height:30px; background-color:$color'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        
        echo "<h3>Випадкові квадрати:</h3>";
        echo "<div class='canvas-container'>";
        for ($i = 0; $i < 5; $i++) {
            $size = mt_rand(20, 100); // Випадковий розмір
            $x = mt_rand(0, 500);
            $y = mt_rand(0, 300);
            echo "<div class='square' style='width:${size}px; height:${size}px; left:${x}px; top:${y}px;'></div>";
        }
        echo "</div>";
    }
}
?>

</body>
</html>