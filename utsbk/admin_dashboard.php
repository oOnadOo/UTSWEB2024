<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika pengguna belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
    // Jika pengguna bukan admin, arahkan kembali ke halaman pengguna biasa
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Admin Dashboard</h1>
    </header>
    <nav>
        <a href="admin_dashboard.php">Admin Dashboard</a> |
        <a href="data_master.php">Data Master</a> |
        <a href="logout.php">Logout</a> <!-- Tautan untuk logout -->
    </nav>
    <section>
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Ini adalah halaman dashboard Anda sebagai admin.</p>
        <!-- Konten dashboard admin di sini -->
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
