<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo -->
    <a href="/Project_bimbel/php/admin/dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">
            Sistem Bimbel
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?php echo $_SESSION['username']; ?>
                </a>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">

                    <?php if ($_SESSION['role'] == "admin") { ?>

                        <a href="/Project_bimbel/php/admin/dashboard.php" class="nav-link">

                        <?php } elseif ($_SESSION['role'] == "pengajar") { ?>

                            <a href="/Project_bimbel/php/pengajar/dashboard.php" class="nav-link">

                            <?php } ?>

                            <i class="nav-icon fas fa-home"></i>

                            <p>Dashboard</p>

                        </a>

                </li>

                <?php if ($_SESSION['role'] == "admin") { ?>
                    <!-- Data Master -->
                    <li class="nav-item has-treeview">

                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/siswa/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/pengajar/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Pengajar</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/mapel/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mata Pelajaran</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/program/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Program Belajar</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/paket/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Paket Kelas</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/Project_bimbel/php/admin/kelas/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>

                        </ul>

                    </li>
                <?php } ?>
                <!-- Akademik -->
                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Akademik
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/jadwal/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/pendaftaran/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendaftaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/absensi/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absensi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/nilai/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nilai</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <!-- Keuangan -->
                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Keuangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/tagihan/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tagihan SPP</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/Project_bimbel/php/admin/pembayaran/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a href="/Project_bimbel/php/admin/laporan/index.php" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="/Project_bimbel/php/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>