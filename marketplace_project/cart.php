<?php
// Koneksi ke database (pastikan koneksi sudah dilakukan)
$servername = "localhost";
$username = "root";
$password = "kuuhaku06"; 
$database = "marketplace_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1><a href="index.php">Marketplace</a></h1>
    <nav>
        <a href="products.php">Produk</a> |
        <a href="cart.php">Keranjang</a>
    </nav>
</header>

<h2>Keranjang Belanja</h2>

<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<table border='1'>
            <tr>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>";

    $total = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $product_name = $product['name'];
            $product_price = number_format($product['price'], 0, ',', '.');
            $product_image = $product['image'] ? $product['image'] : 'default.jpg'; // Default image jika tidak ada gambar
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
            
            echo "<tr>
                    <td><img src='images/$product_image' alt='$product_name' width='100' height='100'></td>
                    <td>$product_name</td>
                    <td>Rp. $product_price</td>
                    <td>$quantity</td>
                    <td>Rp. " . number_format($subtotal, 0, ',', '.') . "</td>
                    <td><a href='remove_from_cart.php?id=$product_id'>Hapus</a></td>
                </tr>";
        }
    }
    
    echo "<tr>
            <td colspan='4'>Total</td>
            <td>Rp. " . number_format($total, 0, ',', '.') . "</td>
            <td><a href='checkout.php'>Lanjut ke Checkout</a></td>
        </tr>";
    echo "</table>";
} else {
    echo "<p>Keranjang Anda kosong.</p>";
}

$conn->close();
?>

<footer>
    <p>&copy; 2025 Marketplace Sederhana</p>
</footer>
</body>
</html>
