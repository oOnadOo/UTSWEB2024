<?php
// Include file config.php untuk koneksi ke database
include 'config.php';

// Inisialisasi variabel pesan error
$errMsg = '';

// Memeriksa apakah parameter id telah diterima dari URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Mendapatkan id dari URL
    $id = trim($_GET['id']);

    // Menyimpan data pemeriksaan berdasarkan id
    $sql = "SELECT * FROM pemeriksaan WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter ke prepared statement
        $stmt->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Mengeksekusi statement
        if ($stmt->execute()) {
            // Menyimpan hasil dari statement
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_pasien = $row['nama_pasien'];
                $nama_dokter = $row['nama_dokter'];
                $jadwal = $row['jadwal'];
                $catatan = $row['catatan'];
                $obat = $row['obat'];
            } else {
                // Jika id tidak valid, redirect ke halaman error
                header("location: error.php");
                exit();
            }
        } else {
            $errMsg = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        // Menutup statement
        $stmt->close();
    }
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memperbarui data pemeriksaan
    $nama_pasien = $_POST['nama_pasien'];
    $nama_dokter = $_POST['nama_dokter'];
    $jadwal = $_POST['jadwal'];
    $catatan = $_POST['catatan'];
    $obat = $_POST['obat'];

    // Menyiapkan dan mengeksekusi query untuk memperbarui data pemeriksaan
    $sql = "UPDATE pemeriksaan SET nama_pasien=?, nama_dokter=?, jadwal=?, catatan=?, obat=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter ke prepared statement
        $stmt->bind_param("sssssi", $nama_pasien, $nama_dokter, $jadwal, $catatan, $obat, $param_id);

        // Set parameter
        $param_id = $id;

        // Mengeksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman checkup.php setelah berhasil memperbarui data
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Periksa Pasien - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Edit Periksa Pasien</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | 
        <a href="checkup.php">Periksa</a> | 
        <a href="logout.php">Logout</a> 
    </nav>
    <section class="container">
        <h2>Edit Periksa Pasien</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nama_pasien">Nama Pasien:</label><br>
            <input type="text" id="nama_pasien" name="nama_pasien" value="<?php echo $nama_pasien; ?>" required><br>
            <label for="nama_dokter">Nama Dokter:</label><br>
            <input type="text" id="nama_dokter" name="nama_dokter" value="<?php echo $nama_dokter; ?>" required><br>
            <label for="jadwal">Jadwal:</label><br>
            <input type="date" id="jadwal" name="jadwal" value="<?php echo $jadwal; ?>" required><br>
            <label for="catatan">Catatan:</label><br>
            <textarea id="catatan" name="catatan" required><?php echo $catatan; ?></textarea><br>
            <label for="obat">Obat:</label><br>
            <textarea id="obat" name="obat" required><?php echo $obat; ?></textarea><br><br>
            <input type="submit" value="Simpan">
            <a href="checkup.php">Batal</a>
        </form>
        <?php
        // Menampilkan pesan error jika ada
        if (!empty($errMsg)) {
            echo "<div class='error'>" . $errMsg . "</div>";
        }
        ?>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
