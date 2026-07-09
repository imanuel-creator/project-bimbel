<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";
include "../../template/header.php";
include "../../template/navbar.php";
include "../../template/sidebar_siswa.php";

$id_user = $_SESSION['id_user'];

$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT id_siswa
FROM siswa
WHERE id_user='$id_user'
"));

$pembayaran = mysqli_query($koneksi, "
SELECT
t.periode,
p.tanggal_bayar,
p.jumlah_bayar,
p.metode_pembayaran,
p.keterangan
FROM pembayaran_spp p
JOIN tagihan_spp t
ON p.id_tagihan=t.id_tagihan
JOIN pendaftaran_siswa ps
ON t.id_pendaftaran=ps.id_pendaftaran
WHERE ps.id_siswa='" . $siswa['id_siswa'] . "'
ORDER BY p.tanggal_bayar DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Riwayat Pembayaran</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        Riwayat Pembayaran SPP

                    </h3>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Periode</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Keterangan</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $no = 1;

                            while ($row = mysqli_fetch_assoc($pembayaran)) {

                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['periode']; ?></td>

                                    <td><?= date('d-m-Y', strtotime($row['tanggal_bayar'])); ?></td>

                                    <td>

                                        Rp <?= number_format($row['jumlah_bayar'], 0, ',', '.'); ?>

                                    </td>

                                    <td><?= $row['metode_pembayaran']; ?></td>

                                    <td><?= $row['keterangan']; ?></td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../../template/footer.php"; ?>