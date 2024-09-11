<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Komponente Webshop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <header class="header">
        <div class="logo">
            <img src="images/25-257501_the-computer-store-logo-for-computer-store-hd.png" alt="logo" width="150" height="100">
        </div>
        <h1>Prodaja računalnih komponenti</h1>
    </header>

    <nav class="navbar">
        <a class="active" href="pocetna_stranica.php"><i class="fa fa-fw fa-home"></i> WEBSHOP</a>
        <a href="kontakt.html"><i class="fa fa-fw fa-envelope"></i> Kontakt</a>

        <?php if (isset($_SESSION['users'])): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="http://localhost/phpmyadmin" target="_blank">
                <?php else: ?>
                <a href="#"><i class="fa fa-fw fa-user"></i> <?php echo htmlspecialchars($_SESSION['users']); ?></a>
            <?php endif; ?>
            <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> Odjava</a>
        <?php else: ?>
            <a href="login.php"><i class="fa fa-fw fa-user"></i> Prijava</a>
            <a href="register.php"><i class="fa fa-fw fa-user-plus"></i> Registracija</a>
        <?php endif; ?>

        <a href="cart.php"><i class="fa fa-fw fa-shopping-cart"></i> Košarica</a>
    </nav>

    <main class="main-content">
        <section class="intro">
            <h2>Dobrodošli u najbolju trgovinu računalnih komponenti!</h2>
            <p>Pronađite sve potrebne komponente za svoje računalo po najpovoljnijim cijenama.</p>
            <a href="proizvodi.html" class="btn">Pogledaj proizvode</a>
        </section>

        <section class="featured-products">
            <h2>Izdvojeni proizvodi</h2>
            <div class="product">
                <img src="images/komponenta1.jpg" alt="Komponenta 1">
                <h3>Napajanje SEASONIC SSR-650GB3</h3>
                <p>Cijena: 58,99€</p>
            </div>
            <div class="product">
                <img src="images/komponenta2.jpg" alt="Komponenta 2">
                <h3>Monitor LG UltraGear 27GR93U</h3>
                <p>Cijena: 548,99€</p>
                <p> UHD (4K) 3840x2160px, 144Hz</p>
            </div>

            <?php include 'get_featured_cpu.php'; ?>
            <?php include 'get_featured_ram.php'; ?>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 PC Komponente. Sva prava pridržana.</p>
    </footer>

</body>
</html>
