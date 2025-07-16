<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
    <style>
        #link {
            text-decoration: none;
            color: inherit;
        }

        #link:hover {
            text-decoration: underline;
            color: blue;
        }
    </style>
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
                    <h3 class="mt-4">Bantuan Sosial Penduduk</h3>
                    <div class="btn-group btn-group-sm " role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('bansos') ?>">Semua</a></li>
                            <?php
                            $distinct_bansos = [];
                            foreach ($data_result as $bansos) {
                                $distinct_bansos[$bansos->jenis] = $bansos;
                            }
                            foreach ($distinct_bansos as $bansos) : ?>
                                <li><a class="dropdown-item" href="<?= base_url("bansos?f=$bansos->jenis") ?>"><?= $bansos->jenis ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <a href="<?= base_url("bansos/report/$filter"); ?>" class="btn btn-sm btn-success" target="_blank">
                        <i class="bi bi-printer"></i> Report
                    </a>

                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Kependudukan Sumberkledung
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No KK</th>
                                        <th>Nama Penduduk</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Penetapan</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($data_result as $item) : ?>
                                        <?php if ($item->jenis != $filter && $filter != '') continue; ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item->no_kk ?></td>
                                            <td><?= $item->nama_penduduk ?></td>
                                            <td><?= $item->jenis ?></td>
                                            <td><?= $item->keterangan ?></td>
                                            <td><?= date('d-m-Y', strtotime($item->tanggal_penetapan)) ?></td>
                                            <td><?= $item->nilai ?></td>
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