<?php
// Include database connection
include('includes/db.php');

// Get the transaction ID and status from the form
$transaction_id = $_POST['transaction_id'];
$status = $_POST['status'];

// Update the transaction status
$sql = "UPDATE transactions SET status = '$status' WHERE id = $transaction_id";
$conn->query($sql);

echo "Transaction status updated!";
$conn->close();
?>
