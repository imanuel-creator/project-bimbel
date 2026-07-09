<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar_pengajar.php";
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>
                        <i class="fas fa-chalkboard-teacher text-success"></i>
                        Dashboard Pengajar
                    </h1>

                    <p class="text-muted">
                        Selamat datang,
                        <b><?= $_SESSION['username']; ?></b>
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card card-success card-outline">

                        <div class="card-body">

                            <h4>Selamat Datang</h4>

                            <p>

                                Selamat datang di Sistem Informasi Bimbingan Belajar.

                                Silakan gunakan menu yang tersedia untuk mengelola kegiatan belajar.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../template/footer.php"; ?>