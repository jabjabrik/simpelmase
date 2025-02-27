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
                            Daftar Data User
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Penduduk</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_result as $item) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $item->nik ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td class="text-lowercase"><?= $item->username ?></td>
                                            <td>...</td>
                                            <td><?= $item->role ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <?php if (!$item->id_user) : ?>
                                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('insert', '', '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-plus-circle"></i>
                                                        </button>
                                                    <?php else : ?>
                                                        <?php $params = "[`$item->username`,`$item->role`]" ?>
                                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', <?= $params ?>, '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <a href="<?= base_url("user/delete/$item->id_user") ?>" type="button" class="btn btn-outline-danger <?= $item->role === 'sekretaris desa' ? 'disabled' : '' ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php endif ?>
                                                </div>
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

    <!-- Modal Form -->
    <div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" method="POST">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-m-6 col-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group col-m-6 col-12">
                                <label for="password" class="form-label">Masukan Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <div style="position: relative;">
                                    <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                    <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                </div>
                                <div id="passwordHelpBlock" class="form-text">
                                    Biarkan Input Password Kosong, Bila Tidak Ingin Merubah Password
                                </div>
                            </div>
                            <div class="form-group col-m-6 col-12">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="" selected>--</option>
                                    <option value="kepala desa">kepala desa</option>
                                    <option value="sekretaris desa">sekretaris desa</option>
                                    <option value="penduduk">penduduk</option>
                                </select>
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

    <!-- Script Eye Password -->
    <script>
        const password = document.querySelector('#password');
        const [show, hidden] = document.querySelectorAll('#eye');

        hidden.addEventListener('click', () => {
            hidden.setAttribute('hidden', '')
            show.removeAttribute('hidden');
            password.setAttribute('type', 'text')
        })

        show.addEventListener('click', () => {
            show.setAttribute('hidden', '')
            hidden.removeAttribute('hidden');
            password.setAttribute('type', 'password')
        })
    </script>
    <!-- End Script Eye Password -->

    <!-- Script Modal Form -->
    <script>
        const setForm = (title, data, id = null) => {
            const modal_form = document.querySelector('#modal_form')
            const modal_title = modal_form.querySelector('.modal-title')
            const form = modal_form.querySelector('form');
            const id_kependudukan = modal_form.querySelector('#id_kependudukan');
            const password = modal_form.querySelector('#password');

            form.setAttribute('action', `user/${title}`)
            modal_title.innerHTML = `${title} Data User`
            id_kependudukan.value = id;

            if (title == 'insert') {
                password.setAttribute('required', '')
            } else {
                password.removeAttribute('required')
            }

            const fields = ['username', 'role'];
            fields.forEach((e, i) => {
                const element = modal_form.querySelector(`#${e}`);
                title == 'insert' ? element.value = '' : element.value = data[i];
            })
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