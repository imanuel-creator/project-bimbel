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
<h1>Tambah Data Pengajar</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h3 class="card-title">
Form Tambah Data Pengajar
</h3>

</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">
<label>Kode Pengajar</label>
<input
type="text"
name="kode_pengajar"
class="form-control"
required>
</div>

<div class="form-group">
<label>Nama</label>
<input
type="text"
name="nama"
class="form-control"
required>
</div>

<div class="form-group">
<label>Jenis Kelamin</label>

<select
name="jenis_kelamin"
class="form-control"
required>

<option value="">-- Pilih --</option>
<option value="L">Laki-laki</option>
<option value="P">Perempuan</option>

</select>

</div>

<div class="form-group">
<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control">

</div>

<div class="form-group">
<label>Email</label>

<input
type="email"
name="email"
class="form-control">

</div>

<div class="form-group">
<label>Alamat</label>

<textarea
name="alamat"
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