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

$query = mysqli_query($koneksi,"SELECT * FROM absensi_kelas WHERE id_absensi='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Absensi</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Absensi</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_absensi" value="<?= $data['id_absensi']; ?>">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_pendaftaran" class="form-control">

<?php

$siswa = mysqli_query($koneksi,"
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

<label>Jadwal</label>

<select name="id_jadwal" class="form-control">

<?php

$jadwal = mysqli_query($koneksi,"
SELECT * FROM v_jadwal_kelas
ORDER BY nama_kelas
");

while($j=mysqli_fetch_assoc($jadwal)){

?>

<option
value="<?= $j['id_jadwal']; ?>"
<?= ($j['id_jadwal']==$data['id_jadwal'])?"selected":"";?>>

<?= $j['nama_kelas']; ?>

|

<?= $j['nama_mapel']; ?>

|

<?= $j['hari']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Tanggal Absensi</label>

<input
type="date"
name="tanggal_absensi"
class="form-control"
value="<?= $data['tanggal_absensi']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="Hadir" <?=($data['status']=="Hadir")?"selected":"";?>>Hadir</option>

<option value="Izin" <?=($data['status']=="Izin")?"selected":"";?>>Izin</option>

<option value="Sakit" <?=($data['status']=="Sakit")?"selected":"";?>>Sakit</option>

<option value="Alpa" <?=($data['status']=="Alpa")?"selected":"";?>>Alpa</option>

</select>

</div>

<div class="form-group">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="3"><?= $data['keterangan']; ?></textarea>

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