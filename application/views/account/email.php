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

                    <div class="card mb-4 mx-0 col-md-7 col-12">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Kelola Email
                        </div>
                        <form class="p-2" id="modal-form" method="post" action="<?= base_url('account/add_update_email') ?>" autocomplete="off">
                            <div class="modal-body p-2">
                                <div id="section-username" class="row g-2">
                                    <div class="col-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Username">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="username" value="<?= $user->username ?>" disabled required>
                                    </div>
                                    <div class="col-3">
                                        <button id="change-username-btn" type="button" class="btn btn-primary mb-3">Ubah</button>
                                    </div>
                                </div>
                                <div id="section-email" class="row g-2">
                                    <div class="col-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Alamat Email">
                                    </div>
                                    <div class="col-6">
                                        <label for="inputPassword2" class="visually-hidden"></label>
                                        <input type="email" class="form-control" id="email" disabled value="<?= $user->email ?>">
                                    </div>
                                    <div class="col-3">
                                        <button id="change-email-btn" type="button" class="btn btn-primary mb-3">Ubah</button>
                                        <button hidden id="send-code-btn" onclick="send_verification_email()" type="button" class="btn btn-primary mb-3">
                                            <i class="bi bi-send"></i>
                                            Kirim Kode
                                        </button>
                                    </div>
                                </div>
                                <div hidden id="section-verify" class="row g-2 mt-1">
                                    <div class="col-3">
                                        <input type="text" readonly class="form-control-plaintext" value="Kode Verifikasi">
                                    </div>
                                    <div class="col-6">
                                        <label for="inputPassword2" class="visually-hidden"></label>
                                        <input type="text" class="form-control" id="verify" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-m-6 col-12">
                                        <div class="row">
                                            <label for="code-verify" class="form-label">Username</label>
                                            <div class="col-8">
                                                <input type="password" class="form-control" id="inputPassword2">
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary mb-3">Ubah</button>
                                            </div>
                                        </div>
                                    </div> -->
                                <!-- <div class="form-group col-m-6 col-12">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="yusufjabriko@gmail.com" disabled>
                                        <?= form_error('password1', '<small class="text-danger mt-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                    </div> -->
                                <!-- <div id="code-verify" class="form-group col-m-6 col-12" hidden>
                                        <label for="code-verify" class="form-label">Masukan Kode Verifikasi</label>
                                        <input type="text" name="code-verify" class="form-control">
                                        <?= form_error('password1', '<small class="text-danger mt-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                    </div> -->
                            </div>
                            <div class="modal-footer mt-3">
                                <button hidden id="back-btn" type="button" class="btn btn-secondary me-2">Kembali</button>
                                <button hidden id="save-btn" type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- Script Change Username -->
    <script>
        const username = document.querySelector('#username');
        const email = document.querySelector('#email');
        const sectionUsername = document.querySelector('#section-username');
        const sectionEmail = document.querySelector('#section-email');
        const sectionVerify = document.querySelector('#section-verify');
        const changeUsernameBtn = document.querySelector('#change-username-btn');
        const changeEmailBtn = document.querySelector('#change-email-btn');
        const sendCodeBtn = document.querySelector('#send-code-btn');
        const saveBtn = document.querySelector('#save-btn');
        const backBtn = document.querySelector('#back-btn');

        changeUsernameBtn.addEventListener('click', (e) => {
            e.preventDefault();
            changeUsernameBtn.setAttribute('hidden', '')
            sectionEmail.setAttribute('hidden', '')
            username.removeAttribute('disabled')
            saveBtn.removeAttribute('hidden')
            backBtn.removeAttribute('hidden')
        })

        changeEmailBtn.addEventListener('click', (e) => {
            e.preventDefault();
            changeEmailBtn.setAttribute('hidden', '')
            sendCodeBtn.removeAttribute('hidden')
            sectionUsername.setAttribute('hidden', '')
            sectionVerify.removeAttribute('hidden')
            email.removeAttribute('disabled')
            saveBtn.removeAttribute('hidden')
            backBtn.removeAttribute('hidden')
        })

        backBtn.addEventListener('click', () => {
            changeUsernameBtn.removeAttribute('hidden')
            changeEmailBtn.removeAttribute('hidden')
            sendCodeBtn.setAttribute('hidden', '')
            sectionUsername.removeAttribute('hidden')
            sectionEmail.removeAttribute('hidden')
            sectionVerify.setAttribute('hidden', '')
            username.setAttribute('disabled', '')
            email.setAttribute('disabled', '')
            saveBtn.setAttribute('hidden', '')
            backBtn.setAttribute('hidden', '')
        })
    </script>
    <!-- End Script Change Username -->

    <!-- Script Change Email -->
    <script>
        const send_verification_email = () => {
            const email = document.querySelector('#email').value

            // Regex untuk validasi email
            let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!email) {
                alert("Email tidak boleh kosong");
            } else if (!emailPattern.test(email)) {
                alert("Masukan alamat email yang valid");
            } else {
                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Define the URL to send the request to
                var url = "<?= base_url('account/send_verification_email') ?>";

                // Configure the request: open a connection, set the method (POST), and the URL
                xhr.open("POST", url, true);

                // Set the request headers, if needed (e.g., for JSON data)
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                // Define a callback function to handle the response
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        // If the request was successful (status 200), handle the response
                        if (xhr.status === 200) {
                            console.log("Response received: ", xhr.responseText);
                        } else {
                            console.error("Request failed. Status: " + xhr.status);
                        }
                    }
                };

                // Prepare the data you want to send (in JSON format for example)
                var data = JSON.stringify({
                    email: "yusufjabriko@gmail.com"
                });

                // Send the request with the data
                xhr.send(data);



                // var xhr = new XMLHttpRequest();
                // xhr.open('POST', '<?= base_url('account/send_verification_email/') ?>' + encodeURIComponent(nik_jenazah), true);
                // xhr.onreadystatechange = function() {
                //     if (xhr.readyState == 4 && xhr.status == 200) {
                //         var response = JSON.parse(xhr.responseText);
                //         const nama_jenazah = document.getElementById('nama_jenazah');
                //         const nama_jenazah_show = document.getElementById('nama_jenazah_show');
                //         const id_kependudukan = document.getElementById('id_kependudukan');
                //         if (response.status === 'success') {
                //             nama_jenazah.value = response.kependudukan.nama
                //             nama_jenazah_show.value = response.kependudukan.nama
                //         } else {
                //             alert(response.message);
                //         }
                //     }
                // };
                // xhr.send();
            };
        }
    </script>
    <!-- End Script Change Email -->

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>