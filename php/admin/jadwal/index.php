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

<h1>Data Jadwal Kelas</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="tambah.php" class="btn btn-primary">

<i class="fas fa-plus"></i>

Tambah Jadwal

</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Kelas</th>
<th>Mata Pelajaran</th>
<th>Pengajar</th>
<th>Hari</th>
<th>Jam</th>
<th>Ruangan</th>
<th>Tahun Ajaran</th>
<th>Semester</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

$query = mysqli_query($koneksi,"
SELECT * FROM v_jadwal_kelas
ORDER BY id_jadwal DESC
");

while($row = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['nama_pengajar']; ?></td>

<td><?= $row['hari']; ?></td>

<td>

<?= substr($row['jam_mulai'],0,5); ?>

-

<?= substr($row['jam_selesai'],0,5); ?>

</td>

<td><?= $row['ruangan']; ?></td>

<td><?= $row['tahun_ajaran']; ?></td>

<td><?= $row['semester']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_jadwal']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $row['id_jadwal']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus jadwal ini?')">

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