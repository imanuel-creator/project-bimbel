<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../template/header.php";
include "../../template/navbar.php";
include "../../template/sidebar.php";
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Laporan</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<?php

$menu=[

["Data Siswa","siswa.php","info","fas fa-user-graduate"],

["Data Pengajar","pengajar.php","success","fas fa-chalkboard-teacher"],

["Mata Pelajaran","mapel.php","primary","fas fa-book"],

["Program Belajar","program.php","warning","fas fa-graduation-cap"],

["Paket Kelas","paket.php","danger","fas fa-box"],

["Kelas","kelas.php","secondary","fas fa-school"],

["Jadwal","jadwal.php","dark","fas fa-calendar"],

["Pendaftaran","pendaftaran.php","info","fas fa-user-plus"],

["Absensi","absensi.php","success","fas fa-check"],

["Nilai","nilai.php","warning","fas fa-chart-line"],

["Tagihan","tagihan.php","danger","fas fa-file-invoice-dollar"],

["Pembayaran","pembayaran.php","primary","fas fa-money-bill-wave"]

];

foreach($menu as $m){

?>

<div class="col-md-3">

<div class="card">

<div class="card-body text-center">

<i class="<?= $m[3]; ?> fa-3x text-<?= $m[2]; ?>"></i>

<h5 class="mt-3"><?= $m[0]; ?></h5>

<a href="<?= $m[1]; ?>" class="btn btn-<?= $m[2]; ?> btn-block">

Buka

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

</div>

<?php include "../../template/footer.php"; ?>