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

                    <!-- Button Component -->
                    <?php $this->view('surat/components/button'); ?>
                    <!-- End Button Component -->

                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Surat Keterangan Kelahiran
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                                            <th rowspan="2">Nama</th>
                                        <?php endif ?>
                                        <th rowspan="2">No. Surat</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2" class="no-sort">Nama Bayi</th>
                                        <th rowspan="2" class="no-sort">Cetak Surat</th>
                                        <th rowspan="2" class="no-sort">Status</th>
                                        <th colspan="2">Validasi</th>
                                        <th rowspan="2" class="no-sort">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="no-sort">Sekdes</th>
                                        <th class="no-sort">Kades</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($sk_kelahiran as $item) : ?>
                                        <?php $data['item'] = $item; ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                                                <td><?= $item->nama ?></td>
                                            <?php endif ?>
                                            <td><?= $item->no_surat ?></td>
                                            <td><?= $item->tanggal_pengajuan ?></td>
                                            <td><?= $item->nama_bayi ?></td>
                                            <td><?= $item->status_print ?></td>
                                            <td>
                                                <?php $this->view('surat/components/info', $data); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($item->validasi_sekdes == 'proses') : ?>
                                                    <span>-</span>
                                                <?php elseif ($item->validasi_sekdes == 'disetujui') : ?>
                                                    <i class="text-success bi bi-check-circle-fill"></i>
                                                <?php else : ?>
                                                    <i class="text-danger bi bi-x-octagon-fill"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($item->validasi_kades == 'proses') : ?>
                                                    <span>-</span>
                                                <?php elseif ($item->validasi_kades == 'disetujui') : ?>
                                                    <i class="text-success bi bi-check-circle-fill"></i>
                                                <?php else : ?>
                                                    <i class="text-danger bi bi-x-octagon-fill"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <?php $params = "[`$item->no_surat`,`$item->nik_ayah`,`$item->nik_ibu`,`$item->nama_bayi`,`$item->jenis_kelamin`,`$item->hari_lahir`,`$item->tempat_lahir`,`$item->tanggal_lahir`,`$item->foto_kk`,`$item->foto_buku_nikah`,`$item->foto_ktp_ayah`,`$item->foto_ktp_ibu`,`$item->status_print`]"; ?>
                                                    <button id="detailBtn" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('detail', <?= $params ?>)">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </button>
                                                    <?php $data['jenis_surat'] = 'sk_kelahiran'; ?>
                                                    <?php $this->view('surat/components/action', $data); ?>
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
                    <h1 class="modal-title fs-5 text-capitalize"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?= base_url('surat/sk_kelahiran_create') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="no_surat" id="no_surat" class="form-control" readonly>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="nik_ayah" class="form-label">NIK Ayah</label>
                                <input type="number" name="nik_ayah" id="nik_ayah" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="nik_ibu" class="form-label">NIK Ibu</label>
                                <input type="number" name="nik_ibu" id="nik_ibu" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="nama_bayi" class="form-label">Nama Bayi</label>
                                <input type="text" id="nama_bayi" name="nama_bayi" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="" selected>--</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="hari_lahir" class="form-label">Hari Lahir</label>
                                <input type="text" name="hari_lahir" id="hari_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-12">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-5 col-md-12">
                                <label for="status_print" class="form-label">Status Print</label>
                                <select class="form-select" name="status_print" id="status_print" required>
                                    <option value="" selected>--</option>
                                    <option value="mandiri">Mandiri</option>
                                    <option value="kantor desa">Pengambilan di Kantor Desa</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="foto_kk" class="form-label">*Foto Kartu keluarga</label>
                                <input type="file" class="form-control-file" id="foto_kk_input" name="foto_kk" required accept="image/*">
                                <img id="foto_kk" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="foto_buku_nikah" class="form-label">*Foto Buku Nikah</label>
                                <input type="file" class="form-control-file" id="foto_buku_nikah_input" name="foto_buku_nikah" required accept="image/*">
                                <img id="foto_buku_nikah" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="foto_ktp_ayah" class="form-label">*Foto KTP Ayah</label>
                                <input type="file" class="form-control-file" id="foto_ktp_ayah_input" name="foto_ktp_ayah" required accept="image/*">
                                <img id="foto_ktp_ayah" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="foto_ktp_ibu" class="form-label">*Foto KTP Ibu</label>
                                <input type="file" class="form-control-file" id="foto_ktp_ibu_input" name="foto_ktp_ibu" required accept="image/*">
                                <img id="foto_ktp_ibu" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <span class="small text-danger">*File maksimal 2mb</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="submit_form" class="btn btn-primary" hidden>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Form -->

    <!-- Script Modal Form -->
    <script>
        const modal_form = document.querySelector('#modal_form')
        const modal_title = modal_form.querySelector('.modal-title')
        const submit_form = modal_form.querySelector('#submit_form')

        const setForm = (title, data = null) => {
            modal_title.innerHTML = `${title} Surat Keterangan Kelahiran`

            const fields = ['no_surat', 'nik_ayah', 'nik_ibu', 'nama_bayi', 'jenis_kelamin', 'hari_lahir', 'tempat_lahir', 'tanggal_lahir', 'foto_kk', 'foto_buku_nikah', 'foto_ktp_ayah', 'foto_ktp_ibu', 'status_print'];
            fields.forEach((e, i) => {
                const element = modal_form.querySelector(`#${e}`);
                if (e.includes('foto')) {
                    const input_element = document.querySelector(`#${e}_input`)
                    input_element.hidden = title === 'detail'
                    element.src = `<?= base_url('files/img/') ?>${title == 'insert' ? '' : data[i]}`
                } else {
                    element.value = title == 'insert' ? '' : data[i];
                    element.disabled = title === 'detail'
                }
            })

            submit_form.hidden = title === 'detail'

            if (title === 'insert') {
                document.querySelector('#no_surat').value = '<?= $no_surat ?>';
            }
        }
    </script>
    <!-- End Script Modal Form -->

    <!-- Modal Reject -->
    <?php $this->view('surat/components/reject'); ?>
    <!-- End Reject Form -->

    <!-- Notification Modal -->
    <?php $this->view('surat/components/notification'); ?>
    <!-- End Notification Modal -->

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>