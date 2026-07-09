<?php
session_start();
include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"
SELECT
a.*,
s.nis,
s.nama,
k.nama_kelas,
m.nama_mapel
FROM absensi_kelas a
JOIN pendaftaran_siswa p ON a.id_pendaftaran=p.id_pendaftaran
JOIN siswa s ON p.id_siswa=s.id_siswa
JOIN kelas k ON p.id_kelas=k.id_kelas
JOIN jadwal_kelas j ON a.id_jadwal=j.id_jadwal
JOIN mata_pelajaran m ON j.id_mapel=m.id_mapel
ORDER BY a.tanggal_absensi DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan Absensi</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 align="center">LAPORAN ABSENSI</h3>

<table class="table table-bordered">

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Kelas</th>
<th>Mapel</th>
<th>Tanggal</th>
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
<td><?= $row['nama_mapel']; ?></td>
<td><?= $row['tanggal_absensi']; ?></td>
<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>