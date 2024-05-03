<?php
// Include file config.php untuk koneksi ke database
include 'config.php';

// Memeriksa apakah parameter id telah diterima dari URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menyiapkan dan mengeksekusi query untuk menghapus data pasien berdasarkan ID
    $sql = "DELETE FROM pasien WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Jika data pasien berhasil dihapus, arahkan kembali ke halaman input_pasien.php
        header("Location: input_pasien.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID pasien tidak diberikan";
    exit();
}
?>
