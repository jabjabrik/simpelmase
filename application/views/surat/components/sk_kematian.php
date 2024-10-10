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
                            <input type="text" id="nama_jenazah" name="nama_jenazah" class="form-control text-capitalize" hidden required>
                            <input type="text" id="nama_jenazah_show" class="form-control text-capitalize" disabled>
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
                            <input type="file" class="form-control-file" id="foto_ktp_pelapor_input" name="foto_ktp_pelapor">
                            <img id="foto_ktp_pelapor" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label class="form-label">*Foto KK Jenazah</label>
                            <input type="file" class="form-control-file" id="foto_kk_jenazah_input" name="foto_kk_jenazah">
                            <img id="foto_kk_jenazah" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label class="form-label">*Foto KTP Jenazah</label>
                            <input type="file" class="form-control-file" id="foto_ktp_jenazah_input" name="foto_ktp_jenazah">
                            <img id="foto_ktp_jenazah" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label class="form-label">*Foto Akte Lahir Jenazah</label>
                            <input type="file" class="form-control-file" id="foto_akte_lahir_input" name="foto_akte_lahir">
                            <img id="foto_akte_lahir" class="img-fluid d-block" style="max-height: 200px;">
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <span class="small text-danger">*File maksimal 2mb</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="find_form" onclick="find_data()" class="btn-sm btn btn-success"><i class="bi bi-search"></i> Cari NIK</button>
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
    const find_form = document.querySelector('#find_form')

    const nama_jenazah = document.querySelector('#nama_jenazah')

    const setForm = (title, id = null) => {
        title_form.innerHTML = `${title} Surat Keterangan Usaha`

        if (title === 'tambah') {
            document.querySelector('#no_surat').value = '<?= isset($no_surat) ? $no_surat : '' ?>';
        }

        if (title === 'detail') {
            find_form.hidden = true
            submit_form.hidden = true
            const data = [...<?= json_encode($sk_kematian) ?>].filter(e => e.id === id)[0];
            const list = ['no_surat', 'nik_jenazah', 'nama_jenazah', 'hari_meninggal', 'tanggal_meninggal', 'penyebab_meninggal', 'tempat_meninggal', 'status_print', 'foto_ktp_pelapor', 'foto_kk_jenazah', 'foto_ktp_jenazah', 'foto_akte_lahir'];

            list.forEach(item => {
                const element = document.querySelector(`#${item}`);
                if (item.includes('foto')) {
                    document.querySelector(`#${item}_input`).hidden = true
                    element.src = `<?= base_url('files/img/') ?>${data[item]}`
                    element.alt = item && 'tidak ada foto'
                } else {
                    if (item === 'nama_jenazah') {
                        const nama_jenazah_show = document.getElementById('nama_jenazah_show').value = data[item];
                    }
                    element.value = data[item]
                    element.disabled = true
                }
            })
        }
    }

    document.querySelector('form').addEventListener('submit', () => {
        event.preventDefault()
        return false;

    })

    submit_form.addEventListener('click', () => {
        if (!nama_jenazah.value) {
            alert('Anda belum menentukan data jenazah')
        }
    })

    const find_data = () => {
        var nik_jenazah = document.getElementById('nik_jenazah').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= base_url('surat/find/') ?>' + encodeURIComponent(nik_jenazah), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                const nama_jenazah = document.getElementById('nama_jenazah');
                const nama_jenazah_show = document.getElementById('nama_jenazah_show');
                const id_kependudukan = document.getElementById('id_kependudukan');
                if (response.status === 'success') {
                    nama_jenazah.value = response.kependudukan.nama
                    nama_jenazah_show.value = response.kependudukan.nama
                } else {
                    alert(response.message);
                }
            }
        };
        xhr.send();
        // });
    }
</script>
<!-- End Script Modal Form -->