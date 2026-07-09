<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi,"
DELETE FROM absensi_kelas
WHERE id_absensi='$id'
");

if(!$query){
    die(mysqli_error($koneksi));
}

header("Location:index.php");
exit;