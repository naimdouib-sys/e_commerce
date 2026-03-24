<?php
// File: api/checkout.php
// Create order from cart

header('Content-Type: application/json');
require_once '../config.php';

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data
$user_id = intval($_POST['user_id'] ?? 0);
$total = floatval($_POST['total'] ?? 0);
$items = json_decode($_POST['items'] ?? '[]', true);

// Validate inputs
if ($user_id <= 0 || $total <= 0 || empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Insert order
    $sql = "INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'completed')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $user_id, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($items as $item) {
        $product_id = intval($item['id']);
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);

        $stmt->bind_param("iiii", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Order created successfully',
        'order_id' => $order_id
    ]);
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to create order']);
}

$stmt->close();
$conn->close();
?>
