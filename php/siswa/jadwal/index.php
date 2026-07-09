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

$jadwal = mysqli_query($koneksi, "
SELECT
j.hari,
j.jam_mulai,
j.jam_selesai,
m.nama_mapel,
k.nama_kelas,
p.nama AS pengajar
FROM pendaftaran_siswa ps
JOIN kelas k
ON ps.id_kelas=k.id_kelas
JOIN jadwal_kelas j
ON k.id_kelas=j.id_kelas
JOIN mata_pelajaran m
ON j.id_mapel=m.id_mapel
JOIN pengajar p
ON j.id_pengajar=p.id_pengajar
WHERE ps.id_siswa='" . $siswa['id_siswa'] . "'
AND ps.status='aktif'
AND j.status='aktif'
ORDER BY
FIELD(j.hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'),
j.jam_mulai
");
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Jadwal Belajar</h1>

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
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Pengajar</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($jadwal)) {
                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['hari']; ?></td>

                                    <td><?= substr($row['jam_mulai'], 0, 5); ?> -
                                        <?= substr($row['jam_selesai'], 0, 5); ?>
                                    </td>

                                    <td><?= $row['nama_mapel']; ?></td>

                                    <td><?= $row['nama_kelas']; ?></td>

                                    <td><?= $row['pengajar']; ?></td>

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