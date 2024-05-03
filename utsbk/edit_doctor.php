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

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_dokter = $_POST['nama_dokter'];
    $alamat = $_POST['alamat'];
    $nomor_hp = $_POST['nomor_hp'];

    // Menyiapkan dan mengeksekusi query untuk memperbarui data dokter
    $sql = "UPDATE dokter SET nama_dokter='$nama_dokter', alamat='$alamat', nomor_hp='$nomor_hp' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Jika data berhasil diperbarui, arahkan kembali ke halaman data master
        header("Location: datamaster.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Mengambil data dokter berdasarkan ID
$sql = "SELECT * FROM dokter WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dokter - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Edit Data Dokter</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | <!-- Tampilkan tautan menu data master -->
        <a href="logout.php">Logout</a> <!-- Tautan untuk logout -->
    </nav>
    <section class="container">
        <h2>Edit Data Dokter</h2>
        <!-- Form edit data dokter -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <label for="nama_dokter">Nama Dokter:</label><br>
            <input type="text" id="nama_dokter" name="nama_dokter" value="<?php echo $row['nama_dokter']; ?>" required><br>
            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br>
            <label for="nomor_hp">Nomor HP:</label><br>
            <input type="text" id="nomor_hp" name="nomor_hp" value="<?php echo $row['nomor_hp']; ?>" required><br><br>
            <input type="submit" value="Simpan">
        </form>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
