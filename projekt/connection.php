<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Neuspjelo povezivanje na bazu podataka: " . $conn->connect_error);
}

echo "Uspješno spojeni na bazu podataka.";

$conn->close();
?>