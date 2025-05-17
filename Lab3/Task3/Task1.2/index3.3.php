<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);
    
    // Безопасное сохранение (используем || как разделитель)
    $entry = $name . '||' . $comment . "\n";
    file_put_contents('comments.txt', $entry, FILE_APPEND);
}

// Виведення таблиці коментарів
echo "<table border='1'><tr><th>Ім'я</th><th>Коментар</th></tr>";
$file = fopen('comments.txt', 'r');
while (($line = fgets($file)) !== false) {
    $parts = explode('||', trim($line));
    if (count($parts) === 2) {
        $name = htmlspecialchars($parts[0]);
        $comment = htmlspecialchars($parts[1]);
        echo "<tr><td>$name</td><td>$comment</td></tr>";
    }
}
fclose($file);
?>

<form method="post">
    <label>Ім'я:</label><br>
    <input type="text" name="name" required><br>
    <label>Коментар:</label><br>
    <textarea name="comment" required></textarea><br>
    <input type="submit" value="Додати коментар">
</form>
