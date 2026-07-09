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

$query=mysqli_query($koneksi,"SELECT * FROM pembayaran_spp WHERE id_pembayaran='$id'");
$data=mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Edit Pembayaran</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Edit Pembayaran</h3>
</div>

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_pembayaran" value="<?= $data['id_pembayaran']; ?>">

<div class="card-body">

<div class="form-group">

<label>Tagihan</label>

<select name="id_tagihan" class="form-control">

<?php

$tagihan=mysqli_query($koneksi,"
SELECT
tagihan_spp.id_tagihan,
tagihan_spp.periode,
siswa.nama

FROM tagihan_spp

JOIN pendaftaran_siswa
ON tagihan_spp.id_pendaftaran=pendaftaran_siswa.id_pendaftaran

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

ORDER BY siswa.nama
");

while($t=mysqli_fetch_assoc($tagihan)){
?>

<option
value="<?= $t['id_tagihan']; ?>"
<?= ($t['id_tagihan']==$data['id_tagihan'])?'selected':'';?>>

<?= $t['nama']; ?> | <?= $t['periode']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Tanggal Bayar</label>

<input
type="date"
name="tanggal_bayar"
class="form-control"
value="<?= $data['tanggal_bayar']; ?>">

</div>

<div class="form-group">
<label>Jumlah Bayar</label>

<input
type="number"
name="jumlah_bayar"
class="form-control"
value="<?= $data['jumlah_bayar']; ?>">

</div>

<div class="form-group">

<label>Metode Pembayaran</label>

<select name="metode_pembayaran" class="form-control">

<option value="Tunai" <?=($data['metode_pembayaran']=="Tunai")?"selected":"";?>>Tunai</option>

<option value="Transfer" <?=($data['metode_pembayaran']=="Transfer")?"selected":"";?>>Transfer</option>

<option value="QRIS" <?=($data['metode_pembayaran']=="QRIS")?"selected":"";?>>QRIS</option>

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