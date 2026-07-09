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
SELECT *
FROM v_jadwal_kelas
ORDER BY hari, jam_mulai
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Jadwal Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_jadwal.php" target="_blank" class="btn btn-success">
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
<th>Kelas</th>
<th>Mata Pelajaran</th>
<th>Pengajar</th>
<th>Hari</th>
<th>Jam</th>
<th>Ruangan</th>
<th>Tahun Ajaran</th>
<th>Semester</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['nama_pengajar']; ?></td>

<td><?= $row['hari']; ?></td>

<td><?= substr($row['jam_mulai'],0,5); ?> -
<?= substr($row['jam_selesai'],0,5); ?></td>

<td><?= $row['ruangan']; ?></td>

<td><?= $row['tahun_ajaran']; ?></td>

<td><?= $row['semester']; ?></td>

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