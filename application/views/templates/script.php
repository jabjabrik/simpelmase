<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/chart-pie.js') ?>"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script> -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Config -->
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            "lengthMenu": [
                [5, 25, 100],
                [5, 25, 100]
            ],
            "language": {
                "lengthMenu": "_MENU_",
                "search": "Telusuri:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">",
                    "previous": "<"
                },
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });
</script>