<?php
include '../config/database.php';
// Fungsi untuk menormalkan data berdasarkan kriteria
function normalize($value, $criteria) {
    switch ($criteria) {
        case 'Tingkat Golongan ASN':
            switch ($value) {
                case 'HONORER':
                    return 1;
                case 'Gol. I':
                    return 1;
                case 'Gol. II':
                    return 3;
                case 'Gol. III':
                    return 4;
                case 'Gol. IV':
                    return 5;
                default:
                    return 0;
            }
        case 'Lamanya Jangka Waktu Pinjam':
            if ($value <= 32) return 1;
            elseif ($value <= 64) return 2;
            elseif ($value <= 96) return 3;
            break;
        case 'Banyaknya realisasi pencairan':
            if ($value < 10000000) return 1;
            elseif ($value < 50000000) return 2;
            elseif ($value < 100000000) return 3;
            elseif ($value < 150000000) return 4;
            elseif ($value < 250000000) return 5;
            break;
        case 'Besarnya jasa yang diterima':
            if ($value >= 1000000 && $value < 2000000) return 1;
            elseif ($value >= 2000000 && $value < 3000000) return 2;
            elseif ($value >= 3000000 && $value < 4000000) return 3;
            elseif ($value >= 4000000 && $value < 5000000) return 4;
            elseif ($value >= 5000000) return 5;
            break;
        case 'Frekuensi jumlah pinjaman':
            if ($value <= 1) return 1;
            elseif ($value == 2) return 2;
            elseif ($value == 3) return 3;
            elseif ($value == 4) return 4;
            elseif ($value <= 6) return 5;
            break;
        case 'Banyaknya jumlah modal':
            return ($value == 100) ? 4 : 2; // Misalkan ini logika sederhana
        case 'Tanggal terdaftar sebagai anggota':
            if ($value >= '2026-01-01' && $value <= '2028-12-31') return 1;
            elseif ($value >= '2023-01-01' && $value <= '2025-12-31') return 2;
            elseif ($value >= '2020-01-01' && $value <= '2022-12-31') return 3;
            elseif ($value >= '2017-01-01' && $value <= '2019-12-31') return 4;
            elseif ($value >= '2014-01-01' && $value <= '2016-12-31') return 5;
            break;
        case 'Intensitas transaksi simpanan wajib':
            if ($value < 0.05) return 2;
            elseif ($value < 1) return 4;
            break;
        case 'Intensitas angsuran pinjaman':
            if ($value < 4000000) return 1;
            elseif ($value < 16000000) return 2;
            elseif ($value < 48000000) return 3;
            break;
    }
    return 0; // Default return jika tidak cocok
}

$totalBobotQuery = "SELECT SUM(bobot) AS total_bobot FROM kriteria";
$totalBobotResult = mysqli_query($conn, $totalBobotQuery);
$totalBobotData = mysqli_fetch_assoc($totalBobotResult);
$totalBobot = round($totalBobotData['total_bobot'], 2);

$totalData = 0;
$selected_ids = isset($_GET['id_anggota']) ? $_GET['id_anggota'] : null;
var_dump($selected_ids);
if ($selected_ids) {
    $query = "SELECT COUNT(*) AS total FROM anggota WHERE id_anggota IN ($selected_ids)";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalData = $row['total'];
}

// Ambil data anggota dari database
$get_data = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota IN ($selected_ids)");


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
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <div class="side-overlay"></div>

    <?php include 'partials/sidebar.php'?>

    <div class="dashboard-main-wrapper">
        <?php include 'partials/topnavbar.php'?>


        <div class="dashboard-body">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <?php if ($totalBobot == 1) { ?>
                    <?php if ($totalData > 1) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h4>Data Anggota</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                        <th>C9</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        while ($anggota = mysqli_fetch_assoc($get_data)) {
                                            echo "<tr>";
                                            echo "<td>{$no}</td>";
                                            echo "<td>{$anggota['nama_anggota']}</td>";
                                            echo "<td>" . normalize($anggota['tingkat_golongan_asn'], 'Tingkat Golongan ASN') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['jangka_waktu_pinjam'], 'Lamanya Jangka Waktu Pinjam') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['realisasi_pencairan'], 'Banyaknya realisasi pencairan') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['jasa_diterima'], 'Besarnya jasa yang diterima') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['frekuensi_pinjaman'], 'Frekuensi jumlah pinjaman') . "</td>";
                                            
                                            echo "<td>" . normalize($anggota['jumlah_modal'], 'Banyaknya jumlah modal') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['tgl_terdaftar'], 'Tanggal terdaftar sebagai anggota') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['intensitas_simpanan_wajib'], 'Intensitas transaksi simpanan wajib') . "</td>";
                                        
                                            echo "<td>" . normalize($anggota['intensitas_angsuran'], 'Intensitas angsuran pinjaman') . "</td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mt-10">
                        <div class="card-body">
                            <h4>Data Normalisasi</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th> C1</th>
                                        <th> C2</th>
                                        <th> C3</th>
                                        <th> C4</th>
                                        <th> C5</th>
                                        <th> C6</th>
                                        <th> C7</th>
                                        <th> C8</th>
                                        <th> C9</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                // Reset pointer ke awal
                mysqli_data_seek($get_data, 0); // Mengatur ulang hasil query ke awal

                $no = 1;
                $maxValues = [ // Initialize all keys to zero
                    'C1' => 0,
                    'C2' => 0,
                    'C3' => 0,
                    'C4' => 0,
                    'C5' => 0,
                    'C6' => 0,
                    'C7' => 0,
                    'C8' => 0,
                    'C9' => 0
                ];

                // Pertama, kita akan mendapatkan nilai maksimum untuk setiap kriteria
                while ($anggota = mysqli_fetch_assoc($get_data)) {
                    $maxValues['C1'] = max($maxValues['C1'], normalize($anggota['tingkat_golongan_asn'], 'Tingkat Golongan ASN'));
                    $maxValues['C2'] = max($maxValues['C2'], normalize($anggota['jangka_waktu_pinjam'], 'Lamanya Jangka Waktu Pinjam'));
                    $maxValues['C3'] = max($maxValues['C3'], normalize($anggota['realisasi_pencairan'], 'Banyaknya realisasi pencairan'));
                    $maxValues['C4'] = max($maxValues['C4'], normalize($anggota['jasa_diterima'], 'Besarnya jasa yang diterima'));
                    $maxValues['C5'] = max($maxValues['C5'], normalize($anggota['frekuensi_pinjaman'], 'Frekuensi jumlah pinjaman'));
                    $maxValues['C6'] = max($maxValues['C6'], normalize($anggota['jumlah_modal'], 'Banyaknya jumlah modal'));
                    $maxValues['C7'] = max($maxValues['C7'], normalize($anggota['tgl_terdaftar'], 'Tanggal terdaftar sebagai anggota'));
                    $maxValues['C8'] = max($maxValues['C8'], normalize($anggota['intensitas_simpanan_wajib'], 'Intensitas transaksi simpanan wajib'));
                    $maxValues['C9'] = max($maxValues['C9'], normalize($anggota['intensitas_angsuran'], 'Intensitas angsuran pinjaman'));
                }

                // Kembali ke awal lagi untuk menampilkan hasil normalisasi
                mysqli_data_seek($get_data, 0);
                while ($anggota = mysqli_fetch_assoc($get_data)) {
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    echo "<td>{$anggota['nama_anggota']}</td>";
                    // Check if max value is zero before division
                    echo "<td>" . (($maxValues['C1'] > 0) ? number_format(normalize($anggota['tingkat_golongan_asn'], 'Tingkat Golongan ASN') / $maxValues['C1'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C2'] > 0) ? number_format(normalize($anggota['jangka_waktu_pinjam'], 'Lamanya Jangka Waktu Pinjam') / $maxValues['C2'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C3'] > 0) ? number_format(normalize($anggota['realisasi_pencairan'], 'Banyaknya realisasi pencairan') / $maxValues['C3'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C4'] > 0) ? number_format(normalize($anggota['jasa_diterima'], 'Besarnya jasa yang diterima') / $maxValues['C4'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C5'] > 0) ? number_format(normalize($anggota['frekuensi_pinjaman'], 'Frekuensi jumlah pinjaman') / $maxValues['C5'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C6'] > 0) ? number_format(normalize($anggota['jumlah_modal'], 'Banyaknya jumlah modal') / $maxValues['C6'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C7'] > 0) ? number_format(normalize($anggota['tgl_terdaftar'], 'Tanggal terdaftar sebagai anggota') / $maxValues['C7'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C8'] > 0) ? number_format(normalize($anggota['intensitas_simpanan_wajib'], 'Intensitas transaksi simpanan wajib') / $maxValues['C8'], 2) : number_format(0, 2)) . "</td>";
                    echo "<td>" . (($maxValues['C9'] > 0) ? number_format(normalize($anggota['intensitas_angsuran'], 'Intensitas angsuran pinjaman') / $maxValues['C9'], 2) : number_format(0, 2)) . "</td>";                    
                    echo "</tr>";
                    $no++;
                }
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Display Preference Values Below Normalization Table -->
                    <div class="card mt-10">
                        <div class="card-body">
                            <h4>Hasil Akhir Preferensi</h4>
                            <form method="POST" action="save_ranking.php">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Anggota</th>
                                            <th>Nilai Preferensi (V)</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                // Reset pointer ke awal
                mysqli_data_seek($get_data, 0);

                $no = 1;
                $preferensi = []; // Array untuk menyimpan nilai preferensi

                $bobot = [];
                $query_bobot = "SELECT nama_kriteria, bobot FROM kriteria";
                $result_bobot = mysqli_query($conn, $query_bobot);

                while ($row = mysqli_fetch_assoc($result_bobot)) {
                    $bobot[$row['nama_kriteria']] = $row['bobot'];
                }

                // Hitung nilai preferensi untuk setiap anggota
                while ($anggota = mysqli_fetch_assoc($get_data)) {
                    $nilaiPreferensi = 0;

                     // Menghitung V_i = ∑ W_j * R_ij menggunakan bobot dari tabel kriteria
                    $nilaiPreferensi += ($maxValues['C1'] > 0) ? (normalize($anggota['tingkat_golongan_asn'], 'Tingkat Golongan ASN') / $maxValues['C1']) * $bobot['Tingkat Golongan ASN'] : 0;
                    $nilaiPreferensi += ($maxValues['C2'] > 0) ? (normalize($anggota['jangka_waktu_pinjam'], 'Lamanya Jangka Waktu Pinjam') / $maxValues['C2']) * $bobot['Lamanya Jangka Waktu Pinjam'] : 0;
                    $nilaiPreferensi += ($maxValues['C3'] > 0) ? (normalize($anggota['realisasi_pencairan'], 'Banyaknya realisasi pencairan') / $maxValues['C3']) * $bobot['Banyaknya realisasi pencairan (1 tahun)'] : 0;
                    $nilaiPreferensi += ($maxValues['C4'] > 0) ? (normalize($anggota['jasa_diterima'], 'Besarnya jasa yang diterima') / $maxValues['C4']) * $bobot['Besarnya jasa yang diterima'] : 0;
                    $nilaiPreferensi += ($maxValues['C5'] > 0) ? (normalize($anggota['frekuensi_pinjaman'], 'Frekuensi jumlah pinjaman') / $maxValues['C5']) * $bobot['Frekuensi jumlah pinjaman'] : 0;
                    $nilaiPreferensi += ($maxValues['C6'] > 0) ? (normalize($anggota['jumlah_modal'], 'Banyaknya jumlah modal') / $maxValues['C6']) * $bobot['Banyaknya jumlah modal (1 tahun)'] : 0;
                    $nilaiPreferensi += ($maxValues['C7'] > 0) ? (normalize($anggota['tgl_terdaftar'], 'Tanggal terdaftar sebagai anggota') / $maxValues['C7']) * $bobot['Tanggal terdaftar sebagai anggota'] : 0;
                    $nilaiPreferensi += ($maxValues['C8'] > 0) ? (normalize($anggota['intensitas_simpanan_wajib'], 'Intensitas transaksi simpanan wajib') / $maxValues['C8']) * $bobot['Intensitas transaksi simpanan wajib (1 tahun)'] : 0;
                    $nilaiPreferensi += ($maxValues['C9'] > 0) ? (normalize($anggota['intensitas_angsuran'], 'Intensitas angsuran pinjaman') / $maxValues['C9']) * $bobot['Intensitas angsuran pinjaman'] : 0;

                    // Simpan nilai preferensi ke array
                    $preferensi[] = [
                        'nama' => $anggota['nama_anggota'],
                        'nilai' => $nilaiPreferensi
                    ];
                }

                // Urutkan preferensi berdasarkan nilai preferensi (V)
                usort($preferensi, function ($a, $b) {
                    return $b['nilai'] <=> $a['nilai']; // Descending order
                });

                // Tampilkan hasil preferensi
                foreach ($preferensi as $item) {
                    echo "<tr>";
                    echo "<td>{$item['nama']}</td>";
                    echo "<td>" . number_format($item['nilai'], 3) . "</td>";
                    echo "<td>{$no}</td>";
                    echo "<input type='hidden' name='nama[]' value='{$item['nama']}'>";
                    echo "<input type='hidden' name='nilai[]' value='{$item['nilai']}'>";
                    echo "</tr>";
                    $no++;
                }
                ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary" name="save_ranking">Save</button>
                            </form>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                        <span>Pilih lebih dari satu anggota untuk melakukan perhitungan.</span>
                        <a href="cek_hitung.php" class="btn btn-primary btn-sm">Kembali</a>
                    </div>

                    <?php } ?>
                    <?php } else { ?>
                    <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                        Bobot kriteria harus sama dengan 1.
                        <a href="kriteria.php" class="btn btn-primary btn-sm">Kembali</a>
                    </div>
                    <?php } ?>
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