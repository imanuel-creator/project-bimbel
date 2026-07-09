<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

/* ==========================================================
   DASHBOARD - QUERY
========================================================== */

// Total Siswa
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM siswa
"));

// Total Pengajar
$pengajar = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM pengajar
"));

// Total Kelas
$kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM kelas
"));

// Total Mata Pelajaran
$mapel = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM mata_pelajaran
"));

// Total Pendaftaran Aktif
$pendaftaran = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM pendaftaran_siswa
WHERE status='aktif'
"));

// Total Tagihan Belum Lunas
$tagihan = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM tagihan_spp
WHERE status='Belum Lunas'
"));

// Total Pembayaran
$pembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM pembayaran_spp
"));

// Total Jadwal Aktif
$jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT COUNT(*) AS total
FROM jadwal_kelas
WHERE status='aktif'
"));

/* ==========================================================
   5 PEMBAYARAN TERBARU
========================================================== */

$pembayaran_terbaru = mysqli_query($koneksi, "
SELECT
    s.nama,
    p.tanggal_bayar,
    p.jumlah_bayar,
    p.metode_pembayaran
FROM pembayaran_spp p
INNER JOIN tagihan_spp t
    ON p.id_tagihan=t.id_tagihan
INNER JOIN pendaftaran_siswa ps
    ON t.id_pendaftaran=ps.id_pendaftaran
INNER JOIN siswa s
    ON ps.id_siswa=s.id_siswa
ORDER BY p.tanggal_bayar DESC
LIMIT 5
");

/* ==========================================================
   5 TAGIHAN BELUM LUNAS
========================================================== */

$tagihan_terbaru = mysqli_query($koneksi, "
SELECT
    s.nama,
    t.periode,
    t.jumlah_tagihan,
    t.jatuh_tempo
FROM tagihan_spp t
INNER JOIN pendaftaran_siswa ps
    ON t.id_pendaftaran=ps.id_pendaftaran
INNER JOIN siswa s
    ON ps.id_siswa=s.id_siswa
WHERE t.status='Belum Lunas'
ORDER BY t.jatuh_tempo ASC
LIMIT 5
");

/* ==========================================================
   JADWAL HARI INI
========================================================== */

$hari = [
    "Sunday" => "Minggu",
    "Monday" => "Senin",
    "Tuesday" => "Selasa",
    "Wednesday" => "Rabu",
    "Thursday" => "Kamis",
    "Friday" => "Jumat",
    "Saturday" => "Sabtu"
];

$hari_ini = $hari[date("l")];

$jadwal_hari_ini = mysqli_query($koneksi, "
SELECT
    j.hari,
    j.jam_mulai,
    j.jam_selesai,
    m.nama_mapel,
    k.nama_kelas,
    p.nama
FROM jadwal_kelas j
INNER JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
INNER JOIN kelas k
ON j.id_kelas=k.id_kelas
INNER JOIN pengajar p
ON j.id_pengajar=p.id_pengajar
WHERE j.hari='$hari_ini'
AND j.status='aktif'
ORDER BY j.jam_mulai
");

?>



<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-3">

                <div class="col-sm-6">

                    <h1 class="m-0">

                        <i class="fas fa-tachometer-alt text-primary"></i>

                        Dashboard Admin

                    </h1>

                    <p class="text-muted mb-0">

                        Selamat Datang,

                        <?= $_SESSION['username']; ?>

                    </p>

                    <small class="text-secondary">

                        <?=
                            date('l, d F Y');
                        ?>

                    </small>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="dashboard.php">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Admin

                        </li>

                    </ol>

                </div>

            </div>

            <hr>

        </div>

    </section>

    <!-- Content -->
    <section class="content">

        <div class="container-fluid">

            <!-- Statistik -->



            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $siswa['total']; ?></h3>

                        <p>Total Siswa</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-user-graduate"></i>

                    </div>

                    <a href="siswa/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $pengajar['total']; ?></h3>

                        <p>Total Pengajar</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-chalkboard-teacher"></i>

                    </div>

                    <a href="pengajar/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>



            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $kelas['total']; ?></h3>

                        <p>Total Kelas</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-school"></i>

                    </div>

                    <a href="kelas/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $mapel['total']; ?></h3>

                        <p>Mata Pelajaran</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-book"></i>

                    </div>

                    <a href="mapel/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $tagihan['total']; ?></h3>

                        <p>Belum Lunas</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-file-invoice-dollar"></i>

                    </div>

                    <a href="tagihan/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $pembayaran['total']; ?></h3>

                        <p>Pembayaran</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-money-bill-wave"></i>

                    </div>

                    <a href="pembayaran/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $pendaftaran['total']; ?></h3>

                        <p>Pendaftaran Aktif</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-user-check"></i>

                    </div>

                    <a href="pendaftaran/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">

                <div class="small-box bg-info elevation-3">

                    <div class="inner">

                        <h3><?= $jadwal['total']; ?></h3>

                        <p>Jadwal Aktif</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-calendar-alt"></i>

                    </div>

                    <a href="jadwal/index.php" class="small-box-footer">

                        Kelola Data
                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

        </div>

        <!-- Grafik -->

        <div class="row">

            <div class="col-md-6">

                <div class="card card-success card-outline">

                    <div class="card card-outline card-primary">

                        <h3 class="card-title">
                            Grafik Pembayaran
                        </h3>

                    </div>

                    <div class="card-body">

                        <canvas id="grafikPembayaran"></canvas>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card card-danger card-outline">

                    <div class="card card-outline card-danger">

                        <h3 class="card-title">
                            Grafik Tagihan
                        </h3>

                    </div>

                    <div class="card-body">

                        <canvas id="grafikTagihan"></canvas>

                    </div>

                </div>

            </div>

        </div>
        <div class="row mt-4">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-header bg-success">

                        <h3 class="card-title">

                            <i class="fas fa-money-check-alt"></i>

                            Pembayaran Terbaru

                        </h3>

                    </div>

                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="thead-light">

                                <tr>

                                    <th>No</th>

                                    <th>Nama Siswa</th>

                                    <th>Tanggal</th>

                                    <th>Metode</th>

                                    <th>Nominal</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $no = 1;

                                while ($row = mysqli_fetch_assoc($pembayaran_terbaru)) {

                                    ?>

                                    <tr>

                                        <td><?= $no++; ?></td>

                                        <td><?= htmlspecialchars($row['nama']); ?></td>

                                        <td><?= date('d-m-Y', strtotime($row['tanggal_bayar'])); ?></td>

                                        <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>

                                        <td>

                                            Rp <?= number_format($row['jumlah_bayar'], 0, ',', '.'); ?>

                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-header bg-danger">

                        <h3 class="card-title">

                            <i class="fas fa-file-invoice-dollar"></i>

                            Tagihan Belum Lunas

                        </h3>

                    </div>

                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Nama Siswa</th>

                                    <th>Periode</th>

                                    <th>Jatuh Tempo</th>

                                    <th>Jumlah</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $no = 1;

                                while ($row = mysqli_fetch_assoc($tagihan_terbaru)) {
                                    ?>

                                    <tr>

                                        <td><?= $no++; ?></td>

                                        <td><?= htmlspecialchars($row['nama']); ?></td>

                                        <td><?= htmlspecialchars($row['periode']); ?></td>

                                        <td><?= date('d-m-Y', strtotime($row['jatuh_tempo'])); ?></td>

                                        <td>
                                            Rp <?= number_format($row['jumlah_tagihan'], 0, ',', '.'); ?>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-lg-12">

                <div class="card card-info card-outline">

                    <div class="card-header bg-info">

                        <h3 class="card-title">

                            <i class="fas fa-calendar-alt"></i>

                            Jadwal Hari Ini (<?= $hari_ini; ?>)

                        </h3>

                    </div>

                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Jam</th>

                                    <th>Kelas</th>

                                    <th>Mapel</th>

                                    <th>Pengajar</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $no = 1;

                                if (mysqli_num_rows($jadwal_hari_ini) > 0) {

                                    while ($row = mysqli_fetch_assoc($jadwal_hari_ini)) {

                                        ?>

                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td>
                                                <?= substr($row['jam_mulai'], 0, 5); ?>
                                                -
                                                <?= substr($row['jam_selesai'], 0, 5); ?>
                                            </td>

                                            <td><?= htmlspecialchars($row['nama_kelas']); ?></td>

                                            <td><?= htmlspecialchars($row['nama_mapel']); ?></td>

                                            <td><?= htmlspecialchars($row['nama']); ?></td>

                                        </tr>

                                        <?php

                                    }

                                } else {

                                    ?>

                                    <tr>

                                        <td colspan="5" class="text-center text-muted">

                                            Tidak ada jadwal hari ini.

                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>
</div>
<?php include "../template/footer.php"; ?>
<script>

    const pembayaran = document.getElementById("grafikPembayaran");

    if (pembayaran) {

        new Chart(pembayaran, {
            type: 'bar',
            data: {
                labels: ['Pembayaran'],
                datasets: [{
                    label: 'Total',
                    data: [<?= $pembayaran['total']; ?>]
                }]
            }
        });

    }

    const tagihan = document.getElementById("grafikTagihan");

    if (tagihan) {

        new Chart(tagihan, {
            type: 'doughnut',
            data: {
                labels: ['Belum Lunas'],
                datasets: [{
                    data: [<?= $tagihan['total']; ?>]
                }]
            }
        });

    }

</script>