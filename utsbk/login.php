<?php
// Mulai session
session_start();

// Jika pengguna sudah login, arahkan ke dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}

// Cek jika form login dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Di sini Anda dapat menambahkan logika autentikasi sesuai kebutuhan
    // Misalnya, memeriksa username dan password di database
    // dan menetapkan session jika login berhasil

    // Contoh sederhana untuk pengecekan login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Misalkan admin login jika username dan password adalah 'admin'
    if ($username === 'admin' && $password === 'admin') {
        // Tetapkan session untuk menandai bahwa pengguna sudah login sebagai admin
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        
        // Arahkan ke halaman dashboard admin
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Tetapkan session untuk menandai bahwa pengguna sudah login sebagai pengguna biasa
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';

        // Arahkan ke halaman dashboard pengguna
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Poliklinik</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Aplikasi Poliklinik</h1>
    </header>
    <nav>
        <a href="index.php">Home</a> |
        <a href="login.php">Login</a> |
        <a href="register.php">Registrasi</a>
    </nav>
    <section>
        <h2>Login Pengguna</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="login_username">Username:</label><br>
            <input type="text" id="login_username" name="username" required><br>
            <label for="login_password">Password:</label><br>
            <input type="password" id="login_password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <p>Lupa password? <a href="forgot_password.php">Klik di sini</a></p>
    </section>
</body>
</html>
