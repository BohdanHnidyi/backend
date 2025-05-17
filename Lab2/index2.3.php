<?php
session_start();

// Зберігаємо мову з GET-параметра в куки
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + (60 * 60 * 24 * 180), '/'); // Кука з терміном дії півроку
}

// Читання вибраної мови з куки
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'ukr'; // За замовчуванням українська

// Переведення фраз в залежності від мови
$lang_phrases = [
    'ukr' => 'Вибрана мова: Українська',
    'eng' => 'Selected language: English',
];

// Якщо форма була відправлена, зберігаємо її значення в сесію
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['file_data'] = $_FILES['photo'];
}

// Заповнюємо значення форми з сесії
$formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : ['name' => '', 'email' => '', 'message' => ''];
$fileData = isset($_SESSION['file_data']) ? $_SESSION['file_data'] : null;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 3</title>
</head>
<body>
    <h2>Форма з вибором мови та завантаженням файлів</h2>
    
    <!-- Вибір мови -->
    <div>
        <a href="index.php?lang=ukr">
            <img src="ukr-icon.png" alt="Українська" />
        </a>
        <a href="index.php?lang=eng">
            <img src="eng-icon.png" alt="English" />
        </a>
        <p><?php echo $lang_phrases[$lang]; ?></p>
    </div>

    <!-- Форма -->
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <label for="name"><?php echo ($lang == 'ukr') ? 'Ім’я' : 'Name'; ?>:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($formData['name']); ?>"><br><br>

        <label for="email"><?php echo ($lang == 'ukr') ? 'Email' : 'Email'; ?>:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($formData['email']); ?>"><br><br>

        <label for="message"><?php echo ($lang == 'ukr') ? 'Повідомлення' : 'Message'; ?>:</label>
        <textarea name="message" id="message"><?php echo htmlspecialchars($formData['message']); ?></textarea><br><br>

        <label for="photo"><?php echo ($lang == 'ukr') ? 'Фото' : 'Photo'; ?>:</label>
        <input type="file" name="photo" id="photo"><br><br>

        <button type="submit"><?php echo ($lang == 'ukr') ? 'Відправити' : 'Submit'; ?></button>
    </form>
</body>
</html>
