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
<h1>Tagihan SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="tambah.php" class="btn btn-primary">
<i class="fas fa-plus"></i>
Tambah Tagihan
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Siswa</th>
<th>Kelas</th>
<th>Periode</th>
<th>Jumlah</th>
<th>Jatuh Tempo</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"
SELECT
tagihan_spp.*,
siswa.nama,
kelas.nama_kelas

FROM tagihan_spp

JOIN pendaftaran_siswa
ON tagihan_spp.id_pendaftaran=pendaftaran_siswa.id_pendaftaran

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

JOIN kelas
ON pendaftaran_siswa.id_kelas=kelas.id_kelas

ORDER BY id_tagihan DESC
");

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['periode']; ?></td>

<td>Rp <?= number_format($row['jumlah_tagihan'],0,',','.'); ?></td>

<td><?= $row['jatuh_tempo']; ?></td>

<td><?= $row['status']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_tagihan']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="hapus.php?id=<?= $row['id_tagihan']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus tagihan ini?')">
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

<?php include "../../template/footer.php"; ?>