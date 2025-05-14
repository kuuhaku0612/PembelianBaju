<?php
session_start();
include('includes/db.php');
 // Koneksi ke database

// Mengambil produk dari database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>All Products</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="products">
    <?php while ($product = $result->fetch_assoc()) { ?>
        <div class="product-item">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p>Price: $<?php echo $product['price']; ?></p>
            <p>Color: <?php echo $product['color']; ?></p>
            <p>Size: <?php echo $product['size']; ?></p>
            <a href="buy_product.php?product_id=<?php echo $product['id']; ?>">Buy Now</a>
        </div>
    <?php } ?>
</section>

</body>
</html>
