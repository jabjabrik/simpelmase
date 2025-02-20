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
                            Daftar User
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .8em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Penduduk</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Expired</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($user as $item) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $item->nik ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td class="text-lowercase"><?= $item->username ?></td>
                                            <td>...</td>
                                            <td><?= $item->role ?></td>
                                            <td><?= $item->expired_password ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <?php if (!$item->username) : ?>
                                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah', '', '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-plus-circle"></i> Daftarkan
                                                        </button>
                                                    <?php else : ?>
                                                        <?php $user_update = "$item->username,$item->password,$item->role" ?>
                                                        <!-- <button type="button" <?= $item->role === 'sekretaris desa' ? 'disabled' : '' ?> class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', '<?= $user_update ?>', '<?= $item->id_penduduk ?>')">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button> -->
                                                        <a href="<?= base_url("user/delete/$item->id_penduduk") ?>" type="button" class="btn btn-outline-danger <?= $item->role === 'sekretaris desa' ? 'disabled' : '' ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </a>
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
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="user/create" id="modal-form" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-m-6 col-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group col-m-6 col-12">
                                <label for="password1" class="form-label">Masukan Password</label>
                                <input type="password" name="password1" id="password1" class="form-control" required>
                                <div style="position: relative;">
                                    <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                    <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                </div>
                                <div id="passwordHelpBlock" class="form-text">
                                    Kombinasi antara Huruf Kecil, Huruf Besar, Angka dan Karakter Spesial
                                </div>
                                <small id="msg-error1" class="text-danger mt-1 pl-3 d-block" style="text-align: left;"></small>
                            </div>
                            <div class="form-group col-m-6 col-12">
                                <label for="password2" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password2" id="password2" class="form-control" required>
                                <div style="position: relative;">
                                    <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                    <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                </div>
                                <div id="passwordHelpBlock" class="form-text">
                                    Konfirmasi Ulang Password Anda
                                </div>
                                <small id="msg-error2" class="text-danger mt-1 pl-3 d-block" style="text-align: left;"></small>
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
                            <div class="form-group col-m-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Anda dengan kebenaran data diatas?
                                    </label>
                                </div>
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
        const passwords = document.querySelectorAll('input[type=password]');
        const [show1, hidden1, show2, hidden2] = document.querySelectorAll('#eye');

        passwords.forEach((password, i) => {
            if (i === 0) {
                hidden1.addEventListener('click', () => {
                    hidden1.setAttribute('hidden', '')
                    show1.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'text')
                })

                show1.addEventListener('click', () => {
                    show1.setAttribute('hidden', '')
                    hidden1.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'password')
                })
            }
            if (i === 1) {
                hidden2.addEventListener('click', () => {
                    hidden2.setAttribute('hidden', '')
                    show2.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'text')
                })

                show2.addEventListener('click', () => {
                    show2.setAttribute('hidden', '')
                    hidden2.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'password')
                })
            }
        })
    </script>
    <!-- End Script Eye Password -->

    <!-- Script Validate Password -->
    <script>
        const form = document.querySelector('#modal-form')

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const password1 = document.querySelector('#password1').value;
            const password2 = document.querySelector('#password2').value;
            const msgError1 = document.querySelector('#msg-error1');
            const msgError2 = document.querySelector('#msg-error2');

            let isValid_pass1 = true;
            let isValid_pass2 = true;

            // Validasi password1
            if (password1.length < 8) {
                msgError1.innerHTML = 'Password harus minimal 8 karakter.';
                isValid_pass1 = false;
            } else if (!/[A-Z]/.test(password1)) {
                msgError1.innerHTML = 'Password harus mengandung setidaknya satu huruf besar.';
                isValid_pass1 = false;
            } else if (!/[a-z]/.test(password1)) {
                msgError1.innerHTML = 'Password harus mengandung setidaknya satu huruf kecil.';
                isValid_pass1 = false;
            } else if (!/[0-9]/.test(password1)) {
                msgError1.innerHTML = 'Password harus mengandung setidaknya satu angka.';
                isValid_pass1 = false;
            } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password1)) {
                msgError1.innerHTML = 'Password harus mengandung setidaknya satu karakter spesial.';
                isValid_pass1 = false;
            } else {
                msgError1.innerHTML = '';
                isValid_pass1 = true;
            }

            // Validasi kecocokan password
            if (password1 !== password2) {
                msgError2.innerHTML = 'Password yang anda masukan tidak sesuai.';
                isValid_pass2 = false;
            } else {
                msgError2.innerHTML = '';
                isValid_pass2 = true;
            }

            // Jika validasi berhasil
            if (isValid_pass1 && isValid_pass2) {
                // Redirect dengan metode POST menggunakan Form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?= base_url('user/create') ?>`; // Ubah sesuai dengan fungsi `base_url` di server Anda

                const passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'password';
                passwordInput.value = password1;

                const usernameInput = document.createElement('input');
                usernameInput.type = 'hidden';
                usernameInput.name = 'username';
                usernameInput.value = e.target.querySelector('#username').value;

                const id_kependudukanInput = document.createElement('input');
                id_kependudukanInput.type = 'hidden';
                id_kependudukanInput.name = 'id_kependudukan';
                id_kependudukanInput.value = e.target.querySelector('#id_kependudukan').value;

                const roleInput = document.createElement('input');
                roleInput.type = 'hidden';
                roleInput.name = 'role';
                roleInput.value = e.target.querySelector('#role').value;


                form.appendChild(id_kependudukanInput);
                form.appendChild(usernameInput);
                form.appendChild(passwordInput);
                form.appendChild(roleInput);
                document.body.appendChild(form);

                form.submit();
            }
        });
    </script>
    <!-- End Script Validate Password -->


    <!-- Script Modal Form -->
    <script>
        const modalTitle = document.querySelector('.modal-title')
        const modalForm = document.querySelector('#modal-form')
        const id_kependudukan = document.querySelector('#id_kependudukan');
        const username = document.querySelector('#username');
        const password = document.querySelector('#password');
        const role = document.querySelector('#role');

        const clearForm = () => {
            id_kependudukan.value = ''
            username.value = ''
            password1.value = ''
            password2.value = ''
            role.value = ''
        }

        const setForm = (title, data, id = null) => {
            clearForm()
            modalTitle.innerHTML = `${title} Data User`
            id_kependudukan.value = id;

            if (title === 'tambah') {
                // ADD
                console.log(id);
                modalForm.setAttribute('action', '<?= base_url('user/create') ?>')
                return
            }

            if (title === 'edit') {
                // EDIT
                modalForm.setAttribute('action', '<?= base_url('user/edit') ?>')
                const user = data.split(',');
                username.value = user[0]
                // password.value = user[1]
                role.value = user[2]
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