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

$query = mysqli_query($koneksi,"SELECT * FROM jadwal_kelas WHERE id_jadwal='$id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Edit Jadwal</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Form Edit Jadwal

</h3>

</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal']; ?>">

<div class="card-body">

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

<label>Pengajar</label>

<select name="id_pengajar" class="form-control">

<?php

$pengajar=mysqli_query($koneksi,"SELECT * FROM pengajar ORDER BY nama");

while($p=mysqli_fetch_assoc($pengajar)){

?>

<option
value="<?= $p['id_pengajar']; ?>"
<?= ($p['id_pengajar']==$data['id_pengajar'])?"selected":"";?>>

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Mata Pelajaran</label>

<select name="id_mapel" class="form-control">

<?php

$mapel=mysqli_query($koneksi,"SELECT * FROM mata_pelajaran ORDER BY nama_mapel");

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

<label>Hari</label>

<select name="hari" class="form-control">

<?php

$hari_list=[
"Senin",
"Selasa",
"Rabu",
"Kamis",
"Jumat",
"Sabtu",
"Minggu"
];

foreach($hari_list as $h){

?>

<option
value="<?= $h;?>"
<?=($data['hari']==$h)?"selected":"";?>>

<?= $h;?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Jam Mulai</label>

<input
type="time"
name="jam_mulai"
class="form-control"
value="<?= $data['jam_mulai']; ?>">

</div>

<div class="form-group">

<label>Jam Selesai</label>

<input
type="time"
name="jam_selesai"
class="form-control"
value="<?= $data['jam_selesai']; ?>">

</div>

<div class="form-group">

<label>Tahun Ajaran</label>

<input
type="text"
name="tahun_ajaran"
class="form-control"
value="<?= $data['tahun_ajaran']; ?>">

</div>

<div class="form-group">

<label>Semester</label>

<select name="semester" class="form-control">

<option value="Ganjil" <?=($data['semester']=="Ganjil")?"selected":"";?>>Ganjil</option>

<option value="Genap" <?=($data['semester']=="Genap")?"selected":"";?>>Genap</option>

</select>

</div>

<div class="form-group">

<label>Ruangan</label>

<input
type="text"
name="ruangan"
class="form-control"
value="<?= $data['ruangan']; ?>">

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif" <?=($data['status']=="aktif")?"selected":"";?>>Aktif</option>

<option value="selesai" <?=($data['status']=="selesai")?"selected":"";?>>Selesai</option>

<option value="dibatalkan" <?=($data['status']=="dibatalkan")?"selected":"";?>>Dibatalkan</option>

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