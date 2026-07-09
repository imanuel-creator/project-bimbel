<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kode_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    $cek = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode_mapel='$kode_mapel'");

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
        alert('Kode Mata Pelajaran sudah digunakan!');
        window.location='tambah.php';
        </script>";

        exit;
    }

    mysqli_query($koneksi, "INSERT INTO mata_pelajaran
    (
        kode_mapel,
        nama_mapel,
        deskripsi,
        status
    )
    VALUES
    (
        '$kode_mapel',
        '$nama_mapel',
        '$deskripsi',
        '$status'
    )");

    echo "<script>
    alert('Data berhasil ditambahkan');
    window.location='index.php';
    </script>";

}
?>