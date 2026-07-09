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

/* Cari id_tagihan terlebih dahulu */
$data=mysqli_query($koneksi,"
SELECT id_tagihan
FROM pembayaran_spp
WHERE id_pembayaran='$id'
");

$row=mysqli_fetch_assoc($data);

$id_tagihan=$row['id_tagihan'];

/* Hapus pembayaran */
mysqli_query($koneksi,"
DELETE FROM pembayaran_spp
WHERE id_pembayaran='$id'
");

/* Kembalikan status tagihan */
mysqli_query($koneksi,"
UPDATE tagihan_spp
SET status='Belum Lunas'
WHERE id_tagihan='$id_tagihan'
");

echo "<script>

alert('Pembayaran berhasil dihapus');

window.location='index.php';

</script>";
?>