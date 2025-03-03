<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
</head>

<body class="sb-nav-fixed">
    <!-- Topbar -->
    <?php $this->view('templates/topbar'); ?>
    <!-- End Topbar -->

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <?php $this->view('templates/sidebar'); ?>
        <!-- End Sidebar -->

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid p-3">
                    <!-- Alert -->
                    <?php $this->view('templates/alert'); ?>
                    <!-- End Alert -->
                    <h3 class="mt-4">Pendataan KTP Penduduk</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Penduduk</li>
                    </ol>

                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Kependudukan Sumberkledung
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenkel</th>
                                        <th>Usia</th>
                                        <th>Hub.Keluarga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($data_result as $item) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item->nik ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td><?= $item->jenis_kelamin ?></td>
                                            <td><?= convert_usia($item->tanggal_lahir) ?> Tahun</td>
                                            <td><?= $item->hubungan_keluarga ?></td>
                                            <td>
                                                <?php if ($item->status_ktp == 'memiliki KTP'): ?>
                                                    <i class="text-success bi bi-check-circle-fill"></i>
                                                    <span>Memiliki KTP</span>
                                                <?php endif; ?>
                                                <?php if ($item->status_ktp == 'belum diketahui' && convert_usia($item->tanggal_lahir) >= 17): ?>
                                                    <span>Belum diketahui</span>
                                                <?php endif; ?>
                                                <?php if ($item->status_ktp == 'belum memiliki KTP'): ?>
                                                    <i class="text-danger bi bi-x-octagon-fill"></i>
                                                    <span>belum memiliki KTP</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_kelas">
                                                    <i class="bi bi-gear"></i>
                                                </button>
                                                <a href="<?= base_url("kependudukan/kk/$item->no_kk") ?>" target="_blank" class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-box-arrow-right"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>