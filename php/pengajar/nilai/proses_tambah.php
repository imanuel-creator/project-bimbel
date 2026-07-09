<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_mapel = $_POST['id_mapel'];
$jenis_ujian = $_POST['jenis_ujian'];
$nilai = $_POST['nilai'];
$tanggal = $_POST['tanggal_ujian'];
$catatan = $_POST['catatan'];

$query = mysqli_query($koneksi,"
INSERT INTO nilai_ulangan
(
    id_pendaftaran,
    id_mapel,
    jenis_ujian,
    nilai,
    tanggal_ujian,
    catatan
)
VALUES
(
    '$id_pendaftaran',
    '$id_mapel',
    '$jenis_ujian',
    '$nilai',
    '$tanggal',
    '$catatan'
)
");

if(!$query){
    die(mysqli_error($koneksi));
}

header("Location: index.php");
exit;
?>