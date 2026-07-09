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

$query = mysqli_query($koneksi,"SELECT * FROM tagihan_spp WHERE id_tagihan='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Tagihan SPP</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Tagihan</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_tagihan" value="<?= $data['id_tagihan']; ?>">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_pendaftaran" class="form-control">

<?php

$siswa=mysqli_query($koneksi,"
SELECT
pendaftaran_siswa.id_pendaftaran,
siswa.nama,
kelas.nama_kelas

FROM pendaftaran_siswa

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

JOIN kelas
ON pendaftaran_siswa.id_kelas=kelas.id_kelas

ORDER BY siswa.nama
");

while($s=mysqli_fetch_assoc($siswa)){
?>

<option
value="<?= $s['id_pendaftaran']; ?>"
<?= ($s['id_pendaftaran']==$data['id_pendaftaran'])?"selected":"";?>>

<?= $s['nama']; ?> - <?= $s['nama_kelas']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Periode</label>

<input
type="month"
name="periode"
class="form-control"
value="<?= $data['periode']; ?>">

</div>

<div class="form-group">

<label>Tanggal Tagihan</label>

<input
type="date"
name="tanggal_tagihan"
class="form-control"
value="<?= $data['tanggal_tagihan']; ?>">

</div>

<div class="form-group">

<label>Jatuh Tempo</label>

<input
type="date"
name="jatuh_tempo"
class="form-control"
value="<?= $data['jatuh_tempo']; ?>">

</div>

<div class="form-group">

<label>Jumlah Tagihan</label>

<input
type="number"
name="jumlah_tagihan"
class="form-control"
value="<?= $data['jumlah_tagihan']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="Belum Lunas" <?=($data['status']=="Belum Lunas")?"selected":"";?>>
Belum Lunas
</option>

<option value="Lunas" <?=($data['status']=="Lunas")?"selected":"";?>>
Lunas
</option>

</select>

</div>

</div>

<div class="card-footer">

<button class="btn btn-success">

<i class="fas fa-save"></i>

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