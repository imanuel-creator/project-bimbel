<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit;
}

$id=$_GET['id'];

mysqli_query($koneksi,"DELETE FROM pendaftaran_siswa
WHERE id_pendaftaran='$id'");

echo "<script>

alert('Pendaftaran berhasil dihapus');

window.location='index.php';

</script>";
?>