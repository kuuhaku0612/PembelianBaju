<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('includes/db.php');
 // Koneksi ke database

$user_id = $_SESSION['user_id'];

// Mengambil data toko dan produk dari database
$sql = "SELECT * FROM stores WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$store = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Welcome to Your Dashboard</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="store-info">
    <h2>Your Store: <?php echo $store['name']; ?></h2>
    <p>Description: <?php echo $store['description']; ?></p>
    <a href="add_product.php">Add New Product</a>
</section>

</body>
</html>
