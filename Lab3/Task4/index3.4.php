<?php
// Завантаження зображення
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $target_dir = "Photo/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image = $_FILES['image'];
    $target_file = $target_dir . basename($image["name"]);
    $check = getimagesize($image["tmp_name"]);

    if ($check !== false) {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "✅ Зображення '" . htmlspecialchars($image["name"]) . "' завантажено.<br><br>";
        } else {
            echo "❌ Помилка при завантаженні.<br><br>";
        }
    } else {
        echo "❌ Файл не є зображенням.<br><br>";
    }
}
?>

<!-- Форма завантаження -->
<form method="post" enctype="multipart/form-data">
    <label>Оберіть зображення:</label><br>
    <input type="file" name="image" accept="image/*" required>
    <input type="submit" value="Завантажити">
</form>

<hr>

<!-- Галерея зображень -->
<h2>Галерея</h2>
<div style="display: flex; flex-wrap: wrap; gap: 10px;">
<?php
$images = glob("Photo/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
foreach ($images as $img) {
    echo '<div><img src="' . $img . '" style="max-width: 200px; max-height: 200px;"></div>';
}
?>
</div>
