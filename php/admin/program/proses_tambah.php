<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama_program = mysqli_real_escape_string($koneksi, $_POST['nama_program']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    mysqli_query($koneksi, "INSERT INTO program_belajar
    (
        nama_program,
        deskripsi,
        status
    )
    VALUES
    (
        '$nama_program',
        '$deskripsi',
        '$status'
    )");

    echo "<script>
    alert('Program belajar berhasil ditambahkan');
    window.location='index.php';
    </script>";

}
?>