
<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->title) || !isset($data->content) || !isset($data->user_id)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Неправильні або порожні вхідні дані"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "lab6");
$title = $conn->real_escape_string($data->title ?? '');
$content = $conn->real_escape_string($data->content ?? '');
$user_id = (int)$data->user_id;

if (trim($title) === '' || trim($content) === '') {
    echo json_encode(["status" => "error", "message" => "Заголовок і текст замітки обов'язкові."]);
    exit;
}

$conn->query("INSERT INTO notes (user_id, title, content) VALUES ($user_id, '$title', '$content')");
echo json_encode(["status" => "success", "message" => "Замітка додана!"]);
?>
