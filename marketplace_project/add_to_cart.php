<?php
include 'includes/db.php';
session_start();

// Ambil product_id dari GET atau POST
$product_id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['product_id']) ? intval($_POST['product_id']) : 0);
$quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Validasi produk
if ($product_id <= 0) {
    die('Produk tidak valid.');
}

// Cek apakah produk ada di database
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
if (!$product) {
    die('Produk tidak ditemukan.');
}

// Inisialisasi session cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tambahkan produk ke dalam cart
if (!isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = $quantity;
} elseif (is_int($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    // Jika terjadi error, reset jumlah
    $_SESSION['cart'][$product_id] = $quantity;
}

// Redirect ke halaman keranjang
header("Location: cart.php");
exit();
?>
