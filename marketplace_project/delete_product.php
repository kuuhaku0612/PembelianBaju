<?php
session_start();
include('includes/db.php');
// Koneksi ke database

// Cek jika pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Cek jika ada ID produk yang ingin dihapus
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Hapus produk dari database
    $sql = "DELETE FROM products WHERE id = '$product_id' AND store_id IN (SELECT id FROM stores WHERE user_id = '$user_id')";

    if ($conn->query($sql) === TRUE) {
        $message = "Product deleted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

header('Location: view_products.php'); // Setelah penghapusan, arahkan kembali ke halaman produk
exit();
?>
