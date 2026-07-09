<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_jadwal = $_POST['id_jadwal'];
$id_kelas = $_POST['id_kelas'];
$id_pengajar = $_POST['id_pengajar'];
$id_mapel = $_POST['id_mapel'];
$hari = $_POST['hari'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tahun_ajaran = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);
$semester = $_POST['semester'];
$ruangan = mysqli_real_escape_string($koneksi, $_POST['ruangan']);
$status = $_POST['status'];

mysqli_query($koneksi,"UPDATE jadwal_kelas SET

id_kelas='$id_kelas',
id_pengajar='$id_pengajar',
id_mapel='$id_mapel',
hari='$hari',
jam_mulai='$jam_mulai',
jam_selesai='$jam_selesai',
tahun_ajaran='$tahun_ajaran',
semester='$semester',
ruangan='$ruangan',
status='$status'

WHERE id_jadwal='$id_jadwal'
");

echo "<script>
alert('Jadwal berhasil diupdate');
window.location='index.php';
</script>";
?>