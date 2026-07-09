<?php
session_start();

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"
SELECT
p.*,
s.nis,
s.nama,
k.nama_kelas
FROM pendaftaran_siswa p
JOIN siswa s ON p.id_siswa=s.id_siswa
JOIN kelas k ON p.id_kelas=k.id_kelas
ORDER BY p.tanggal_daftar DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Pendaftaran</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN PENDAFTARAN SISWA</h3>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Kelas</th>
<th>Tanggal Daftar</th>
<th>Sesi</th>
<th>Status</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nis']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['tanggal_daftar']; ?></td>

<td><?= $row['sesi_tersisa']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>