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

$id=$_GET['id'];

$query=mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas='$id'");
$data=mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Kelas</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">

<div class="card-body">

<div class="form-group">

<label>Paket Kelas</label>

<select name="id_paket" class="form-control">

<?php

$paket=mysqli_query($koneksi,"
SELECT paket_kelas.*,program_belajar.nama_program
FROM paket_kelas
JOIN program_belajar
ON paket_kelas.id_program=program_belajar.id_program");

while($p=mysqli_fetch_assoc($paket)){
?>

<option
value="<?= $p['id_paket']; ?>"
<?= ($p['id_paket']==$data['id_paket'])?"selected":"";?>>

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
value="<?= $data['nama_kelas']; ?>">

</div>

<div class="form-group">

<label>Kapasitas</label>

<input
type="number"
name="kapasitas"
class="form-control"
value="<?= $data['kapasitas']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif" <?=($data['status']=="aktif")?"selected":"";?>>Aktif</option>

<option value="selesai" <?=($data['status']=="selesai")?"selected":"";?>>Selesai</option>

<option value="nonaktif" <?=($data['status']=="nonaktif")?"selected":"";?>>Nonaktif</option>

</select>

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