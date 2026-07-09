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
<h1>Data Mata Pelajaran</h1>
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
<th>Kode Mapel</th>
<th>Nama Mata Pelajaran</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"SELECT * FROM mata_pelajaran ORDER BY id_mapel DESC");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['kode_mapel']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_mapel']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="hapus.php?id=<?= $row['id_mapel']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus mata pelajaran ini?')">

Hapus

</a>

</td>

</tr>

<?php
}
?>

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