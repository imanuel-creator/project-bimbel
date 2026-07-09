<?php
session_start();

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"
SELECT p.*,pb.nama_program
FROM paket_kelas p
JOIN program_belajar pb
ON p.id_program=pb.id_program
ORDER BY pb.nama_program,p.nama_paket
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Paket</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN PAKET KELAS</h3>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Program</th>
<th>Paket</th>
<th>Harga</th>
<th>Pertemuan</th>
<th>Status</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_program']; ?></td>

<td><?= $row['nama_paket']; ?></td>

<td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>

<td><?= $row['jumlah_pertemuan']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>