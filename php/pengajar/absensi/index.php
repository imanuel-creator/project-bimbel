<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "pengajar") {
    header("Location: ../../login.php");
    exit;
}

include "../../config/koneksi.php";
include "../../template/header.php";
include "../../template/navbar.php";
include "../../template/sidebar_pengajar.php";

$absensi = mysqli_query($koneksi, "
SELECT
a.id_absensi,
s.nama,
j.hari,
m.nama_mapel,
a.tanggal_absensi,
a.status
FROM absensi_kelas a
JOIN pendaftaran_siswa ps
ON a.id_pendaftaran=ps.id_pendaftaran
JOIN siswa s
ON ps.id_siswa=s.id_siswa
JOIN jadwal_kelas j
ON a.id_jadwal=j.id_jadwal
JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
ORDER BY a.tanggal_absensi DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Data Absensi</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">Daftar Absensi</h3>

                    <div class="card-tools">

                        <a href="tambah.php" class="btn btn-primary btn-sm">

                            <i class="fas fa-plus"></i>

                            Tambah Absensi

                        </a>

                    </div>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Siswa</th>
                                <th>Mapel</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            while ($row = mysqli_fetch_assoc($absensi)) {
                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['nama']; ?></td>

                                    <td><?= $row['nama_mapel']; ?></td>

                                    <td><?= $row['hari']; ?></td>

                                    <td><?= date('d-m-Y', strtotime($row['tanggal_absensi'])); ?></td>

                                    <td><?= $row['status']; ?></td>

                                    <td>

                                        <a href="edit.php?id=<?= $row['id_absensi']; ?>" class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <a href="hapus.php?id=<?= $row['id_absensi']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus absensi ini?')">

                                            <i class="fas fa-trash"></i>

                                        </a>

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