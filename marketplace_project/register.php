<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $name = $conn->real_escape_string($_POST['name']);

    // Validasi data tidak boleh kosong
    if (empty($email) || empty($password) || empty($name)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location='register.php';</script>";
        exit();
    }

    // Cek email sudah terdaftar
    $cek = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($cek->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='register.php';</script>";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan user baru
    $insert = $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')");

    if ($insert) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<body>
    <h2>Form Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Lengkap" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
