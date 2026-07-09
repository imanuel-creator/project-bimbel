<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"SELECT * FROM mata_pelajaran ORDER BY nama_mapel ASC");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Mata Pelajaran</title>

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

<h3 align="center">LAPORAN DATA MATA PELAJARAN</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>Kode Mapel</th>
<th>Nama Mata Pelajaran</th>
<th>Deskripsi</th>
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

<td><?= $row['kode_mapel']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['deskripsi']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</body>

</html>