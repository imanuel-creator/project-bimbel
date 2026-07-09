<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_nilai = $_POST['id_nilai'];
$id_pendaftaran = $_POST['id_pendaftaran'];
$id_mapel = $_POST['id_mapel'];
$jenis_ujian = $_POST['jenis_ujian'];
$nilai = $_POST['nilai'];
$tanggal_ujian = $_POST['tanggal_ujian'];
$catatan = mysqli_real_escape_string($koneksi,$_POST['catatan']);

mysqli_query($koneksi,"UPDATE nilai_ulangan SET

id_pendaftaran='$id_pendaftaran',
id_mapel='$id_mapel',
jenis_ujian='$jenis_ujian',
nilai='$nilai',
tanggal_ujian='$tanggal_ujian',
catatan='$catatan'

WHERE id_nilai='$id_nilai'
");

echo "<script>

alert('Nilai berhasil diupdate');

window.location='index.php';

</script>";
?>