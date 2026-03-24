/* ============================
   SHOPPING CART FUNCTIONS
============================ */

// Get cart from localStorage
function getCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

// Update cart count in navbar
function updateCartCount() {
    const cart = getCart();
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}

// Add item to cart
function addToCart(id, name, price) {
    let cart = getCart();
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1
        });
    }

    saveCart(cart);
    console.log(`Added "${name}" to cart`);
}

// Remove item from cart
function removeFromCart(id) {
    let cart = getCart();
    cart = cart.filter(item => item.id !== id);
    saveCart(cart);
    location.reload();
}

// Clear entire cart
function clearCart() {
    localStorage.removeItem('cart');
    updateCartCount();
    location.reload();
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});

/* ============================
   UTILITY FUNCTIONS
============================ */

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#007bff'};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

/* ============================
   FORM VALIDATION
============================ */

// Validate email
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Validate password
function validatePassword(password) {
    return password.length >= 6;
}

// Validate form inputs
function validateFormInput(input, type) {
    switch(type) {
        case 'email':
            return validateEmail(input);
        case 'password':
            return validatePassword(input);
        case 'text':
            return input.trim().length > 0;
        case 'number':
            return !isNaN(input) && input > 0;
        default:
            return input.trim().length > 0;
    }
}

/* ============================
   API HELPER FUNCTIONS
============================ */

// Make GET request
async function apiGet(url) {
    try {
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error('API GET Error:', error);
        throw error;
    }
}

// Make POST request
async function apiPost(url, data) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        return await response.json();
    } catch (error) {
        console.error('API POST Error:', error);
        throw error;
    }
}

// Make form data POST request
async function apiPostForm(url, formData) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        return await response.json();
    } catch (error) {
        console.error('API POST Form Error:', error);
        throw error;
    }
}

/* ============================
   STORAGE FUNCTIONS
============================ */

// Get from localStorage
function getStorageItem(key) {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : null;
}

// Set in localStorage
function setStorageItem(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

// Remove from localStorage
function removeStorageItem(key) {
    localStorage.removeItem(key);
}

/* ============================
   DOM HELPER FUNCTIONS
============================ */

// Get element by ID
function getElement(id) {
    return document.getElementById(id);
}

// Get elements by class
function getElements(className) {
    return document.querySelectorAll('.' + className);
}

// Create element
function createElement(tag, className = '', innerHTML = '') {
    const element = document.createElement(tag);
    if (className) element.className = className;
    if (innerHTML) element.innerHTML = innerHTML;
    return element;
}

// Check if user is logged in
function isUserLoggedIn() {
    return localStorage.getItem('user') !== null;
}

// Check if admin is logged in
function isAdminLoggedIn() {
    return sessionStorage.getItem('admin') !== null;
}

// Get logged in user
function getLoggedInUser() {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user) : null;
}

// Get logged in admin
function getLoggedInAdmin() {
    const admin = sessionStorage.getItem('admin');
    return admin ? JSON.parse(admin) : null;
}

// Logout user
function logoutUser() {
    localStorage.removeItem('user');
    window.location.href = 'index.html';
}

// Logout admin
function logoutAdmin() {
    sessionStorage.removeItem('admin');
    window.location.href = 'admin-login.html';
}

/* ============================
   ANIMATIONS
============================ */

// Add slide in animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
`;
document.head.appendChild(style);
