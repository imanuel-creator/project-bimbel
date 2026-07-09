<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_siswa        = $_POST['id_siswa'];
    $nis             = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama            = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin   = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir   = $_POST['tanggal_lahir'];
    $alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp           = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email           = mysqli_real_escape_string($koneksi, $_POST['email']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Ambil id_user berdasarkan siswa
    $ambil = mysqli_query($koneksi, "SELECT id_user FROM siswa WHERE id_siswa='$id_siswa'");
    $data = mysqli_fetch_assoc($ambil);

    if (!$data) {
        echo "<script>
            alert('Data siswa tidak ditemukan!');
            window.location='index.php';
        </script>";
        exit;
    }

    $id_user = $data['id_user'];

    // Update tabel siswa
    mysqli_query($koneksi, "UPDATE siswa SET
        nis='$nis',
        nama='$nama',
        jenis_kelamin='$jenis_kelamin',
        tanggal_lahir='$tanggal_lahir',
        alamat='$alamat',
        no_hp='$no_hp',
        email='$email',
        status='$status'
        WHERE id_siswa='$id_siswa'
    ");

    // Update username pada tabel users
    mysqli_query($koneksi, "UPDATE users SET
        username='$nis',
        status='$status'
        WHERE id_user='$id_user'
    ");

    echo "<script>
        alert('Data siswa berhasil diupdate');
        window.location='index.php';
    </script>";
}
?>