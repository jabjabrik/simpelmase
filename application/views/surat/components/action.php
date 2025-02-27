<?php $role = $this->session->userdata('role'); ?>

<?php if ($role != 'kepala desa') : ?>
    <a href="<?= base_url("surat/sk_delete/$item->id/$jenis_surat") ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');" class="btn btn-outline-danger btn-sm">
        <i class="bi bi-trash"></i>
    </a>
<?php endif ?>
<?php if (($item->validasi_sekdes == 'disetujui' && $item->validasi_kades == 'disetujui') && ($item->status_print == 'mandiri' || $role != 'penduduk')) : ?>
    <a href="<?= base_url("files/dokumen/$item->file_surat") ?>" class="btn btn-outline-success btn-sm">
        <i class="bi bi-download"></i>
    </a>
<?php endif; ?>
<?php if ($item->validasi_sekdes == 'ditolak' || $item->validasi_kades == 'ditolak') : ?>
    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_notification" onclick="notification('<?= $item->notifikasi ?>', '<?= $item->validasi_sekdes ?>', '<?= $item->validasi_kades ?>')">
        <i class="bi bi-bell-fill"></i>
    </button>
<?php endif; ?>
<?php if (!($item->validasi_sekdes == 'ditolak' || $item->validasi_kades == 'ditolak')) : ?>
    <?php if ($item->validasi_sekdes == 'proses' && $role == 'sekretaris desa') : ?>
        <a href="<?= base_url("surat/accept/sekdes/$jenis_surat/$item->id") ?>" onclick="return confirm('Apakah Anda yakin ingin mengkonfirmasi surat?');" id="notificationBtn" type="button" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-check-lg"></i>
        </a>
        <p id="notificationMsg" hidden><?= $item->notifikasi ?></p>
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_reject" onclick="reject('<?= $item->id ?>')">
            <i class="bi bi-x-octagon-fill"></i>
        </button>
    <?php endif; ?>
    <?php if ($item->validasi_kades == 'proses' && $role == 'kepala desa') : ?>
        <a href="<?= base_url("surat/accept/kades/$jenis_surat/$item->id") ?>" onclick="return confirm('Apakah Anda yakin ingin mengkonfirmasi surat?');" id="notificationBtn" type="button" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-check-lg"></i>
        </a>
        <p id="notificationMsg" hidden><?= $item->notifikasi ?></p>
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_reject" onclick="reject('<?= $item->id ?>')">
            <i class="bi bi-x-octagon-fill"></i>
        </button>
    <?php endif; ?>
<?php endif; ?>