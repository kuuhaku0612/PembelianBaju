<?php
// Koneksi ke database
include('includes/db.php');

// Ambil data produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Welcome to Our Marketplace</h1>
    <nav>
        <a href="index.php">Home</a> | 
        <a href="login.php">Login</a> | 
        <a href="register.php">Register</a>
    </nav>
</header>

<section class="products">
    <h2>Available Products</h2>
    <?php while ($product = $result->fetch_assoc()): ?>
        <div class="product">
            <h3><?php echo $product['name']; ?></h3>
            <p>Description: <?php echo $product['description']; ?></p>
            <p>Price: Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>

            <!-- Menampilkan gambar produk -->
            <?php if (!empty($product['image'])): ?>
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="300">
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>

            <a href="product_details.php?product_id=<?php echo $product['id']; ?>">View Details</a>
        </div>
    <?php endwhile; ?>
</section>

<footer>
    <p>&copy; 2025 Marketplace AUDITYA MEROSYA PUTRI. All Rights Reserved.</p>
</footer>

</body>
</html>
