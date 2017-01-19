<?php
include 'includes/szyfrowanie.php';
$iv = "20B25DBFCEBE48AC2FFC2415E7DC4E75";
$haslo = "Dominik1";
$text = "Paulinka i ja jest mna";
echo Encryption($text, $haslo, $iv);
?>