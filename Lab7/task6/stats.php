
<?php
$conn = new mysqli("localhost", "root", "", "lab7");
if ($conn->connect_error) {
    die("Помилка з'єднання з базою даних");
}
$res = $conn->query("SELECT COUNT(*) as total FROM traffic_logs WHERE created_at >= NOW() - INTERVAL 1 DAY");
$total = $res->fetch_assoc()['total'] ?? 0;

$res404 = $conn->query("SELECT COUNT(*) as err FROM traffic_logs WHERE status_code=404 AND created_at >= NOW() - INTERVAL 1 DAY");
$errors = $res404->fetch_assoc()['err'] ?? 0;

echo "404 за добу: $errors з $total запитів<br>";
if ($total > 0 && ($errors / $total) > 0.1) {
    echo "⚠️ Понад 10% 404 помилок! Повідомлено адміністратора.";
}
?>
