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
<h1>Tambah Pendaftaran</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Pendaftaran</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_siswa" class="form-control" required>

<option value="">-- Pilih Siswa --</option>

<?php

$siswa=mysqli_query($koneksi,"
SELECT * FROM siswa
WHERE status='aktif'
ORDER BY nama
");

while($s=mysqli_fetch_assoc($siswa)){
?>

<option value="<?= $s['id_siswa']; ?>">

<?= $s['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Kelas</label>

<select name="id_kelas" class="form-control" required>

<option value="">-- Pilih Kelas --</option>

<?php

$kelas=mysqli_query($koneksi,"
SELECT * FROM kelas
WHERE status='aktif'
ORDER BY nama_kelas
");

while($k=mysqli_fetch_assoc($kelas)){
?>

<option value="<?= $k['id_kelas']; ?>">

<?= $k['nama_kelas']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Tanggal Daftar</label>

<input
type="date"
name="tanggal_daftar"
class="form-control"
required>

</div>

<div class="form-group">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control">

</div>

<div class="form-group">

<label>Sesi Tersisa</label>

<input
type="number"
name="sesi_tersisa"
class="form-control"
required>

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif">Aktif</option>
<option value="lulus">Lulus</option>
<option value="berhenti">Berhenti</option>

</select>

</div>

<div class="form-group">

<label>Catatan</label>

<textarea
name="catatan"
class="form-control"
rows="3"></textarea>

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

<?php
include "../../template/footer.php";
?>