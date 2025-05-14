<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "kuuhaku06"; // Password yang kamu gunakan
$database = "marketplace_db"; // Pastikan nama database sesuai

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Marketplace Sederhana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1><a href="index.php">Marketplace</a></h1>
    <nav>
        <a href="products.php">Produk</a> |
        <a href="cart.php">Keranjang</a>
    </nav>
</header>

<!-- Konten checkout -->
<h2>Checkout</h2>
<p>Produk: T-Shirt</p>
<p>Jumlah: 1</p>
<p>Subtotal: Rp. 100.000</p>
<p>Total: Rp. 100.000</p>
<button>Konfirmasi Checkout</button>

<?php
// Cek apakah keranjang kosong
if (empty($_SESSION['cart'])) {
    echo "<p>Keranjang kosong, tidak bisa checkout.</p>";
} else {
    // Proses checkout
    // (Misalnya, simpan data checkout ke database atau lainnya)
    echo "<p>Checkout berhasil!</p>";
}
?>

<!-- Footer Manual -->
<footer>
    <p>&copy; 2025 Marketplace Sederhana</p>
</footer>
</body>
</html>
