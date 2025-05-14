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

// Proses jika form ditambahkan
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $store_id = $_POST['store_id'];

    // Query untuk menyimpan data produk ke database
    $sql = "INSERT INTO products (store_id, name, description, price, color, size) 
            VALUES ('$store_id', '$name', '$description', '$price', '$color', '$size')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Product added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Add New Product</h1>
</header>

<section class="product-form">
    <form action="add_product.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required>

        <label for="description">Product Description:</label>
        <textarea name="description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" required>

        <label for="color">Color:</label>
        <input type="text" name="color" required>

        <label for="size">Size:</label>
        <input type="text" name="size" required>

        <input type="hidden" name="store_id" value="<?php echo $_SESSION['store_id']; ?>">

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
</section>

</body>
</html>
