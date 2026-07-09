<?php
session_start();

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"SELECT * FROM pengajar ORDER BY nama ASC");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Pengajar</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN DATA PENGAJAR</h3>

<hr>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Kode</th>
<th>Nama</th>
<th>JK</th>
<th>No HP</th>
<th>Email</th>
<th>Status</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>
<td><?= $row['kode_pengajar']; ?></td>
<td><?= $row['nama']; ?></td>
<td><?= $row['jenis_kelamin']; ?></td>
<td><?= $row['no_hp']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>