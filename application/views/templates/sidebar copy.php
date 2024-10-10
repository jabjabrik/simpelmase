<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-10">
            <img src="<?= base_url('assets/img/logo/logopemkab.png') ?>" style="width: 30px; height: 30px;">
        </div>
        <div class="sidebar-brand-text mx-2">Simpelmase</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Dokumen
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item <?= $title == 'SK Usaha' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pembuatan Surat</span>
        </a>
        <div id="collapse2" class="collapse <?= $title == 'SK Usaha' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Keterangan:</h6>
                <a class="collapse-item <?= $title == 'SK Usaha' ? 'active' : '' ?>" href="<?= base_url('sk_usaha'); ?>">Usaha</a>
                <a class="collapse-item" href="buttons.html">Kelahiran</a>
                <a class="collapse-item" href="buttons.html">Hilang</a>
                <a class="collapse-item" href="buttons.html">Domisili Perorangan</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= $title == 'Serah terima SKU' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
            <i class="fas fa-fw fa-cog"></i>
            <span>Serah Terima Surat</span>
        </a>
        <div id="collapse6" class="collapse <?= $title == 'Serah terima SKU' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Keterangan:</h6>
                <a class="collapse-item  <?= $title == 'Serah terima SKU' ? 'active' : '' ?>" href="<?= base_url('serah_terima/sk_usaha'); ?>">Usaha</a>
                <a class="collapse-item" href="buttons.html">Kelahiran</a>
                <a class="collapse-item" href="buttons.html">Hilang</a>
                <a class="collapse-item" href="buttons.html">Domisili Perorangan</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kekependudukanan</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Data kependudukanan</a>
                <a class="collapse-item" href="buttons.html">Data Keluarga</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
            <i class="fas fa-fw fa-cog"></i>
            <span>Lainnya</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Kelola User</a>
                <a class="collapse-item" href="buttons.html">Nomor Surat</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Laporan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
            <i class="fas fa-fw fa-cog"></i>
            <span>Dokumen Surat</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Keterangan:</h6>
                <a class="collapse-item" href="buttons.html">Usaha</a>
                <a class="collapse-item" href="buttons.html">Kelahiran</a>
                <a class="collapse-item" href="buttons.html">Hilang</a>
                <a class="collapse-item" href="buttons.html">Domisili Perorangan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data kependudukan</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- <div class="sidebar-heading">
        Profile
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
            <i class="fas fa-fw fa-cog"></i>
            <span>My Profile</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Detail Profile</a>
                <a class="collapse-item" href="buttons.html">Edit Profile</a>
                <a class="collapse-item" href="buttons.html">Ganti Password</a>
            </div>
        </div>
    </li> -->
</ul>