<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_program = $_POST['id_program'];
    $nama_program = mysqli_real_escape_string($koneksi, $_POST['nama_program']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    mysqli_query($koneksi, "UPDATE program_belajar SET

        nama_program='$nama_program',
        deskripsi='$deskripsi',
        status='$status'

        WHERE id_program='$id_program'
    ");

    echo "<script>
    alert('Program belajar berhasil diupdate');
    window.location='index.php';
    </script>";
}
?>