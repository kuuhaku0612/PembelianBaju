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

// Mengambil riwayat transaksi berdasarkan user_id
$sql = "SELECT transactions.*, products.name, products.price 
        FROM transactions 
        INNER JOIN products ON transactions.product_id = products.id
        WHERE transactions.user_id = '$user_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Your Transaction History</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="transactions">
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Date</th>
            </tr>
            <?php while ($transaction = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $transaction['name']; ?></td>
                    <td>$<?php echo $transaction['price']; ?></td>
                    <td><?php echo $transaction['payment_method']; ?></td>
                    <td><?php echo $transaction['payment_status']; ?></td>
                    <td><?php echo $transaction['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No transactions found.</p>
    <?php } ?>
</section>

</body>
</html>
