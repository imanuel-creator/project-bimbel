<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pembayaran = $_POST['id_pembayaran'];
$id_tagihan = $_POST['id_tagihan'];
$tanggal_bayar = $_POST['tanggal_bayar'];
$jumlah_bayar = $_POST['jumlah_bayar'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$keterangan = mysqli_real_escape_string($koneksi,$_POST['keterangan']);

mysqli_query($koneksi,"UPDATE pembayaran_spp SET

id_tagihan='$id_tagihan',
tanggal_bayar='$tanggal_bayar',
jumlah_bayar='$jumlah_bayar',
metode_pembayaran='$metode_pembayaran',
keterangan='$keterangan'

WHERE id_pembayaran='$id_pembayaran'
");

mysqli_query($koneksi,"UPDATE tagihan_spp
SET status='Lunas'
WHERE id_tagihan='$id_tagihan'");

echo "<script>

alert('Pembayaran berhasil diupdate');

window.location='index.php';

</script>";
?>