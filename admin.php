<?php
// File: admin.php
// Admin Dashboard

session_start();
require_once 'config.php';

// Check if admin is logged in (from sessionStorage in JavaScript)
// For this basic implementation, we'll check a simple session variable
// In production, implement proper session management

$admin_id = $_POST['admin_id'] ?? null;
$action = $_POST['action'] ?? null;
$page = $_GET['page'] ?? 'products';

// Handle product operations
if ($action === 'add_product' && !empty($admin_id)) {
    // Redirect to add_product.php
    $_POST['admin_id'] = $admin_id;
    include 'api/add-product.php';
    exit;
}

if ($action === 'update_product' && !empty($admin_id)) {
    $_POST['admin_id'] = $admin_id;
    include 'api/update-product.php';
    exit;
}

if ($action === 'delete_product' && !empty($admin_id)) {
    $_POST['admin_id'] = $admin_id;
    include 'api/delete-product.php';
    exit;
}

// Get all products for display
$sql = "SELECT id, name, price, description, image FROM products ORDER BY id DESC";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Get all orders
$ordersSql = "SELECT o.id, o.user_id, u.name as user_name, o.total, o.status, o.created_at FROM orders o
              LEFT JOIN users u ON o.user_id = u.id
              ORDER BY o.created_at DESC";
$ordersResult = $conn->query($ordersSql);
$orders = $ordersResult ? $ordersResult->fetch_all(MYSQLI_ASSOC) : [];

// Get all users
$usersSql = "SELECT id, name, email, created_at FROM users WHERE email != 'admin@ecommerce.com' ORDER BY id DESC";
$usersResult = $conn->query($usersSql);
$users = $usersResult ? $usersResult->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ECommerce Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .admin-logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="index.html">🛍️ ECommerce Store</a>
            </div>
            <ul class="nav-menu">
                <li><a href="index.html">Store</a></li>
                <li style="margin-left: auto;">
                    <span style="color: var(--white); margin-right: 1rem;">Admin Panel</span>
                    <button class="admin-logout-btn" onclick="logoutAdmin()">Logout</button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Admin Section -->
    <section class="admin-section">
        <div class="admin-notice-box">
            ⚠️ Restricted Area: Admin Only | All changes are logged and monitored
        </div>

        <div class="admin-header">
            <h1>📊 Admin Dashboard</h1>
        </div>

        <!-- Admin Tabs -->
        <div class="admin-tabs">
            <button class="tab-btn <?php echo $page === 'products' ? 'active' : ''; ?>" onclick="switchTab('products')">
                📦 Products
            </button>
            <button class="tab-btn <?php echo $page === 'orders' ? 'active' : ''; ?>" onclick="switchTab('orders')">
                📋 Orders
            </button>
            <button class="tab-btn <?php echo $page === 'users' ? 'active' : ''; ?>" onclick="switchTab('users')">
                👥 Users
            </button>
        </div>

        <!-- Products Tab -->
        <div class="admin-content">
            <div class="tab-content active" id="productsTab">
                <h2>Manage Products</h2>

                <!-- Add Product Form -->
                <div class="admin-form">
                    <h3>Add New Product</h3>
                    <form id="addProductForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input type="text" id="productName" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Price ($):</label>
                            <input type="number" id="productPrice" name="price" step="0.01" min="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description:</label>
                            <textarea id="productDescription" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="productImage">Product Image:</label>
                            <input type="file" id="productImage" name="image" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>

                <hr style="margin: 2rem 0;">

                <!-- Products Table -->
                <h3>All Products</h3>
                <table class="admin-products-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td>
                                <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     onerror="this.src='https://via.placeholder.com/50'">
                            </td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo substr(htmlspecialchars($product['description']), 0, 50) . '...'; ?></td>
                            <td>
                                <div class="admin-actions">
                                    <button class="btn btn-small" onclick="editProduct(<?php echo $product['id']; ?>)">Edit</button>
                                    <button class="btn btn-small btn-danger" onclick="deleteProduct(<?php echo $product['id']; ?>)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Orders Tab -->
            <div class="tab-content" id="ordersTab">
                <h2>Orders</h2>
                <table class="admin-products-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?php echo $order['id']; ?></td>
                            <td><?php echo htmlspecialchars($order['user_name'] ?? 'Guest'); ?></td>
                            <td>$<?php echo number_format($order['total'], 2); ?></td>
                            <td>
                                <span style="background: #28a745; color: white; padding: 5px 10px; border-radius: 5px;">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($orders)): ?>
                <p style="text-align: center; padding: 2rem; color: #666;">No orders yet.</p>
                <?php endif; ?>
            </div>

            <!-- Users Tab -->
            <div class="tab-content" id="usersTab">
                <h2>Users</h2>
                <table class="admin-products-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($users)): ?>
                <p style="text-align: center; padding: 2rem; color: #666;">No users registered yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 ECommerce Store. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
    <script>
        // Tab switching
        function switchTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            const buttons = document.querySelectorAll('.tab-btn');

            tabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.id === tabName + 'Tab') {
                    tab.classList.add('active');
                }
            });

            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.includes(tabName === 'products' ? 'Products' : tabName === 'orders' ? 'Orders' : 'Users')) {
                    btn.classList.add('active');
                }
            });
        }

        // Get admin ID from sessionStorage
        function getAdminId() {
            const admin = sessionStorage.getItem('admin');
            if (!admin) {
                alert('Admin session expired. Please login again.');
                window.location.href = 'admin-login.html';
                return null;
            }
            const adminData = JSON.parse(admin);
            return adminData.id;
        }

        // Add product form submission
        document.getElementById('addProductForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const adminId = getAdminId();
            if (!adminId) return;

            const formData = new FormData();
            formData.append('admin_id', adminId);
            formData.append('name', document.getElementById('productName').value);
            formData.append('price', document.getElementById('productPrice').value);
            formData.append('description', document.getElementById('productDescription').value);
            
            const imageFile = document.getElementById('productImage').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            try {
                const response = await apiPostForm('api/add-product.php', formData);
                if (response.success) {
                    alert('Product added successfully!');
                    document.getElementById('addProductForm').reset();
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });

        // Edit product
        function editProduct(productId) {
            const adminId = getAdminId();
            if (!adminId) return;

            const newName = prompt('Enter new product name:');
            if (!newName) return;

            const newPrice = prompt('Enter new price:');
            if (!newPrice || isNaN(newPrice)) return;

            const newDescription = prompt('Enter new description:');
            if (!newDescription) return;

            const formData = new FormData();
            formData.append('admin_id', adminId);
            formData.append('id', productId);
            formData.append('name', newName);
            formData.append('price', newPrice);
            formData.append('description', newDescription);

            fetch('api/update-product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product updated successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
        }

        // Delete product
        function deleteProduct(productId) {
            if (!confirm('Are you sure you want to delete this product?')) return;

            const adminId = getAdminId();
            if (!adminId) return;

            const formData = new FormData();
            formData.append('admin_id', adminId);
            formData.append('id', productId);

            fetch('api/delete-product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product deleted successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
        }

        // Verify admin is logged in
        window.addEventListener('load', function() {
            if (!getAdminId()) {
                window.location.href = 'admin-login.html';
            }
        });
    </script>
</body>
</html>
