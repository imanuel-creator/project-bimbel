<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi,"DELETE FROM paket_kelas WHERE id_paket='$id'");

echo "<script>

alert('Paket kelas berhasil dihapus');

window.location='index.php';

</script>";
?>