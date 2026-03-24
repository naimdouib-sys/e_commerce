<?php
// File: api/update-product.php
// Update existing product

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

// Get and sanitize inputs
$id = intval($_POST['id'] ?? 0);
$name = sanitize($_POST['name'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$description = sanitize($_POST['description'] ?? '');

// Validate inputs
if ($id <= 0 || empty($name) || $price <= 0 || empty($description)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Get current product
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
$image = $product['image'];

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        // Delete old image
        if (file_exists($uploadDir . $image) && $image !== 'product-default.jpg') {
            unlink($uploadDir . $image);
        }
        $image = $fileName;
    }
}

// Update product
$sql = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssi", $name, $price, $description, $image, $id);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Product updated successfully'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to update product']);
}

$stmt->close();
$conn->close();
?>
