<!-- Modal Reject -->
<div class="modal fade" id="modal_reject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_reject">Alasan Penolakan.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $role = $this->session->userdata('role') == "sekretaris desa" ? "sekdes" : "kades"; ?>
            <form method="post" action="<?= base_url("serahterima/reject/$role/$jenis_surat") ?>" autocomplete="off">
                <div class="modal-body">
                    <input type="text" name="id" id="id_surat" hidden>
                    <div class="mb-3">
                        <label for="notifikasi" class="form-label">Masukan Pesan</label>
                        <textarea class="form-control" name="notifikasi" id="notifikasi" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Reject Form -->

<!-- Reject Script -->
<script>
    const inputIdSurat = document.querySelector('#id_surat');
    const reject = (id) => {
        inputIdSurat.value = id
    }
</script>
<!-- EndReject Script -->