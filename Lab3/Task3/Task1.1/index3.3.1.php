<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    
    // Запис у файл
    $file = fopen('comments.txt', 'a');
    fwrite($file, "$name||$comment\n");
    fclose($file);
}

// Зчитування і виведення коментарів
echo "<table border='1'><tr><th>Ім'я</th><th>Коментар</th></tr>";
$file = fopen('comments.txt', 'r');
while (($line = fgets($file)) !== false) {
    $parts = explode('||', trim($line));
    if (count($parts) == 2) {
        $name = htmlspecialchars($parts[0]);
        $comment = htmlspecialchars($parts[1]);
        echo "<tr><td>$name</td><td>$comment</td></tr>";
    }
}
fclose($file);
?>

<form method="post">
    Ім'я: <input type="text" name="name" required><br>
    Коментар: <textarea name="comment" required></textarea><br>
    <input type="submit" value="Додати коментар">
</form>
