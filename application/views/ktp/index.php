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
                    <h3 class="mt-4">Pendataan KTP Penduduk <?= $op == '>' ? 'Diatas 17 Tahun' : 'Dibawah 17 Tahun' ?></h3>
                    <ol class="breadcrumb mb-4">
                        <?php if (empty($filter)): ?>
                            <li class="breadcrumb-item active">Semua Penduduk</li>
                        <?php else: ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('ktp'); ?>">Semua Penduduk</a></li>
                            <li class="breadcrumb-item active"><?= $filter == 1 ? 'Belum Diketahui' : ($filter == 2 ? 'Memiliki KTP' : 'Belum Memiliki KTP'); ?></li>
                        <?php endif; ?>
                    </ol>
                    <div class="btn-group btn-group-sm " role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('ktp?op=>') ?>">> 17 Tahun</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('ktp?op=<') ?>">
                                    < 17 Tahun</a>
                            </li>
                        </ul>
                    </div>

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
                                        <?php if ($op == '>'): ?>
                                            <th>Status</th>
                                        <?php endif; ?>
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
                                            <?php if ($op == '>'): ?>
                                                <td>
                                                    <?php if ($item->status_ktp == 'memiliki KTP'): ?>
                                                        <i class="text-success bi bi-check-circle-fill"></i>
                                                        <a id="link" href="<?= base_url('ktp?f=2'); ?>">Memiliki KTP</a>
                                                    <?php endif; ?>
                                                    <?php if ($item->status_ktp == 'belum diketahui' && convert_usia($item->tanggal_lahir) >= 17): ?>
                                                        <a id="link" href="<?= base_url('ktp?f=1'); ?>">Belum diketahui</a>
                                                    <?php endif; ?>
                                                    <?php if ($item->status_ktp == 'belum memiliki KTP'): ?>
                                                        <i class="text-danger bi bi-x-octagon-fill"></i>
                                                        <a id="link" href="<?= base_url('ktp?f=3'); ?>">belum memiliki KTP</a>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>

                                            <td>
                                                <?php $params = "[`$item->id_kependudukan`,`$item->status_ktp`]" ?>
                                                <?php if ($op == '>'): ?>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_ktp" onclick="setForm(<?= $params ?>);">
                                                        <i class="bi bi-gear"></i>
                                                    </button>
                                                <?php endif; ?>
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

    <div class="modal fade" id="modal_ktp" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Kepemilikan KTP</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('ktp/edit'); ?>" method="post">
                    <div class="modal-body">
                        <input name="id_kependudukan" id="id_kependudukan" hidden>
                        <select class="form-select" name="status_ktp" id="status_ktp">
                            <option value="belum diketahui">Belum diketahui</option>
                            <option value="memiliki KTP">Memiliki KTP</option>
                            <option value="belum memiliki KTP">Belum memiliki KTP</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const id_kependudukan = document.querySelector('#id_kependudukan');
        const status_ktp = document.querySelector('#status_ktp');

        const setForm = ([_id_kependudukan, _status_ktp]) => {
            id_kependudukan.value = _id_kependudukan;
            status_ktp.value = _status_ktp;
        }
    </script>

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>