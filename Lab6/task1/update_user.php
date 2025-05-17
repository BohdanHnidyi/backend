
<?php
$data = json_decode(file_get_contents("php://input"));
$conn = new mysqli("localhost", "root", "", "lab6");
$id = (int)$data->id;
$name = $conn->real_escape_string($data->name);
$email = $conn->real_escape_string($data->email);
$conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
echo "Користувача оновлено.";
?>
