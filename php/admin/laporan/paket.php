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
SELECT p.*, pb.nama_program
FROM paket_kelas p
JOIN program_belajar pb ON p.id_program = pb.id_program
ORDER BY pb.nama_program, p.nama_paket ASC
");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Paket Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_paket.php" target="_blank" class="btn btn-success">
<i class="fas fa-print"></i> Print
</a>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<thead>

<tr>
<th>No</th>
<th>Program</th>
<th>Nama Paket</th>
<th>Harga</th>
<th>Pertemuan</th>
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

<td><?= $row['nama_program']; ?></td>

<td><?= $row['nama_paket']; ?></td>

<td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>

<td><?= $row['jumlah_pertemuan']; ?></td>

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