
CREATE DATABASE IF NOT EXISTS marketplace_db;
USE marketplace_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255),
    role ENUM('admin', 'penjual', 'pelanggan')
);

CREATE TABLE stores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    store_name VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT,
    name VARCHAR(100),
    description TEXT,
    color VARCHAR(50),
    size VARCHAR(20),
    price DECIMAL(10,2),
    image VARCHAR(255),
    FOREIGN KEY (store_id) REFERENCES stores(id)
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT,
    total DECIMAL(10,2),
    status ENUM('pending', 'completed', 'canceled'),
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_ip VARCHAR(100),
    user_agent TEXT,
    visited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action VARCHAR(100)
);
