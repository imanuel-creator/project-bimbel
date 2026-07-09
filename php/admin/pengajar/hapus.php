<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_pengajar = $_GET['id'];

// Ambil id_user
$query = mysqli_query($koneksi, "SELECT id_user FROM pengajar WHERE id_pengajar='$id_pengajar'");
$data = mysqli_fetch_assoc($query);

if (!$data) {

    echo "<script>
    alert('Data tidak ditemukan');
    window.location='index.php';
    </script>";

    exit;
}

$id_user = $data['id_user'];

// Hapus data pengajar
mysqli_query($koneksi, "DELETE FROM pengajar WHERE id_pengajar='$id_pengajar'");

// Hapus akun login
mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id_user'");

echo "<script>
alert('Data pengajar berhasil dihapus');
window.location='index.php';
</script>";
?>