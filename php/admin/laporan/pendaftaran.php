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

$query=mysqli_query($koneksi,"
SELECT
p.*,
s.nis,
s.nama,
k.nama_kelas
FROM pendaftaran_siswa p
JOIN siswa s ON p.id_siswa=s.id_siswa
JOIN kelas k ON p.id_kelas=k.id_kelas
ORDER BY p.tanggal_daftar DESC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Pendaftaran Siswa</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_pendaftaran.php" target="_blank" class="btn btn-success">
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
<th>Kelas</th>
<th>Tanggal Daftar</th>
<th>Sesi Tersisa</th>
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

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['tanggal_daftar']; ?></td>

<td><?= $row['sesi_tersisa']; ?></td>

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