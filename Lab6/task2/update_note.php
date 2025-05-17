
<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->id) || !isset($data->title) || !isset($data->content)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Неправильні або порожні дані"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "lab6");
$id = (int)$data->id;
$title = $conn->real_escape_string($data->title ?? '');
$content = $conn->real_escape_string($data->content ?? '');

if (trim($title) === '' || trim($content) === '') {
    echo json_encode(["status" => "error", "message" => "Поля не можуть бути порожніми"]);
    exit;
}

$conn->query("UPDATE notes SET title='$title', content='$content' WHERE id=$id");
echo json_encode(["status" => "success", "message" => "Замітку оновлено."]);
?>
