
<?php
ob_start();

$ip = $_SERVER['REMOTE_ADDR'];
$log_file = "requests.log";
$limit = 5;
$interval = 60;

$time = time();
$entries = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
$entries = array_filter($entries, function($line) use ($time, $interval) {
    $parts = explode("|", $line);
    if (count($parts) < 2) return false;
    return ($time - (int)$parts[1]) < $interval;
});

file_put_contents($log_file, implode("\n", $entries) . "\n", LOCK_EX);
$entry_count = 0;
foreach ($entries as $entry) {
    $parts = explode("|", $entry);
    if (count($parts) >= 2 && $parts[0] === $ip) $entry_count++;
}

if ($entry_count >= $limit) {
    http_response_code(429);
    echo "Забагато запитів. Спробуйте пізніше.";
} else {
    file_put_contents($log_file, "$ip|$time\n", FILE_APPEND);
    http_response_code(200);
    echo "Ви можете переглянути сторінку.";
}

ob_end_flush();
?>
