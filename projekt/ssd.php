<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSDs</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; 
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #004d40;
            text-align: center;
            margin-bottom: 20px;
        }
        .ssd-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .ssd-item {
            background: rgba(255, 255, 255, 0.9); 
            border: 1px solid #b2dfdb;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            padding: 20px;
            width: calc(30% - 40px);
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .ssd-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .ssd-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            display: block;
            margin-bottom: 15px;
        }
        .ssd-item h2 {
            font-size: 1.5em;
            color: #00796b;
            margin: 0 0 10px;
            text-align: center;
        }
        .ssd-item p {
            font-size: 1.2em;
            color: #004d40;
            margin: 0;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #004d40;
        }

        /* Styling for "Nazad na proizvode" and "Košarica" buttons */
        .back-button, .cart-button {
            position: fixed;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 1em;
        }

        .back-button {
            background-color: #007bff; /* Blue color */
            top: 20px;
            left: 20px;
        }
        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .cart-button {
            background-color: #e53935; /* Red color */
            top: 20px;
            right: 20px;
        }
        .cart-button:hover {
            background-color: #b71c1c; /* Darker red on hover */
        }

    </style>
</head>
<body>
    <a href="proizvodi.html" class="back-button">Nazad na proizvode</a>
    <a href="cart.php" class="cart-button">Košarica</a>
    <h1>Dostupni SSD-ovi</h1>
    <div class="ssd-container">
        <?php
        session_start(); 

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
                echo "<a href='ssd.php?add_to_cart&id=" . $row["id"] . "&name=" . urlencode($row["name"]) . "&price=" . $row["price"] . "&image=" . urlencode($row["image"]) . "' class='btn'>Dodaj u košaricu</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Trenutno nema dostupnih SSD-ova.</p>";
        }

        $conn->close();
        ?>

    <?php
    if (isset($_GET['add_to_cart'])) {
        $productId = $_GET['id'];
        $productName = $_GET['name'];
        $productPrice = $_GET['price'];
        $productImage = $_GET['image'];

        $cartItem = [
            'id' => $productId,
            'name' => urldecode($productName),
            'price' => $productPrice,
            'image' => urldecode($productImage)
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = $cartItem;

        header('Location: ssd.php');
        exit();
    }
    ?>
    </div>
</body>
</html>
