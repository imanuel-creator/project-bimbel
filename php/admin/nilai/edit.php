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

$query = mysqli_query($koneksi,"SELECT * FROM nilai_ulangan WHERE id_nilai='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Nilai</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Nilai</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_nilai" value="<?= $data['id_nilai']; ?>">

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

<label>Mata Pelajaran</label>

<select name="id_mapel" class="form-control">

<?php

$mapel=mysqli_query($koneksi,"
SELECT *
FROM mata_pelajaran
ORDER BY nama_mapel
");

while($m=mysqli_fetch_assoc($mapel)){
?>

<option
value="<?= $m['id_mapel']; ?>"
<?= ($m['id_mapel']==$data['id_mapel'])?"selected":"";?>>

<?= $m['nama_mapel']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Jenis Ujian</label>

<select name="jenis_ujian" class="form-control">

<option value="Quiz" <?=($data['jenis_ujian']=="Quiz")?"selected":"";?>>Quiz</option>

<option value="UTS" <?=($data['jenis_ujian']=="UTS")?"selected":"";?>>UTS</option>

<option value="UAS" <?=($data['jenis_ujian']=="UAS")?"selected":"";?>>UAS</option>

<option value="Try Out" <?=($data['jenis_ujian']=="Try Out")?"selected":"";?>>Try Out</option>

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
value="<?= $data['nilai']; ?>">

</div>

<div class="form-group">

<label>Tanggal Ujian</label>

<input
type="date"
name="tanggal_ujian"
class="form-control"
value="<?= $data['tanggal_ujian']; ?>">

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