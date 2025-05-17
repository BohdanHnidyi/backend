
<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->id)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ID відсутній"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "lab6");
$id = (int)$data->id;
$conn->query("DELETE FROM notes WHERE id=$id");

echo json_encode(["status" => "success", "message" => "Замітку видалено."]);
?>
