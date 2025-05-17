<?php
// Завдання 2.1: Виведення повторюваних елементів масиву
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['array'])) {
    $array = explode(',', $_POST['array']);
    $duplicates = array();
    $counts = array_count_values($array);
    foreach ($counts as $value => $count) {
        if ($count > 1) {
            $duplicates[] = $value;
        }
    }
    echo "Повторювані елементи масиву: " . implode(', ', $duplicates) . "<br><br>";
}

// Завдання 2.2: Генератор імен
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['syllables'])) {
    $syllables = explode(',', $_POST['syllables']);
    function generateName($syllables) {
        return $syllables[array_rand($syllables)] . $syllables[array_rand($syllables)];
    }
    echo "Згенероване ім'я: " . generateName($syllables) . "<br><br>";
}

// Завдання 2.3: Створення масивів з випадковими значеннями
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createArray'])) {
    function createArray() {
        $length = rand(3, 7);
        $array = [];
        for ($i = 0; $i < $length; $i++) {
            $array[] = rand(10, 20);
        }
        return $array;
    }

    $array1 = createArray();
    $array2 = createArray();

    echo "Масив 1: " . implode(', ', $array1) . "<br>";
    echo "Масив 2: " . implode(', ', $array2) . "<br><br>";
}

// Завдання 2.4: Об'єднання та обробка масивів
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mergeArrays'])) {
    function mergeAndProcessArrays($array1, $array2) {
        $merged = array_merge($array1, $array2);
        $unique = array_unique($merged);
        sort($unique);
        return $unique;
    }

    $mergedArray = mergeAndProcessArrays($array1, $array2);
    echo "Об'єднаний та відсортований масив: " . implode(', ', $mergedArray) . "<br><br>";
}

// Завдання 2.5: Сортування асоціативного масиву
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usersSort'])) {
    // Асоціативний масив
    $users = [
        'John' => 25,
        'Jane' => 22,
        'Alex' => 30,
        'Michael' => 28,
        'Emma' => 23
    ];

    // Функція для сортування масиву
    function sortArray($array, $by) {
        if ($by == 'name') {
            // Сортуємо масив за іменем (ключами)
            ksort($array);
        } elseif ($by == 'age') {
            // Сортуємо масив за віком (значеннями)
            asort($array);
        }
        return $array;
    }

    // Вибір параметра сортування (ім'я або вік)
    $sortedArray = sortArray($users, $_POST['usersSort']);
    
    echo "<h3>Сортування за " . ($_POST['usersSort'] == 'name' ? 'іменем' : 'віком') . ":</h3>";
    echo "<pre>";
    print_r($sortedArray);
    echo "</pre><br><br>";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 2</title>
</head>
<body>
    <h2>Завдання 2: Робота з масивами</h2>
    <form method="POST">
        <label for="array">Масив (через кому):</label>
        <input type="text" name="array" id="array"><br><br>
        <button type="submit">Вивести повторювані елементи</button><br><br>

        <label for="syllables">Складови (через кому):</label>
        <input type="text" name="syllables" id="syllables"><br><br>
        <button type="submit">Згенерувати ім'я</button><br><br>

        <button type="submit" name="createArray">Створити масиви</button><br><br>
        <button type="submit" name="mergeArrays">Об'єднати масиви</button><br><br>

        <label for="usersSort">Сортувати масив за: (name або age)</label>
        <input type="text" name="usersSort" id="usersSort"><br><br>
        <button type="submit">Сортувати масив</button><br><br>
    </form>
</body>
</html>
