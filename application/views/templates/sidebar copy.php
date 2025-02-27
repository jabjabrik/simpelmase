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
                    <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        Data Penduduk
                    </a>
                    <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        Aset Penduduk
                    </a>
                    <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        PKH
                    </a>
                <?php endif ?>

                <div class="sb-sidenav-menu-heading">Dokumen Penduduk</div>
                <a class="nav-link <?= $title == 'SK Usaha' ? 'active' : '' ?>" href="<?= base_url('surat/sk_usaha') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Usaha
                </a>
                <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Domisili
                </a>
                <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Kematian
                </a>
                <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    SK. Kelahiran
                </a>
                <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
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



                <div class="sb-sidenav-menu-heading">Master</div>
                <a class="nav-link <?= $title == 'Kependudukan' ? 'active' : '' ?>" href="<?= base_url('kependudukan') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </div>
                    Kependudukan
                </a>
                <?php if ($this->session->userdata('role') == 'sekretaris desa') : ?>
                    <a class="nav-link <?= $title == 'User' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        User
                    </a>
                <?php endif ?>
                <div class="sb-sidenav-menu-heading">Transaksi</div>
                <a class="nav-link <?= $title == 'SK Usaha' || $title == 'SK Kematian' ?  "" : "collapsed" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    Dokumen
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>
                <div class="collapse <?= strstr($title, 'SK') ? 'show' : '' ?>" id="collapse" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link <?= $title == 'SK Usaha' || $title == 'SK Kematian' ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth1">
                            Buat Surat
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse <?= !strstr($title, 'Serah') && strstr($title, 'SK') ? 'show' : '' ?>" id="pagesCollapseAuth1" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link p-2 <?= $title == 'SK Usaha' ? 'active' : '' ?>" href="<?= base_url('surat/sk_usaha') ?>">SK. Usaha</a>
                                <a class="nav-link p-2 <?= $title == 'SK Domisili' ? 'active' : '' ?>" href="<?= base_url('surat/sk_domisili') ?>">SK. Domisili</a>
                                <a class="nav-link p-2 <?= $title == 'SK Kematian' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kematian') ?>">SK. Kematian</a>
                                <a class="nav-link p-2 <?= $title == 'SK Kelahiran' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kelahiran') ?>">SK. Kelahiran</a>
                                <a class="nav-link p-2 <?= $title == 'SK Kehilangan' ? 'active' : '' ?>" href="<?= base_url('surat/sk_kehilangan') ?>">SK. Kehilangan</a>
                            </nav>
                        </div>
                        <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                            <a class="nav-link <?= $title == 'Serah terima SK Usaha' ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Serah Terima Surat
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse <?= strstr($title, 'Serah') && strstr($title, 'SK') ? 'show' : '' ?>" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link p-2 <?= $title == 'Serah terima SK Usaha' ? 'active' : '' ?>" href="<?= base_url('serahterima/sk_usaha') ?>">SK. Usaha</a>
                                    <a class="nav-link p-2 <?= $title == 'Serah terima SK Domisili' ? 'active' : '' ?>" href="<?= base_url('serahterima/sk_domisili') ?>">SK. Domisili</a>
                                    <a class="nav-link p-2 <?= $title == 'Serah terima SK Kematian' ? 'active' : '' ?>" href="<?= base_url('serahterima/sk_kematian') ?>">SK. Kematian</a>
                                    <a class="nav-link p-2 <?= $title == 'Serah terima SK Kelahiran' ? 'active' : '' ?>" href="<?= base_url('serahterima/sk_kelahiran') ?>">SK. Kelahiran</a>
                                    <a class="nav-link p-2 <?= $title == 'Serah terima SK Kehilangan' ? 'active' : '' ?>" href="<?= base_url('serahterima/sk_kehilangan') ?>">SK. Kehilangan</a>
                                </nav>
                            </div>
                        <?php endif ?>
                    </nav>
                </div>
                <?php if ($this->session->userdata('role') != 'penduduk') : ?>

                    <a class="nav-link <?= $title == 'Aset' ? 'active' : '' ?>" href="<?= base_url('aset') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        Aset kependudukan
                    </a>
                    <a class="nav-link <?= $title == 'PKH' ? 'active' : '' ?>" href="<?= base_url('pkh') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        PKH
                    </a>
                <?php endif ?>
                <div class="sb-sidenav-menu-heading">Akun</div>
                <a class="nav-link <?= $title == 'Email' ? 'active' : '' ?>" href="<?= base_url('account/email') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    Info Login
                </a>
                <a class="nav-link <?= $title == 'Change Password' ? 'active' : '' ?>" href="<?= base_url('account/changepassword') ?>">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    Change Password
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