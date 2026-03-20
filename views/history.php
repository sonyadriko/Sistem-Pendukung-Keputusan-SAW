<?php
include '../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Perhitungan</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">

</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay Start ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->
    <?php include 'partials/sidebar.php'?>

    <!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">
        <?php include 'partials/topnavbar.php'?>


        <div class="dashboard-body">

            <div class="row gy-4">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">History Perhitungan SAW</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th width="250">Tanggal Perhitungan</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_data = mysqli_query($conn, "SELECT * FROM hasil ORDER BY created_at DESC");
                                        $num_rows = mysqli_num_rows($get_data);

                                        if ($num_rows > 0) {
                                            $no = 1;
                                            while ($display = mysqli_fetch_array($get_data)) {
                                                $id = htmlspecialchars($display['id_hasil']);
                                                $tanggal = $display['created_at'];

                                                // Format tanggal Indonesia
                                                $timestamp = strtotime($tanggal);
                                                $formatted_date = date('d/m/Y H:i', $timestamp);
                                                $hari_indo = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                                                $nama_hari = $hari_indo[date('w', $timestamp)];
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <span class="fw-medium"><?php echo $nama_hari; ?>, <?php echo $formatted_date; ?></span>
                                                <br><small class="text-muted"><?php echo $tanggal; ?></small>
                                            </td>
                                            <td>
                                                <a href="detail_history.php?GetID=<?php echo $id; ?>"
                                                   class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
                                                   <i class="ph ph-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                        <tr>
                                            <td colspan="3" class="text-center py-5">
                                                <i class="ph ph-file-text" style="font-size: 48px; color: #dee2e6;"></i>
                                                <p class="mt-3 mb-0 text-muted">Belum ada history perhitungan</p>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include 'partials/footer.php' ?>
    </div>

    <!-- jQuery JS -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="../assets/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Icons JS -->
    <script src="../assets/js/phosphor-icon.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/jquery-ui.js"></script>
    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- DataTable Initialization -->
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            order: [[0, 'desc']]
        });
    });
    </script>

</body>

</html>