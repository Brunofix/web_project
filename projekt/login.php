<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Neuspješno povezivanje: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $k_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM users WHERE k_ime = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $k_ime);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();

        if ($lozinka === $users['lozinka']) {
            $_SESSION['users'] = $users['k_ime'];
            $_SESSION['role'] = $users['uloga']; 
            header("Location: pocetna_stranica.php"); 
            exit();
        } else {
            echo "Pogrešna lozinka.";
        }
    } else {
        echo "Korisnik ne postoji.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Prijava</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="k_ime">Korisničko ime:</label>
        <input type="text" name="korisnicko_ime" required><br>

        <label for="lozinka">Lozinka:</label>
        <input type="password" name="lozinka" required><br>

        <input type="submit" value="Prijavi se">
    </form>

</body>
</html>
