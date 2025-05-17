
<?php
$data = json_decode(file_get_contents("php://input"));
$conn = new mysqli("localhost", "root", "", "lab6");
$email = $conn->real_escape_string($data->email);
$check = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    echo "Користувач з таким email вже існує.";
    exit;
}
$name = $conn->real_escape_string($data->name);
$password = password_hash($data->password, PASSWORD_BCRYPT);
$conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
echo "Користувача зареєстровано!";
?>
