<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar_siswa.php";

/* Cari id_siswa berdasarkan id_user */
$id_user = $_SESSION['id_user'];

$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT *
FROM siswa
WHERE id_user='$id_user'
"));

$id_siswa = $siswa['id_siswa'];

/* Pendaftaran Aktif */
$pendaftaran = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT *
FROM pendaftaran_siswa
WHERE id_siswa='$id_siswa'
AND status='aktif'
"));

$id_pendaftaran = $pendaftaran['id_pendaftaran'];

/* Total Nilai */
$totalNilai = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM nilai_ulangan
WHERE id_pendaftaran='$id_pendaftaran'
"));

/* Total Absensi */
$totalAbsensi = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM absensi_kelas
WHERE id_pendaftaran='$id_pendaftaran'
"));

/* Tagihan Belum Lunas */
$totalTagihan = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM tagihan_spp
WHERE id_pendaftaran='$id_pendaftaran'
AND status='Belum Lunas'
"));
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Dashboard Siswa</h1>

            <p>Selamat datang <?= $siswa['nama']; ?></p>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-4">

                    <div class="small-box bg-info">

                        <div class="inner">

                            <h3><?= $totalNilai['total']; ?></h3>

                            <p>Data Nilai</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-book"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="small-box bg-success">

                        <div class="inner">

                            <h3><?= $totalAbsensi['total']; ?></h3>

                            <p>Data Absensi</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-user-check"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="small-box bg-danger">

                        <div class="inner">

                            <h3><?= $totalTagihan['total']; ?></h3>

                            <p>Tagihan Belum Lunas</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-money-bill-wave"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../template/footer.php"; ?>