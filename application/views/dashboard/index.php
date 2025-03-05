<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);
    </style>
    <?php $this->view('templates/head'); ?>
</head>

<body class="sb-nav-fixed">
    <?= $this->session->userdata('username') ?>
    <!-- Topbar -->
    <?php $this->view('templates/topbar'); ?>
    <!-- End Topbar -->

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <?php $this->view('templates/sidebar'); ?>
        <!-- End Sidebar -->

        <div id="layoutSidenav_content">
            <main>
                <div class="container p-md-3 p-2">
                    <!-- Alert -->
                    <?php $this->view('templates/alert'); ?>
                    <!-- End Alert -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Data Kependudukan Desa Sumberkledung
                        </div>
                        <div class="card-body bg-surface-secondary p-md-3 p-2 p-md-3 p-2">
                            <div class="row gy-2 px-md-5 px-0">
                                <div class="col-md-4 col-12">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">Jumlah Penduduk</a>
                                                    <span class="h3 font-bold mb-0"><?= $jumlah_penduduk ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Penduduk Laki-laki</span>
                                                    <span class="h3 font-bold mb-0"><?= $jumlah_laki_laki ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Penduduk Perempuan</span>
                                                    <span class="h3 font-bold mb-0"><?= $jumlah_perempuan ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Data Kependudukan Per RW
                        </div>
                        <div class="card-body bg-surface-secondary p-md-3 p-2">
                            <div class="row gy-2 px-md-5 px-0">
                                <div class="col-md-4 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rw=001") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RW 001</a>
                                                    <span class="h3 font-bold mb-0"><?= $rw1 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rw=002") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RW 002</a>
                                                    <span class="h3 font-bold mb-0"><?= $rw2 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rw=003") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RW 003</a>
                                                    <span class="h3 font-bold mb-0"><?= $rw3 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Data Kependudukan Per RT
                        </div>
                        <div class="card-body bg-surface-secondary p-md-3 p-2">
                            <div class="row gy-2 px-md-3 px-0">
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=001") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 001</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt1 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=002") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 002</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt2 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=003") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 003</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt3 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=004") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 004</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt4 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=005") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 005</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt5 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=006") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 006</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt6 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=007") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 007</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt7 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=008") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 008</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt8 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=009") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 009</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt9 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=010") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 010</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt10 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=011") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 011</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt11 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=012") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 012</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt12 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=013") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 013</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt13 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=014") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 014</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt14 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=015") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 015</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt15 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= $this->session->userdata('role') == 'penduduk' ? '#' : base_url("kependudukan?rt=016") ?>" class="h6 font-semibold text-muted text-sm d-block mb-2 text-decoration-none">RT 016</a>
                                                    <span class="h3 font-bold mb-0"><?= $rt16 ?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i>
                            Statistik Penduduk Desa Sumberkledung
                        </div>
                        <div class="card-body bg-surface-secondary">
                            <div class="row px-0">
                                <div class="col-md-6 col-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-pie me-1"></i>
                                            Jumlah Penduduk Berdasarkan Tingkat Pendidikan
                                        </div>
                                        <div class="card-body"><canvas id="pendidikan" width="100%" height="100"></canvas></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-pie me-1"></i>
                                            Jumlah Penduduk Berdasarkan Status Penikahan
                                        </div>
                                        <div class="card-body"><canvas id="pernikahan" width="100%" height="75"></canvas></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        let labels = [];
        let data = [];

        const pendidikan = [...<?= json_encode($jumlah_pendidikan) ?>];

        pendidikan.forEach(e => {
            labels.push(e.pendidikan);
            data.push(e.jumlah)
        })

        var ctx = document.getElementById("pendidikan");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data,
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#33FFA1', '#A133FF', '#FF8C00', '#8CFF00', '#008CFF', '#FF008C']
                }],
            },
        });

        labels = [];
        data = [];

        const pernikahan = [...<?= json_encode($jumlah_pernikahan) ?>];

        pernikahan.forEach(e => {
            labels.push(e.status_perkawinan);
            data.push(e.jumlah)
        })

        var ctx = document.getElementById("pernikahan");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data,
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#33FFA1', '#A133FF', '#FF8C00', '#8CFF00', '#008CFF', '#FF008C']
                }],
            },
        });
    </script>

</body>

</html>