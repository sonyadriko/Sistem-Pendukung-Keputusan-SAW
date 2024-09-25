<?php
include '../config/database.php';

if (isset($_GET['GetID'])) {
    $id = $_GET['GetID'];

    // Ambil data anggota berdasarkan ID
    $query = "SELECT * FROM anggota WHERE id_anggota = '$id'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $nama = $row['nama_anggota'];
        $tingkat = $row['tingkat_golongan_asn'];
        $jangka_waktu = $row['jangka_waktu_pinjam'];
        $realisasi = $row['realisasi_pencairan'];
        $jasa = $row['jasa_diterima'];
        $frekuensi = $row['frekuensi_pinjaman'];
        $modal = $row['jumlah_modal'];
        $tgl_terdaftar = $row['tgl_terdaftar'];
        $simpanan = $row['intensitas_simpanan_wajib'];
        $angsuran = $row['intensitas_angsuran'];
    } else {
        // Jika data tidak ditemukan
        echo "Data tidak ditemukan!";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['GetID'];
    $nama = $_POST['nama'];
    $tingkat = $_POST['tingkat'];
    $jangka_waktu = $_POST['jangka_waktu'];
    $realisasi = str_replace(".", "", $_POST['realisasi']); // Menghapus pemisah ribuan
    $jasa = str_replace(".", "", $_POST['jasa']); // Mata uang jasa diterima
    $frekuensi = $_POST['frekuensi'];
    $modal = $_POST['modal'];
    $simpanan = $_POST['simpanan'];
    $angsuran = str_replace(".", "", $_POST['angsuran']); // Mata uang intensitas angsuran

    // Update query
    $query = "UPDATE anggota SET 
                nama_anggota='$nama', 
                tingkat_golongan_asn='$tingkat', 
                jangka_waktu_pinjam='$jangka_waktu', 
                realisasi_pencairan='$realisasi', 
                jasa_diterima='$jasa', 
                frekuensi_pinjaman='$frekuensi', 
                jumlah_modal='$modal', 
                intensitas_simpanan_wajib='$simpanan', 
                intensitas_angsuran='$angsuran'
              WHERE id_anggota='$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: anggota.php"); // Redirect to anggota list page after updating
        exit();
    } else {
        echo 'Please Check Your Query';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <!-- Sidebar -->
    <?php include 'partials/sidebar.php' ?>

    <div class="dashboard-main-wrapper">
        <?php include 'partials/topnavbar.php' ?>

        <div class="dashboard-body">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Edit Data Anggota</h4>
                            <form method="post">
                                <div class="form-group">
                                    <label>Nama Anggota</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"
                                        required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Tingkat Golongan ASN</label>
                                    <select name="tingkat" class="form-control" required>
                                        <option value="Honorer" <?php if ($tingkat == "Honorer") echo "selected"; ?>>
                                            Honorer</option>
                                        <option value="Gol. I" <?php if ($tingkat == "Gol. I") echo "selected"; ?>>Gol.
                                            I</option>
                                        <option value="Gol. II" <?php if ($tingkat == "Gol. II") echo "selected"; ?>>
                                            Gol. II</option>
                                        <option value="Gol. III" <?php if ($tingkat == "Gol. III") echo "selected"; ?>>
                                            Gol. III</option>
                                        <option value="Gol. IV" <?php if ($tingkat == "Gol. IV") echo "selected"; ?>>
                                            Gol. IV</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Jangka Waktu Pinjam</label>
                                    <input type="number" name="jangka_waktu" class="form-control"
                                        value="<?php echo $jangka_waktu; ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Realisasi Pencairan (IDR)</label>
                                    <input type="text" name="realisasi" class="form-control"
                                        value="<?php echo number_format($realisasi, 2, ',', '.'); ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Besarnya Jasa yang Diterima (IDR)</label>
                                    <input type="text" name="jasa" class="form-control"
                                        value="<?php echo number_format($jasa, 2, ',', '.'); ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Frekuensi Pinjaman</label>
                                    <input type="number" name="frekuensi" class="form-control"
                                        value="<?php echo $frekuensi; ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Jumlah Modal</label>
                                    <input type="number" name="modal" class="form-control" value="<?php echo $modal; ?>"
                                        required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Intensitas Simpanan Wajib</label>
                                    <input type="number" name="simpanan" class="form-control"
                                        value="<?php echo $simpanan; ?>" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Intensitas Angsuran Pinjaman (IDR)</label>
                                    <input type="text" name="angsuran" class="form-control"
                                        value="<?php echo number_format($angsuran, 2, ',', '.'); ?>" required>
                                </div>
                                <button type="submit" name="update" class="btn btn-primary mt-4">Update</button>
                                <a href="anggota.php" class="btn btn-secondary mt-4">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'partials/footer.php' ?>
    </div>

    <!-- jQuery js -->
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