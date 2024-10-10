<!-- Modal Notification -->
<div class="modal fade" id="modal_notification" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_notification"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="notifikasi" class="form-label">Pesan</label>
                    <textarea class="form-control" id="msg_notification" rows="5" disabled></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End Notification Form -->

<!-- Script Notification -->
<script>
    const title_notification = document.querySelector('#title_notification');
    const msg_notification = document.querySelector('#msg_notification');

    const notification = (msg, sekdes, kades) => {
        if (sekdes === 'ditolak') {
            title_notification.innerHTML = 'Pesan Dari Sekretaris Desa'
        }

        if (kades === 'ditolak') {
            title_notification.innerHTML = 'Pesan Dari Kepala Desa'
        }

        msg_notification.innerHTML = msg
    }
</script>
<!-- End Script Notification -->