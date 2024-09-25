<?php
// Database connection
include '../config/database.php';

if (isset($_POST['save_ranking'])) {
    // Insert into history table
    $insert_history = "INSERT INTO hasil () VALUES ()"; // Assuming you don't need values for `hasil`
    mysqli_query($conn, $insert_history);
    $id_history = mysqli_insert_id($conn); // Get the last inserted ID

    // Insert into history_detail table
    $success = true; // Flag to track success
    for ($i = 0; $i < count($_POST['nama']); $i++) {
        $nama = $_POST['nama'][$i];
        $nilai_utilitas = $_POST['nilai'][$i];
        $ranking = $i + 1;

        // Prepare SQL statement for detail insertion
        $insert_detail = "INSERT INTO detail_hasil (id_hasil, nama, nilai_akhir, ranking) 
                          VALUES ('$id_history', '$nama', '$nilai_utilitas', '$ranking')";
        if (!mysqli_query($conn, $insert_detail)) {
            $success = false; // Set success to false if any query fails
            break; // Exit the loop on failure
        }
    }

    // Use JavaScript alert and redirect
    if ($success) {
        echo "<script>
                alert('Data penilaian berhasil disimpan ke history!');
                setTimeout(function() {
                    window.location.href = 'index.php'; // Adjust to your target page
                }, 100); // 100 milliseconds delay
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data!');
                setTimeout(function() {
                    window.location.href = 'index.php'; // Adjust to your target page
                }, 100); // 100 milliseconds delay
              </script>";
    }
    exit(); // Exit to prevent further script execution
}
?>