

<?php
ob_start();

header("Content-Type: text/html; charset=UTF-8");

$status = 200;
$content = "<h1>Це контент сторінки</h1>";

$cache_file = "cache.html";
if (isset($_GET['status']) && $_GET['status'] == 404) {
    $status = 404;
    $content = "<h1>Сторінку не знайдено</h1>";
    if (file_exists($cache_file)) unlink($cache_file);
    http_response_code(404);
} elseif (file_exists($cache_file)) {
    echo file_get_contents($cache_file);
    exit;
} else {
    http_response_code(200);
    echo $content;
    file_put_contents($cache_file, ob_get_contents());
}
ob_end_flush();
?>
