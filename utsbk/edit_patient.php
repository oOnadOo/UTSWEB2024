<?php
// Include file config.php untuk koneksi ke database
include 'config.php';

// Memeriksa apakah parameter id telah diterima dari URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Memeriksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_pasien = $_POST['nama_pasien'];
        $alamat = $_POST['alamat'];
        $nomor_hp = $_POST['nomor_hp'];

        // Menyiapkan dan mengeksekusi query untuk mengupdate data pasien berdasarkan ID
        $sql = "UPDATE pasien SET nama_pasien='$nama_pasien', alamat='$alamat', nomor_hp='$nomor_hp' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Jika data pasien berhasil diupdate, arahkan kembali ke halaman input_pasien.php
            header("Location: input_pasien.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Mengambil data pasien berdasarkan ID
    $sql = "SELECT * FROM pasien WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_pasien = $row['nama_pasien'];
        $alamat = $row['alamat'];
        $nomor_hp = $row['nomor_hp'];
    } else {
        echo "Data pasien tidak ditemukan";
        exit();
    }
} else {
    echo "ID pasien tidak diberikan";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Edit Data Pasien</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | 
        <a href="logout.php">Logout</a> 
    </nav>
    <section class="container">
        <h2>Edit Data Pasien</h2>
        <!-- Form edit data pasien -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
            <label for="nama_pasien">Nama Pasien:</label><br>
            <input type="text" id="nama_pasien" name="nama_pasien" value="<?php echo $nama_pasien; ?>" required><br>
            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required><br>
            <label for="nomor_hp">Nomor HP:</label><br>
            <input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo $nomor_hp; ?>" required><br><br>
            <input type="submit" value="Simpan">
        </form>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
