<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

$id=$_POST['id_absensi'];
$id_pendaftaran=$_POST['id_pendaftaran'];
$id_jadwal=$_POST['id_jadwal'];
$tanggal=$_POST['tanggal_absensi'];
$status=$_POST['status'];
$keterangan=$_POST['keterangan'];

$query=mysqli_query($koneksi,"
UPDATE absensi_kelas
SET
id_pendaftaran='$id_pendaftaran',
id_jadwal='$id_jadwal',
tanggal_absensi='$tanggal',
status='$status',
keterangan='$keterangan'
WHERE id_absensi='$id'
");

if(!$query){
    die(mysqli_error($koneksi));
}

header("Location:index.php");
exit;