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

                    <div class="card mb-4 mx-0 col-md-6 col-12">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Ubah Password
                        </div>
                        <form class="p-2" id="modal-form" method="post" action="<?= base_url('account/changepassword_change') ?>" autocomplete="off">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="form-group col-m-6 col-12">
                                        <label for="password1" class="form-label">Password Lama</label>
                                        <input type="password" name="password1" id="password1" class="form-control" value="<?= set_value('password1'); ?>">
                                        <div style="position: relative;">
                                            <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                            <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                        </div>
                                        <?= form_error('password1', '<small class="text-danger mt-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-m-6 col-12">
                                        <label for="password2" class="form-label">Password Baru</label>
                                        <input type="password" name="password2" id="password2" class="form-control" value="<?= set_value('password2'); ?>">
                                        <div style="position: relative;">
                                            <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                            <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                        </div>
                                        <div id="passwordHelpBlock" class="form-text">
                                            Kombinasi antara Huruf Kecil, Huruf Besar, Angka dan Karakter Spesial
                                        </div>
                                        <?= form_error('password2', '<small class="text-danger mt-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                    </div>
                                    <div class="form-group col-m-6 col-12">
                                        <label for="password3" class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" name="password3" id="password3" class="form-control" value="<?= set_value('password3'); ?>">
                                        <div style="position: relative;">
                                            <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                            <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                        </div>
                                        <div id="passwordHelpBlock" class="form-text">
                                            Konfirmasi Ulang Password Anda
                                        </div>
                                        <?= form_error('password3', '<small class="text-danger mt-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> -->
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- Script Eye Password -->
    <script>
        const passwords = document.querySelectorAll('input[type=password]');
        const [show1, hidden1, show2, hidden2, show3, hidden3] = document.querySelectorAll('#eye');

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
            if (i === 2) {
                hidden3.addEventListener('click', () => {
                    hidden3.setAttribute('hidden', '')
                    show3.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'text')
                })

                show3.addEventListener('click', () => {
                    show3.setAttribute('hidden', '')
                    hidden3.removeAttribute('hidden');
                    passwords[i].setAttribute('type', 'password')
                })
            }
        })
    </script>
    <!-- End Script Eye Password -->

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
            password.value = ''
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
                password.value = user[1]
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