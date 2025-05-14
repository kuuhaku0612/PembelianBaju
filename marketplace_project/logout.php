<?php
session_start();
session_destroy(); // Menghancurkan sesi
header('Location: login.php'); // Mengarahkan ke halaman login setelah logout
exit();
?>
