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
                            Data Surat Keterangan Kematian
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
                                        <th rowspan="2" class="no-sort">Nama Jenazah</th>
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
                                    <?php foreach ($sk_kematian as $item) : ?>
                                        <?php $data['item'] = $item; ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                                                <td><?= $item->nama ?></td>
                                            <?php endif ?>
                                            <td><?= $item->no_surat ?></td>
                                            <td><?= $item->tanggal_pengajuan ?></td>
                                            <td><?= $item->nama_jenazah ?></td>
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
                                                    <?php $params = "[`$item->no_surat`,`$item->nik_jenazah`,`$item->nama_jenazah`,`$item->hari_meninggal`,`$item->tanggal_meninggal`,`$item->penyebab_meninggal`,`$item->tempat_meninggal`,`$item->status_print`,`$item->foto_ktp_pelapor`,`$item->foto_kk_jenazah`,`$item->foto_ktp_jenazah`,`$item->foto_akte_lahir`]"; ?>
                                                    <button id="detailBtn" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('detail', <?= $params ?>)">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </button>
                                                    <?php $data['jenis_surat'] = 'sk_kematian'; ?>
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
                    <h1 class="modal-title fs-5 text-capitalize" id="title_form"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?= base_url('surat/sk_kematian_create') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="form-group col-md-12 col-lg-3">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="no_surat" id="no_surat" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-12 col-lg-4">
                                <label for="nik_jenazah" class="form-label">NIK Jenazah</label>
                                <input type="number" name="nik_jenazah" id="nik_jenazah" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 col-lg-5">
                                <label for="nama_jenazah" class="form-label">Nama Jenazah</label>
                                <input type="text" id="nama_jenazah" name="nama_jenazah" class="form-control text-capitalize" readonly>
                                <!-- <input type="text" id="nama_jenazah_show" class="form-control text-capitalize" disabled>e -->
                            </div>
                            <div class="form-group col-md-12 col-lg-3">
                                <label for="hari_meninggal" class="form-label">Hari Meninggal</label>
                                <input type="text" name="hari_meninggal" id="hari_meninggal" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 col-lg-3">
                                <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
                                <input type="date" name="tanggal_meninggal" id="tanggal_meninggal" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label for="penyebab_meninggal" class="form-label">Penyebab Meninggal</label>
                                <textarea name="penyebab_meninggal" id="penyebab_meninggal" class="form-control" required rows="1"></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label for="tempat_meninggal" class="form-label">Tempat Meninggal</label>
                                <input type="text" name="tempat_meninggal" id="tempat_meninggal" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label for="status_print" class="form-label">Status Print</label>
                                <select class="form-select" name="status_print" id="status_print" required>
                                    <option value="" selected>--</option>
                                    <option value="mandiri">Mandiri</option>
                                    <option value="kantor desa">Pengambilan di Kantor Desa</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label class="form-label">*Foto KTP Pelapor</label>
                                <input type="file" class="form-control-file" id="foto_ktp_pelapor_input" name="foto_ktp_pelapor" required accept="image/*">
                                <img id="foto_ktp_pelapor" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label class="form-label">*Foto KK Jenazah</label>
                                <input type="file" class="form-control-file" id="foto_kk_jenazah_input" name="foto_kk_jenazah" required accept="image/*">
                                <img id="foto_kk_jenazah" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label class="form-label">*Foto KTP Jenazah</label>
                                <input type="file" class="form-control-file" id="foto_ktp_jenazah_input" name="foto_ktp_jenazah" required accept="image/*">
                                <img id="foto_ktp_jenazah" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <label class="form-label">*Foto Akte Lahir Jenazah</label>
                                <input type="file" class="form-control-file" id="foto_akte_lahir_input" name="foto_akte_lahir" required accept="image/*">
                                <img id="foto_akte_lahir" class="img-fluid d-block" style="max-height: 200px;">
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <span class="small text-danger">*File maksimal 2mb</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="find_form" onclick="find_data()" class="btn-sm btn btn-success"><i class="bi bi-search"></i> Cari NIK Jenazah</button>
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
        const find_form = document.querySelector('#find_form')
        const nama_jenazah = document.querySelector('#nama_jenazah')

        const setForm = (title, data = null) => {
            modal_title.innerHTML = `${title} Surat Keterangan Kematian`

            const fields = ['no_surat', 'nik_jenazah', 'nama_jenazah', 'hari_meninggal', 'tanggal_meninggal', 'penyebab_meninggal', 'tempat_meninggal', 'status_print', 'foto_ktp_pelapor', 'foto_kk_jenazah', 'foto_ktp_jenazah', 'foto_akte_lahir'];
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

            find_form.hidden = title === 'detail'

            if (title === 'insert') {
                document.querySelector('#no_surat').value = '<?= $no_surat ?>';
            }

        }

        document.querySelector('form').addEventListener('submit', () => {
            event.preventDefault()
            if (!nama_jenazah.value) {
                alert('Anda belum menentukan data jenazah')
                return false;
            }
        })

        const find_data = () => {
            const nik_jenazah = document.getElementById('nik_jenazah').value;
            const nama_jenazah = document.getElementById('nama_jenazah');
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= base_url('surat/find/') ?>' + encodeURIComponent(nik_jenazah), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        nama_jenazah.value = response.kependudukan.nama
                        submit_form.removeAttribute('hidden');
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send();
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