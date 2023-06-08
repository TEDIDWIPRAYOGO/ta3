        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pengaduan<sup></sup></div>
            </a>


            <?php if (in_groups('admin')) : ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/index'); ?>">
                        <i class="fas fa-fw fa-tachometer-alt text-gray-300"></i>
                        <span>Dashboard</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaduan
            </div>


            <!-- Nav Item - Tabel Pengaduan -->
            <li class="nav-item">
                <a class="nav-link" href="/pengaduan">
                    <i class="fas fa-fw fa-chart-area text-gray-300"></i>
                    <span>Pengaduan</span></a>
            </li>

            <?php if (in_groups('admin')) : ?>
                <!-- Nav Item - Tabel Pengaduan -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/userlist'); ?>">
                        <i class="fas fa-users text-gray-300"></i>
                        <span>User List</span></a>
                </li>
            <?php endif; ?>

            <?php if (in_groups('admin')) : ?>
                <!-- Nav Item - Report -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/report'); ?>">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        <span>Laporan</span></a>
                </li>
            <?php endif; ?>

            <!-- Nav Item - Edit Profile -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user/index'); ?>">
                    <i class="fas fa-user-edit text-gray-300"></i>
                    <span>Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout'); ?>">
                    <i class="fas fa-sign-out-alt text-gray-300"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->