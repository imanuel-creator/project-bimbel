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
<h1>Tambah Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Tambah Kelas</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">
<label>Paket Kelas</label>

<select name="id_paket" class="form-control" required>

<option value="">-- Pilih Paket Kelas --</option>

<?php

$query = mysqli_query($koneksi,"
SELECT paket_kelas.*, program_belajar.nama_program
FROM paket_kelas
JOIN program_belajar
ON paket_kelas.id_program=program_belajar.id_program
WHERE paket_kelas.status='aktif'
ORDER BY program_belajar.nama_program
");

while($p=mysqli_fetch_assoc($query)){
?>

<option value="<?= $p['id_paket']; ?>">

<?= $p['nama_program']; ?> - <?= $p['nama_paket']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Nama Kelas</label>

<input
type="text"
name="nama_kelas"
class="form-control"
required>

</div>

<div class="form-group">
<label>Kapasitas</label>

<input
type="number"
name="kapasitas"
class="form-control"
required>

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif">Aktif</option>
<option value="selesai">Selesai</option>
<option value="nonaktif">Nonaktif</option>

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

<?php
include "../../template/footer.php";
?>