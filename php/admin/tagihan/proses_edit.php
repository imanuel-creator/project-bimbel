<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_tagihan = $_POST['id_tagihan'];
$id_pendaftaran = $_POST['id_pendaftaran'];
$periode = $_POST['periode'];
$tanggal_tagihan = $_POST['tanggal_tagihan'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$jumlah_tagihan = $_POST['jumlah_tagihan'];
$status = $_POST['status'];

mysqli_query($koneksi,"UPDATE tagihan_spp SET

id_pendaftaran='$id_pendaftaran',
periode='$periode',
tanggal_tagihan='$tanggal_tagihan',
jatuh_tempo='$jatuh_tempo',
jumlah_tagihan='$jumlah_tagihan',
status='$status'

WHERE id_tagihan='$id_tagihan'
");

echo "<script>

alert('Tagihan berhasil diupdate');

window.location='index.php';

</script>";
?>