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

/* Data siswa */
$siswa = mysqli_query($koneksi, "
SELECT
ps.id_pendaftaran,
s.nama
FROM pendaftaran_siswa ps
JOIN siswa s
ON ps.id_siswa=s.id_siswa
WHERE ps.status='aktif'
ORDER BY s.nama
");

/* Data jadwal */
$jadwal = mysqli_query($koneksi, "
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

            <h1>Tambah Absensi</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form action="proses_tambah.php" method="POST">

                        <div class="form-group">

                            <label>Siswa</label>

                            <select name="id_pendaftaran" class="form-control" required>

                                <option value="">-- Pilih Siswa --</option>

                                <?php while ($row = mysqli_fetch_assoc($siswa)) { ?>

                                    <option value="<?= $row['id_pendaftaran']; ?>">

                                        <?= $row['nama']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Jadwal</label>

                            <select name="id_jadwal" class="form-control" required>

                                <option value="">-- Pilih Jadwal --</option>

                                <?php while ($row = mysqli_fetch_assoc($jadwal)) { ?>

                                    <option value="<?= $row['id_jadwal']; ?>">

                                        <?= $row['nama_mapel']; ?> -
                                        <?= $row['hari']; ?> -
                                        <?= substr($row['jam_mulai'], 0, 5); ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Tanggal</label>

                            <input type="date" name="tanggal_absensi" class="form-control" required>

                        </div>

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option>Hadir</option>
                                <option>Izin</option>
                                <option>Sakit</option>
                                <option>Alpa</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Keterangan</label>

                            <textarea name="keterangan" class="form-control"></textarea>

                        </div>

                        <button class="btn btn-success">

                            Simpan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../../template/footer.php"; ?>