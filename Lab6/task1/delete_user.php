
<?php
$data = json_decode(file_get_contents("php://input"));
$conn = new mysqli("localhost", "root", "", "lab6");
$id = (int)$data->id;
$conn->query("DELETE FROM users WHERE id=$id");
echo "Користувача видалено.";
?>
