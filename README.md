# Complete E-Commerce Website Setup Guide

## Project Overview
A complete, fully functional e-commerce website built with native HTML5, CSS3, Vanilla JavaScript, PHP, and MySQL - NO frameworks!

## Features Included
✅ Responsive Homepage with Featured Products  
✅ Product Catalog with Search & Filter  
✅ Product Detail Pages  
✅ Shopping Cart (LocalStorage)  
✅ User Registration & Login  
✅ Admin Dashboard (Add/Edit/Delete Products)  
✅ Order System  
✅ Responsive Design (Mobile Friendly)  
✅ Secure Password Hashing  
✅ Input Validation & Sanitization  

---

## 📂 Project Structure
```
ecommerce2/
├── index.html                   # Homepage
├── shop.html                    # Product listing page
├── product-detail.html          # Product details page
├── cart.html                    # Shopping cart page
├── login.html                   # User login page
├── register.html                # User registration page
├── admin-login.html             # Admin login page
├── admin.php                    # Admin dashboard (MAIN ADMIN PANEL)
├── config.php                   # Database configuration
├── style.css                    # All CSS styles (responsive)
├── script.js                    # Vanilla JavaScript utilities
├── database-setup.sql           # Database setup script
├── api/
│   ├── get-products.php        # Get all products API
│   ├── register.php            # User registration API
│   ├── login.php               # User login API
│   ├── admin-login.php         # Admin login API
│   ├── add-product.php         # Add product API
│   ├── update-product.php      # Update product API
│   ├── delete-product.php      # Delete product API
│   └── checkout.php            # Order checkout API
├── uploads/                     # Product images directory
└── README.md                    # This file
```

---

## 🚀 Quick Start Instructions

### Step 1: Start XAMPP
1. Open XAMPP Control Panel
2. Start **Apache** (Web Server)
3. Start **MySQL** (Database)

### Step 2: Create Database
1. Open **phpMyAdmin** → http://localhost/phpmyadmin
2. Click "New" → Create new database named: `ecommerce_db`
3. Select the database and click "Import" tab
4. Upload and run the `database-setup.sql` file from the project

**OR manually import SQL:**
```sql
-- Copy the entire content from database-setup.sql
-- Paste it in phpMyAdmin → SQL tab
-- Click Go
```

### Step 3: Access the Website
- **Store**: http://localhost/ecommerce2/index.html
- **Shop**: http://localhost/ecommerce2/shop.html
- **User Login**: http://localhost/ecommerce2/login.html
- **Admin Panel**: http://localhost/ecommerce2/admin.php

### Step 4: Admin Login Credentials
```
Email: admin@ecommerce.com
Password: admin123
```

**IMPORTANT:** Change this password immediately in production!

---

## 🛒 Shopping Cart Usage

### For Customers:
1. Browse products on **Shop** page
2. Click **"Add to Cart"** button
3. View cart at **Cart** page
4. Update quantities or remove items
5. Checkout (data stored in browser localStorage)

### Cart Features:
- ✅ Add products to cart
- ✅ Remove items from cart
- ✅ Update quantities
- ✅ Calculate totals automatically
- ✅ Free shipping for orders over $50
- ✅ Tax calculation (10%)
- ✅ Persistent storage (survives page refresh)

---

## 🔐 Admin Panel Features

### Access Admin Panel:
1. Go to http://localhost/ecommerce2/admin.php
2. Click the red "Admin" link in navbar
3. Login with credentials above

### Admin Capabilities:

#### 📦 **Products Tab** - Manage all products
- ✅ **Add New Product**
  - Product Name
  - Price
  - Description
  - Product Image (auto upload)
  
- ✅ **View All Products** in table format
- ✅ **Edit Products** - Update details
- ✅ **Delete Products** - Remove from store

#### 📋 **Orders Tab** - View customer orders
- ✅ Order ID
- ✅ Customer Name
- ✅ Order Total
- ✅ Status
- ✅ Order Date

#### 👥 **Users Tab** - View registered users
- ✅ User ID
- ✅ User Name
- ✅ Email Address
- ✅ Registration Date

---

## 🗄️ Database Structure

### Tables Created:

#### **users table**
```sql
id          INT PRIMARY KEY AUTO_INCREMENT
name        VARCHAR(100)
email       VARCHAR(100) UNIQUE
password    VARCHAR(255) - bcrypt hashed
created_at  TIMESTAMP
```

#### **products table**
```sql
id          INT PRIMARY KEY AUTO_INCREMENT
name        VARCHAR(200)
price       DECIMAL(10,2)
description TEXT
image       VARCHAR(255) - filename
created_at  TIMESTAMP
```

#### **orders table**
```sql
id         INT PRIMARY KEY AUTO_INCREMENT
user_id    INT - FOREIGN KEY to users
total      DECIMAL(10,2)
status     VARCHAR(50)
created_at TIMESTAMP
```

#### **order_items table**
```sql
id          INT PRIMARY KEY AUTO_INCREMENT
order_id    INT - FOREIGN KEY to orders
product_id  INT - FOREIGN KEY to products
quantity    INT
price       DECIMAL(10,2)
```

---

## 🎨 Features Breakdown

### Frontend
- **Responsive Design** - Works on desktop, tablet, mobile
- **Modern UI** - Clean, professional styling
- **Smooth Animations** - Fade-in, slide effects
- **Product Cards** - Image, name, price, buttons
- **Search & Filter** - Find products easily
- **Dynamic Cart** - Real-time updates
- **Form Validation** - Client-side checks

### Backend (PHP)
- **Secure Authentication** - bcrypt password hashing
- **Input Sanitization** - SQL injection prevention
- **CRUD Operations** - Create, Read, Update, Delete
- **Database Queries** - Prepared statements
- **API Endpoints** - RESTful design
- **File Upload** - Product image handling
- **Error Handling** - User-friendly messages

### Security Features
- ✅ Password hashing with bcrypt
- ✅ SQL injection protection (prepared statements)
- ✅ Input validation on both client and server
- ✅ Admin authentication check
- ✅ Session management
- ✅ File upload validation
- ✅ XSS protection with htmlspecialchars()

---

## 📱 Responsive Design Breakpoints
- **Desktop**: 1200px and up
- **Tablet**: 768px - 1199px
- **Mobile**: 480px - 767px
- **Small Mobile**: Below 480px

---

## 🔌 API Endpoints (All POST requests)

### Products
- `GET api/get-products.php` - Fetch all products
- `POST api/add-product.php` - Add new product (admin only)
- `POST api/update-product.php` - Update product (admin only)
- `POST api/delete-product.php` - Delete product (admin only)

### Users
- `POST api/register.php` - Register new user
- `POST api/login.php` - User login
- `POST api/admin-login.php` - Admin login

### Orders
- `POST api/checkout.php` - Create order

---

## ⚙️ Configuration

### Database Connection (config.php)
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Default XAMPP user
define('DB_PASSWORD', '');           // Default XAMPP password (empty)
define('DB_NAME', 'ecommerce_db');
```

### Change if needed:
- Update credentials in `config.php` if your database is different
- Ensure MySQL is running before accessing the site

---

## 🧪 Testing the Website

### Test Customer Flow:
1. Go to **index.html** (homepage)
2. Click **Shop** → Browse products
3. Click **Add to Cart** on any product
4. Go to **Cart** → View your items
5. Update quantity or remove items

### Test Registration:
1. Go to **register.html**
2. Fill in: Name, Email, Password
3. Click Register
4. Login with your credentials at **login.html**

### Test Admin Panel:
1. Go to **admin-login.html**
2. Login with: admin@ecommerce.com / admin123
3. Add a new product in the **Products** tab
4. View the product on the shop page
5. Edit or delete the product

---

## 🚨 Troubleshooting

### Issue: "Connection failed"
- **Solution**: Make sure MySQL is running in XAMPP

### Issue: Database not created
- **Solution**: Import `database-setup.sql` via phpMyAdmin

### Issue: "File upload failed"
- **Solution**: Check if `uploads/` folder exists and is writable

### Issue: Admin login not working
- **Solution**: Verify admin credentials and database is imported

### Issue: Images not loading
- **Solution**: Ensure product image path is correct in uploads folder

---

## 📝 Code Quality

### HTML5
- Semantic markup
- Form accessibility
- Meta tags for responsiveness

### CSS3
- Flexbox & Grid layouts
- CSS variables for colors
- Media queries (no Bootstrap)
- Smooth transitions & animations
- No external dependencies

### JavaScript
- Vanilla JS (no jQuery)
- DOM manipulation
- LocalStorage for cart
- Fetch API for AJAX
- Error handling
- Code comments

### PHP
- Object-oriented where applicable
- Error handling
- Security best practices
- Database abstraction
- Code comments
- Input validation

---

## 🎁 Bonus Features Included

✅ Responsive design  
✅ Smooth animations  
✅ Product search  
✅ Product filtering  
✅ Shopping cart  
✅ User authentication  
✅ Admin dashboard  
✅ Order management  
✅ Image uploads  
✅ Tax calculation  
✅ Free shipping logic  
✅ Professional UI/UX  

---

## 📦 No External Dependencies!

This entire project uses:
- ✅ HTML5 only
- ✅ CSS3 only (no Bootstrap, Tailwind, etc.)
- ✅ Vanilla JavaScript (no jQuery, React, Vue, Angular)
- ✅ PHP only (no Laravel, Symfony, CodeIgniter)
- ✅ MySQL only (no MongoDB, PostgreSQL)

---

## 🎓 Learning Outcomes

By studying this code, you'll learn:
- Full-stack web development
- Responsive design techniques
- Client-side cart management
- User authentication & security
- Database design & normalization
- RESTful API design
- File upload handling
- Input validation & sanitization
- Password hashing & security
- Admin dashboard development

---

## 📞 Support & Customization

To customize:
1. **Colors**: Edit `:root` variables in `style.css`
2. **Database**: Modify tables in `database-setup.sql`
3. **Products**: Use admin panel to manage
4. **Users**: Implement email verification if needed
5. **Payments**: Add payment gateway (Stripe, PayPal, etc.)

---

## ⚡ Performance Tips

1. Optimize images before uploading
2. Use browser caching
3. Minify CSS/JS in production
4. Use database indexes
5. Implement pagination for large product lists

---

## 🔒 Production Checklist

Before going live:
- [ ] Change admin password
- [ ] Update database credentials
- [ ] Enable HTTPS
- [ ] Set up proper error logging
- [ ] Add rate limiting
- [ ] Implement CSRF protection
- [ ] Add email verification for users
- [ ] Set up automated backups
- [ ] Configure firewall rules
- [ ] Implement payment processing

---

## 📄 License

This project is open source and available for educational purposes.

---

**Enjoy your e-commerce website! 🎉**

For questions or issues, review the code comments or check the database structure.
