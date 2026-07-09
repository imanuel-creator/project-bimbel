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
/* Ambil data siswa */
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

/* Ambil mata pelajaran */
$mapel = mysqli_query($koneksi, "
SELECT
id_mapel,
nama_mapel
FROM mata_pelajaran
WHERE status='aktif'
ORDER BY nama_mapel
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Tambah Nilai</h1>

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

                            <label>Mata Pelajaran</label>

                            <select name="id_mapel" class="form-control" required>

                                <option value="">-- Pilih Mapel --</option>

                                <?php while ($row = mysqli_fetch_assoc($mapel)) { ?>

                                    <option value="<?= $row['id_mapel']; ?>">

                                        <?= $row['nama_mapel']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Jenis Ujian</label>

                            <select name="jenis_ujian" class="form-control">

                                <option>Quiz</option>

                                <option>UTS</option>

                                <option>UAS</option>

                                <option>Try Out</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Nilai</label>

                            <input type="number" name="nilai" class="form-control" min="0" max="100" required>

                        </div>

                        <div class="form-group">

                            <label>Tanggal Ujian</label>

                            <input type="date" name="tanggal_ujian" class="form-control" required>

                        </div>

                        <div class="form-group">

                            <label>Catatan</label>

                            <textarea name="catatan" class="form-control"></textarea>

                        </div>

                        <button class="btn btn-success">

                            Simpan Nilai

                        </button>

                    </form>
                </div>

            </div>

        </div>

    </section>

</div>

<?php include "../../template/footer.php"; ?>