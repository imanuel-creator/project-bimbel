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
/* Ambil data pengajar */
$pengajar = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT id_pengajar,nama
FROM pengajar
WHERE id_user='" . $_SESSION['id_user'] . "'
"));

$id_pengajar = $pengajar['id_pengajar'];

/* Daftar nilai */

$nilai = mysqli_query($koneksi, "
SELECT
    n.id_nilai,
    s.nama,
    m.nama_mapel,
    n.jenis_ujian,
    n.nilai,
    n.tanggal_ujian
FROM nilai_ulangan n
JOIN pendaftaran_siswa ps
    ON n.id_pendaftaran = ps.id_pendaftaran
JOIN siswa s
    ON ps.id_siswa = s.id_siswa
JOIN mata_pelajaran m
    ON n.id_mapel = m.id_mapel
ORDER BY n.tanggal_ujian DESC
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Data Nilai</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card card-success card-outline">

                <div class="card-header">

                    <h3 class="card-title">Daftar Nilai</h3>

                    <div class="card-tools">
                        <a href="tambah.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Nilai
                        </a>
                    </div>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Siswa</th>
                                <th>Mata Pelajaran</th>
                                <th>Jenis Ujian</th>
                                <th>Nilai</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $no = 1;

                            while ($row = mysqli_fetch_assoc($nilai)) {

                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['nama']; ?></td>

                                    <td><?= $row['nama_mapel']; ?></td>

                                    <td><?= $row['jenis_ujian']; ?></td>

                                    <td><?= $row['nilai']; ?></td>

                                    <td><?= date('d-m-Y', strtotime($row['tanggal_ujian'])); ?></td>
                                    <td>

                                        <a href="edit.php?id=<?= $row['id_nilai']; ?>" class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <a href="hapus.php?id=<?= $row['id_nilai']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus nilai ini?')">

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