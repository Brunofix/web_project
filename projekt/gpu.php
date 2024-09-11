<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafičke kartice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .gpu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .gpu-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: calc(25% - 40px);
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }
        .gpu-item:hover {
            transform: scale(1.05);
        }
        .gpu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            margin-bottom: 15px;
        }
        .gpu-item h2 {
            font-size: 1.4em;
            color: #333;
            margin: 0 0 10px;
        }
        .gpu-item p {
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
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        /* Back and Cart Buttons */
        .back-button, .cart-button {
            position: fixed;
            background-color: #00796b;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
        }
        .back-button {
            top: 20px;
            left: 20px;
        }
        .cart-button {
            top: 20px;
            right: 20px;
        }
        .back-button:hover, .cart-button:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>
    <a href="proizvodi.html" class="back-button">Nazad na proizvode</a>
    <a href="cart.php" class="cart-button">Košarica</a>
    <h1>Dostupne grafičke kartice</h1>
    <div class="gpu-container" id="gpu-list"></div>

    <script>
        fetch('get_gpus.php')
            .then(response => response.json())
            .then(data => {
                const gpuList = document.getElementById('gpu-list');
                data.forEach(gpu => {
                    const gpuCard = document.createElement('div');
                    gpuCard.className = 'gpu-item';
                    gpuCard.innerHTML = `
                        <img src="${gpu.image}" alt="${gpu.name}">
                        <h2>${gpu.name}</h2>
                        <p>${gpu.price} USD</p>
                        <a href="gpu.php?add_to_cart&id=${gpu.id}&name=${encodeURIComponent(gpu.name)}&price=${gpu.price}&image=${encodeURIComponent(gpu.image)}" class="btn">Dodaj u košaricu</a>
                    `;
                    gpuList.appendChild(gpuCard);
                });
            })
            .catch(error => console.error('Error:', error));
    </script>

    <?php
    session_start();

    if (isset($_GET['add_to_cart'])) {
        $productId = $_GET['id'];
        $productName = urldecode($_GET['name']);
        $productPrice = $_GET['price'];
        $productImage = urldecode($_GET['image']);

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

        header('Location: gpu.php');
        exit();
    }
    ?>
</body>
</html>
