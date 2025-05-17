<?php
session_start();

// Перевірка, чи є дані у сесії
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['file_data'] = $_FILES['photo'];
}

// Виведення переданих даних
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : null;
$fileData = isset($_SESSION['file_data']) ? $_SESSION['file_data'] : null;

echo "<h2>Дані форми:</h2>";
if ($formData) {
    echo "<p><strong>Ім’я:</strong> " . htmlspecialchars($formData['name']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($formData['email']) . "</p>";
    echo "<p><strong>Повідомлення:</strong> " . nl2br(htmlspecialchars($formData['message'])) . "</p>";
}

// Виведення фотографії
if ($fileData && $fileData['error'] == 0) {
    $uploadDir = 'uploads/';
    $fileName = $uploadDir . basename($fileData['name']);
    move_uploaded_file($fileData['tmp_name'], $fileName);
    echo "<p><strong>Фото:</strong> <img src='" . htmlspecialchars($fileName) . "' alt='Фото'></p>";
} else {
    echo "<p>Фото не було завантажено.</p>";
}

echo "<br><a href='index.php'>Повернутися на головну сторінку</a>";
?>
