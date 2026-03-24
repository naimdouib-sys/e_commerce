<?php
// File: api/admin-login.php
// Admin login

header('Content-Type: application/json');
require_once '../config.php';

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get and sanitize inputs
$email = sanitize($_POST['email'] ?? '');
$password = sanitize($_POST['password'] ?? '');

// Validate inputs
if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit;
}

// Get admin from database (check if admin user)
$sql = "SELECT id, name, email, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Admin account not found']);
    exit;
}

$user = $result->fetch_assoc();

// Verify password
if (!verifyPassword($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    exit;
}

// Unset password before returning
unset($user['password']);

echo json_encode([
    'success' => true,
    'message' => 'Login successful',
    'user' => $user
]);

$stmt->close();
$conn->close();
?>
