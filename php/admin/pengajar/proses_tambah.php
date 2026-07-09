<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $kode_pengajar = mysqli_real_escape_string($koneksi, $_POST['kode_pengajar']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Username = Kode Pengajar
    $username = $kode_pengajar;

    // Password default = 123456
    $password = password_hash("123456", PASSWORD_DEFAULT);

    // Cek username
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
            alert('Username sudah digunakan!');
            window.location='tambah.php';
        </script>";

        exit;
    }

    // Simpan ke tabel users
    mysqli_query($koneksi, "INSERT INTO users
    (
        username,
        password,
        role,
        status
    )
    VALUES
    (
        '$username',
        '$password',
        'pengajar',
        '$status'
    )");

    $id_user = mysqli_insert_id($koneksi);

    // Simpan ke tabel pengajar
    mysqli_query($koneksi, "INSERT INTO pengajar
    (
        id_user,
        kode_pengajar,
        nama,
        jenis_kelamin,
        no_hp,
        email,
        alamat,
        status
    )
    VALUES
    (
        '$id_user',
        '$kode_pengajar',
        '$nama',
        '$jenis_kelamin',
        '$no_hp',
        '$email',
        '$alamat',
        '$status'
    )");

    echo "<script>
        alert('Data pengajar berhasil ditambahkan');
        window.location='index.php';
    </script>";
}
?>