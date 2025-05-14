<?php
include('includes/db.php');
// Mengambil data produk dari database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css">  <!-- File CSS untuk styling -->
</head>
<body>

<header>
    <h1>Welcome to Our Marketplace</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
</header>

<section class="products">
    <h2>Available Products</h2>
    <div class="product-list">
        <?php
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                // Menampilkan produk dengan gambar dan informasi yang benar
                echo "<div class='product'>";
                echo "<img src='images/" . $product['image'] . "' alt='" . $product['name'] . "' width='200'>"; // Path gambar sesuai folder images
                echo "<h3>" . $product['name'] . "</h3>";
                echo "<p>Price: Rp. " . number_format($product['price'], 0, ',', '.') . " IDR</p>";
                echo "<a href='product_detail.php?id=" . $product['id'] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available</p>";
        }
        ?>
    </div>
</section>

<footer>
    <p>&copy; 2025 Marketplace AUDITYA MEROSYA PUTRI. All Rights Reserved.</p>
</footer>

</body>
</html>
