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

$absensi = mysqli_query($koneksi, "
SELECT
a.tanggal_absensi,
a.status,
a.keterangan,
m.nama_mapel,
j.hari
FROM absensi_kelas a
JOIN pendaftaran_siswa ps
ON a.id_pendaftaran=ps.id_pendaftaran
JOIN jadwal_kelas j
ON a.id_jadwal=j.id_jadwal
JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
WHERE ps.id_siswa='" . $siswa['id_siswa'] . "'
ORDER BY a.tanggal_absensi DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Absensi Saya</h1>

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
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Mata Pelajaran</th>
                                <th>Status</th>
                                <th>Keterangan</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($absensi)) {
                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= date('d-m-Y', strtotime($row['tanggal_absensi'])); ?></td>

                                    <td><?= $row['hari']; ?></td>

                                    <td><?= $row['nama_mapel']; ?></td>

                                    <td><?= $row['status']; ?></td>

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