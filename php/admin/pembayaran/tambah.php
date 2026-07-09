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
<h1>Tambah Pembayaran</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Form Pembayaran</h3>
</div>

<form action="proses_tambah.php" method="POST">

<div class="card-body">

<div class="form-group">

<label>Tagihan</label>

<select name="id_tagihan" class="form-control" required>

<option value="">-- Pilih Tagihan --</option>

<?php

$data=mysqli_query($koneksi,"
SELECT
tagihan_spp.id_tagihan,
tagihan_spp.periode,
tagihan_spp.jumlah_tagihan,
siswa.nama

FROM tagihan_spp

JOIN pendaftaran_siswa
ON tagihan_spp.id_pendaftaran=pendaftaran_siswa.id_pendaftaran

JOIN siswa
ON pendaftaran_siswa.id_siswa=siswa.id_siswa

WHERE tagihan_spp.status='Belum Lunas'

ORDER BY siswa.nama
");

while($d=mysqli_fetch_assoc($data)){

?>

<option value="<?= $d['id_tagihan']; ?>">

<?= $d['nama']; ?> | <?= $d['periode']; ?> | Rp <?= number_format($d['jumlah_tagihan'],0,',','.'); ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Tanggal Bayar</label>
<input type="date" name="tanggal_bayar" class="form-control" required>
</div>

<div class="form-group">
<label>Jumlah Bayar</label>
<input type="number" name="jumlah_bayar" class="form-control" required>
</div>

<div class="form-group">

<label>Metode Pembayaran</label>

<select name="metode_pembayaran" class="form-control">

<option value="Tunai">Tunai</option>
<option value="Transfer">Transfer</option>
<option value="QRIS">QRIS</option>

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

<?php include "../../template/footer.php"; ?>