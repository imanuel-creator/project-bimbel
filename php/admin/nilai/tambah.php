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
<h1>Tambah Nilai</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Nilai</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Siswa</label>

<select name="id_pendaftaran" class="form-control" required>

<option value="">-- Pilih Siswa --</option>

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

WHERE pendaftaran_siswa.status='aktif'

ORDER BY siswa.nama
");

while($s=mysqli_fetch_assoc($siswa)){

?>

<option value="<?= $s['id_pendaftaran']; ?>">

<?= $s['nama']; ?> - <?= $s['nama_kelas']; ?>

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
SELECT *
FROM mata_pelajaran
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

<label>Jenis Ujian</label>

<select name="jenis_ujian" class="form-control">

<option>Quiz</option>
<option>UTS</option>
<option>UAS</option>
<option>Try Out</option>

</select>

</div>

<div class="form-group">

<label>Nilai</label>

<input
type="number"
step="0.01"
min="0"
max="100"
name="nilai"
class="form-control"
required>

</div>

<div class="form-group">

<label>Tanggal Ujian</label>

<input
type="date"
name="tanggal_ujian"
class="form-control"
required>

</div>

<div class="form-group">

<label>Catatan</label>

<textarea
name="catatan"
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