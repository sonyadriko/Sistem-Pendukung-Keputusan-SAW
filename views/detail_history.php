<?php
include '../config/database.php';

// Format date to Indonesian - define function before any output
function formatTanggalIndonesia($date) {
    if (empty($date)) return '-';

    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $timestamp = strtotime($date);
    $hari = date('N', $timestamp);
    $nama_hari = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    return $nama_hari[$hari] . ', ' . date('j', $timestamp) . ' ' . $bulan[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}

// Initialize variables
$id_history = null;
$calculation_date = null;
$history_data = array();
$has_error = false;

// Validate and sanitize input
if (isset($_GET['GetID'])) {
    $id_history = mysqli_real_escape_string($conn, $_GET['GetID']);

    // Verify history exists and get calculation date - using correct column name
    $check_query = "SELECT created_at FROM hasil WHERE id_hasil = '$id_history'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $hasil_row = mysqli_fetch_assoc($check_result);
        $calculation_date = $hasil_row['created_at'];

        // Get history details - sanitized query
        $query = "SELECT * FROM detail_hasil WHERE id_hasil = '$id_history' ORDER BY ranking ASC";
        $detail_result = mysqli_query($conn, $query);

        if ($detail_result) {
            while($row = mysqli_fetch_assoc($detail_result)) {
                $history_data[] = $row;
            }
        }
    } else {
        $has_error = true;
    }
} else {
    $has_error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail History Perhitungan</title>
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <link rel="stylesheet" href="../assets/css/main.css">

    <style>
        .ranking-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-weight: bold;
        }
        .rank-1 {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #fff;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);
        }
        .rank-2 {
            background: linear-gradient(135deg, #C0C0C0, #A8A8A8);
            color: #fff;
            box-shadow: 0 2px 8px rgba(192, 192, 192, 0.4);
        }
        .rank-3 {
            background: linear-gradient(135deg, #CD7F32, #B87333);
            color: #fff;
            box-shadow: 0 2px 8px rgba(205, 127, 50, 0.4);
        }
        .rank-other {
            background-color: #6c757d;
            color: #fff;
        }
        .date-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .date-info .date-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }
        .date-info .date-value {
            font-size: 1.125rem;
            font-weight: 600;
            margin-top: 4px;
        }
    </style>

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
                                <div>
                                    <h4 class="mb-1">Detail History Perhitungan</h4>
                                    <p class="text-muted mb-0">Hasil perankingan anggota koperasi</p>
                                </div>
                                <a href="history.php" class="btn btn-outline-secondary">
                                    <i class="ph ph-arrow-left me-1"></i> Kembali
                                </a>
                            </div>

                            <?php if ($calculation_date): ?>
                            <div class="date-info">
                                <div class="date-label">Tanggal Perhitungan</div>
                                <div class="date-value"><?php echo formatTanggalIndonesia($calculation_date); ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if ($has_error): ?>
                            <div class="alert alert-danger">
                                Data tidak ditemukan. <a href="history.php">Kembali ke History</a>
                            </div>
                            <?php else: ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th width="250">Nama Anggota</th>
                                            <th width="200">Nilai Akhir</th>
                                            <th width="100">Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($history_data)) {
                                            $no = 1;
                                            foreach($history_data as $display) {
                                                $nama = htmlspecialchars($display['nama'], ENT_QUOTES, 'UTF-8');
                                                $nilai = htmlspecialchars($display['nilai_akhir'], ENT_QUOTES, 'UTF-8');
                                                $rank = (int) $display['ranking'];

                                                $badgeClass = 'rank-other';
                                                if ($rank === 1) $badgeClass = 'rank-1';
                                                elseif ($rank === 2) $badgeClass = 'rank-2';
                                                elseif ($rank === 3) $badgeClass = 'rank-3';
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <span class="fw-medium"><?php echo $nama; ?></span>
                                            </td>
                                            <td>
                                                <span class="fw-bold"><?php echo number_format($nilai, 4); ?></span>
                                            </td>
                                            <td>
                                                <span class="ranking-badge <?php echo $badgeClass; ?>">
                                                    <?php echo $rank; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <i class="ph ph-file-text" style="font-size: 48px; color: #dee2e6;"></i>
                                                <p class="mt-3 mb-0 text-muted">Tidak ada data perhitungan ditemukan</p>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include 'partials/footer.php' ?>
    </div>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/boostrap.bundle.min.js"></script>
    <script src="../assets/js/phosphor-icon.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            order: [[3, 'asc']]
        });
    });
    </script>

</body>

</html>
