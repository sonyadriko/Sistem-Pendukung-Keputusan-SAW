<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include '../config/database.php';

// Fetch total weight from the database
$totalBobotQuery = "SELECT ROUND(SUM(bobot), 4) AS total_bobot FROM kriteria";
$totalBobotResult = mysqli_query($conn, $totalBobotQuery);
$totalBobotData = mysqli_fetch_assoc($totalBobotResult);
$totalBobot = (float) $totalBobotData['total_bobot'];
$bobotValid = abs($totalBobot - 1.0) < 0.0001; // Valid if rounded sum equals 1.0
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Kriteria</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jquery Ui -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <!-- Main css -->
    <link rel="stylesheet" href="../assets/css/main.css">

</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
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
                            <h4>Data Kriteria</h4>

                            <!-- Weight status message -->
                            <?php if (!$bobotValid) : ?>
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    <strong>Peringatan!</strong> Total bobot saat ini: <strong><?php echo number_format($totalBobot, 4); ?></strong>. Bobot harus sama dengan 1 untuk perhitungan SAW.
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                <div>
                                    Total bobot: <strong><?php echo number_format($totalBobot, 4); ?></strong> - Valid untuk perhitungan SAW.
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Kriteria</th>
                                            <th>Bobot Kriteria</th>
                                            <th>Jenis Kriteria</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $get_data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                                        while($display = mysqli_fetch_assoc($get_data)) :
                                            $id = htmlspecialchars($display['id_kriteria']);
                                            $nama = htmlspecialchars($display['nama_kriteria']);
                                            $bobot = htmlspecialchars($display['bobot']);
                                            $jenis = htmlspecialchars($display['jenis']);
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo number_format((float)$bobot, 4); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $jenis === 'Benefit' ? 'success' : 'danger'; ?>">
                                                    <?php echo $jenis; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="edit_kriteria.php?GetID=<?php echo $id; ?>" class="btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill me-1" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg>
                                                    Ubah
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        endwhile;
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

    <!-- Jquery js -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="../assets/js/phosphor-icon.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/jquery-ui.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>

    <!-- DataTable Initialization -->
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
        });
    });
    </script>

</body>

</html>