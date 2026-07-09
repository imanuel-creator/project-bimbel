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

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT * FROM nilai_ulangan
WHERE id_nilai='$id'
"));

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
            <h1>Edit Nilai</h1>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    <form action="proses_edit.php" method="POST">

                        <input type="hidden" name="id_nilai" value="<?= $data['id_nilai']; ?>">

                        <div class="form-group">
                            <label>Siswa</label>

                            <select name="id_pendaftaran" class="form-control" required>

                                <?php while ($row = mysqli_fetch_assoc($siswa)) { ?>

                                    <option value="<?= $row['id_pendaftaran']; ?>"
                                        <?= ($row['id_pendaftaran'] == $data['id_pendaftaran']) ? 'selected' : ''; ?>>

                                        <?= $row['nama']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Mata Pelajaran</label>

                            <select name="id_mapel" class="form-control" required>

                                <?php while ($row = mysqli_fetch_assoc($mapel)) { ?>

                                    <option value="<?= $row['id_mapel']; ?>" <?= ($row['id_mapel'] == $data['id_mapel']) ? 'selected' : ''; ?>>

                                        <?= $row['nama_mapel']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Jenis Ujian</label>

                            <select name="jenis_ujian" class="form-control">

                                <option <?= ($data['jenis_ujian'] == "Quiz") ? "selected" : ""; ?>>Quiz</option>

                                <option <?= ($data['jenis_ujian'] == "UTS") ? "selected" : ""; ?>>UTS</option>

                                <option <?= ($data['jenis_ujian'] == "UAS") ? "selected" : ""; ?>>UAS</option>

                                <option <?= ($data['jenis_ujian'] == "Try Out") ? "selected" : ""; ?>>Try Out</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Nilai</label>

                            <input type="number" step="0.01" name="nilai" class="form-control"
                                value="<?= $data['nilai']; ?>" required>

                        </div>

                        <div class="form-group">

                            <label>Tanggal Ujian</label>

                            <input type="date" name="tanggal_ujian" class="form-control"
                                value="<?= $data['tanggal_ujian']; ?>" required>

                        </div>

                        <div class="form-group">

                            <label>Catatan</label>

                            <textarea name="catatan" class="form-control"><?= $data['catatan']; ?></textarea>

                        </div>

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Nilai

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