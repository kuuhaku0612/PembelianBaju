<?php
// Include database connection
include('includes/db.php');

// Only allow access to admin
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Access denied.";
    exit;
}

// Query to get all transactions
$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='transaction'>";
        echo "<p>Transaction ID: " . $row['id'] . "</p>";
        echo "<p>Product ID: " . $row['product_id'] . "</p>";
        echo "<p>Status: " . $row['status'] . "</p>";
        echo "<p>Payment Method: " . $row['payment_method'] . "</p>";
        echo "<form action='update_transaction.php' method='POST'>";
        echo "<input type='hidden' name='transaction_id' value='" . $row['id'] . "'>";
        echo "<select name='status'>
                <option value='Pending'>Pending</option>
                <option value='Confirmed'>Confirmed</option>
                <option value='Canceled'>Canceled</option>
              </select>";
        echo "<input type='submit' value='Update Status'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No transactions found.";
}

$conn->close();
?>
