<?php
session_start();

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"
SELECT *
FROM v_jadwal_kelas
ORDER BY hari,jam_mulai
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Jadwal</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN JADWAL KELAS</h3>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>Kelas</th>
<th>Mapel</th>
<th>Pengajar</th>
<th>Hari</th>
<th>Jam</th>
<th>Ruangan</th>
<th>TA</th>
<th>Semester</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['nama_pengajar']; ?></td>

<td><?= $row['hari']; ?></td>

<td><?= substr($row['jam_mulai'],0,5); ?> -
<?= substr($row['jam_selesai'],0,5); ?></td>

<td><?= $row['ruangan']; ?></td>

<td><?= $row['tahun_ajaran']; ?></td>

<td><?= $row['semester']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>