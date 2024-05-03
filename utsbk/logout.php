<?php
// Mulai session
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan session
session_destroy();

// Redirect kembali ke halaman login
header("Location: login.php");
exit();
?>
