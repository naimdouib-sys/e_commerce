<?php
// File: api/add-product.php
// Add new product

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
$name = sanitize($_POST['name'] ?? '');
$price = floatval($_POST['price'] ?? 0);
$description = sanitize($_POST['description'] ?? '');
$image = $_FILES['image']['name'] ?? 'product-default.jpg';

// Validate inputs
if (empty($name) || $price <= 0 || empty($description)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $filePath = $uploadDir . $fileName;

    // Create uploads directory if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        $image = $fileName;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
        exit;
    }
}

// Insert product into database
$sql = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdss", $name, $price, $description, $image);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Product added successfully',
        'product_id' => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to add product']);
}

$stmt->close();
$conn->close();
?>
