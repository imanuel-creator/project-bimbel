<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD']=="POST"){

$id_program=mysqli_real_escape_string($koneksi,$_POST['id_program']);
$nama_paket=mysqli_real_escape_string($koneksi,$_POST['nama_paket']);
$harga=mysqli_real_escape_string($koneksi,$_POST['harga']);
$jumlah_pertemuan=mysqli_real_escape_string($koneksi,$_POST['jumlah_pertemuan']);
$status=mysqli_real_escape_string($koneksi,$_POST['status']);

mysqli_query($koneksi,"INSERT INTO paket_kelas
(
id_program,
nama_paket,
harga,
jumlah_pertemuan,
status
)

VALUES

(
'$id_program',
'$nama_paket',
'$harga',
'$jumlah_pertemuan',
'$status'
)");

echo "<script>

alert('Paket kelas berhasil ditambahkan');

window.location='index.php';

</script>";

}
?>