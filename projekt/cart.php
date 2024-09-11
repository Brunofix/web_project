<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $removeId) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košarica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-item img {
            width: 100px;
        }
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #004d40;
        }
        .total-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="cart-container">
        <h1>Košarica</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
            <?php 
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $item): 
                $totalPrice += $item['price'];
            ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div>
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Cijena: <?php echo htmlspecialchars($item['price']); ?>€</p>
                    </div>
                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn">Ukloni</a>
                </div>
            <?php endforeach; ?>

            <div class="total-container">
                <div></div> <!-- Empty div to push the total price to the right -->
                <div class="total">
                    Ukupna cijena: <?php echo number_format($totalPrice, 2); ?>€
                </div>
            </div>
        <?php else: ?>
            <p>Vaša košarica je prazna.</p>
        <?php endif; ?>

        <a href="proizvodi.html" class="btn">Nastavi s kupnjom</a>
    </div>

</body>
</html>
