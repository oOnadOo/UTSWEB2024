<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "poliklinik"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID dokter dari URL
$id = $_GET['id'];

// Menyiapkan dan mengeksekusi query untuk menghapus data dokter
$sql = "DELETE FROM dokter WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Jika data berhasil dihapus, arahkan kembali ke halaman data master
    header("Location: datamaster.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
