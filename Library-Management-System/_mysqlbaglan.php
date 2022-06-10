<?php
$server = 'localhost:3306';
$user = 'root';
$password = '';
$database = 'kutuphane';
$baglanti = mysqli_connect($server,$user,$password,$database);

if (!$baglanti) {
    echo "MySQL sunucu ile baglanti kurulamadi!!! </br> ";
    echo "HATA: " . mysqli_connect_error();
    exit;
}
?>