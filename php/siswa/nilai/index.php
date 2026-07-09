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

$nilai = mysqli_query($koneksi, "
SELECT
m.nama_mapel,
n.jenis_ujian,
n.nilai,
n.tanggal_ujian,
n.catatan
FROM nilai_ulangan n
JOIN pendaftaran_siswa ps
ON n.id_pendaftaran=ps.id_pendaftaran
JOIN mata_pelajaran m
ON n.id_mapel=m.id_mapel
WHERE ps.id_siswa='" . $siswa['id_siswa'] . "'
ORDER BY n.tanggal_ujian DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Nilai Saya</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Jenis Ujian</th>
                                <th>Nilai</th>
                                <th>Tanggal</th>
                                <th>Catatan</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($nilai)) {
                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['nama_mapel']; ?></td>

                                    <td><?= $row['jenis_ujian']; ?></td>

                                    <td><?= $row['nilai']; ?></td>

                                    <td><?= date('d-m-Y', strtotime($row['tanggal_ujian'])); ?></td>

                                    <td><?= $row['catatan']; ?></td>

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