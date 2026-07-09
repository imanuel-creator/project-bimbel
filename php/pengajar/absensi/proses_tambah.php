<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_jadwal = $_POST['id_jadwal'];
$tanggal = $_POST['tanggal_absensi'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];

$query = mysqli_query($koneksi, "
INSERT INTO absensi_kelas
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
'$tanggal',
'$status',
'$keterangan'
)
");

if (!$query) {
    die(mysqli_error($koneksi));
}

header("Location:index.php");
exit;