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

$query = mysqli_query($koneksi, "SELECT * FROM program_belajar ORDER BY nama_program ASC");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan Program Belajar</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<a href="print_program.php" target="_blank" class="btn btn-success">
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

<th width="5%">No</th>
<th>Nama Program</th>
<th>Deskripsi</th>
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

<td><?= $row['deskripsi']; ?></td>

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