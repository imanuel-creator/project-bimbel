<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_nilai        = $_POST['id_nilai'];
$id_pendaftaran  = $_POST['id_pendaftaran'];
$id_mapel        = $_POST['id_mapel'];
$jenis_ujian     = $_POST['jenis_ujian'];
$nilai           = $_POST['nilai'];
$tanggal_ujian   = $_POST['tanggal_ujian'];
$catatan         = $_POST['catatan'];

$query = mysqli_query($koneksi, "
UPDATE nilai_ulangan
SET
    id_pendaftaran = '$id_pendaftaran',
    id_mapel = '$id_mapel',
    jenis_ujian = '$jenis_ujian',
    nilai = '$nilai',
    tanggal_ujian = '$tanggal_ujian',
    catatan = '$catatan'
WHERE id_nilai = '$id_nilai'
");

if (!$query) {
    die(mysqli_error($koneksi));
}

header("Location: index.php");
exit;