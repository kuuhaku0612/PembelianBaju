<?php
session_start();
include('includes/db.php');
// Koneksi ke database

// Cek jika pengguna adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaction_id = $_POST['transaction_id'];
    
    // Update status pembayaran menjadi 'Paid'
    $sql = "UPDATE transactions SET payment_status = 'Paid' WHERE transaction_id = '$transaction_id'";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Payment confirmed for transaction ID: $transaction_id!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Menampilkan transaksi yang belum dibayar
$sql = "SELECT transactions.*, products.name, products.price 
        FROM transactions 
        INNER JOIN products ON transactions.product_id = products.id 
        WHERE transactions.payment_status = 'Pending'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Confirm Payments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Admin - Confirm Payments</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="transactions">
    <h2>Pending Payments</h2>
    
    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>User ID</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Action</th>
            </tr>
            <?php while ($transaction = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $transaction['name']; ?></td>
                    <td>$<?php echo $transaction['price']; ?></td>
                    <td><?php echo $transaction['user_id']; ?></td>
                    <td><?php echo $transaction['payment_method']; ?></td>
                    <td><?php echo $transaction['transaction_id']; ?></td>
                    <td>
                        <!-- Form untuk konfirmasi pembayaran -->
                        <form method="POST" action="admin_confirm_payment.php">
                            <input type="hidden" name="transaction_id" value="<?php echo $transaction['transaction_id']; ?>">
                            <button type="submit">Confirm Payment</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No pending payments.</p>
    <?php } ?>
</section>

</body>
</html>
