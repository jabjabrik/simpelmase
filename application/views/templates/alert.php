<?php $alert = $this->session->flashdata('alert'); ?>

<?php if ($alert) : ?>
    <div class="alert alert-<?= $alert['color'] ?> alert-dismissible fade show" role="alert">
        <?= $alert['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>