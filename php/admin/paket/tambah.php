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
<h1>Tambah Paket Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Tambah Paket Kelas</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">
<label>Program Belajar</label>

<select name="id_program" class="form-control" required>

<option value="">-- Pilih Program --</option>

<?php

$program = mysqli_query($koneksi,"SELECT * FROM program_belajar WHERE status='aktif' ORDER BY nama_program ASC");

while($p=mysqli_fetch_assoc($program)){

?>

<option value="<?= $p['id_program']; ?>">

<?= $p['nama_program']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Nama Paket</label>

<input
type="text"
name="nama_paket"
class="form-control"
required>

</div>

<div class="form-group">
<label>Harga</label>

<input
type="number"
name="harga"
class="form-control"
required>

</div>

<div class="form-group">
<label>Jumlah Pertemuan</label>

<input
type="number"
name="jumlah_pertemuan"
class="form-control"
required>

</div>

<div class="form-group">
<label>Status</label>

<select
name="status"
class="form-control">

<option value="aktif">Aktif</option>
<option value="nonaktif">Nonaktif</option>

</select>

</div>

</div>

<div class="card-footer">

<button
type="submit"
class="btn btn-primary">

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