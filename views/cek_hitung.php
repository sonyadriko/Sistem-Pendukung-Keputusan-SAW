<?php
include '../config/database.php';
// session_start();
// if (!isset($_SESSION['id_users'])) {
//     header('Location: login.php');
// }
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if any checkboxes are selected
    if (!empty($_POST['selected_items'])) {
        // Redirect to hitung1.php with selected id_penilaian values
        $selected_ids = implode(",", $_POST['selected_items']);
        header("Location: hasil1.php?id_anggota=$selected_ids");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Anggota</title>
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
                            <h4>Data Anggota</h4>
                            <div class="table-responsive">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped-columns" id="dataTable">
                                            <thead>
                                                <th>#</th>
                                                <th>Nama Anggota</th>
                                                <th>Tingkat Golongan ASN</th>
                                                <th>Jangka Waktu Pinjam</th>
                                                <th>Realisasi Pencairan</th>
                                                <th>Jasa Diterima</th>
                                                <th>Frekuensi Pinjaman</th>
                                                <th>Jumlah Modal</th>
                                                <th>Tanggal Terdaftar</th>
                                                <th>Intensitas Simpanan Wajib</th>
                                                <th>Intensitas Angsuran</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <?php 
            $no = 1;
            $get_data = mysqli_query($conn, "SELECT * FROM anggota");
            while($display = mysqli_fetch_array($get_data)) {
                $id = $display['id_anggota'];
                $nama = $display['nama_anggota'];
                $tingkat = $display['tingkat_golongan_asn'];
                $jangka_waktu = $display['jangka_waktu_pinjam'];
                $realisasi = $display['realisasi_pencairan'];
                $jasa = $display['jasa_diterima'];
                $frekuensi = $display['frekuensi_pinjaman'];
                $modal = $display['jumlah_modal'];
                $tgl_terdaftar = $display['tgl_terdaftar'];
                $simpanan = $display['intensitas_simpanan_wajib'];
                $angsuran = $display['intensitas_angsuran'];
            ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $nama; ?></td>
                                                    <td><?php echo $tingkat; ?></td>
                                                    <td><?php echo $jangka_waktu; ?></td>
                                                    <td><?php echo number_format($realisasi, 2); ?></td>
                                                    <td><?php echo number_format($jasa, 2); ?></td>
                                                    <td><?php echo $frekuensi; ?></td>
                                                    <td><?php echo number_format($modal, 2); ?></td>
                                                    <td><?php echo $tgl_terdaftar; ?></td>
                                                    <td><?php echo number_format($simpanan, 6); ?></td>
                                                    <td><?php echo number_format($angsuran, 2); ?></td>
                                                    <td>
                                                        <input type="checkbox" name="selected_items[]"
                                                            value="<?php echo $id ?>" class="action-checkbox">

                                                    </td>

                                                </tr>
                                                <?php
            $no++;
                }
            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="submit" name="submit" value="Hitung" class="btn btn-primary btn-user">
                                </form>
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
        $(' #dataTable').DataTable();
    });
    </script>

</body>

</html>