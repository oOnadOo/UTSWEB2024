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

// Mengambil data dari form
$nama_pasien = $_POST['nama_pasien'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['nomor_hp'];

// Menyiapkan dan mengeksekusi query untuk menyimpan data ke dalam tabel pasien
$sql = "INSERT INTO pasien (nama_pasien, alamat, nomor_hp)
        VALUES ('$nama_pasien', '$alamat', '$nomor_hp')";

if ($conn->query($sql) === TRUE) {
    // Jika data pasien berhasil disimpan, arahkan kembali ke halaman input_pasien.php
    header("Location: input_pasien.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
