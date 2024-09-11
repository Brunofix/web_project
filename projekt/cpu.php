<?php
session_start();

if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['id'];
    $productName = $_GET['name'];
    $productPrice = $_GET['price'];
    $productImage = $_GET['image'];

    $cartItem = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $cartItem;

    header('Location: cpu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPUs</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .cpu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .cpu-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: calc(25% - 40px);
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }
        .cpu-item:hover {
            transform: scale(1.05);
        }
        .cpu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            margin-bottom: 15px;
        }
        .cpu-item h2 {
            font-size: 1.4em;
            color: #333;
            margin: 0 0 10px;
        }
        .cpu-item p {
            font-size: 1.1em;
            color: #666;
            margin: 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #004d40;
        }
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
        }
        .back-button:hover {
            background-color: #004d40;
        }

        .cart-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ff5722;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
        }
        .cart-button:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <a href="proizvodi.html" class="back-button">Nazad na proizvode</a>
    <a href="cart.php" class="cart-button">Košarica</a>
    <h1>Trenutno dostupni procesori</h1>
    <div class="cpu-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webshop"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cpus";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='cpu-item'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' />";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>Cijena: $" . $row["price"] . "</p>";
                echo "<a href='cpu.php?add_to_cart&id=" . $row["id"] . "&name=" . urlencode($row["name"]) . "&price=" . $row["price"] . "&image=" . urlencode($row["image"]) . "' class='btn'>Dodaj u košaricu</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Trenutno nema dostupnih procesora.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
