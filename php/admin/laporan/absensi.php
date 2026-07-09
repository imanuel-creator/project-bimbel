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
a.*,
s.nis,
s.nama,
k.nama_kelas,
m.nama_mapel
FROM absensi_kelas a
JOIN pendaftaran_siswa p ON a.id_pendaftaran=p.id_pendaftaran
JOIN siswa s ON p.id_siswa=s.id_siswa
JOIN kelas k ON p.id_kelas=k.id_kelas
JOIN jadwal_kelas j ON a.id_jadwal=j.id_jadwal
JOIN mata_pelajaran m ON j.id_mapel=m.id_mapel
ORDER BY a.tanggal_absensi DESC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Absensi</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_absensi.php" target="_blank" class="btn btn-success">
<i class="fas fa-print"></i> Print
</a>

<a href="index.php" class="btn btn-secondary">Kembali</a>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Kelas</th>
<th>Mapel</th>
<th>Tanggal</th>
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
<td><?= $row['nama_mapel']; ?></td>
<td><?= $row['tanggal_absensi']; ?></td>
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