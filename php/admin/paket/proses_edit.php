<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_paket = $_POST['id_paket'];
$id_program = $_POST['id_program'];
$nama_paket = mysqli_real_escape_string($koneksi,$_POST['nama_paket']);
$harga = $_POST['harga'];
$jumlah_pertemuan = $_POST['jumlah_pertemuan'];
$status = $_POST['status'];

mysqli_query($koneksi,"UPDATE paket_kelas SET

id_program='$id_program',
nama_paket='$nama_paket',
harga='$harga',
jumlah_pertemuan='$jumlah_pertemuan',
status='$status'

WHERE id_paket='$id_paket'
");

echo "<script>

alert('Paket kelas berhasil diupdate');

window.location='index.php';

</script>";
?>