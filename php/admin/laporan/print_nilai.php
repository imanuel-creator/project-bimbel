<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($koneksi,"
SELECT
n.*,
s.nis,
s.nama,
m.nama_mapel
FROM nilai_ulangan n
JOIN pendaftaran_siswa p ON n.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN mata_pelajaran m ON n.id_mapel = m.id_mapel
ORDER BY n.tanggal_ujian DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Nilai</title>

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

LAPORAN NILAI SISWA

</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Mata Pelajaran</th>
<th>Jenis Ujian</th>
<th>Nilai</th>
<th>Tanggal Ujian</th>

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

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['jenis_ujian']; ?></td>

<td><?= $row['nilai']; ?></td>

<td><?= $row['tanggal_ujian']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>