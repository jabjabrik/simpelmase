<table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                <th rowspan="2">Nama</th>
            <?php endif ?>
            <th rowspan="2">No. Surat</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2" class="no-sort">Nama Usaha</th>
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
        <?php foreach ($sk_usaha as $item) : ?>
            <?php $data['item'] = $item; ?>

            <tr>
                <td><?= $no ?></td>
                <?php if ($this->session->userdata('role') != 'penduduk') : ?>
                    <td><?= $item->nama ?></td>
                <?php endif ?>
                <td><?= $item->no_surat ?></td>
                <td><?= $item->tanggal_pengajuan ?></td>
                <td><?= $item->nama_usaha ?></td>
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
                    <?php $this->view('surat/components/action', $data); ?>
                </td>
            </tr>
            <?php $no++ ?>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Form -->
<div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-capitalize" id="title_form"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?= base_url('surat/sk_usaha_create') ?>" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="no_surat" class="form-label">Nomor Surat</label>
                            <input type="text" name="no_surat" id="no_surat" class="form-control" readonly>
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="nama_usaha" class="form-label">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <input type="text" name="keperluan" id="keperluan" class="form-control" placeholder="Keperluan" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="status_print" class="form-label">Status Print</label>
                            <select class="form-select" name="status_print" id="status_print" required>
                                <option value="" selected>--</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="kantor desa">Pengambilan di Kantor Desa</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label class="form-label">*Upload Foto KTP</label>
                            <input type="file" class="form-control-file" id="foto_ktp_input" name="foto_ktp" required accept="image/*">
                            <img id="foto_ktp" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label class="form-label">*Upload Foto Kartu Pajak</label>
                            <input type="file" class="form-control-file" id="foto_kartu_pajak_input" name="foto_kartu_pajak" required accept="image/*">
                            <img id="foto_kartu_pajak" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label class="form-label">Upload Pas Foto</label>
                            <input type="file" class="form-control-file" id="pas_foto_input" name="pas_foto" accept="image/*">
                            <img id="pas_foto" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label class="form-label">Upload Foto Kartu Vaksin</label>
                            <input type="file" class="form-control-file" id="foto_kartu_vaksin_input" name="foto_kartu_vaksin" accept="image/*">
                            <img id="foto_kartu_vaksin" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <span class="small text-danger">*File maksimal 2mb</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="submit_form" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Form -->

<!-- Script Modal Form -->
<script>
    const title_form = document.querySelector('#title_form')
    const modal_form = document.querySelector('#modal_form')
    const submit_form = document.querySelector('#submit_form')

    const setForm = (title, id = null) => {
        title_form.innerHTML = `${title} Surat Keterangan Usaha`

        if (title === 'tambah') {
            submit_form.hidden = false
            document.querySelector('#no_surat').value = '<?= isset($no_surat) ? $no_surat : '' ?>';
        }

        if (title === 'detail') {
            const data = [...<?= json_encode($sk_usaha) ?>].filter(e => e.id === id)[0];
            const list = ['no_surat', 'nama_usaha', 'keperluan', 'status_print', 'foto_ktp', 'pas_foto', 'foto_kartu_pajak', 'foto_kartu_vaksin'];

            list.forEach(item => {
                submit_form.hidden = true
                const element = document.querySelector(`#${item}`);
                if (item.includes('foto')) {
                    document.querySelector(`#${item}_input`).hidden = true
                    element.src = `<?= base_url('files/img/') ?>${data[item]}`
                    element.alt = item && 'tidak ada foto'
                } else {
                    element.value = data[item]
                    element.disabled = true
                }
            })
        }
    }
</script>
<!-- End Script Modal Form -->