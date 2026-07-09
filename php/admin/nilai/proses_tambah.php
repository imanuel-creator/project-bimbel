<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_mapel = $_POST['id_mapel'];
$jenis_ujian = $_POST['jenis_ujian'];
$nilai = $_POST['nilai'];
$tanggal_ujian = $_POST['tanggal_ujian'];
$catatan = mysqli_real_escape_string($koneksi,$_POST['catatan']);

mysqli_query($koneksi,"INSERT INTO nilai_ulangan
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
'$tanggal_ujian',
'$catatan'
)");

echo "<script>

alert('Nilai berhasil ditambahkan');

window.location='index.php';

</script>";
?>