<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
</head>

<body class="bg-primary">

    <div class="container">
        <div class="row justify-content-center mt-md-0 mt-3">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-md-5">
                    <div class="card-body">
                        <div class="row m-0 p-0">
                            <div class="col-lg-6 p-md-5 p-3 text-center">
                                <h1 class="lead fw-bolder" style="color: black;">SIMPELMASE</h1>
                                <h3 class="text-dark small font-size-16 font-weight-bold">Sistem Informasi Pelayanan Masyarakat Desa</h3>
                                <div class="px-5">
                                    <img src="<?= base_url('assets/img/logo/logopemkab.png') ?>" class="img-fluid" alt="">
                                </div>
                                <!-- <img src="<?= base_url('assets/img/logo/logopemkab.png') ?>" class="img-fluid" height="250" alt=""> -->
                                <p class="fs-5" style="color: black;">Desa Sumberkledung, Kec. Tegalsiwalan</p>
                                <p class="fs-5" style="color: black;">Kabupaten Probolinggo</p>
                            </div>
                            <div class="col-lg-6 p-md-4 p-3 ">
                                <div class="mt-md-2 mt-0">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><i class="bi bi-person-lock"></i> Login Web Simpelmase</h1>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form id="modal-form" action="<?= base_url('auth'); ?>" autocomplete="off" method="POST">
                                        <?= form_error('username', '<small class="text-danger mt-3 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                        <div class="form-floating mt-2 mb-4">
                                            <input type="text" name="username" class="form-control" id="username" placeholder="" value="<?php echo set_value('username'); ?>">
                                            <label for="username">Masukan Username / Email</label>
                                        </div>
                                        <?= form_error('password', '<small class="text-danger mt-3 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                        <div class="form-floating mt-2">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="" value="<?php echo set_value('password'); ?>">
                                            <label for="password">Masukan Password</label>
                                        </div>
                                        <div style="position: relative;">
                                            <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -40px; cursor: pointer;"></i>
                                            <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -40px; cursor: pointer;"></i>
                                        </div>
                                        <input type="submit" value="Login" class="btn mt-4 btn-primary btn-user btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const password = document.querySelector('#password')
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

    <?php $this->view('templates/script'); ?>
</body>

</html>


<!-- <div class="form-group">
    <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username">
    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
<div class="form-group">
    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
</div> -->