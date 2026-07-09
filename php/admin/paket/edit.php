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

$query = mysqli_query($koneksi, "SELECT * FROM paket_kelas WHERE id_paket='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
    alert('Data tidak ditemukan!');
    window.location='index.php';
    </script>";
    exit;
}
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Paket Kelas</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Paket Kelas</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_paket" value="<?= $data['id_paket']; ?>">

<div class="card-body">

<div class="form-group">
<label>Program Belajar</label>

<select name="id_program" class="form-control" required>

<?php
$program = mysqli_query($koneksi,"SELECT * FROM program_belajar ORDER BY nama_program ASC");

while($p=mysqli_fetch_assoc($program)){
?>

<option value="<?= $p['id_program']; ?>"
<?= ($p['id_program']==$data['id_program'])?"selected":"";?>>

<?= $p['nama_program']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Nama Paket</label>

<input
type="text"
name="nama_paket"
class="form-control"
value="<?= $data['nama_paket']; ?>"
required>

</div>

<div class="form-group">
<label>Harga</label>

<input
type="number"
name="harga"
class="form-control"
value="<?= $data['harga']; ?>"
required>

</div>

<div class="form-group">
<label>Jumlah Pertemuan</label>

<input
type="number"
name="jumlah_pertemuan"
class="form-control"
value="<?= $data['jumlah_pertemuan']; ?>"
required>

</div>

<div class="form-group">

<label>Status</label>

<select name="status" class="form-control">

<option value="aktif" <?=($data['status']=="aktif")?"selected":"";?>>Aktif</option>

<option value="nonaktif" <?=($data['status']=="nonaktif")?"selected":"";?>>Nonaktif</option>

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