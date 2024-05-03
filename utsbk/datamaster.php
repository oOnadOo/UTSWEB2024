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

// Menyiapkan query untuk mengambil data dokter dari database
$sql = "SELECT * FROM dokter";
$result = $conn->query($sql);

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Data Master</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | <!-- Tampilkan tautan menu data master -->
        <a href="logout.php">Logout</a> <!-- Tautan untuk logout -->
    </nav>
    <section class="container">
        <h2>Form Tambah Data</h2>
        <!-- Form tambah data dokter -->
        <form method="post" action="insert_doctor.php">
            <label for="nama_dokter">Nama Dokter:</label><br>
            <input type="text" id="nama_dokter" name="nama_dokter" required><br>
            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" required><br>
            <label for="nomor_hp">Nomor HP:</label><br>
            <input type="text" id="nomor_hp" name="nomor_hp" required><br><br>
            <input type="submit" value="Simpan">
        </form>
        <!-- Tautan untuk halaman input pasien -->
        <a href="input_pasien.php">Input Pasien Baru</a>
        
        <!-- Tabel daftar data dokter -->
        <h2>Daftar Data Dokter</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Dokter</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
            </tr>
            <?php
            // Menampilkan data dokter dalam tabel
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nama_dokter"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>" . $row["nomor_hp"] . "</td>";
                    echo "<td>";
                    // Tambahkan tombol untuk mengedit dan menghapus data
                    echo "<a href='edit_doctor.php?id=" . $row["id"] . "'>Edit</a> | ";
                    echo "<a href='delete_doctor.php?id=" . $row["id"] . "'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data dokter</td></tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>

