<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pasien Baru - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Input Pasien Baru</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | 
        <a href="logout.php">Logout</a> 
    </nav>
    <section class="container">
        <h2>Form Tambah Data Pasien</h2>
        <?php
        // Include file config.php untuk koneksi ke database
        include 'config.php';

        // Inisialisasi variabel
        $nama_pasien = $alamat = $nomor_hp = "";

        // Memproses form jika ada data yang disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        }
        ?>
        <!-- Form tambah data pasien -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nama_pasien">Nama Pasien:</label><br>
            <input type="text" id="nama_pasien" name="nama_pasien" required><br>
            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" required><br>
            <label for="nomor_hp">Nomor HP:</label><br>
            <input type="text" id="nomor_hp" name="nomor_hp" required><br><br>
            <input type="submit" value="Simpan">
        </form>
        
        <!-- Tabel daftar data pasien -->
        <h2>Daftar Data Pasien</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
            </tr>
            <?php
            // Menampilkan data pasien dalam tabel
            $sql = "SELECT * FROM pasien";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nama_pasien"] . "</td>";
                    echo "<td>" . $row["alamat"] . "</td>";
                    echo "<td>" . $row["nomor_hp"] . "</td>";
                    echo "<td>";
                    // Tambahkan tombol untuk mengedit dan menghapus data
                    echo "<a href='edit_patient.php?id=" . $row["id"] . "'>Edit</a> | ";
                    echo "<a href='delete_patient.php?id=" . $row["id"] . "'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data pasien</td></tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
