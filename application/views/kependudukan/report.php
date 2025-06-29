<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>

<body class="sb-nav-fixed">
    <main>
        <div class="container-fluid p-3">
            <!-- Alert -->
            <?php $this->view('templates/alert'); ?>
            <!-- End Alert -->
            <h3 class="mt-4">Kelola Data Penduduk</h3>

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
                                            <?php else: ?>
                                                <span>---</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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
                                                <th>Luas</th>
                                                <th>Kepemilikan</th>
                                                <th>Lama Sewa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($aset_tidak_bergerak as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->jenis ?></td>
                                                    <td><?= $item->keterangan ?></td>
                                                    <td>Rp <?= number_format($item->nilai, 0, ',', '.') ?></td>
                                                    <td class="text-lowercase"><?= $item->luas ?></td>
                                                    <td><?= $item->kepemilikan ?></td>
                                                    <td><?= empty($item->lama_sewa) ? '-' : $item->lama_sewa ?></td>
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table id="" class="table table-bordered text-capitalize" style="font-size: .9em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Bansos</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal Penetapan</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($bansos as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td style="white-space: nowrap;"><?= $item->jenis ?></td>
                                                    <td><?= $item->keterangan ?></td>
                                                    <td style="white-space: nowrap;"><?= $item->tanggal_penetapan ?></td>
                                                    <td style="white-space: nowrap;"><?= $item->nilai ?></td>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($informasi_tambahan as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td style="white-space: nowrap;"><?= $item->informasi ?></td>
                                                    <td><?= $item->deskripsi ?></td>
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
</body>

</html>