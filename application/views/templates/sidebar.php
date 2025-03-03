<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                    <div class="sb-sidenav-menu-heading"></div>
                    <a class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">User</div>
                    <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        Kelola User
                    </a>
                    <div class="sb-sidenav-menu-heading">Kependudukan</div>
                    <a class="nav-link <?= $title == 'Kependudukan' ? 'active' : '' ?>" href="<?= base_url('kependudukan') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        Data Penduduk
                    </a>
                    <a class="nav-link <?= $title == 'Pendataan KTP' ? 'active' : '' ?>" href="<?= base_url('ktp') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-file-earmark-post"></i>
                        </div>
                        Pendataan KTP
                    </a>
                <?php endif ?>

                <div class="sb-sidenav-menu-heading">Dokumen Penduduk</div>
                <a class="nav-link <?= $title == 'SK Usaha' ? 'active' : '' ?>" href="<?= base_url('surat/sk_usaha') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Usaha
                </a>
                <a class="nav-link <?= $title == 'SK Domisili' ? 'active' : '' ?>" href="<?= base_url('surat/sk_domisili') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Domisili
                </a>
                <a class="nav-link <?= $title == 'SK Kematian' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kematian') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Kematian
                </a>
                <a class="nav-link <?= $title == 'SK Kelahiran' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kelahiran') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Kelahiran
                </a>
                <a class="nav-link <?= $title == 'SK Kehilangan' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kehilangan') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Kehilangan
                </a>
                <div class="sb-sidenav-menu-heading">Akun</div>
                <a class="nav-link <?= $title == 'Change Password' ? 'active' : '' ?>" href="<?= base_url('account/changepassword') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    Ubah Password
                </a>
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    Logout
                </a>
            </div>
        </div>
    </nav>
</div>