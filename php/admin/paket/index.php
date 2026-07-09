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
<h1>Data Paket Kelas</h1>
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
<th>Program</th>
<th>Nama Paket</th>
<th>Harga</th>
<th>Pertemuan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"SELECT paket_kelas.*, program_belajar.nama_program
FROM paket_kelas
JOIN program_belajar
ON paket_kelas.id_program=program_belajar.id_program
ORDER BY paket_kelas.id_paket DESC");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_program']; ?></td>

<td><?= $row['nama_paket']; ?></td>

<td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>

<td><?= $row['jumlah_pertemuan']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_paket']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $row['id_paket']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus paket kelas ini?')">

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