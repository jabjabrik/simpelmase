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
                <div class="container-fluid p-4">
                    <!-- Alert -->
                    <?php $this->view('templates/alert'); ?>
                    <!-- End Alert -->

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Template Nomor Surat
                        </div>
                        <div class="card-body">
                            <table id="datatables" class="table-striped text-capitalize">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Surat</th>
                                        <th>Nomor Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($no_surat as $item) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $item->nama_surat ?></td>
                                            <td><?= $item->no_surat ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <?php $nosurat = "$item->nama_surat,$item->no_surat" ?>
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', '<?= $nosurat ?>', '<?= $item->id_nosurat ?>')">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <a href="<?= base_url("surat/no_surat_delete/$item->id_nosurat") ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
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
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form">Tambah Data Nomor Surat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('surat/no_surat_create') ?>" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_nosurat" id="id_nosurat" hidden>
                            <div class="form-group col-6">
                                <label for="nama_surat" class="form-label">Nama Surat</label>
                                <input type="text" name="nama_surat" id="nama_surat" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="no_surat" id="no_surat" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
        // const btnModalSubmit = document.querySelector('#btn-modal-submit')
        const id_nosurat = document.querySelector('#id_nosurat');
        const nama_surat = document.querySelector('#nama_surat');
        const no_surat = document.querySelector('#no_surat');

        const clearForm = () => {
            // btnModalSubmit.removeAttribute('hidden')
            id_nosurat.value = ''
            nama_surat.value = ''
            no_surat.value = ''

            id_nosurat.removeAttribute('disabled')
            nama_surat.removeAttribute('disabled')
            no_surat.removeAttribute('disabled')
        }

        const setForm = (title, data, id = null) => {
            clearForm()
            modalTitle.innerHTML = `${title} Data Nomor Surat`

            if (title === 'tambah') {
                // ADD
                modalForm.setAttribute('action', '<?= base_url('surat/no_surat_create') ?>')
                return
            }

            if (title === 'edit') {
                // EDIT
                modalForm.setAttribute('action', '<?= base_url('surat/no_surat_edit') ?>')
                const nosurat = data.split(',');
                nama_surat.value = nosurat[0]
                no_surat.value = nosurat[1]
                id_nosurat.value = id;
                return
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