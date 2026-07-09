<?php

$host = "localhost";
$user = "root";
$pass = "noel123";
$db   = "db_bimbingan_belajar";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>