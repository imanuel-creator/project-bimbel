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
<h1>Tambah Tagihan SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Tagihan</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_pendaftaran" class="form-control" required>

<option value="">-- Pilih Siswa --</option>

<?php

$data=mysqli_query($koneksi,"
SELECT
pendaftaran_siswa.id_pendaftaran,
siswa.nama,
kelas.nama_kelas

FROM pendaftaran_siswa

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

JOIN kelas
ON pendaftaran_siswa.id_kelas=kelas.id_kelas

WHERE pendaftaran_siswa.status='aktif'

ORDER BY siswa.nama
");

while($d=mysqli_fetch_assoc($data)){
?>

<option value="<?= $d['id_pendaftaran']; ?>">

<?= $d['nama']; ?> - <?= $d['nama_kelas']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Periode</label>
<input type="month" name="periode" class="form-control" required>
</div>

<div class="form-group">
<label>Tanggal Tagihan</label>
<input type="date" name="tanggal_tagihan" class="form-control" required>
</div>

<div class="form-group">
<label>Jatuh Tempo</label>
<input type="date" name="jatuh_tempo" class="form-control" required>
</div>

<div class="form-group">
<label>Jumlah Tagihan</label>
<input type="number" name="jumlah_tagihan" class="form-control" required>
</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="Belum Lunas">Belum Lunas</option>
<option value="Lunas">Lunas</option>

</select>

</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">
<i class="fas fa-save"></i>
Simpan
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</div>

</form>

</div>

</div>

</section>

</div>

<?php include "../../template/footer.php"; ?>