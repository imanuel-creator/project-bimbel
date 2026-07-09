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
<h1>Tambah Absensi</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Absensi</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_pendaftaran" class="form-control" required>

<option value="">-- Pilih Siswa --</option>

<?php

$data=mysqli_query($koneksi,"
SELECT
pendaftaran_siswa.id_pendaftaran,
siswa.nama,
kelas.nama_kelas

FROM pendaftaran_siswa

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

JOIN kelas
ON pendaftaran_siswa.id_kelas=kelas.id_kelas

WHERE pendaftaran_siswa.status='aktif'

ORDER BY siswa.nama
");

while($d=mysqli_fetch_assoc($data)){

?>

<option value="<?= $d['id_pendaftaran']; ?>">

<?= $d['nama']; ?> - <?= $d['nama_kelas']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Jadwal</label>

<select name="id_jadwal" class="form-control" required>

<option value="">-- Pilih Jadwal --</option>

<?php

$jadwal=mysqli_query($koneksi,"
SELECT *
FROM v_jadwal_kelas
ORDER BY nama_kelas
");

while($j=mysqli_fetch_assoc($jadwal)){

?>

<option value="<?= $j['id_jadwal']; ?>">

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
required>

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option>Hadir</option>
<option>Izin</option>
<option>Sakit</option>
<option>Alpa</option>

</select>

</div>

<div class="form-group">

<label>Keterangan</label>

<textarea
name="keterangan"
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