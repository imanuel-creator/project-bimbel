<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$query=mysqli_query($koneksi,"SELECT * FROM program_belajar ORDER BY nama_program ASC");
?>

<!DOCTYPE html>

<html>

<head>

<title>Laporan Program Belajar</title>

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

<h3 align="center">LAPORAN PROGRAM BELAJAR</h3>

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>
<th>Nama Program</th>
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

<td><?= $row['nama_program']; ?></td>

<td><?= $row['deskripsi']; ?></td>

<td><?= $row['status']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</body>

</html>