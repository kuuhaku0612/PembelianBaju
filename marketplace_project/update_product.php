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

// Cek jika ada ID produk yang ingin diedit
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Ambil data produk berdasarkan ID
    $sql = "SELECT * FROM products WHERE id = '$product_id' AND store_id IN (SELECT id FROM stores WHERE user_id = '$user_id')";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Proses update produk
if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $size = $_POST['size'];

    $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', color = '$color', size = '$size' WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Product updated successfully!";
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
    <title>Edit Product - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Edit Product</h1>
</header>

<section class="product-form">
    <form action="update_product.php?product_id=<?php echo $product['id']; ?>" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

        <label for="description">Product Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

        <label for="color">Color:</label>
        <input type="text" name="color" value="<?php echo $product['color']; ?>" required>

        <label for="size">Size:</label>
        <input type="text" name="size" value="<?php echo $product['size']; ?>" required>

        <button type="submit" name="update_product">Update Product</button>
    </form>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
</section>

</body>
</html>
