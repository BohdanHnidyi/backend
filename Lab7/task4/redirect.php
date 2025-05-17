
<?php
ob_start();
$uri = $_SERVER['REQUEST_URI'];
$redirects = json_decode(file_get_contents("redirects.json"), true);

if (isset($redirects[$uri])) {
    $target = $redirects[$uri];
    if ($target === "/404") {
        http_response_code(404);
        echo "Сторінку не знайдено.";
    } else {
        header("Location: $target", true, 301);
        exit;
    }
} else {
    echo "Поточна сторінка: $uri";
}
ob_end_flush();
?>
