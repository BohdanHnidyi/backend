<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=lab5", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Помилка підключення: " . $e->getMessage();
    exit;
}

// Виведення товарів у вигляді таблиці
$res = $conn->query("SELECT * FROM tov");

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Назва</th><th>Ціна</th><th>Кількість</th><th>Примітка</th></tr>";
foreach ($res as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['price']) . " грн</td>";
    echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
    echo "<td>" . htmlspecialchars($row['note']) . "</td>";
    echo "</tr>";
}
echo "</table>";

// Форма для видалення запису
echo '<form action="delete.php" method="post" style="margin-top:20px;">
    <label>Номер запису для видалення: <input type="number" name="id_to_delete" required></label>
    <button type="submit">Вилучити запис</button>
</form>';

// Кнопка для переходу на додавання товару
echo '<a href="add_product.php"><button style="margin-top:10px;">Додати товар</button></a>';
?>
