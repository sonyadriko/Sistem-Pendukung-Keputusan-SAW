<?php
include '../config/database.php';

// Ambil ID dari parameter GET
if (isset($_GET['GetID'])) {
    $id = $_GET['GetID'];

    // Query untuk mendapatkan data kriteria berdasarkan ID
    $query = "SELECT * FROM kriteria WHERE id_kriteria = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    // Jika data tidak ditemukan
    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Edit Kriteria</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                            <h4>Edit Kriteria</h4>
                            <form action="update_kriteria.php" method="POST">
                                <input type="hidden" name="id_kriteria" value="<?php echo $data['id_kriteria']; ?>">

                                <div class="mb-3">
                                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                    <input type="text" class="form-control" id="nama_kriteria"
                                        value="<?php echo $data['nama_kriteria']; ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="bobot" class="form-label">Bobot Kriteria</label>
                                    <input type="decimal" name="bobot" class="form-control" id="bobot"
                                        value="<?php echo $data['bobot']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis Kriteria</label>
                                    <select name="jenis" id="jenis" class="form-select" disabled>
                                        <option value="benefit"
                                            <?php echo ($data['jenis'] == 'benefit') ? 'selected' : ''; ?>>Benefit
                                        </option>
                                        <option value="cost"
                                            <?php echo ($data['jenis'] == 'cost') ? 'selected' : ''; ?>>Cost</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="kriteria.php" class="btn btn-secondary">Kembali</a>
                            </form>
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
    <!-- jQuery UI -->
    <script src="../assets/js/jquery-ui.js"></script>
    <!-- main js -->
    <script src="../assets/js/main.js"></script>

</body>

</html>