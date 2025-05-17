<?php
require_once("classes/Text.php");

$Text = new Text();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <table>
            <th>Читання файлу</th>
            <tr>
                <td>Оберіть файл, який хочете вивести: </td>
                <td>
                    <select name="readFile" id="">
                        <option value="">Оберіть файл</option>
                        <option value="text1.txt" <?php if (isset($_POST['readFile']) && $_POST['readFile'] == 'text1.txt') echo 'selected'; ?>>text1</option>
                        <option value="text2.txt" <?php if (isset($_POST['readFile']) && $_POST['readFile'] == 'text2.txt') echo 'selected'; ?>>text2</option>
                        <option value="text3.txt" <?php if (isset($_POST['readFile']) && $_POST['readFile'] == 'text3.txt') echo 'selected'; ?>>text3</option>
                    </select>
                </td>
                <td>
                    <input type="submit" value="Прочитати" name="read">
                </td>
            </tr>
            <th>Запис до файлу</th>

            <tr>
                <td>Введіть текст, який бажаєте додати</td>
                <td><input type="text" name="text"></td>
            </tr>
            <tr>
                <td>Оберіть файл, в який хочете додати текст: </td>
                <td>
                    <select name="writeFile" id="">
                        <option value="">Оберіть файл</option>
                        <option value="text1.txt" <?php if (isset($_POST['writeFile']) && $_POST['writeFile'] == 'text1.txt') echo 'selected'; ?>>text1</option>
                        <option value="text2.txt" <?php if (isset($_POST['writeFile']) && $_POST['writeFile'] == 'text2.txt') echo 'selected'; ?>>text2</option>
                        <option value="text3.txt" <?php if (isset($_POST['writeFile']) && $_POST['writeFile'] == 'text3.txt') echo 'selected'; ?>>text3</option>
                    </select>
                </td>
                <td>
                    <input type="submit" value="Записати" name="write">
                </td>
            </tr>
            <th>Очищення файлу</th>
            <tr>
                <td>Оберіть файл, який хочете очистити: </td>
                <td>
                    <select name="clearFile" id="">
                        <option value="">Оберіть файл</option>
                        <option value="text1.txt" <?php if (isset($_POST['clearFile']) && $_POST['clearFile'] == 'text1.txt') echo 'selected'; ?>>text1</option>
                        <option value="text2.txt" <?php if (isset($_POST['clearFile']) && $_POST['clearFile'] == 'text2.txt') echo 'selected'; ?>>text2</option>
                        <option value="text3.txt" <?php if (isset($_POST['clearFile']) && $_POST['clearFile'] == 'text3.txt') echo 'selected'; ?>>text3</option>
                    </select>
                </td>
                <td><input type="submit" value="Очистити вміст файлу" name="clear"></td>
            </tr>
        </table>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $fileForRead = $_POST['readFile'];

        $textForm = $_POST['text'];
        $fileForWrite = $_POST['writeFile'];

        $fileForClear = $_POST['clearFile'];

        if (isset($_POST['read'])) {
            echo "<h3>$fileForRead</h3>" . $Text->readText($fileForRead);
        } else if (isset($_POST['write'])) {
            echo $Text->writeText($fileForWrite, $textForm);
        } else if (isset($_POST['clear'])) {
            echo $Text->clearText($fileForClear);
        }
    }
    ?>
</body>

</html>