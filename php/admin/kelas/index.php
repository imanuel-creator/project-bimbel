<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";
include "../../template/header.php";
include "../../template/navbar.php";
include "../../template/sidebar.php";
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Data Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="tambah.php" class="btn btn-primary">
<i class="fas fa-plus"></i>
Tambah Data
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Paket Kelas</th>
<th>Nama Kelas</th>
<th>Kapasitas</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"SELECT
kelas.*,
paket_kelas.nama_paket,
program_belajar.nama_program

FROM kelas

JOIN paket_kelas
ON kelas.id_paket=paket_kelas.id_paket

JOIN program_belajar
ON paket_kelas.id_program=program_belajar.id_program

ORDER BY kelas.id_kelas DESC");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td>

<?= $row['nama_program']; ?>

<br>

<small class="text-muted">

<?= $row['nama_paket']; ?>

</small>

</td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['kapasitas']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_kelas']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $row['id_kelas']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus kelas ini?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php
include "../../template/footer.php";
?>