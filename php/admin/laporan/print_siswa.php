<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Laporan Data Siswa</title>

<link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">

</head>

<body onload="window.print()">

<div class="container mt-4">

<h3 class="text-center">

LAPORAN DATA SISWA

</h3>

<hr>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>JK</th>
<th>No HP</th>
<th>Email</th>
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

<td><?= $row['jenis_kelamin']; ?></td>

<td><?= $row['no_hp']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>