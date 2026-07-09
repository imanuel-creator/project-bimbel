<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_jadwal = $_POST['id_jadwal'];
$tanggal_absensi = $_POST['tanggal_absensi'];
$status = $_POST['status'];
$keterangan = mysqli_real_escape_string($koneksi,$_POST['keterangan']);

mysqli_query($koneksi,"INSERT INTO absensi_kelas
(
id_pendaftaran,
id_jadwal,
tanggal_absensi,
status,
keterangan
)

VALUES

(
'$id_pendaftaran',
'$id_jadwal',
'$tanggal_absensi',
'$status',
'$keterangan'
)");

echo "<script>

alert('Absensi berhasil ditambahkan');

window.location='index.php';

</script>";
?>