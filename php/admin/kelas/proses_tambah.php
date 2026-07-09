<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_paket=$_POST['id_paket'];
$nama_kelas=mysqli_real_escape_string($koneksi,$_POST['nama_kelas']);
$kapasitas=$_POST['kapasitas'];
$status=$_POST['status'];

mysqli_query($koneksi,"INSERT INTO kelas
(
id_paket,
nama_kelas,
kapasitas,
status
)

VALUES

(
'$id_paket',
'$nama_kelas',
'$kapasitas',
'$status'
)");

echo "<script>

alert('Data kelas berhasil ditambahkan');

window.location='index.php';

</script>";
?>