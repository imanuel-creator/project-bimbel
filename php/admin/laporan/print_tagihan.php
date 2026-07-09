<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($koneksi,"
SELECT
t.*,
s.nis,
s.nama
FROM tagihan_spp t
JOIN pendaftaran_siswa p ON t.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
ORDER BY t.tanggal_tagihan DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Tagihan SPP</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

<style>

body{
font-size:14px;
}

h3{
margin-bottom:20px;
}

table{
width:100%;
}

</style>

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">

LAPORAN TAGIHAN SPP

</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Periode</th>
<th>Tanggal Tagihan</th>
<th>Jatuh Tempo</th>
<th>Jumlah Tagihan</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nis']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['periode']; ?></td>

<td><?= $row['tanggal_tagihan']; ?></td>

<td><?= $row['jatuh_tempo']; ?></td>

<td>Rp <?= number_format($row['jumlah_tagihan'],0,',','.'); ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>