<?php

$filePath = './files/file.txt';

function readFileContents($filePath)
{
    if (!file_exists($filePath)) {
        echo "<p style='color: red;'>Файл не знайдено!</p>";
        return [];
    }

    $contents = file_get_contents($filePath);
    return explode(" ", trim($contents));
}

function outputFile($filePath)
{
    $contents = readFileContents($filePath);

    if (empty($contents)) {
        return;
    }

    echo "<div><h3>" . basename($filePath) . "</h3>";
    foreach ($contents as $word) {
        echo htmlspecialchars($word) . "<br>";
    }
    echo "</div>";
}
function sortAlphabetAscending($filePath)
{
    $contents = readFileContents($filePath);
    sort($contents);
    file_put_contents($filePath, implode(' ', $contents));
}

function sortAlphabetDescending($filePath)
{
    $contents = readFileContents($filePath);
    rsort($contents);
    file_put_contents($filePath, implode(' ', $contents));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["sortAlphabetAscending"])) {
        sortAlphabetAscending($filePath);
    }
    if (isset($_POST["sortAlphabetDescending"])) {
        sortAlphabetDescending($filePath);
    }
}

?>

<form action="" method="POST">
    <table>
        <tr>
            <td><input type="submit" value="Сортувати файл за алфавітом (по зростанню)" name="sortAlphabetAscending"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Сортувати файл за алфавітом (по спаданню)" name="sortAlphabetDescending"></td>
        </tr>
    </table>
</form>

<?php outputFile($filePath); ?>