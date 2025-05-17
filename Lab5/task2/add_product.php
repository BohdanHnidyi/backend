<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=lab5", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Помилка підключення: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare("INSERT INTO tov (name, price, quantity, note) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], 
            $_POST['price'], 
            $_POST['quantity'], 
            $_POST['note']
        ]);
        echo "<p style='color:green;'>Товар додано!</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Помилка додавання товару: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="post">
  <input name="name" placeholder="Назва" required><br><br>
  <input name="price" type="number" step="0.01" placeholder="Ціна" required><br><br>
  <input name="quantity" type="number" placeholder="Кількість" required><br><br>
  <input name="note" placeholder="Примітка"><br><br>
  <button type="submit">Додати</button>
</form>

<a href="index.php" style="display:block; margin-top:10px;">Назад до списку товарів</a>
