<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/Project_bimbel/php/pengajar/dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">
            Sistem Bimbel
        </span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?= $_SESSION['username']; ?>
                </a>
            </div>
        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
                    <a href="/Project_bimbel/php/pengajar/dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/Project_bimbel/php/pengajar/jadwal/index.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jadwal Mengajar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/Project_bimbel/php/pengajar/nilai/index.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Input Nilai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Project_bimbel/php/pengajar/absensi/index.php" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Input Absensi</p>
                    </a>
                </li>
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