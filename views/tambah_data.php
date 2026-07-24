<?php
include '../config/database.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $tingkat = $_POST['tingkat'];
    $jangka_waktu = $_POST['jangka_waktu'];
    $realisasi = str_replace(".", "", $_POST['realisasi']); // Menghapus pemisah ribuan
    $jasa = str_replace(".", "", $_POST['jasa']); // Mata uang jasa diterima
    $frekuensi = $_POST['frekuensi'];
    $modal = $_POST['modal'];
    $simpanan = $_POST['simpanan'];
    $angsuran = str_replace(".", "", $_POST['angsuran']); // Mata uang intensitas angsuran
    $tanggal_terdaftar = $_POST['tanggal_terdaftar']; // Mengambil tanggal terdaftar

    // Insert query
    $query = "INSERT INTO anggota (nama_anggota, tingkat_golongan_asn, jangka_waktu_pinjam, realisasi_pencairan, jasa_diterima, frekuensi_pinjaman, jumlah_modal, intensitas_simpanan_wajib, intensitas_angsuran, tgl_terdaftar) 
              VALUES ('$nama', '$tingkat', '$jangka_waktu', '$realisasi', '$jasa', '$frekuensi', '$modal', '$simpanan', '$angsuran', '$tanggal_terdaftar')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: anggota.php"); // Redirect to anggota list page after adding
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
    <title>Tambah Data Anggota</title>
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
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Tambah Data Anggota</h4>
                            <form method="post">
                                <div class="row mt-4">
                                    <!-- Left Column -->
                                    <div class="col-lg-6 pe-4">
                                        <div class="form-group">
                                            <label>Nama Anggota</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Masukkan nama anggota" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Tingkat Golongan ASN (Golongan)</label>
                                            <select name="tingkat" class="form-control" required>
                                                <option value="Honorer">Honorer</option>
                                                <option value="Gol. I">Gol. I</option>
                                                <option value="Gol. II">Gol. II</option>
                                                <option value="Gol. III">Gol. III</option>
                                                <option value="Gol. IV">Gol. IV</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Jangka Waktu Pinjam (Bulan)</label>
                                            <input type="number" name="jangka_waktu" class="form-control"
                                                placeholder="Masukkan jangka waktu pinjam" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Realisasi Pencairan (Rp)</label>
                                            <input type="text" name="realisasi" class="form-control"
                                                placeholder="Masukkan realisasi pencairan" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Besarnya Jasa yang Diterima (Rp)</label>
                                            <input type="text" name="jasa" class="form-control"
                                                placeholder="Masukkan besarnya jasa yang diterima" required>
                                        </div>
                                    </div>
                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Frekuensi Pinjaman (Kali/Tahun)</label>
                                            <input type="number" name="frekuensi" class="form-control"
                                                placeholder="Masukkan frekuensi pinjaman" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Jumlah Modal (%)</label>
                                            <input type="number" name="modal" class="form-control"
                                                placeholder="Masukkan jumlah modal" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Intensitas Simpanan Wajib (%)</label>
                                            <input type="number" step="any" name="simpanan" class="form-control"
                                                placeholder="Masukkan intensitas simpanan wajib (contoh: 0.005782)" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Intensitas Angsuran Pinjaman (Rp)</label>
                                            <input type="text" name="angsuran" class="form-control"
                                                placeholder="Masukkan intensitas angsuran pinjaman" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>Tanggal Terdaftar (-)</label>
                                            <input type="date" name="tanggal_terdaftar" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" name="tambah" class="btn btn-primary mt-4">Tambah</button>
                                        <a href="anggota.php" class="btn btn-secondary mt-4">Batal</a>
                                    </div>
                                </div>
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