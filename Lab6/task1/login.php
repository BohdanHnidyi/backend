
<?php
$data = json_decode(file_get_contents("php://input"));
$conn = new mysqli("localhost", "root", "", "lab6");
$email = $conn->real_escape_string($data->email);
$password = $data->password;

$res = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($res->num_rows == 1) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo json_encode(["status" => "success", "user_id" => $user['id']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Невірний пароль"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Користувача не знайдено"]);
}
?>
