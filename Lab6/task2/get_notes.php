
<?php
$conn = new mysqli("localhost", "root", "", "lab6");
$res = $conn->query("SELECT * FROM notes");
$notes = array();
while($row = $res->fetch_assoc()) {
    $notes[] = $row;
}
echo json_encode($notes);
?>
