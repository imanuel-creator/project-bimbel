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
t.*,
s.nis,
s.nama
FROM tagihan_spp t
JOIN pendaftaran_siswa p ON t.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
ORDER BY t.tanggal_tagihan DESC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Tagihan SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_tagihan.php" target="_blank" class="btn btn-success">
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
<th>Tanggal Tagihan</th>
<th>Jatuh Tempo</th>
<th>Jumlah Tagihan</th>
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

<td><?= $row['nis']; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['periode']; ?></td>

<td><?= $row['tanggal_tagihan']; ?></td>

<td><?= $row['jatuh_tempo']; ?></td>

<td>Rp <?= number_format($row['jumlah_tagihan'],0,',','.'); ?></td>

<td><?= $row['status']; ?></td>

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