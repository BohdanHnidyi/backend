
<?php
ob_start();

function shutdownHandler() {
    $error = error_get_last();
    if ($error && $error['type'] === E_ERROR) {
        ob_clean();
        http_response_code(500);
        echo "<h1>500 Internal Server Error</h1><p>Ми працюємо над вирішенням проблеми.</p>";
    }
}

register_shutdown_function('shutdownHandler');

// Фатальна помилка для тесту
undefined_function();

ob_end_flush();
?>
