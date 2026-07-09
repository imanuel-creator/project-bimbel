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

$query = mysqli_query($koneksi, "SELECT * FROM program_belajar WHERE id_program='$id'");
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
<h1>Edit Program Belajar</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Program Belajar</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_program" value="<?= $data['id_program']; ?>">

<div class="card-body">

<div class="form-group">
<label>Nama Program</label>
<input type="text"
name="nama_program"
class="form-control"
value="<?= $data['nama_program']; ?>"
required>
</div>

<div class="form-group">
<label>Deskripsi</label>
<textarea
name="deskripsi"
class="form-control"
rows="4"><?= $data['deskripsi']; ?></textarea>
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

<button type="submit" class="btn btn-success">
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