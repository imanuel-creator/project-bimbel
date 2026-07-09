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

$siswa = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT id_siswa
FROM siswa
WHERE id_user='$id_user'
"));

$tagihan = mysqli_query($koneksi,"
SELECT
t.periode,
t.tanggal_tagihan,
t.jatuh_tempo,
t.jumlah_tagihan,
t.status
FROM tagihan_spp t
JOIN pendaftaran_siswa ps
ON t.id_pendaftaran = ps.id_pendaftaran
WHERE ps.id_siswa='".$siswa['id_siswa']."'
ORDER BY t.periode DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Tagihan SPP</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">Daftar Tagihan</h3>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Periode</th>
                                <th>Tanggal Tagihan</th>
                                <th>Jatuh Tempo</th>
                                <th>Jumlah</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            while($row = mysqli_fetch_assoc($tagihan)){
                            ?>

                            <tr>

                                <td><?= $no++; ?></td>

                                <td><?= $row['periode']; ?></td>

                                <td><?= date('d-m-Y', strtotime($row['tanggal_tagihan'])); ?></td>

                                <td><?= date('d-m-Y', strtotime($row['jatuh_tempo'])); ?></td>

                                <td>
                                    Rp <?= number_format($row['jumlah_tagihan'],0,',','.'); ?>
                                </td>

                                <td>

                                    <?php if($row['status']=="Lunas"){ ?>

                                        <span class="badge badge-success">
                                            Lunas
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge badge-danger">
                                            Belum Lunas
                                        </span>

                                    <?php } ?>

                                </td>

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