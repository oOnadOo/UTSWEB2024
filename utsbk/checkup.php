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

    // Menyiapkan dan mengeksekusi query untuk menyimpan data pemeriksaan ke database
    $sql = "INSERT INTO pemeriksaan (nama_pasien, nama_dokter, jadwal, catatan, obat) VALUES ('$nama_pasien', '$nama_dokter', '$jadwal', '$catatan', '$obat')";

    if ($conn->query($sql) === TRUE) {
        // Jika data berhasil disimpan, redirect ke halaman checkup.php untuk melihat hasil
        header("Location: checkup.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Pasien - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Periksa Pasien</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | 
        <a href="checkup.php">Periksa</a> | 
        <a href="logout.php">Logout</a> 
    </nav>
    <section class="container">
        <h2>Form Periksa Pasien</h2>
        <!-- Form periksa pasien -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nama_pasien">Nama Pasien:</label><br>
            <select id="nama_pasien" name="nama_pasien" required>
                <option value="">Pilih Nama Pasien</option>
                <?php
                // Mengambil data pasien dari tabel pasien
                $sql = "SELECT * FROM pasien";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["nama_pasien"] . "'>" . $row["nama_pasien"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada data pasien</option>";
                }
                ?>
            </select><br>
            <label for="nama_dokter">Nama Dokter:</label><br>
            <select id="nama_dokter" name="nama_dokter" required>
                <option value="">Pilih Nama Dokter</option>
                <?php
                // Mengambil data dokter dari tabel dokter
                $sql = "SELECT * FROM dokter";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["nama_dokter"] . "'>" . $row["nama_dokter"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada data dokter</option>";
                }
                ?>
            </select><br>
            <label for="jadwal">Jadwal:</label><br>
            <input type="date" id="jadwal" name="jadwal" required><br><br>
            <h3>Catatan</h3>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Catatan</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="catatan[]" required></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="catatan[]"></td>
                </tr>
                <!-- Tambahkan baris catatan sesuai kebutuhan -->
            </table>
            <br>
            <h3>Obat</h3>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Obat</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="obat[]" required></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="obat[]"></td>
                </tr>
                <!-- Tambahkan baris obat sesuai kebutuhan -->
            </table>
            <br>
            <input type="submit" value="Simpan">
        </form>
        
        <h2>Data Periksa Pasien</h2>
        <!-- Tabel untuk menampilkan data pemeriksaan -->
        <table border="1">
            <tr>
                <th>No.</th>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Jadwal</th>
                <th>Catatan</th>
                <th>Obat</th>
                <th>Aksi</th>
            </tr>
            <?php
            // Query untuk mengambil data pemeriksaan dari database
            $query = "SELECT * FROM pemeriksaan";
            $result = $conn->query($query);

            // Memeriksa apakah ada data pemeriksaan yang ditemukan
            if ($result->num_rows > 0) {
                // Menampilkan data pemeriksaan dalam tabel
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama_pasien'] . "</td>";
                    echo "<td>" . $row['nama_dokter'] . "</td>";
                    echo "<td>" . $row['jadwal'] . "</td>";
                    echo "<td>" . nl2br($row['catatan']) . "</td>"; // Menggunakan nl2br untuk menampilkan baris baru (\n) sebagai <br>
                    echo "<td>" . nl2br($row['obat']) . "</td>"; // Menggunakan nl2br untuk menampilkan baris baru (\n) sebagai <br>
                    echo "<td><a href='edit_checkup.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_checkup.php?id=" . $row['id'] . "' onclick=\"return confirm('Anda yakin ingin menghapus data ini?');\">Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data pemeriksaan.</td></tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
