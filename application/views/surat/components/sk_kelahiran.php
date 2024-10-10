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
            <form method="post" action="<?= base_url('surat/sk_kelahiran_create') ?>" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="form-group col-lg-3 col-md-12">
                            <label for="no_surat" class="form-label">Nomor Surat</label>
                            <input type="text" name="no_surat" id="no_surat" class="form-control" readonly>
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="nik_ayah" class="form-label">NIK Ayah</label>
                            <input type="number" name="nik_ayah" id="nik_ayah" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-5 col-md-12">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" hidden required>
                            <input type="text" id="nama_ayah_show" class="form-control text-capitalize" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="nik_ibu" class="form-label">NIK Ibu</label>
                            <input type="number" name="nik_ibu" id="nik_ibu" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" hidden required>
                            <input type="text" id="nama_ibu_show" class="form-control text-capitalize" disabled>
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
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
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
                            <label for="foto_kk" class="form-label">*Foto Kartu keluarga</label>
                            <input type="file" class="form-control-file" id="foto_kk_input" name="foto_kk" required>
                            <img id="foto_kk" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="foto_buku_nikah" class="form-label">*Foto Buku Nikah</label>
                            <input type="file" class="form-control-file" id="foto_buku_nikah_input" name="foto_buku_nikah" required>
                            <img id="foto_buku_nikah" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="foto_ktp_ayah" class="form-label">*Foto KTP Ayah</label>
                            <input type="file" class="form-control-file" id="foto_ktp_ayah_input" name="foto_ktp_ayah" required>
                            <img id="foto_ktp_ayah" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="foto_ktp_ibu" class="form-label">*Foto KTP Ibu</label>
                            <input type="file" class="form-control-file" id="foto_ktp_ibu_input" name="foto_ktp_ibu" required>
                            <img id="foto_ktp_ibu" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <span class="small text-danger">*File maksimal 2mb</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="find_form_ayah" onclick="find_data('ayah')" class="btn-sm btn btn-success"><i class="bi bi-search"></i> Cari NIK Ayah</button>
                    <button type="button" id="find_form_ibu" onclick="find_data('ibu')" class="btn-sm btn btn-success"><i class="bi bi-search"></i> Cari NIK Ibu</button>
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
    const find_form_ayah = document.querySelector('#find_form_ayah')
    const find_form_ibu = document.querySelector('#find_form_ibu')

    const nama_ayah = document.querySelector('#nama_ayah')
    const nama_ibu = document.querySelector('#nama_ibu')

    const setForm = (title, id = null) => {
        title_form.innerHTML = `${title} Surat Keterangan Kelahiran`

        if (title === 'tambah') {
            document.querySelector('#no_surat').value = '<?= isset($no_surat) ? $no_surat : '' ?>';
        }

        if (title === 'detail') {
            nama_ayah.value = '<?= isset($nama_ayah) ? $nama_ayah : '' ?>';
            nama_ibu.value = '<?= isset($nama_ibu) ? $nama_ibu : '' ?>';
            find_form_ayah.hidden = true
            find_form_ibu.hidden = true
            submit_form.hidden = true
            const data = [...<?= json_encode($sk_kelahiran) ?>].filter(e => e.id === id)[0];
            const list = ['no_surat', 'nik_ayah', 'nama_ayah', 'nik_ibu', 'nama_ibu', 'nama_bayi', 'jenis_kelamin', 'hari_lahir', 'tempat_lahir', 'tanggal_lahir', 'status_print', 'foto_kk', 'foto_buku_nikah', 'foto_ktp_ayah', 'foto_ktp_ibu'];

            list.forEach(item => {
                const element = document.querySelector(`#${item}`);
                if (item.includes('foto')) {
                    document.querySelector(`#${item}_input`).hidden = true
                    element.src = `<?= base_url('files/img/') ?>${data[item]}`
                    element.alt = item && 'tidak ada foto'
                } else {
                    if (item === 'nik_ayah') {
                        document.getElementById('nama_ayah_show').value = '<?= isset($nama_ayah) ? $nama_ayah : '' ?>';
                    }
                    if (item === 'nik_ibu') {
                        document.getElementById('nama_ibu_show').value = '<?= isset($nama_ibu) ? $nama_ibu : '' ?>';
                    }
                    element.value = data[item]
                    element.disabled = true
                }
            })
        }
    }

    submit_form.addEventListener('click', () => {
        if (!nama_ayah.value || !nama_ibu.value) {
            alert('Anda belum menentukan data Ayah Atau Ibu.')
        }
    })

    const find_data = (title) => {
        var nik = document.getElementById(`nik_${title}`).value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= base_url('surat/find/') ?>' + encodeURIComponent(nik), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                const nama = document.getElementById(`nama_${title}`);
                const nama_show = document.getElementById(`nama_${title}_show`);
                if (response.status === 'success') {
                    nama.value = response.kependudukan.nama
                    nama_show.value = response.kependudukan.nama
                } else {
                    alert(response.message);
                }
            }
        };
        xhr.send();
    }
</script>
<!-- End Script Modal Form -->