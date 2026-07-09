<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id_pendaftaran = $_POST['id_pendaftaran'];
$id_siswa = $_POST['id_siswa'];
$id_kelas = $_POST['id_kelas'];
$tanggal_daftar = $_POST['tanggal_daftar'];
$tanggal_selesai = !empty($_POST['tanggal_selesai']) ? $_POST['tanggal_selesai'] : NULL;
$sesi_tersisa = $_POST['sesi_tersisa'];
$status = $_POST['status'];
$catatan = mysqli_real_escape_string($koneksi,$_POST['catatan']);

if($tanggal_selesai == NULL){

mysqli_query($koneksi,"UPDATE pendaftaran_siswa SET

id_siswa='$id_siswa',
id_kelas='$id_kelas',
tanggal_daftar='$tanggal_daftar',
tanggal_selesai=NULL,
sesi_tersisa='$sesi_tersisa',
status='$status',
catatan='$catatan'

WHERE id_pendaftaran='$id_pendaftaran'");

}else{

mysqli_query($koneksi,"UPDATE pendaftaran_siswa SET

id_siswa='$id_siswa',
id_kelas='$id_kelas',
tanggal_daftar='$tanggal_daftar',
tanggal_selesai='$tanggal_selesai',
sesi_tersisa='$sesi_tersisa',
status='$status',
catatan='$catatan'

WHERE id_pendaftaran='$id_pendaftaran'");

}

echo "<script>

alert('Pendaftaran berhasil diupdate');

window.location='index.php';

</script>";
?>