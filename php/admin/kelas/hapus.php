<?php
session_start();

include "../../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($koneksi,"DELETE FROM kelas WHERE id_kelas='$id'");

echo "<script>

alert('Data berhasil dihapus');

window.location='index.php';

</script>";
?>