<?php
// File: api/delete-product.php
// Delete product

header('Content-Type: application/json');
require_once '../config.php';

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Check admin authentication
$admin = $_POST['admin_id'] ?? null;
if (empty($admin)) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Get and validate product ID
$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    exit;
}

// Get product image
$sql = "SELECT image FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

$product = $result->fetch_assoc();

// Delete product
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Delete image file
    $uploadDir = '../uploads/';
    if (file_exists($uploadDir . $product['image']) && $product['image'] !== 'product-default.jpg') {
        unlink($uploadDir . $product['image']);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Product deleted successfully'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
}

$stmt->close();
$conn->close();
?>
