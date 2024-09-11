<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAM Modules</title>
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
        .ram-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .ram-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: calc(25% - 40px);
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }
        .ram-item:hover {
            transform: scale(1.05);
        }
        .ram-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            margin-bottom: 15px;
        }
        .ram-item h2 {
            font-size: 1.4em;
            color: #333;
            margin: 0 0 10px;
        }
        .ram-item p {
            font-size: 1.1em;
            color: #666;
            margin: 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
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
    <h1>Dostupni RAM</h1>
    <div class="ram-container">
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

        $sql = "SELECT * FROM ram"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='ram-item'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' />";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>Cijena: $" . $row["price"] . "</p>";
                echo "<a href='ram.php?add_to_cart&id=" . $row["id"] . "&name=" . urlencode($row["name"]) . "&price=" . $row["price"] . "&image=" . urlencode($row["image"]) . "' class='btn'>Dodaj u košaricu</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Trenutno nema dostupnih RAM modula.</p>";
        }

        $conn->close();
        ?>
    </div>

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

        header('Location: ram.php');
        exit();
    }
    ?>
</body>
</html>
