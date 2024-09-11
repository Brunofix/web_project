<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webshop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Neuspjelo povezivanje na bazu podataka: " . $conn->connect_error);
    }

    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka =$_POST['lozinka'];
    $role = "user"; 

    $stmt = $conn->prepare("SELECT * FROM users WHERE k_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Korisničko ime već postoji. Pokušajte s drugim.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (k_ime, lozinka, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $korisnicko_ime, $lozinka, $role);

        if ($stmt->execute()) {
            echo "Registracija uspješna! Možete se prijaviti.";
            header("Location: login.php");
            exit();
        } else {
            echo "Greška prilikom registracije: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>
<body>

    <h1>Registracija</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="korisnicko_ime">Korisničko ime:</label>
        <input type="text" name="korisnicko_ime" required><br>

        <label for="lozinka">Lozinka:</label>
        <input type="password" name="lozinka" required><br>

        <input type="submit" value="Registriraj se">
    </form>

</body>
</html>
