<?php
include '../config/database.php';

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kriteria = $_POST['id_kriteria'];
    $bobot = $_POST['bobot'];

    // Query untuk memperbarui data kriteria
    $query = "UPDATE kriteria SET bobot = '$bobot' WHERE id_kriteria = $id_kriteria";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil, redirect ke halaman kriteria
        header("Location: kriteria.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>