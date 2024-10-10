<div class="btn-group" role="group">
    <?php if ($this->session->userdata('role') == 'penduduk') : ?>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
            <i class="bi bi-plus-circle"></i> Tambah
        </button>
    <?php endif ?>
    <!-- <button type="button" class="btn btn-success btn-sm">
        <i class="bi bi-info-circle"></i> Informasi
    </button> -->
</div>