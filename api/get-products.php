<?php
// File: api/get-products.php
// Get all products from database

header('Content-Type: application/json');
require_once '../config.php';

try {
    $sql = "SELECT id, name, price, description, image FROM products ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Query error: " . $conn->error);
    }

    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>
