<?php
// Include file config.php untuk koneksi ke database
include 'config.php';

// Inisialisasi variabel pesan error
$errMsg = '';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Mendapatkan id dari URL
    $id = trim($_GET['id']);

    // Menyiapkan dan mengeksekusi query untuk menghapus data pemeriksaan
    $sql = "DELETE FROM pemeriksaan WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter ke prepared statement
        $stmt->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Mengeksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman checkup.php setelah berhasil menghapus data
            header("location: checkup.php");
            exit();
        } else {
            $errMsg = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        // Menutup statement
        $stmt->close();
    }
}
?>
