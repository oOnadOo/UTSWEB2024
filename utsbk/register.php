<?php
// Proses registrasi pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost"; // nama host 
    $username = "root"; // username database 
    $password = ""; //  password database 
    $dbname = "poliklinik"; //nama database 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password)
    VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi ke database
    $conn->close();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses registrasi pengguna
    // (Kode registrasi yang sudah ada di sini)

    // Setelah berhasil mendaftar, tampilkan kotak dialog
    echo '<script>alert("User berhasil ditambahkan.");</script>';

    // Redirect ke halaman login setelah menutup kotak dialog
    echo '<script>window.location.href = "login.php";</script>';
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses registrasi pengguna
    // (Kode registrasi yang sudah ada di sini)

    // Setelah berhasil mendaftar, tampilkan kotak dialog
    echo '<script>alert("User berhasil ditambahkan.");</script>';

    // Redirect ke halaman login setelah menutup kotak dialog
    echo '<script>window.location.href = "login.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Aplikasi Poliklinik</title>
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
        <h2>Registrasi Pengguna</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="reg_username">Username:</label><br>
            <input type="text" id="reg_username" name="username" required><br>
            <label for="reg_email">Email:</label><br>
            <input type="email" id="reg_email" name="email" required><br>
            <label for="reg_password">Password:</label><br>
            <input type="password" id="reg_password" name="password" required><br><br>
            <input type="submit" value="Daftar">
        </form>
    </section>
    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
