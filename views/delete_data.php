<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus anggota
    $query = "DELETE FROM anggota WHERE id_anggota = $id";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil menghapus, redirect ke halaman anggota
        header("Location: anggota.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>