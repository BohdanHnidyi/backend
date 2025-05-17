<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO employees (name, position, salary) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['position'], $_POST['salary']]);
    header('Location: employees.php');
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: employees.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $stmt = $pdo->prepare("UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?");
    $stmt->execute([$_POST['name'], $_POST['position'], $_POST['salary'], $_POST['id']]);
    header('Location: employees.php');
    exit;
}

$editEmployee = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editEmployee = $stmt->fetch(PDO::FETCH_ASSOC);
}

$employees = $pdo->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);

$avgSalary = $pdo->query("SELECT AVG(salary) AS avg_salary FROM employees")->fetch(PDO::FETCH_ASSOC)['avg_salary'];
if (is_null($avgSalary)) {
    $avgSalary = 0;
}

$positionCounts = $pdo->query("SELECT position, COUNT(*) AS count FROM employees GROUP BY position")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Працівники компанії</title>
</head>
<body>

<h2>Список працівників</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Ім'я</th><th>Посада</th><th>Зарплата</th><th>Дії</th>
    </tr>
    <?php foreach ($employees as $emp): ?>
    <tr>
        <td><?= htmlspecialchars($emp['id']) ?></td>
        <td><?= htmlspecialchars($emp['name']) ?></td>
        <td><?= htmlspecialchars($emp['position']) ?></td>
        <td><?= number_format($emp['salary'], 2) ?> грн</td>
        <td>
            <a href="?edit=<?= $emp['id'] ?>">Редагувати</a> | 
            <a href="?delete=<?= $emp['id'] ?>" onclick="return confirm('Видалити працівника?')">Видалити</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<hr>

<?php if ($editEmployee): ?>
<h3>Редагування працівника ID <?= $editEmployee['id'] ?></h3>
<form method="post">
    <input type="hidden" name="id" value="<?= $editEmployee['id'] ?>">
    <label>Ім'я: <input name="name" value="<?= htmlspecialchars($editEmployee['name']) ?>" required></label><br><br>
    <label>Посада: <input name="position" value="<?= htmlspecialchars($editEmployee['position']) ?>" required></label><br><br>
    <label>Зарплата: <input name="salary" type="number" step="0.01" value="<?= htmlspecialchars($editEmployee['salary']) ?>" required></label><br><br>
    <button type="submit" name="edit">Зберегти</button>
    <a href="employees.php">Скасувати</a>
</form>

<?php else: ?>
<h3>Додати нового працівника</h3>
<form method="post">
    <label>Ім'я: <input name="name" required></label><br><br>
    <label>Посада: <input name="position" required></label><br><br>
    <label>Зарплата: <input name="salary" type="number" step="0.01" required></label><br><br>
    <button type="submit" name="add">Додати</button>
</form>
<?php endif; ?>

<hr>

<h3>Статистика</h3>
<p>Середня заробітна плата: <?= number_format($avgSalary, 2) ?> грн</p>
<p>Кількість працівників за посадами:</p>
<ul>
<?php foreach ($positionCounts as $pos): ?>
    <li><?= htmlspecialchars($pos['position']) ?>: <?= $pos['count'] ?></li>
<?php endforeach; ?>
</ul>

</body>
</html>
