<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-4 mt-1 fw-semibold" style="letter-spacing: 0.2em;" href="<?= base_url('dashboard') ?>">SIMPELMASE</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>

    <span class="mr-2 d-none d-lg-inline text-white small" style="text-transform: capitalize;"><?= $this->session->userdata('nama') ?> | (<?= $this->session->userdata('role') ?>)</span>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!-- <li><a class="dropdown-item" href="#!">Ubah Password</a></li> -->
                <!-- <li>
                    <hr class="dropdown-divider" />
                </li> -->
                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</button></li>
            </ul>
        </li>
    </ul>
</nav>