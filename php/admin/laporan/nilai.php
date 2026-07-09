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
n.*,
s.nis,
s.nama,
m.nama_mapel
FROM nilai_ulangan n
JOIN pendaftaran_siswa p ON n.id_pendaftaran = p.id_pendaftaran
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN mata_pelajaran m ON n.id_mapel = m.id_mapel
ORDER BY n.tanggal_ujian DESC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Nilai</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_nilai.php" target="_blank" class="btn btn-success">
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
<th>Mata Pelajaran</th>
<th>Jenis Ujian</th>
<th>Nilai</th>
<th>Tanggal Ujian</th>

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

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['jenis_ujian']; ?></td>

<td><?= $row['nilai']; ?></td>

<td><?= $row['tanggal_ujian']; ?></td>

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