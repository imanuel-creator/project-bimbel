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
<h1>Pembayaran SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="tambah.php" class="btn btn-primary">
<i class="fas fa-plus"></i>
Tambah Pembayaran
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Siswa</th>
<th>Periode</th>
<th>Tanggal Bayar</th>
<th>Jumlah Bayar</th>
<th>Metode</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"
SELECT

pembayaran_spp.*,
tagihan_spp.periode,
siswa.nama

FROM pembayaran_spp

JOIN tagihan_spp
ON pembayaran_spp.id_tagihan=tagihan_spp.id_tagihan

JOIN pendaftaran_siswa
ON tagihan_spp.id_pendaftaran=pendaftaran_siswa.id_pendaftaran

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

ORDER BY pembayaran_spp.id_pembayaran DESC
");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['periode']; ?></td>

<td><?= $row['tanggal_bayar']; ?></td>

<td>Rp <?= number_format($row['jumlah_bayar'],0,',','.'); ?></td>

<td><?= $row['metode_pembayaran']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id_pembayaran']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="hapus.php?id=<?= $row['id_pembayaran']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">
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