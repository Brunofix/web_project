<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cpus ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='product'>";
    echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' />";
    echo "<h3>" . $row["name"] . "</h3>";
    echo "<p>Cijena: $" . $row["price"] . "</p>";
    echo "<a href='cpu.php' class='btn'>Pogledaj više</a>";
    echo "</div>";
} else {
    echo "<p>Trenutno nemamo procesora</p>";
}
$conn->close();
?>
