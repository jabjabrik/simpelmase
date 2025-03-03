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
                    <h3 class="mt-4">Kelola Data Penduduk</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('kependudukan'); ?>">Data Penduduk</a></li>
                        <li class="breadcrumb-item active">Data Keluarga</li>
                    </ol>

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI UMUM</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Nomor Kartu Keluarga</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <span><?= $no_kk; ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Alamat</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <?php $alamat = $keluarga->alamat . ", RT " . sprintf("%03d", $keluarga->rt) . " RW " . sprintf("%03d", $keluarga->rw) . " Desa " . $keluarga->kelurahan . " Kecamatan " . $keluarga->kecamatan . "Kabupaten Probolinggo"; ?>
                                                    <span><?= $alamat; ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Foto Rumah</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <?php if (is_null($keluarga->foto_rumah)): ?>
                                                        <form action="<?= base_url('kependudukan/import') ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <input type="file" class="form-control" name="import_file">
                                                                </div>
                                                                <div class="col-4">
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <?php else: ?>
                                                        <a href="<?= base_url("files/img/" . $penduduk[0]->foto_rumah); ?>" target="_blank">
                                                            <img class="rounded shadow" src="<?= base_url("files/img/" . $penduduk[0]->foto_rumah); ?>" style="width: 50%;" />
                                                        </a>
                                                        <a href="<?= base_url("user/delete") ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Foto SPPT</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <a href="<?= base_url("files/img/sppt-1.jpg"); ?>" target="_blank">
                                                        <img class="rounded shadow" src="<?= base_url("files/img/sppt-1.jpg"); ?>" style="width: 50%;" />
                                                    </a>
                                                    <a href="<?= base_url("user/delete") ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI ANGGOTA KELUARGA</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table  table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NIK</th>
                                                        <th>Nama</th>
                                                        <th>Jenkel</th>
                                                        <th>Tgl.Lahir</th>
                                                        <th>Usia</th>
                                                        <th>Hub.Keluarga</th>
                                                        <th>Status.Kawin</th>
                                                        <th>Agama</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($penduduk as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->nik ?></td>
                                                            <td><?= $item->nama ?></td>
                                                            <td><?= $item->jenis_kelamin ?></td>
                                                            <td style="white-space: nowrap;"><?= $item->tanggal_lahir ?></td>
                                                            <td><?= convert_usia($item->tanggal_lahir) ?> Tahun</td>
                                                            <td style="white-space: nowrap;"><?= $item->hubungan_keluarga ?></td>
                                                            <td><?= $item->status_perkawinan ?></td>
                                                            <td><?= $item->agama ?></td>
                                                            <td>
                                                                <a href="<?= base_url("kependudukan/kk/$item->no_kk") ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-gear"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI ASET PENDUDUK</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table  table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6" style="color: red;">ASET BERGERAK</th>
                                                    </tr>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Aset</th>
                                                        <th>Keterangan</th>
                                                        <th>Nilai Aset</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($aset_bergerak as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->jenis ?></td>
                                                            <td><?= $item->keterangan ?></td>
                                                            <td><?= $item->nilai ?></td>
                                                            <td>
                                                                <a href="<?= base_url("kependudukan/kk") ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-gear"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table  table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="8" style="color: red;">ASET TIDAK BERGERAK</th>
                                                    </tr>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Aset</th>
                                                        <th>Keterangan</th>
                                                        <th>Nilai Aset</th>
                                                        <th>Luas (Hektar)</th>
                                                        <th>Kepemilikan</th>
                                                        <th>Lama Sewa</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($aset_tidak_bergerak as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->jenis ?></td>
                                                            <td><?= $item->keterangan ?></td>
                                                            <td><?= $item->nilai ?></td>
                                                            <td><?= $item->luas ?></td>
                                                            <td><?= $item->kepemilikan ?></td>
                                                            <td><?= $item->lama_sewa ?></td>
                                                            <td>
                                                                <a href="https://www.google.com/maps?q=<?= "$item->latitude,$item->longitude " ?>&t=h&z=50" target="_blank" type="button" id="maps" class="btn-sm btn btn-success"><i class="bi bi-geo-alt-fill"></i> Lihat Lokasi</a>
                                                                <a href="<?= base_url("kependudukan/kk") ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-gear"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">PENDAPATAN KELUARGA PERBULAN</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Pekerjaan</th>
                                                        <th>Pendapatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($penduduk as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->nama ?></td>
                                                            <td><?= $item->pekerjaan ?></td>
                                                            <td><?= $item->pendapatan ?></td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <h6 class="mb-0 fw-semibold">Total Pendapatan : Rp <?= number_format('3000000', 0, ',', '.') ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI BANTUAN SOSIAL</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table  table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Bansos</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal Penetapan</th>
                                                        <th>Nilai</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($bansos as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->jenis ?></td>
                                                            <td><?= $item->keterangan ?></td>
                                                            <td><?= $item->tanggal_penetapan ?></td>
                                                            <td><?= $item->nilai ?></td>
                                                            <td>
                                                                <a href="<?= base_url("kependudukan/kk/$item->no_kk") ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-gear"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">STATUS PENDIDIKAN KELUARGA</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Usia</th>
                                                        <th>Pendidikan</th>
                                                        <th>Kelas (Usia)</th>
                                                        <th>Kelas (Real)</th>
                                                        <th>Set Kelas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($penduduk as $item) : ?>
                                                        <?php
                                                        $usia = convert_usia($item->tanggal_lahir);
                                                        $is_usia_sekolah = $usia >= 5 && $usia <= 19;
                                                        $kelas_usia = convert_kelas_usia($usia);
                                                        $kelas_real = convert_kelas_real($item->kelas, $item->kelas_update);
                                                        ?>
                                                        <tr style="background-color: <?= $is_usia_sekolah ? '#f3f3f3' : '' ?>;">
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->nama ?></td>
                                                            <td><?= $usia ?> Tahun</td>
                                                            <td><?= $item->pendidikan ?></td>
                                                            <td><?= $kelas_usia ?></td>
                                                            <td>
                                                                <?php if ($item->kelas): ?>
                                                                    <?= $kelas_real ?>
                                                                <?php else: ?>
                                                                    <span>-</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center ">
                                                                <button type="button" <?= !$is_usia_sekolah ? 'disabled' : '' ?> class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_kelas">
                                                                    <i class="bi bi-gear"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">STATUS KEPEMILIKAN KTP</h6>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Usia</th>
                                                        <th>Status</th>
                                                        <th>Set KTP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($penduduk as $item) : ?>
                                                        <?php
                                                        $usia = convert_usia($item->tanggal_lahir);
                                                        $is_can_set = !preg_match('/\b(kepala keluarga|istri|orang-tua|mertua|menantu)\b/', $item->hubungan_keluarga) && $usia >= 17;
                                                        ?>
                                                        <tr style="background-color: <?= $is_can_set ? '#f3f3f3' : '' ?>;">
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->nama ?></td>
                                                            <td><?= $usia ?> Tahun</td>
                                                            <td>
                                                                <?php if ($usia < 17): ?>
                                                                    <span>Belum Dapat Memiliki KTP</span>
                                                                <?php endif; ?>
                                                                <?php if ($item->status_ktp == 'memiliki KTP'): ?>
                                                                    <i class="text-success bi bi-check-circle-fill"></i>
                                                                    <span>Memiliki KTP</span>
                                                                <?php endif; ?>
                                                                <?php if ($item->status_ktp == 'belum diketahui' && $usia >= 17): ?>
                                                                    <span>Belum diketahui</span>
                                                                <?php endif; ?>
                                                                <?php if ($item->status_ktp == 'belum memiliki KTP'): ?>
                                                                    <i class="text-danger bi bi-x-octagon-fill"></i>
                                                                    <span>belum memiliki KTP</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center ">
                                                                <button type="button" <?= $is_can_set ? '' : 'disabled' ?> class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_kelas">
                                                                    <i class="bi bi-gear"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="modal_kelas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Set Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="modal_form">Tambah Data Kependudukan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('kependudukan/create') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-12 col-md-2">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="no_kk" class="form-label">No Kartu Keluarga</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="" selected>--</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" name="agama" id="agama" required>
                                    <option value="" selected>--</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="khonghucu">Khonghucu</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="hubungan_keluarga" class="form-label">Hubungan Keluarga</label>
                                <select class="form-select" name="hubungan_keluarga" id="hubungan_keluarga" required>
                                    <option value="" selected>--</option>
                                    <option value="kepala keluarga">Kepala Keluarga</option>
                                    <option value="istri">Istri</option>
                                    <option value="anak">Anak</option>
                                    <option value="famili-lain">Famili-lain</option>
                                    <option value="orang-tua">Orang-tua</option>
                                    <option value="mertua">Mertua</option>
                                    <option value="menantu">Menantu</option>
                                    <option value="cucu">Cucu</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                <select class="form-select" name="status_perkawinan" id="status_perkawinan" required>
                                    <option value="" selected>--</option>
                                    <option value="belum kawin">Belum Kawin</option>
                                    <option value="kawin">Kawin</option>
                                    <option value="cerai hidup">Cerai Hidup</option>
                                    <option value="cerai mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="pendidikan" class="form-label">Hubungan Keluarga</label>
                                <select class="form-select text-capitalize" name="pendidikan" id="pendidikan" required>
                                    <option value="" selected>--</option>
                                    <option value="tidak/belum sekolah">tidak/belum sekolah</option>
                                    <option value="belum tamat sd/sederajat">belum tamat sd/sederajat</option>
                                    <option value="tamat sd/sederajat">tamat sd/sederajat</option>
                                    <option value="sltp/sederajat">sltp/sederajat</option>
                                    <option value="slta/sederajat">slta/sederajat</option>
                                    <option value="diploma i/ii">diploma i/ii</option>
                                    <option value="akademi/diploma 3/sarjana muda">akademi/diploma 3/sarjana muda</option>
                                    <option value="diploma iv/strata i">diploma iv/strata i</option>
                                    <option value="strata ii">strata ii</option>
                                    <option value="strata iii">strata iii</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-1">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" name="rt" id="rt" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-1">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" name="rw" id="rw" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kelurahan" class="form-label">Kelurahan</label>
                                        <input type="text" name="kelurahan" id="kelurahan" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="gaji" class="form-label">Gaji Per Bulan</label>
                                        <input type="text" name="gaji" id="gaji" class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="ktp" class="form-label">Status KTP</label>
                                        <select class="form-select text-capitalize" name="ktp" id="ktp">
                                            <option value="belum diketahui" selected>Belum Diketahui</option>
                                            <option value="memiliki KTP">Memiliki KTP</option>
                                            <option value="belum memiliki KTP">Belum memiliki KTP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="foto_rumah" class="form-label">Upload Foto Rumah (Maks 2mb)</label>
                                <input type="file" class="form-control-file" id="foto_rumah" name="foto_rumah" accept="image/*" onchange="showPreview(event);">
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <img id="preview" class="img-fluid" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="btn-modal-submit" class="btn btn-primary">Simpan</button>
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
        const btnModalSubmit = document.querySelector('#btn-modal-submit')
        const id_kependudukan = document.querySelector('#id_kependudukan');
        const nik = document.querySelector('#nik');
        const no_kk = document.querySelector('#no_kk');
        const nama = document.querySelector('#nama');
        const jenis_kelamin = document.querySelector('#jenis_kelamin');
        const tanggal_lahir = document.querySelector('#tanggal_lahir');
        const tempat_lahir = document.querySelector('#tempat_lahir');
        const agama = document.querySelector('#agama');
        const hubungan_keluarga = document.querySelector('#hubungan_keluarga');
        const status_perkawinan = document.querySelector('#status_perkawinan');
        const pendidikan = document.querySelector('#pendidikan');
        const nama_ibu = document.querySelector('#nama_ibu');
        const nama_ayah = document.querySelector('#nama_ayah');
        const pekerjaan = document.querySelector('#pekerjaan');
        const alamat = document.querySelector('#alamat');
        const rt = document.querySelector('#rt');
        const rw = document.querySelector('#rw');
        const kelurahan = document.querySelector('#kelurahan');
        const kecamatan = document.querySelector('#kecamatan');
        const gaji = document.querySelector('#gaji');
        const ktp = document.querySelector('#ktp');
        const foto_rumah = document.querySelector('#foto_rumah');
        const foto_rumah_preview = document.querySelector('#preview');

        const clearForm = () => {
            btnModalSubmit.removeAttribute('hidden')
            nik.value = ''
            no_kk.value = ''
            nama.value = ''
            jenis_kelamin.value = ''
            tanggal_lahir.value = ''
            tempat_lahir.value = ''
            agama.value = ''
            hubungan_keluarga.value = ''
            status_perkawinan.value = ''
            pendidikan.value = ''
            nama_ibu.value = ''
            nama_ayah.value = ''
            pekerjaan.value = ''
            alamat.value = ''
            rt.value = ''
            rw.value = ''
            kelurahan.value = ''
            kecamatan.value = ''
            gaji.value = ''
            ktp.value = ''

            nik.removeAttribute('disabled')
            no_kk.removeAttribute('disabled')
            nama.removeAttribute('disabled')
            jenis_kelamin.removeAttribute('disabled')
            tanggal_lahir.removeAttribute('disabled')
            tempat_lahir.removeAttribute('disabled')
            agama.removeAttribute('disabled')
            hubungan_keluarga.removeAttribute('disabled')
            status_perkawinan.removeAttribute('disabled')
            pendidikan.removeAttribute('disabled')
            nama_ibu.removeAttribute('disabled')
            nama_ayah.removeAttribute('disabled')
            pekerjaan.removeAttribute('disabled')
            alamat.removeAttribute('disabled')
            rt.removeAttribute('disabled')
            rw.removeAttribute('disabled')
            kelurahan.removeAttribute('disabled')
            kecamatan.removeAttribute('disabled')
            gaji.removeAttribute('disabled')
            ktp.removeAttribute('disabled')
            foto_rumah.removeAttribute('disabled')
            foto_rumah_preview.removeAttribute('src')
            foto_rumah_preview.removeAttribute('alt')
        }

        const setForm = (title, data, id = null) => {
            clearForm()
            modalTitle.innerHTML = `${title} Data Kependudukan`

            if (title === 'tambah') {
                // ADD
                modalForm.setAttribute('action', '<?= base_url('kependudukan/create') ?>')
                return
            }

            const kependudukan = data.split(',');
            nik.value = kependudukan[0]
            no_kk.value = kependudukan[1]
            nama.value = kependudukan[2]
            jenis_kelamin.value = kependudukan[3]
            tanggal_lahir.value = kependudukan[4]
            tempat_lahir.value = kependudukan[5]
            agama.value = kependudukan[6]
            hubungan_keluarga.value = kependudukan[7]
            status_perkawinan.value = kependudukan[8]
            pendidikan.value = kependudukan[9]
            nama_ibu.value = kependudukan[10]
            nama_ayah.value = kependudukan[11]
            pekerjaan.value = kependudukan[12]
            alamat.value = kependudukan[13]
            rt.value = kependudukan[14]
            rw.value = kependudukan[15]
            kelurahan.value = kependudukan[16]
            kecamatan.value = kependudukan[17]
            gaji.value = kependudukan[18]
            ktp.value = kependudukan[19]
            if (kependudukan[20]) {
                foto_rumah_preview.setAttribute('src', `<?= base_url('files/img/'); ?>${kependudukan[20]}`)
            } else {
                console.log(1);
                foto_rumah_preview.setAttribute('src', '')
                foto_rumah_preview.setAttribute('alt', 'Belum Ada Foto')
            }


            if (title === 'detail') {
                // DETAIL
                btnModalSubmit.setAttribute('hidden', '')
                nik.setAttribute('disabled', '')
                no_kk.setAttribute('disabled', '')
                nama.setAttribute('disabled', '')
                jenis_kelamin.setAttribute('disabled', '')
                tanggal_lahir.setAttribute('disabled', '')
                tempat_lahir.setAttribute('disabled', '')
                agama.setAttribute('disabled', '')
                hubungan_keluarga.setAttribute('disabled', '')
                status_perkawinan.setAttribute('disabled', '')
                pendidikan.setAttribute('disabled', '')
                nama_ibu.setAttribute('disabled', '')
                nama_ayah.setAttribute('disabled', '')
                pekerjaan.setAttribute('disabled', '')
                alamat.setAttribute('disabled', '')
                rt.setAttribute('disabled', '')
                rw.setAttribute('disabled', '')
                kelurahan.setAttribute('disabled', '')
                kecamatan.setAttribute('disabled', '')
                gaji.setAttribute('disabled', '')
                ktp.setAttribute('disabled', '')
                foto_rumah.setAttribute('disabled', '')
                return
            }

            if (title === 'edit') {
                // EDIT
                modalForm.setAttribute('action', '<?= base_url('kependudukan/edit') ?>')
                id_kependudukan.value = id
                return
            }
        }

        const showPreview = (event) => {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                foto_rumah_preview.setAttribute('src', src)
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