<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_mapel = $_POST['id_mapel'];
    $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kode_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    mysqli_query($koneksi, "UPDATE mata_pelajaran SET

        kode_mapel='$kode_mapel',
        nama_mapel='$nama_mapel',
        deskripsi='$deskripsi',
        status='$status'

        WHERE id_mapel='$id_mapel'
    ");

    echo "<script>
    alert('Data berhasil diupdate');
    window.location='index.php';
    </script>";

}
?>