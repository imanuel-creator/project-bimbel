<?php
session_start();

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"
SELECT k.*,p.nama_paket
FROM kelas k
JOIN paket_kelas p
ON k.id_paket=p.id_paket
ORDER BY k.nama_kelas
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Kelas</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN KELAS</h3>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Paket</th>
<th>Nama Kelas</th>
<th>Kapasitas</th>
<th>Status</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_paket']; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['kapasitas']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>