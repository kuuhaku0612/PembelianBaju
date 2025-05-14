<?php
// db.php - Koneksi ke database

$servername = "localhost";
$username = "root";
$password = "kuuhaku06"; // Sesuaikan dengan password MySQL kamu
$database = "marketplace_db"; // Nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>