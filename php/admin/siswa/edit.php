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

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id'");
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
        <h1>Edit Data Siswa</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
    <h3 class="card-title">Form Edit Data Siswa</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_siswa" value="<?= $data['id_siswa']; ?>">

<div class="card-body">

<div class="form-group">
<label>NIS</label>
<input
type="text"
name="nis"
class="form-control"
value="<?= $data['nis']; ?>"
required>
</div>

<div class="form-group">
<label>Nama</label>
<input
type="text"
name="nama"
class="form-control"
value="<?= $data['nama']; ?>"
required>
</div>

<div class="form-group">
<label>Jenis Kelamin</label>

<select name="jenis_kelamin" class="form-control">

<option value="L" <?= ($data['jenis_kelamin']=="L")?"selected":""; ?>>
Laki-laki
</option>

<option value="P" <?= ($data['jenis_kelamin']=="P")?"selected":""; ?>>
Perempuan
</option>

</select>

</div>

<div class="form-group">
<label>Tanggal Lahir</label>

<input
type="date"
name="tanggal_lahir"
class="form-control"
value="<?= $data['tanggal_lahir']; ?>">

</div>

<div class="form-group">
<label>Alamat</label>

<textarea
name="alamat"
class="form-control"
rows="4"><?= $data['alamat']; ?></textarea>

</div>

<div class="form-group">
<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= $data['no_hp']; ?>">

</div>

<div class="form-group">
<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= $data['email']; ?>">

</div>

<div class="form-group">
<label>Status</label>

<select name="status" class="form-control">

<option value="aktif"
<?= ($data['status']=="aktif")?"selected":""; ?>>
Aktif
</option>

<option value="nonaktif"
<?= ($data['status']=="nonaktif")?"selected":""; ?>>
Nonaktif
</option>

</select>

</div>

</div>

<div class="card-footer">

<button
type="submit"
class="btn btn-success">

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