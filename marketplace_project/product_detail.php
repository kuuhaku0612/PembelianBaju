<?php
include 'includes/db.php';
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $conn->query("SELECT * FROM products WHERE id='$id'");
    if ($query->num_rows > 0) {
        $product = $query->fetch_assoc();
    } else {
        echo "<script>alert('Produk tidak ditemukan'); window.location='products.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Produk tidak ditemukan'); window.location='products.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="style.css"> <!-- Pastikan file style.css ada -->
</head>
<body>
    <header>
        <h1>Detail Produk</h1>
    </header>

    <section class="product-detail">
        <h2><?php echo $product['name']; ?></h2>
        <!-- Menampilkan gambar produk -->
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="300">

        <p><strong>Deskripsi:</strong> <?php echo $product['description']; ?></p>
        <p><strong>Harga:</strong> Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>

        <!-- Tombol untuk menambah ke keranjang -->
        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn">Tambah ke Keranjang</a>
    </section>

</body>
</html>