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
                    <a href="<?= base_url("kependudukan/report/$no_kk"); ?>" class="btn btn-sm btn-success" target="_blank">
                        <i class="bi bi-printer"></i> Report
                    </a>

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI KELUARGA</h6>
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
                                                    <span><?= $keluarga->no_kk; ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Alamat Lengkap</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <?php $alamat = $keluarga->alamat . ", RT " .  $keluarga->rt . " RW " .  $keluarga->rw . " Desa " . $keluarga->kelurahan . " Kecamatan " . $keluarga->kecamatan . "Kabupaten Probolinggo"; ?>
                                                    <span><?= $alamat; ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Foto Rumah</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <?php if ($keluarga->foto_rumah): ?>
                                                        <a href="<?= base_url("files/img/" . $keluarga->foto_rumah); ?>" target="_blank">
                                                            <img class="rounded shadow" src="<?= base_url("files/img/$keluarga->foto_rumah"); ?>" style="width: 50%;" />
                                                        </a>
                                                        <a href="<?= base_url("kependudukan/delete_keluarga/$keluarga->id_keluarga/foto_rumah") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span>---</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 mb-0">
                                                    <h6 class="mb-0">Foto SPPT</h6>
                                                </div>
                                                <div class="col-6 mb-0">
                                                    <?php if ($keluarga->foto_sppt): ?>
                                                        <a href="<?= base_url("files/img/$keluarga->foto_sppt"); ?>" target="_blank">
                                                            <img class="rounded shadow" src="<?= base_url("files/img/$keluarga->foto_sppt"); ?>" style="width: 50%;" />
                                                        </a>
                                                        <a href="<?= base_url("kependudukan/delete_keluarga/$keluarga->id_keluarga/foto_sppt") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span>---</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php $params_keluarga = "[`$keluarga->id_keluarga`,`$keluarga->no_kk`,`$keluarga->alamat`,`$keluarga->rt`,`$keluarga->rw`,`$keluarga->kelurahan`,`$keluarga->kecamatan`]" ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modal_keluarga" onclick="set_form_keluarga(<?= $params_keluarga ?>);">
                                                <i class="bi bi-gear"></i> Perbarui
                                            </button>
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
                                                                <?php $params_penduduk = "[`$item->id_kependudukan`,`$item->nik`,`$item->nama`,`$item->jenis_kelamin`,`$item->tanggal_lahir`,`$item->tempat_lahir`,`$item->agama`,`$item->hubungan_keluarga`,`$item->status_perkawinan`,`$item->pendidikan`,`$item->nama_ibu`,`$item->nama_ayah`]" ?>
                                                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modal_penduduk" onclick="set_form_penduduk(<?= $params_penduduk ?>);">
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
                                            <button type="button" class="my-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_aset_bergerak" onclick="set_form_aset_bergerak('insert')">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </button>
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
                                                            <td>Rp <?= number_format($item->nilai, 0, ',', '.') ?></td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <?php $params_aset = "[`$item->id_aset`,`$item->jenis`,`$item->keterangan`,`$item->nilai`]" ?>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_aset_bergerak" onclick="set_form_aset_bergerak('edit',<?= $params_aset ?>);">
                                                                        <i class="bi bi-gear"></i>
                                                                    </button>
                                                                    <a href="<?= base_url("kependudukan/delete_aset/$item->id_aset") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                                        <i class="bi bi-trash"></i>
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
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" class="my-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_aset_tidak_bergerak" onclick="set_form_aset_tidak_bergerak('insert')">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </button>
                                            <table id="" class="table  table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="8" style="color: red;">ASET TIDAK BERGERAK</th>
                                                    </tr>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Aset</th>
                                                        <th>NOP</th>
                                                        <th>Keterangan</th>
                                                        <th>Nilai Aset</th>
                                                        <th>Luas</th>
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
                                                            <td><?= $item->nop ?? '-' ?></td>
                                                            <td><?= $item->keterangan ?></td>
                                                            <td>Rp <?= number_format($item->nilai, 0, ',', '.') ?></td>
                                                            <td class="text-lowercase"><?= $item->luas ?></td>
                                                            <td><?= $item->kepemilikan ?></td>
                                                            <td><?= empty($item->lama_sewa) ? '-' : $item->lama_sewa ?></td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <?php $params_aset = "[`$item->id_aset`,`$item->jenis`,`$item->nop`,`$item->keterangan`,`$item->nilai`,`$item->luas`,`$item->kepemilikan`,`$item->lama_sewa`,`$item->url_maps`]" ?>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_aset_tidak_bergerak" onclick="set_form_aset_tidak_bergerak('edit',<?= $params_aset ?>);">
                                                                        <i class="bi bi-gear"></i>
                                                                    </button>
                                                                    <a href="<?= base_url("kependudukan/delete_aset/$item->id_aset") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                                        <i class="bi bi-trash"></i>
                                                                    </a>
                                                                    <a href="<?= $item->url_maps ?>" target="_blank" class="btn btn-success"><i class="bi bi-geo-alt-fill"></i> Lihat Lokasi</a>
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($penduduk as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $item->nama ?></td>
                                                            <td><?= $item->pekerjaan ?></td>
                                                            <td>Rp <?= number_format($item->pendapatan, 0, ',', '.') ?></td>
                                                            <td>
                                                                <?php $params_pendapatan = "[`$item->id_kependudukan`,`$item->pekerjaan`,`$item->pendapatan`]" ?>
                                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_pendapatan" onclick="set_form_pendapatan(<?= $params_pendapatan ?>);">
                                                                    <i class="bi bi-gear"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $no++ ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php $total_pendapatan = array_sum(array_column($penduduk, 'pendapatan')); ?>
                                            <h6 class="mb-0 fw-semibold" style="color: red;">Total Pendapatan : Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></h6>
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
                                                                <?php $params_kelas = "[`$item->id_kependudukan`,`$item->kelas`]" ?>
                                                                <button type="button" <?= !$is_usia_sekolah ? 'disabled' : '' ?> class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_kelas" onclick="set_form_kelas(<?= $params_kelas ?>);">
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
                            <div class="card mb-3 shadow-sm">
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
                                                                <?php $params_ktp = "[`$item->id_kependudukan`,`$item->status_ktp`]" ?>
                                                                <button type="button" <?= $is_can_set ? '' : 'disabled' ?> class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_ktp" onclick="set_form_ktp(<?= $params_ktp ?>);">
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
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI BANTUAN SOSIAL</h6>
                                            <hr>
                                            <button type="button" class="mb-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_bansos" onclick="set_form_bansos('insert')">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Penduduk</th>
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
                                                            <td style="white-space: nowrap;"><?= $item->nama_penduduk ?></td>
                                                            <td><?= $item->jenis ?></td>
                                                            <td><?= $item->keterangan ?></td>
                                                            <td style="white-space: nowrap;"><?= date('d-m-Y', strtotime($item->tanggal_penetapan)) ?></td>
                                                            <td style="white-space: nowrap;"><?= $item->nilai ?></td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <?php $params_bansos = "[`$item->id_bansos`,`$item->nama_penduduk`,`$item->jenis`,`$item->keterangan`,`$item->tanggal_penetapan`,`$item->nilai`]" ?>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_bansos" onclick="set_form_bansos('edit',<?= $params_bansos ?>);">
                                                                        <i class="bi bi-gear"></i>
                                                                    </button>
                                                                    <a href="<?= base_url("kependudukan/delete_bansos/$item->id_bansos") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                                        <i class="bi bi-trash"></i>
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">PENDUDUK DISABILITAS</h6>
                                            <hr>
                                            <button type="button" class="mb-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_disabilitas" onclick="set_form_disabilitas('insert')">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>nama Penduduk</th>
                                                        <th>Jenis Disabilitas</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($disabilitas as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td style="white-space: nowrap;"><?= $item->nama_penduduk ?></td>
                                                            <td style="white-space: nowrap;"><?= $item->jenis_disabilitas ?></td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <?php $params_disabilitas = "[`$item->id_disabilitas`,`$item->nama_penduduk`,`$item->jenis_disabilitas`]" ?>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_disabilitas" onclick="set_form_disabilitas('edit',<?= $params_disabilitas ?>);">
                                                                        <i class="bi bi-gear"></i>
                                                                    </button>
                                                                    <a href="<?= base_url("kependudukan/delete_disabilitas/$item->id_disabilitas") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                                        <i class="bi bi-trash"></i>
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="my-1 fw-bolder text-center">INFORMASI TAMBAHAN</h6>
                                            <hr>
                                            <button type="button" class="mb-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_informasi_tambahan" onclick="set_form_informasi_tambahan('insert')">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table id="" class="table table-bordered text-capitalize" style="font-size: .9em;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Informasi Terkait</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1 ?>
                                                    <?php foreach ($informasi_tambahan as $item) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td style="white-space: nowrap;"><?= $item->informasi ?></td>
                                                            <td><?= $item->deskripsi ?></td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <?php $params_informasi_tambahan = "[`$item->id_informasi_tambahan`,`$item->informasi`,`$item->deskripsi`]" ?>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_informasi_tambahan" onclick="set_form_informasi_tambahan('edit',<?= $params_informasi_tambahan ?>);">
                                                                        <i class="bi bi-gear"></i>
                                                                    </button>
                                                                    <a href="<?= base_url("kependudukan/delete_informasi_tambahan/$item->id_informasi_tambahan") ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">
                                                                        <i class="bi bi-trash"></i>
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
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="modal_keluarga" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Form Informasi Keluarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('kependudukan/edit_keluarga') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_keluarga" id="id_keluarga" hidden>
                            <div class="form-group col-12 col-md-4">
                                <label for="no_kk" class="form-label">No Kartu Keluarga</label>
                                <input type="number" name="no_kk" id="no_kk" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" name="rt" id="rt" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" name="rw" id="rw" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" id="kelurahan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="foto_rumah" class="form-label">Upload Foto Rumah</label>
                                <input type="file" class="form-control" id="foto_rumah" name="foto_rumah" accept="image/*">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="foto_sppt" class="form-label">Upload Foto SPPT</label>
                                <input type="file" class="form-control" id="foto_sppt" name="foto_sppt" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_penduduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Form Anggota Keluarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modal-form" method="post" action="<?= base_url('kependudukan/edit_penduduk') ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-12 col-md-4">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-5">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="" selected>--</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
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
                            <div class="form-group col-12 col-md-4">
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
                            <div class="form-group col-12 col-md-4">
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
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <select class="form-select text-capitalize" name="pendidikan" id="pendidikan" required>
                                    <option value="" selected>--</option>
                                    <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                                    <option value="Belum Tamat SD/Sederajat">Belum Tamat SD/Sederajat</option>
                                    <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                    <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                                    <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                    <option value="Diploma I/II">Diploma I/II</option>
                                    <option value="Akademi/Diploma 3/Sarjana Muda">Akademi/Diploma 3/Sarjana Muda</option>
                                    <option value="Diploma IV/Strata I">Diploma IV/Strata I</option>
                                    <option value="Strata II">Strata II</option>
                                    <option value="Strata III">Strata III</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_aset_bergerak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Aset Bergerak</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="no_kk" id="no_kk" value="<?= $keluarga->no_kk ?>" hidden>
                            <input name="id_aset" id="id_aset" hidden>
                            <input name="kategori" value="aset bergerak" hidden>
                            <div class="form-group col-12 col-md-4">
                                <label for="jenis" class="form-label">Jenis Aset</label>
                                <select class="form-select" name="jenis" id="jenis" required>
                                    <option value="" selected>--</option>
                                    <option value="kendaraan">Kendaraan</option>
                                    <option value="perangkat elektronik">Prangkat Elektronik</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="nilai" class="form-label">Nilai Aset</label>
                                <input type="number" name="nilai" id="nilai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_aset_tidak_bergerak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Aset Tidak Bergerak</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="no_kk" id="no_kk" value="<?= $keluarga->no_kk ?>" hidden>
                            <input name="id_aset" id="id_aset" hidden>
                            <input name="kategori" value="aset tidak bergerak" hidden>
                            <div class="form-group col-12 col-md-3">
                                <label for="jenis" class="form-label">Jenis Aset</label>
                                <select class="form-select" name="jenis" id="jenis" required>
                                    <option value="" selected>--</option>
                                    <option value="tanah">Tanah</option>
                                    <option value="bangunan">Bangunan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-5">
                                <label for="nop" class="form-label">NOP</label>
                                <input type="text" name="nop" id="nop" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="nilai" class="form-label">Nilai Aset</label>
                                <input type="number" name="nilai" id="nilai" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="luas" class="form-label">Luas</label>
                                <input type="text" name="luas" id="luas" class="form-control" required placeholder="Beri nilai Satuan (m2) / (ha)">
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="kepemilikan" class="form-label">Kepemilikan</label>
                                <select class="form-select" name="kepemilikan" id="kepemilikan" required>
                                    <option value="" selected>--</option>
                                    <option value="milik pribadi">Milik Pribadi</option>
                                    <option value="sewa">Sewa</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="lama_sewa" class="form-label">Lama Sewa</label>
                                <input type="text" name="lama_sewa" id="lama_sewa" class="form-control" placeholder="-">
                            </div>
                            <div class="form-group col-12">
                                <label for="url_maps" class="form-label">URL Maps</label>
                                <input type="text" name="url_maps" id="url_maps" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_pendapatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Pendapatan Anggota Keluarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('kependudukan/edit_pendapatan'); ?>" method="post">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_kependudukan" id="id_kependudukan" hidden>
                            <div class="form-group col-12">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="pendapatan" class="form-label">Nominal Pendapatan</label>
                                <input type="number" name="pendapatan" id="pendapatan" class="form-control" required>
                                <div class="form-text">Beri nilai 0 bila tidak memiliki pendapatan.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_kelas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Set Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('kependudukan/edit_kelas'); ?>" method="post">
                    <div class="modal-body">
                        <input name="id_kependudukan" id="id_kependudukan" hidden>
                        <label for="kelas" class="form-label">Pilih Kelas</label>
                        <select class="form-select" name="kelas" id="kelas" required>
                            <option selected value="">--</option>
                            <option value="1">Kelas 1 SD/Sederajat</option>
                            <option value="2">Kelas 2 SD/Sederajat</option>
                            <option value="3">Kelas 3 SD/Sederajat</option>
                            <option value="4">Kelas 4 SD/Sederajat</option>
                            <option value="5">Kelas 5 SD/Sederajat</option>
                            <option value="6">Kelas 6 SD/Sederajat</option>
                            <option value="7">Kelas 7 SMP/Sederajat</option>
                            <option value="8">Kelas 8 SMP/Sederajat</option>
                            <option value="9">Kelas 9 SMP/Sederajat</option>
                            <option value="10">Kelas 10 SMA/Sederajat</option>
                            <option value="11">Kelas 11 SMA/Sederajat</option>
                            <option value="12">Kelas 12 SMA/Sederajat</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_ktp" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Kepemilikan KTP</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('kependudukan/edit_ktp'); ?>" method="post">
                    <div class="modal-body">
                        <input name="id_kependudukan" id="id_kependudukan" hidden>
                        <select class="form-select" name="status_ktp" id="status_ktp">
                            <option value="belum diketahui">Belum diketahui</option>
                            <option value="memiliki KTP">Memiliki KTP</option>
                            <option value="belum memiliki KTP">Belum memiliki KTP</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_bansos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Bantuan Sosial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="no_kk" id="no_kk" value="<?= $keluarga->no_kk ?>" hidden>
                            <input name="id_bansos" id="id_bansos" hidden>
                            <div class="form-group col-12">
                                <select class="form-select text-capitalize" name="nama_penduduk" id="nama_penduduk">
                                    <option value="">-</option>
                                    <?php foreach ($penduduk as $item) : ?>
                                        <option value="<?= $item->nama ?>"><?= $item->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="jenis" class="form-label">Jenis Bantuan</label>
                                <input type="text" name="jenis" id="jenis" class="form-control" required placeholder="PKH, BPNT, Dsb..">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="tanggal_penetapan" class="form-label">Tanggal Penetapan</label>
                                <input type="date" name="tanggal_penetapan" id="tanggal_penetapan" class="form-control" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="text" name="nilai" id="nilai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_disabilitas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Disabilitas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_disabilitas" id="id_disabilitas" hidden>
                            <input name="no_kk" id="no_kk" value="<?= $keluarga->no_kk ?>" hidden>
                            <div class="form-group col-12">
                                <select class="form-select text-capitalize" name="nama_penduduk" id="nama_penduduk" required>
                                    <option value="">-</option>
                                    <?php foreach ($penduduk as $item) : ?>
                                        <option value="<?= $item->nama ?>"><?= $item->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <select class="form-select" name="jenis_disabilitas" id="jenis_disabilitas" required>
                                    <option value="">-</option>
                                    <option value="tuna netra">Tuna Netra</option>
                                    <option value="tuna rungu">Tuna Rungu</option>
                                    <option value="tuna wicara">Tuna Wicara</option>
                                    <option value="tuna daksa">Tuna Daksa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_informasi_tambahan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Form Informasi Tambahan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="no_kk" id="no_kk" value="<?= $keluarga->no_kk ?>" hidden>
                            <input name="id_informasi_tambahan" id="id_informasi_tambahan" hidden>
                            <div class="form-group col-12">
                                <label for="informasi" class="form-label">Informasi Terkait</label>
                                <input type="text" name="informasi" id="informasi" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const set_form_keluarga = (data) => {
            const modal_keluarga = document.querySelector('#modal_keluarga');
            const fields = ['id_keluarga', 'no_kk', 'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan'];

            fields.forEach((e, i) => {
                const element = modal_keluarga.querySelector(`#${e}`);
                element.value = data[i];
            })
        }

        const set_form_penduduk = (data) => {
            const modal_penduduk = document.querySelector('#modal_penduduk');
            const fields = ['id_kependudukan', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'tempat_lahir', 'agama', 'hubungan_keluarga', 'status_perkawinan', 'pendidikan', 'nama_ibu', 'nama_ayah'];

            fields.forEach((e, i) => {
                const element = modal_penduduk.querySelector(`#${e}`);
                element.value = data[i];
            })
        }

        const set_form_aset_bergerak = (title, data) => {
            const modal_aset_bergerak = document.querySelector('#modal_aset_bergerak');
            const form = modal_aset_bergerak.querySelector('form').setAttribute('action', `<?= base_url(); ?>kependudukan/${title}_aset`);
            const fields = ['id_aset', 'jenis', 'keterangan', 'nilai'];
            fields.forEach((e, i) => {
                const element = modal_aset_bergerak.querySelector(`#${e}`);
                element.value = title == 'insert' ? '' : data[i];
            })
        }

        const set_form_aset_tidak_bergerak = (title, data) => {
            const modal_aset_tidak_bergerak = document.querySelector('#modal_aset_tidak_bergerak');
            const form = modal_aset_tidak_bergerak.querySelector('form').setAttribute('action', `<?= base_url(); ?>kependudukan/${title}_aset`);
            const fields = ['id_aset', 'jenis', 'nop', 'keterangan', 'nilai', 'luas', 'kepemilikan', 'lama_sewa', 'url_maps'];
            fields.forEach((e, i) => {
                const element = modal_aset_tidak_bergerak.querySelector(`#${e}`);
                element.value = title == 'insert' ? '' : data[i];
            })
        }

        const set_form_pendapatan = (data) => {
            const modal_pendapatan = document.querySelector('#modal_pendapatan');
            const fields = ['id_kependudukan', 'pekerjaan', 'pendapatan'];

            fields.forEach((e, i) => {
                const element = modal_pendapatan.querySelector(`#${e}`);
                element.value = data[i];
            })
        }

        const set_form_kelas = (data) => {
            const modal_kelas = document.querySelector('#modal_kelas');
            const fields = ['id_kependudukan', 'kelas'];
            fields.forEach((e, i) => {
                const element = modal_kelas.querySelector(`#${e}`);
                element.value = data[i];
            })
        }

        const set_form_ktp = ([_id_kependudukan, _status_ktp]) => {
            const modal_ktp = document.querySelector('#modal_ktp');
            const id_kependudukan = modal_ktp.querySelector('#id_kependudukan');
            const status_ktp = modal_ktp.querySelector('#status_ktp');
            id_kependudukan.value = _id_kependudukan;
            status_ktp.value = _status_ktp;
        }

        const set_form_bansos = (title, data) => {
            const modal_bansos = document.querySelector('#modal_bansos');
            const form = modal_bansos.querySelector('form').setAttribute('action', `<?= base_url(); ?>kependudukan/${title}_bansos`);
            const fields = ['id_bansos', 'nama_penduduk', 'jenis', 'keterangan', 'tanggal_penetapan', 'nilai'];
            fields.forEach((e, i) => {
                const element = modal_bansos.querySelector(`#${e}`);
                element.value = title == 'insert' ? '' : data[i];
            })
        }

        const set_form_disabilitas = (title, data) => {
            const modal_disabilitas = document.querySelector('#modal_disabilitas');
            const form = modal_disabilitas.querySelector('form').setAttribute('action', `<?= base_url(); ?>kependudukan/${title}_disabilitas`);
            const fields = ['id_disabilitas', 'nama_penduduk', 'jenis_disabilitas', ];
            fields.forEach((e, i) => {
                const element = modal_disabilitas.querySelector(`#${e}`);
                element.value = title == 'insert' ? '' : data[i];
            })
        }

        const set_form_informasi_tambahan = (title, data) => {
            const modal_informasi_tambahan = document.querySelector('#modal_informasi_tambahan');
            const form = modal_informasi_tambahan.querySelector('form').setAttribute('action', `<?= base_url(); ?>kependudukan/${title}_informasi_tambahan`);
            const fields = ['id_informasi_tambahan', 'informasi', 'deskripsi'];
            fields.forEach((e, i) => {
                const element = modal_informasi_tambahan.querySelector(`#${e}`);
                element.value = title == 'insert' ? '' : data[i];
            })
        }
    </script>

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>