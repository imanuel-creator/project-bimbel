<?php

$host     = getenv('MYSQLHOST')     ?: 'hayabusa.proxy.rlwy.net';
$port     = getenv('MYSQLPORT')     ?: '52613';
$dbname   = getenv('MYSQLDATABASE') ?: 'railway';
$user     = getenv('MYSQLUSER')     ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: 'wOTAmDbogLcRJRHGTfcnDmHwJStLNUat';

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>
