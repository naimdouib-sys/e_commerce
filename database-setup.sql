-- Create Database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Admin User (Password: 111111)
INSERT INTO users (name, email, password) VALUES 
('Admin', 'naim.douib@gmail.com', '$2y$10$bkjjcqKGX0QrD7mqGxYhTe9fRWAjH.lYvZFJQwN8VbOKPz8GQ4mZa');

-- Sample Products
INSERT INTO products (name, price, description, image) VALUES
('Wireless Headphones', 49.99, 'Premium quality wireless headphones with noise cancellation', 'product1.jpg'),
('Smart Watch', 199.99, 'Feature-rich smartwatch with health tracking', 'product2.jpg'),
('USB-C Cable', 12.99, 'Fast charging USB-C cable with durable design', 'product3.jpg'),
('Phone Case', 19.99, 'Protective phone case with premium material', 'product4.jpg'),
('Screen Protector', 9.99, 'Tempered glass screen protector for durability', 'product5.jpg'),
('Power Bank', 34.99, '20000mAh power bank with fast charging', 'product6.jpg');
