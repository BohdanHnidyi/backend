
<?php
require_once "Response.php";
ob_start();

$response = new Response();
$response->setStatus(200);
    $response->addHeader("Content-Type: text/html; charset=UTF-8");
$response->send("<h1>Вітаємо!</h1><p>Це відповідь, сформована через PHP.</p>");
?>
