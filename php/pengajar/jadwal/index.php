<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";
include "../../template/header.php";
include "../../template/navbar.php";
include "../../template/sidebar_pengajar.php";

/* Ambil id_pengajar berdasarkan user login */

$dataPengajar = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT id_pengajar,nama
FROM pengajar
WHERE id_user='".$_SESSION['id_user']."'
"));

$id_pengajar = $dataPengajar['id_pengajar'];

/* Ambil jadwal */

$jadwal = mysqli_query($koneksi,"
SELECT
    j.hari,
    j.jam_mulai,
    j.jam_selesai,
    k.nama_kelas,
    m.nama_mapel,
    j.ruangan
FROM jadwal_kelas j
INNER JOIN kelas k
ON j.id_kelas=k.id_kelas
INNER JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
WHERE j.id_pengajar='$id_pengajar'
AND j.status='aktif'
ORDER BY
FIELD(j.hari,
'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'),
j.jam_mulai
");
?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Jadwal Mengajar</h1>

<p>Pengajar : <b><?= $dataPengajar['nama']; ?></b></p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h3 class="card-title">Daftar Jadwal Mengajar</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>Hari</th>
<th>Jam</th>
<th>Kelas</th>
<th>Mapel</th>
<th>Ruangan</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($jadwal)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['hari']; ?></td>

<td><?= substr($row['jam_mulai'],0,5); ?> - <?= substr($row['jam_selesai'],0,5); ?></td>

<td><?= $row['nama_kelas']; ?></td>

<td><?= $row['nama_mapel']; ?></td>

<td><?= $row['ruangan']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php include "../../template/footer.php"; ?>