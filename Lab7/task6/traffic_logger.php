
<?php
$conn = new mysqli("localhost", "root", "", "lab7");
$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['REQUEST_URI'];
$status = http_response_code();
$stmt = $conn->prepare("INSERT INTO traffic_logs (ip, url, status_code) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $ip, $url, $status);
$stmt->execute();
?>
