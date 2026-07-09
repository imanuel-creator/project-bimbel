<?php
session_start();

include "../../config/koneksi.php";

$id=$_POST['id_kelas'];
$id_paket=$_POST['id_paket'];
$nama=mysqli_real_escape_string($koneksi,$_POST['nama_kelas']);
$kapasitas=$_POST['kapasitas'];
$status=$_POST['status'];

mysqli_query($koneksi,"UPDATE kelas SET

id_paket='$id_paket',
nama_kelas='$nama',
kapasitas='$kapasitas',
status='$status'

WHERE id_kelas='$id'
");

echo "<script>

alert('Data berhasil diupdate');

window.location='index.php';

</script>";
?>