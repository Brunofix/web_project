<?php
session_start();

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, price, image FROM gpus";
$result = $conn->query($sql);

$gpus = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $gpus[] = $row;
    }
}

$conn->close();

echo json_encode($gpus);
?>
