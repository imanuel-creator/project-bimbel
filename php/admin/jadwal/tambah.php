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

<h1>Tambah Jadwal</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Form Tambah Jadwal

</h3>

</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Kelas</label>

<select name="id_kelas" class="form-control" required>

<option value="">-- Pilih Kelas --</option>

<?php

$kelas = mysqli_query($koneksi,"
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

<label>Pengajar</label>

<select name="id_pengajar" class="form-control" required>

<option value="">-- Pilih Pengajar --</option>

<?php

$pengajar=mysqli_query($koneksi,"
SELECT * FROM pengajar
WHERE status='aktif'
ORDER BY nama
");

while($p=mysqli_fetch_assoc($pengajar)){

?>

<option value="<?= $p['id_pengajar']; ?>">

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Mata Pelajaran</label>

<select name="id_mapel" class="form-control" required>

<option value="">-- Pilih Mata Pelajaran --</option>

<?php

$mapel=mysqli_query($koneksi,"
SELECT * FROM mata_pelajaran
WHERE status='aktif'
ORDER BY nama_mapel
");

while($m=mysqli_fetch_assoc($mapel)){

?>

<option value="<?= $m['id_mapel']; ?>">

<?= $m['nama_mapel']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Hari</label>

<select name="hari" class="form-control">

<option>Senin</option>
<option>Selasa</option>
<option>Rabu</option>
<option>Kamis</option>
<option>Jumat</option>
<option>Sabtu</option>
<option>Minggu</option>

</select>

</div>

<div class="form-group">

<label>Jam Mulai</label>

<input
type="time"
name="jam_mulai"
class="form-control"
required>

</div>

<div class="form-group">

<label>Jam Selesai</label>

<input
type="time"
name="jam_selesai"
class="form-control"
required>

</div>

<div class="form-group">

<label>Tahun Ajaran</label>

<input
type="text"
name="tahun_ajaran"
class="form-control"
placeholder="2025/2026"
required>

</div>

<div class="form-group">

<label>Semester</label>

<select name="semester" class="form-control">

<option>Ganjil</option>
<option>Genap</option>

</select>

</div>

<div class="form-group">

<label>Ruangan</label>

<input
type="text"
name="ruangan"
class="form-control">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option>aktif</option>
<option>selesai</option>
<option>dibatalkan</option>

</select>

</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan

</button>

<a href="index.php"
class="btn btn-secondary">

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