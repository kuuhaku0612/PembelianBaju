<?php
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Permintaan tidak valid.');
}

$id = intval($_GET['id']);

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

header("Location: cart.php");
exit();
