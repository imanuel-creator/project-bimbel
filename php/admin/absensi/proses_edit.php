<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_absensi = $_POST['id_absensi'];
$id_pendaftaran = $_POST['id_pendaftaran'];
$id_jadwal = $_POST['id_jadwal'];
$tanggal_absensi = $_POST['tanggal_absensi'];
$status = $_POST['status'];
$keterangan = mysqli_real_escape_string($koneksi,$_POST['keterangan']);

mysqli_query($koneksi,"UPDATE absensi_kelas SET

id_pendaftaran='$id_pendaftaran',
id_jadwal='$id_jadwal',
tanggal_absensi='$tanggal_absensi',
status='$status',
keterangan='$keterangan'

WHERE id_absensi='$id_absensi'
");

echo "<script>

alert('Data absensi berhasil diupdate');

window.location='index.php';

</script>";
?>