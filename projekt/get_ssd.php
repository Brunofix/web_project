<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ssd";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='ssd-item'>";
        echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' />";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p>Cijena: $" . $row["price"] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Trenutno nemamo ssd-ova.</p>";
}
$conn->close();
?>
