<?php
session_start();
include('includes/db.php');

// Cek jika produk dipilih
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Ambil data produk berdasarkan ID
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Proses transaksi
if (isset($_POST['buy_product'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $payment_method = $_POST['payment_method'];

    // Simpan transaksi ke database
    $sql = "INSERT INTO transactions (user_id, product_id, payment_method) 
            VALUES ('$user_id', '$product_id', '$payment_method')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Transaction Successful!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Buy Product</h1>
</header>

<section class="buy-product">
    <h3><?php echo $product['name']; ?></h3>
    <p>Description: <?php echo $product['description']; ?></p>
    <p>Price: Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?></p>

    <!-- Menampilkan gambar produk -->
    <?php if (!empty($product['image'])): ?>
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="300">
    <?php else: ?>
        <p>No image available</p>
    <?php endif; ?>

    <form action="buy_product.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="mobile_banking">Mobile Banking</option>
        </select>

        <button type="submit" name="buy_product">Buy Now</button>
    </form>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
</section>

</body>
</html>
        