<?php
session_start();
session_unset(); 
session_destroy(); 
header("Location: pocetna_stranica.php");
exit();
?>
