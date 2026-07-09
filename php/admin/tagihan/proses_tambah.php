<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$periode = $_POST['periode'];
$tanggal_tagihan = $_POST['tanggal_tagihan'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$jumlah_tagihan = $_POST['jumlah_tagihan'];
$status = $_POST['status'];

mysqli_query($koneksi,"INSERT INTO tagihan_spp
(
id_pendaftaran,
periode,
tanggal_tagihan,
jatuh_tempo,
jumlah_tagihan,
status
)

VALUES

(
'$id_pendaftaran',
'$periode',
'$tanggal_tagihan',
'$jatuh_tempo',
'$jumlah_tagihan',
'$status'
)");

echo "<script>

alert('Tagihan berhasil ditambahkan');

window.location='index.php';

</script>";
?>