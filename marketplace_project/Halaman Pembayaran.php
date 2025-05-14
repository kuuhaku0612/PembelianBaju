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
$product_id = $_GET['product_id']; // Produk yang dibeli

// Ambil data produk yang dibeli
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = $_POST['payment_method'];
    $transaction_id = uniqid('TXN');
    $payment_status = 'Pending'; // Status pembayaran masih pending

    // Simpan transaksi ke database
    $sql = "INSERT INTO transactions (user_id, product_id, payment_method, payment_status, transaction_id) 
            VALUES ('$user_id', '$product_id', '$payment_method', '$payment_status', '$transaction_id')";

    if ($conn->query($sql) === TRUE) {
        $message = "Your order has been placed! Please complete the payment.";
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
    <title>Payment - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Complete Your Payment</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="payment-form">
    <h2>Product: <?php echo $product['name']; ?></h2>
    <p>Price: $<?php echo $product['price']; ?></p>
    
    <form method="POST">
        <label for="payment_method">Select Payment Method:</label>
        <select name="payment_method" required>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Mobile Banking">Mobile Banking</option>
        </select>
        <button type="submit">Place Order</button>
    </form>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
</section>

</body>
</html>
