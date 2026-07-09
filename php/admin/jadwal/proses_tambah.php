<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_kelas = $_POST['id_kelas'];
$id_pengajar = $_POST['id_pengajar'];
$id_mapel = $_POST['id_mapel'];
$hari = $_POST['hari'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tahun_ajaran = mysqli_real_escape_string($koneksi,$_POST['tahun_ajaran']);
$semester = $_POST['semester'];
$ruangan = mysqli_real_escape_string($koneksi,$_POST['ruangan']);
$status = $_POST['status'];

mysqli_query($koneksi,"INSERT INTO jadwal_kelas
(
id_kelas,
id_pengajar,
id_mapel,
hari,
jam_mulai,
jam_selesai,
tahun_ajaran,
semester,
ruangan,
status
)

VALUES

(
'$id_kelas',
'$id_pengajar',
'$id_mapel',
'$hari',
'$jam_mulai',
'$jam_selesai',
'$tahun_ajaran',
'$semester',
'$ruangan',
'$status'
)");

echo "<script>

alert('Jadwal berhasil ditambahkan');

window.location='index.php';

</script>";
?>