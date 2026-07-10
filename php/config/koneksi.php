<?php

<?php
$host     = getenv('MYSQLHOST')     ?: 'localhost';
$port     = getenv('MYSQLPORT')     ?: '3306';
$dbname   = getenv('MYSQLDATABASE') ?: 'db_bimbingan_belajar';
$user     = getenv('MYSQLUSER')     ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: 'noel123';

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>
