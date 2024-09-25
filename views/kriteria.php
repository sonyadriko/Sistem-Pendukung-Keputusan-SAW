<?php
include '../config/database.php';

// Fetch total weight from the database
$totalBobotQuery = "SELECT SUM(bobot) AS total_bobot FROM kriteria";
$totalBobotResult = mysqli_query($conn, $totalBobotQuery);
$totalBobotData = mysqli_fetch_assoc($totalBobotResult);
$totalBobot = round($totalBobotData['total_bobot'], 2); // Round to 2 decimal places
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- DataTables CSS -->
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

                            <!-- Warning message -->
                            <?php if ($totalBobot != 1) : ?>
                            <div class="alert alert-warning" role="alert">
                                Bobot harus sama dengan 1!
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
                                        $get_data = mysqli_query($conn, "SELECT * FROM kriteria");
                                        while($display = mysqli_fetch_array($get_data)) {
                                            $id = $display['id_kriteria'];
                                            $nama = $display['nama_kriteria'];
                                            $bobot = $display['bobot'];
                                            $jenis = $display['jenis'];
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $bobot; ?></td>
                                            <td><?php echo $jenis; ?></td>
                                            <td>
                                                <a href='edit_kriteria.php?GetID=<?php echo $id; ?>'
                                                    style="text-decoration: none; list-style: none;">
                                                    <input type='button' value='Ubah' class="btn btn-primary btn-user">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
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

    <!-- Jquery js -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="../assets/js/boostrap.bundle.min.js"></script>
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
        $('#dataTable').DataTable();
    });
    </script>

</body>

</html>