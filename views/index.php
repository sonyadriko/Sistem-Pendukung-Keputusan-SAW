<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Dashboard</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="../assets/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="../assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="../assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="../assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="../assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="../assets/css/jquery-jvectormap-2.0.5.css">
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

                    <!-- Top Course Start -->
                    <div class="card mt-12">
                        <div class="card-body">
                            <div class="mb-20 flex-between flex-wrap gap-8">
                                <h4 class="mb-0">Metode Simple Additive Weighting</h4>
                                <span>Konsep dasar metode SAW ini adalah mencari penjumlahan terbobot dari
                                    rating kinerja pada setiap alternatif semua atribut. Metode SAW disarankan untuk
                                    penyeleksian dalam SPK multi proses.</span>
                                <span>Metode SAW mengenal adanya 2 (dua) atribut yaitu kriteria keuntungan
                                    alternatif (benefit) dan kriteria biaya (cost). Perbedaan mendasar dari kedua
                                    kriteria ini adalah dalam pemilihan kriteria ketika mengambil keputusan. Metode
                                    SAW dapat diartikan sebagai metode pembobotan sederhana atau penjumlahan
                                    pada penyelesaian masalah dalam sebuah SPK.</span>

                            </div>

                            <div id="doubleLineChart" class="tooltip-style y-value-left"></div>

                        </div>
                    </div>

                    <div class="card mt-24">
                        <div class="card-body">
                            <div class="mb-20 flex-between flex-wrap gap-8">
                                <h4 class="mb-0">Kelebihan Metode Simple Additive Weighting</h4>
                                <span>Kelebihan dari metode SAW antara lain menentukan nilai bobot untuk
                                    setiap atribut kemudian dilanjutkan dengan proses perankingan yang akan
                                    menyeleksi alternatif terbaik dari sejumlah alternatif , selanjutnya kelebihan
                                    metode tersebut yakni penilaian yang dilakukan akan lebih tepat karena
                                    didasarkan pada nilai kriteria dari bobot preferensi yang sudah ditentukan dan
                                    adanya perhitungan normalisasi matriks sesuai dengan nilai atribut (antara nilai
                                    benefit dan cost).</span>
                            </div>

                            <div id="doubleLineChart" class="tooltip-style y-value-left"></div>

                        </div>
                    </div>
                    <!-- Top Course End -->


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
    <!-- file upload -->
    <script src="../assets/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="../assets/js/plyr.js"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- full calendar -->
    <script src="../assets/js/full-calendar.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="../assets/js/editor-quill.js"></script>
    <!-- apex charts -->
    <script src="../assets/js/apexcharts.min.js"></script>
    <!-- Calendar Js -->
    <script src="../assets/js/calendar.js"></script>
    <!-- jvectormap Js -->
    <script src="../assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="../assets/js/jquery-jvectormap-world-mill-en.js"></script>

    <!-- main js -->
    <script src="../assets/js/main.js"></script>



</body>

</html>