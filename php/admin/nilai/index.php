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
<h1>Data Nilai</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="tambah.php" class="btn btn-primary">
<i class="fas fa-plus"></i>
Tambah Nilai
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Siswa</th>
<th>Mata Pelajaran</th>
<th>Jenis Ujian</th>
<th>Nilai</th>
<th>Tanggal</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"
SELECT

nilai_ulangan.*,
siswa.nama,
mata_pelajaran.nama_mapel

FROM nilai_ulangan

JOIN pendaftaran_siswa
ON nilai_ulangan.id_pendaftaran=pendaftaran_siswa.id_pendaftaran

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

JOIN mata_pelajaran
ON nilai_ulangan.id_mapel=mata_pelajaran.id_mapel

ORDER BY id_nilai DESC
");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['jenis_ujian']; ?></td>

<td><?= $row['nilai']; ?></td>

<td><?= $row['tanggal_ujian']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_nilai']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $row['id_nilai']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus nilai ini?')">

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