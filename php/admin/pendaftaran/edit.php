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

$id = $_GET['id'];

$query = mysqli_query($koneksi,"SELECT * FROM pendaftaran_siswa WHERE id_pendaftaran='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Pendaftaran</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Pendaftaran</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_pendaftaran" value="<?= $data['id_pendaftaran']; ?>">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_siswa" class="form-control">

<?php

$siswa=mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nama");

while($s=mysqli_fetch_assoc($siswa)){

?>

<option
value="<?= $s['id_siswa']; ?>"
<?= ($s['id_siswa']==$data['id_siswa'])?"selected":"";?>>

<?= $s['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Kelas</label>

<select name="id_kelas" class="form-control">

<?php

$kelas=mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY nama_kelas");

while($k=mysqli_fetch_assoc($kelas)){

?>

<option
value="<?= $k['id_kelas']; ?>"
<?= ($k['id_kelas']==$data['id_kelas'])?"selected":"";?>>

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
value="<?= $data['tanggal_daftar']; ?>">

</div>

<div class="form-group">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="<?= $data['tanggal_selesai']; ?>">

</div>

<div class="form-group">

<label>Sesi Tersisa</label>

<input
type="number"
name="sesi_tersisa"
class="form-control"
value="<?= $data['sesi_tersisa']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif" <?=($data['status']=="aktif")?"selected":"";?>>Aktif</option>
<option value="lulus" <?=($data['status']=="lulus")?"selected":"";?>>Lulus</option>
<option value="berhenti" <?=($data['status']=="berhenti")?"selected":"";?>>Berhenti</option>

</select>

</div>

<div class="form-group">

<label>Catatan</label>

<textarea
name="catatan"
class="form-control"
rows="3"><?= $data['catatan']; ?></textarea>

</div>

</div>

<div class="card-footer">

<button class="btn btn-success">

Update

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