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

                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Program Keluarga Harapan (PKH) Sumberkledung
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>No KK</th>
                                        <th>Nama</th>
                                        <th>status</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($pkh as $item) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $item->nik ?></td>
                                            <td><?= $item->no_kk ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td><?= $item->status ? $item->status : '-' ?></td>
                                            <td><?= $item->tanggal ? $item->tanggal : '-' ?></td>
                                            <td><?= $item->nominal ? $item->nominal : '-' ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <?php if (!$item->id_kependudukan) : ?>
                                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah', '', '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-plus-circle"></i> Daftarkan
                                                        </button>
                                                    <?php else : ?>
                                                        <?php $pkh_update = "$item->status,$item->tanggal,$item->nominal"; ?>
                                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', '<?= $pkh_update ?>', '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <a href="<?= base_url("pkh/delete/$item->id_penduduk") ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');"><i class="bi bi-trash"></i></a>
                                                    <?php endif ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form">Tambah Data PKH</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('pkh/create') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select text-capitalize" name="status" id="status" required>
                                    <option value="" selected>--</option>
                                    <option value="aktif">aktif</option>
                                    <option value="tidak aktif">tidak aktif</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="tanggal" class="form-label">Tanggal Penetapan</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="nominal" class="form-label">Nominal Bantuan</label>
                                <input type="number" name="nominal" id="nominal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="btn-modal-submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Form -->

    <!-- Script Modal Form -->
    <script>
        const modalTitle = document.querySelector('.modal-title')
        const modalForm = document.querySelector('#modal-form')
        const btnModalSubmit = document.querySelector('#btn-modal-submit')
        const id_kependudukan = document.querySelector('#id_kependudukan');
        const status = document.querySelector('#status');
        const tanggal = document.querySelector('#tanggal');
        const nominal = document.querySelector('#nominal');

        const clearForm = () => {
            id_kependudukan.value = ''
            status.value = ''
            tanggal.value = ''
            nominal.value = ''
        }

        const setForm = (title, data, id = null) => {
            clearForm()
            modalTitle.innerHTML = `${title} Data PKH`
            console.log(id);
            id_kependudukan.value = id

            if (title === 'tambah') {
                // ADD
                modalForm.setAttribute('action', '<?= base_url('pkh/create') ?>')
                return
            }

            const kependudukan = data.split(',');
            status.value = kependudukan[0]
            tanggal.value = kependudukan[1]
            nominal.value = kependudukan[2]

            if (title === 'edit') {
                // EDIT
                modalForm.setAttribute('action', '<?= base_url('pkh/edit') ?>')
                return
            }
        }

        const showPreview = (event) => {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                foto_rumah_preview.setAttribute('src', src)
            }
        }
    </script>
    <!-- End Script Modal Form -->

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>