
<?php
$conn = new mysqli("localhost", "root", "", "lab6");
$res = $conn->query("SELECT id, name, email FROM users");
$users = array();
while($row = $res->fetch_assoc()) {
    $users[] = $row;
}
echo json_encode($users);
?>
