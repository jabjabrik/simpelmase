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

                    <div class="card mb-4 mx-0">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Serah Terima Surat Keterangan Usaha
                        </div>
                        <div class="card-body" style="overflow: auto;">
                            <!-- SK Usaha Component -->
                            <?php $data['jenis_surat'] = 'sk_usaha'; ?>
                            <?php $data['type'] = 'serahterima' ?>

                            <?php $this->view('surat/components/sk_usaha', $data) ?>
                            <!-- End SK Usaha Component -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Reject -->
    <?php $this->view('serahterima/components/reject'); ?>
    <!-- End Reject Form -->

    <!-- Notification Modal -->
    <?php $this->view('surat/components/notification'); ?>
    <!-- End Notification Modal -->

    <!-- Logout Modal -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->
</body>

</html>