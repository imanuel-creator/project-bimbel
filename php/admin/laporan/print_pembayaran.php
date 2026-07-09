<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($koneksi,"
SELECT
pb.*,
tg.periode,
s.nis,
s.nama
FROM pembayaran_spp pb
JOIN tagihan_spp tg ON pb.id_tagihan = tg.id_tagihan
JOIN pendaftaran_siswa p ON tg.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
ORDER BY pb.tanggal_bayar DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Pembayaran SPP</title>

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

LAPORAN PEMBAYARAN SPP

</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Periode</th>
<th>Tanggal Bayar</th>
<th>Jumlah Bayar</th>
<th>Metode</th>
<th>Keterangan</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($row = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nis']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['periode']; ?></td>

<td><?= $row['tanggal_bayar']; ?></td>

<td>Rp <?= number_format($row['jumlah_bayar'],0,',','.'); ?></td>

<td><?= $row['metode_pembayaran']; ?></td>

<td><?= $row['keterangan']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>