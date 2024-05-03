<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika pengguna belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik - Dashboard</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="datamaster.php">Data Master</a> | 
        <a href="checkup.php">Periksa</a> | 
        <a href="logout.php">Logout</a> 
    </nav>
    <section class="container">
        <!-- Konten Dashboard -->
        <h2>Selamat Datang di Dashboard</h2>
        <p>Isi konten dashboard di sini...</p>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>

