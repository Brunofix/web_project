<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $poruka = $_POST['poruka'];

    if (empty($ime) || empty($email) || empty($poruka)) {
        echo "Sva polja osim telefona su obavezna.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Neispravna e-mail adresa.";
    } else {
        $sadrzaj_poruke = "Ime: $ime\nEmail: $email\nTelefon: $telefon\nPoruka: $poruka\n------------------\n";
        
        $file = fopen("poruka.txt", "a"); 
        if ($file) {
            fwrite($file, $sadrzaj_poruke); 
            fclose($file); 
            echo "Poruka uspješno pohranjena!";
        } else {
            echo "Došlo je do greške prilikom pohranjivanja poruke.";
        }
    }
}
?>
