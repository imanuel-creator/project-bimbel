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

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT *
FROM absensi_kelas
WHERE id_absensi='$id'
"));

$siswa = mysqli_query($koneksi,"
SELECT
ps.id_pendaftaran,
s.nama
FROM pendaftaran_siswa ps
JOIN siswa s
ON ps.id_siswa=s.id_siswa
WHERE ps.status='aktif'
ORDER BY s.nama
");

$jadwal = mysqli_query($koneksi,"
SELECT
j.id_jadwal,
m.nama_mapel,
j.hari,
j.jam_mulai
FROM jadwal_kelas j
JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
WHERE j.status='aktif'
ORDER BY j.hari
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Edit Absensi</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form action="proses_edit.php" method="POST">

                        <input type="hidden"
                               name="id_absensi"
                               value="<?= $data['id_absensi']; ?>">

                        <div class="form-group">

                            <label>Siswa</label>

                            <select name="id_pendaftaran" class="form-control" required>

                                <?php while($row=mysqli_fetch_assoc($siswa)){ ?>

                                    <option value="<?= $row['id_pendaftaran']; ?>"
                                        <?= ($row['id_pendaftaran']==$data['id_pendaftaran']) ? 'selected' : ''; ?>>

                                        <?= $row['nama']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Jadwal</label>

                            <select name="id_jadwal" class="form-control" required>

                                <?php while($row=mysqli_fetch_assoc($jadwal)){ ?>

                                    <option value="<?= $row['id_jadwal']; ?>"
                                        <?= ($row['id_jadwal']==$data['id_jadwal']) ? 'selected' : ''; ?>>

                                        <?= $row['nama_mapel']; ?> -
                                        <?= $row['hari']; ?> -
                                        <?= substr($row['jam_mulai'],0,5); ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Tanggal Absensi</label>

                            <input
                                type="date"
                                name="tanggal_absensi"
                                class="form-control"
                                value="<?= $data['tanggal_absensi']; ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="Hadir"
                                    <?= ($data['status']=="Hadir")?"selected":""; ?>>
                                    Hadir
                                </option>

                                <option value="Izin"
                                    <?= ($data['status']=="Izin")?"selected":""; ?>>
                                    Izin
                                </option>

                                <option value="Sakit"
                                    <?= ($data['status']=="Sakit")?"selected":""; ?>>
                                    Sakit
                                </option>

                                <option value="Alpa"
                                    <?= ($data['status']=="Alpa")?"selected":""; ?>>
                                    Alpa
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Keterangan</label>

                            <textarea
                                name="keterangan"
                                class="form-control"><?= $data['keterangan']; ?></textarea>

                        </div>

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Absensi

                        </button>

                        <a href="index.php" class="btn btn-secondary">

                            Kembali

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../../template/footer.php"; ?>