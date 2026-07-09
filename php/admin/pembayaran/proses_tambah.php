<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_tagihan = $_POST['id_tagihan'];
$tanggal_bayar = $_POST['tanggal_bayar'];
$jumlah_bayar = $_POST['jumlah_bayar'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$keterangan = mysqli_real_escape_string($koneksi,$_POST['keterangan']);

mysqli_begin_transaction($koneksi);

try{

mysqli_query($koneksi,"INSERT INTO pembayaran_spp
(
id_tagihan,
tanggal_bayar,
jumlah_bayar,
metode_pembayaran,
keterangan
)

VALUES

(
'$id_tagihan',
'$tanggal_bayar',
'$jumlah_bayar',
'$metode_pembayaran',
'$keterangan'
)");

mysqli_query($koneksi,"UPDATE tagihan_spp
SET status='Lunas'
WHERE id_tagihan='$id_tagihan'");

mysqli_commit($koneksi);

echo "<script>
alert('Pembayaran berhasil ditambahkan');
window.location='index.php';
</script>";

}catch(Exception $e){

mysqli_rollback($koneksi);

echo "<script>
alert('Gagal menyimpan pembayaran');
history.back();
</script>";

}
?>