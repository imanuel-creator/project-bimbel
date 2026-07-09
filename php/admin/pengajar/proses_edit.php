<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_pengajar    = $_POST['id_pengajar'];
    $kode_pengajar  = mysqli_real_escape_string($koneksi, $_POST['kode_pengajar']);
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $status         = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Ambil id_user
    $ambil = mysqli_query($koneksi,
        "SELECT id_user FROM pengajar WHERE id_pengajar='$id_pengajar'");

    $data = mysqli_fetch_assoc($ambil);

    if (!$data) {
        echo "<script>
        alert('Data pengajar tidak ditemukan!');
        window.location='index.php';
        </script>";
        exit;
    }

    $id_user = $data['id_user'];

    // Update tabel pengajar
    mysqli_query($koneksi, "UPDATE pengajar SET

        kode_pengajar='$kode_pengajar',
        nama='$nama',
        jenis_kelamin='$jenis_kelamin',
        no_hp='$no_hp',
        email='$email',
        alamat='$alamat',
        status='$status'

        WHERE id_pengajar='$id_pengajar'
    ");

    // Update tabel users
    mysqli_query($koneksi, "UPDATE users SET

        username='$kode_pengajar',
        status='$status'

        WHERE id_user='$id_user'
    ");

    echo "<script>

    alert('Data pengajar berhasil diupdate');

    window.location='index.php';

    </script>";

}
?>