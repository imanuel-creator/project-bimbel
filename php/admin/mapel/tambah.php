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
<h1>Tambah Mata Pelajaran</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Tambah Mata Pelajaran</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">
<label>Kode Mata Pelajaran</label>
<input
type="text"
name="kode_mapel"
class="form-control"
required>
</div>

<div class="form-group">
<label>Nama Mata Pelajaran</label>
<input
type="text"
name="nama_mapel"
class="form-control"
required>
</div>

<div class="form-group">
<label>Deskripsi</label>
<textarea
name="deskripsi"
class="form-control"
rows="4"></textarea>
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