<?php
// Password Reset Script
require_once 'config.php';

// Generate hash for password: 111111
$password = '111111';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "Updating admin password...<br>";
echo "New Hash: " . $hash . "<br><br>";

// Update the password in database
$sql = "UPDATE users SET password = ? WHERE email = 'naim.douib@gmail.com'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hash);

if ($stmt->execute()) {
    echo "✅ Password updated successfully!<br>";
    echo "Email: naim.douib@gmail.com<br>";
    echo "Password: 111111<br><br>";
    echo "You can now login at: <a href='admin-login.html'>Admin Login</a>";
} else {
    echo "❌ Error updating password: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
