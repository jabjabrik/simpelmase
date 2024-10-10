<?php if ($item->validasi_sekdes == 'disetujui' && $item->validasi_kades == 'disetujui') : ?>
    <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="<?= $item->status_print == 'mandiri' ? 'Dokumen Dapat di-unduh' : 'Dokumen Dapat Diambil di Kantor Desa' ?>">
        <i class="text-success bi bi-check-circle-fill"></i>
        Selesai
    </span>
<?php elseif ($item->validasi_sekdes == 'ditolak' || $item->validasi_kades == 'ditolak') : ?>
    <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Mohon ajukan surat lagi dan masukan data sesuai persyaratan!">
        <i class="text-danger bi bi-x-octagon-fill"></i>
        Ditolak!
    </span>
<?php else : ?>
    <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Menunggu Konfirmasi Dari Admin">
        <i class="text-primary bi bi-info-circle-fill"></i>
        Diproses
    </span>
<?php endif; ?>