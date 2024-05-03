<?php
// Include file config.php untuk koneksi ke database
include 'config.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pasien = $_POST['nama_pasien'];
    $nama_dokter = $_POST['nama_dokter'];
    $jadwal = $_POST['jadwal'];
    $catatan = implode("\n", $_POST['catatan']); // Menggabungkan catatan menjadi satu string
    $obat = implode("\n", $_POST['obat']); // Menggabungkan obat menjadi satu string

    // Menyiapkan dan mengeksekusi query untuk menyimpan data pemeriksaan ke dalam tabel pemeriksaan
    $sql = "INSERT INTO pemeriksaan (nama_pasien, nama_dokter, jadwal, catatan, obat)
            VALUES ('$nama_pasien', '$nama_dokter', '$jadwal', '$catatan', '$obat')";

    if ($conn->query($sql) === TRUE) {
        // Jika data pemeriksaan berhasil disimpan, arahkan kembali ke halaman checkup.php
        header("Location: checkup.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
