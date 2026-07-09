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

$query = mysqli_query($koneksi,"
SELECT
pb.*,
tg.periode,
s.nis,
s.nama
FROM pembayaran_spp pb
JOIN tagihan_spp tg ON pb.id_tagihan = tg.id_tagihan
JOIN pendaftaran_siswa p ON tg.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
ORDER BY pb.tanggal_bayar DESC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Pembayaran SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_pembayaran.php" target="_blank" class="btn btn-success">
    <i class="fas fa-print"></i> Print
</a>

<a href="index.php" class="btn btn-secondary">
    Kembali
</a>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Periode</th>
<th>Tanggal Bayar</th>
<th>Jumlah Bayar</th>
<th>Metode</th>
<th>Keterangan</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($row = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nis']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['periode']; ?></td>

<td><?= $row['tanggal_bayar']; ?></td>

<td>Rp <?= number_format($row['jumlah_bayar'],0,',','.'); ?></td>

<td><?= $row['metode_pembayaran']; ?></td>

<td><?= $row['keterangan']; ?></td>

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