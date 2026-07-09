<?php
session_start();

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nis             = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama            = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin   = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir   = $_POST['tanggal_lahir'];
    $alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp           = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email           = mysqli_real_escape_string($koneksi, $_POST['email']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Username = NIS
    $username = $nis;

    // Password default = 123456
    $password = password_hash("123456", PASSWORD_DEFAULT);

    // Cek username
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){

        echo "<script>
        alert('Username sudah digunakan!');
        window.location='tambah.php';
        </script>";

        exit;
    }

    // Simpan ke tabel users
    mysqli_query($koneksi, "INSERT INTO users(username,password,role,status)
    VALUES(
    '$username',
    '$password',
    'siswa',
    'aktif'
    )");

    // Ambil id_user
    $id_user = mysqli_insert_id($koneksi);

    // Simpan ke tabel siswa
    mysqli_query($koneksi,"INSERT INTO siswa
    (
    id_user,
    nis,
    nama,
    jenis_kelamin,
    tanggal_lahir,
    alamat,
    no_hp,
    email,
    status
    )
    VALUES
    (
    '$id_user',
    '$nis',
    '$nama',
    '$jenis_kelamin',
    '$tanggal_lahir',
    '$alamat',
    '$no_hp',
    '$email',
    '$status'
    )");

    echo "<script>
    alert('Data siswa berhasil ditambahkan');
    window.location='index.php';
    </script>";

}
?>