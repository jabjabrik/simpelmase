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

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </button>
                    </div>
                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Aset Penduduk Sumberkledung
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>No KK</th>
                                        <th>Nama</th>
                                        <th>kategori</th>
                                        <th>Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($aset as $item) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $item->nik ?></td>
                                            <td><?= $item->no_kk ?></td>
                                            <td><?= $item->nama ?></td>
                                            <td><?= $item->kategori ?></td>
                                            <td><?= $item->jenis ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                    <?php $data_aset = "$item->nik,$item->no_kk,$item->nama,$item->kategori,$item->jenis,$item->keterangan,$item->nilai,$item->luas,$item->alamat,$item->latitude,$item->longitude"; ?>
                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('detail', '<?= $data_aset ?>', '<?= $item->id_aset ?>')">
                                                        <i class="bi bi-eye-fill"></i> Detail
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', '<?= $data_aset ?>', '<?= $item->id_aset ?>')">
                                                        <i class=" bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <a href="<?= base_url("aset/delete/$item->id_aset") ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
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
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form">Tambah Data Nomor Surat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('aset/create') ?>" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3 text-capitalize">
                            <input type="text" name="id_aset" id="id_aset" hidden>
                            <input type="text" name="id_kependudukan" id="id_kependudukan" hidden required>
                            <div class="form-group col-3">
                                <label for="nik" class="form-label">NIK Penduduk</label>
                                <input type="number" id="nik" class="form-control" required>
                            </div>
                            <div class="form-group col-3">
                                <label for="no_kk" class="form-label">Nomor KK</label>
                                <input type="text" id="no_kk" class="form-control" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="nama" class="form-label">Nama Penduduk</label>
                                <input type="text" id="nama" class="form-control" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select text-capitalize" name="kategori" id="kategori" required>
                                    <option value="" selected>--</option>
                                    <option value="aset bergerak">aset bergerak</option>
                                    <option value="aset tidak bergerak">aset tidak bergerak</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="jenis" class="form-label">Jenis Aset</label>
                                <select class="form-select text-capitalize" name="jenis" id="jenis" required>
                                    <option value="" selected>--</option>
                                    <option value="tanah">tanah</option>
                                    <option value="bangunan">bangunan</option>
                                    <option value="kendaraan">kendaraan</option>
                                    <option value="lainnya">lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="1" required></textarea>
                            </div>
                            <div class="form-group col-3">
                                <label for="nilai" class="form-label">Nilai Aset</label>
                                <input type="text" id="nilai" name="nilai" class="form-control" required>
                            </div>
                            <div class="form-group col-3">
                                <label for="luas" class="form-label">Luas (m<sup>2</sup>)</label>
                                <input type="text" id="luas" name="luas" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" target="_blank" type="button" id="maps" class="btn-sm btn btn-success"><i class="bi bi-geo-alt-fill"></i> Lihat Lokasi</a>
                        <button type="button" id="find" class="btn-sm btn btn-success"><i class="bi bi-search"></i> Cari NIK</button>
                        <button type="button" class="btn-sm btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="save" class="btn-sm btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Form -->

    <!-- Script Modal Form -->
    <script>
        const modalTitle = document.querySelector('.modal-title')
        const modalForm = document.querySelector('#modal-form')
        const save = document.querySelector('#save')
        const maps = document.querySelector('#maps')
        const find = document.querySelector('#find')
        const id_aset = document.querySelector('#id_aset');
        const id_kependudukan = document.querySelector('#id_kependudukan');
        const nik = document.querySelector('#nik');
        const no_kk = document.querySelector('#no_kk');
        const nama = document.querySelector('#nama');
        const kategori = document.querySelector('#kategori');
        const jenis = document.querySelector('#jenis');
        const keterangan = document.querySelector('#keterangan');
        const nilai = document.querySelector('#nilai');
        const luas = document.querySelector('#luas');
        const alamat = document.querySelector('#alamat');
        const latitude = document.querySelector('#latitude');
        const longitude = document.querySelector('#longitude');

        const clearForm = () => {
            id_aset.value = ''
            id_kependudukan.value = ''
            nik.value = ''
            no_kk.value = ''
            nama.value = ''
            kategori.value = ''
            jenis.value = ''
            keterangan.value = ''
            nilai.value = ''
            luas.value = ''
            alamat.value = ''
            latitude.value = ''
            longitude.value = ''
            id_kependudukan.setAttribute('required', '')
            maps.setAttribute('hidden', '')
            find.removeAttribute('hidden')
            save.removeAttribute('hidden')
            nik.removeAttribute('disabled')
            kategori.removeAttribute('disabled')
            jenis.removeAttribute('disabled')
            keterangan.removeAttribute('disabled')
            nilai.removeAttribute('disabled')
            luas.removeAttribute('disabled')
            alamat.removeAttribute('disabled')
            latitude.removeAttribute('disabled')
            longitude.removeAttribute('disabled')
        }

        const setForm = (title, data, id = null) => {
            clearForm()
            modalTitle.innerHTML = `${title} Data Aset Kependudukan`
            id_aset.value = id;

            if (title === 'tambah') {
                // ADD
                modalForm.setAttribute('action', '<?= base_url('aset/create') ?>')
                return
            }


            const aset = data.split(',');
            id_aset.value = id
            nik.value = aset[0]
            no_kk.value = aset[1]
            nama.value = aset[2]
            kategori.value = aset[3]
            jenis.value = aset[4]
            keterangan.value = aset[5]
            nilai.value = aset[6]
            luas.value = aset[7]
            alamat.value = aset[8]
            latitude.value = aset[9]
            longitude.value = aset[10]

            find.setAttribute('hidden', '')
            nik.setAttribute('disabled', '')
            if (aset[3] === 'aset tidak bergerak') {
                maps.removeAttribute('hidden')
                maps.setAttribute('href', `https://www.google.com/maps?q=${aset[9]},${aset[10]}&t=h&z=50`)
            }


            if (title === 'detail') {
                save.setAttribute('hidden', '')
                kategori.setAttribute('disabled', '')
                jenis.setAttribute('disabled', '')
                keterangan.setAttribute('disabled', '')
                nilai.setAttribute('disabled', '')
                luas.setAttribute('disabled', '')
                alamat.setAttribute('disabled', '')
                latitude.setAttribute('disabled', '')
                longitude.setAttribute('disabled', '')
            }

            if (title === 'edit') {
                // EDIT
                modalForm.setAttribute('action', '<?= base_url('aset/edit') ?>')
                id_kependudukan.removeAttribute('required')
                return
            }
        }

        document.getElementById('find').addEventListener('click', function() {
            var nik = document.getElementById('nik').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?= base_url('aset/find/') ?>' + encodeURIComponent(nik), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    const input_id_kependudukan = document.getElementById('id_kependudukan');
                    const input_nama = document.getElementById('nama');
                    const input_no_kk = document.getElementById('no_kk');
                    if (response.status === 'success') {
                        input_id_kependudukan.value = response.kependudukan.id_kependudukan
                        input_nama.value = response.kependudukan.nama
                        input_no_kk.value = response.kependudukan.no_kk
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhr.send();
        });
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