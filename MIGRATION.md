# 📌 Guide de Migration - Anciennes → Nouvelles URLs

## ⚠️ Fichiers Dupliqués (Conservés à la racine)

Les fichiers suivants existent toujours à la racine pour **référence uniquement**. 
Utilisez plutôt les **nouveaux chemins** listés ci-dessous.

---

## 🔄 Mapping Ancien → Nouveau

### 📄 Fichiers HTML Pages

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/index.html` | `/ecommerce2/frontend/pages/index.html` |
| `/ecommerce2/shop.html` | `/ecommerce2/frontend/pages/shop.html` |
| `/ecommerce2/product-detail.html` | `/ecommerce2/frontend/pages/product-detail.html` |
| `/ecommerce2/cart.html` | `/ecommerce2/frontend/pages/cart.html` |

### 📝 Fichiers HTML Formulaires

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/login.html` | `/ecommerce2/frontend/forms/login.html` |
| `/ecommerce2/register.html` | `/ecommerce2/frontend/forms/register.html` |
| `/ecommerce2/admin-login.html` | `/ecommerce2/frontend/forms/admin-login.html` |

### 🎨 Ressources (CSS/JS)

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/style.css` | `/ecommerce2/frontend/css/style.css` |
| `/ecommerce2/script.js` | `/ecommerce2/frontend/js/script.js` |

### ⚙️ Backend Configuration

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/config.php` | `/ecommerce2/backend/config.php` |
| `/ecommerce2/admin.php` | `/ecommerce2/backend/admin.php` |

### 🔗 APIs Authentification

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/api/login.php` | `/ecommerce2/backend/api/auth/login.php` |
| `/ecommerce2/api/register.php` | `/ecommerce2/backend/api/auth/register.php` |
| `/ecommerce2/api/admin-login.php` | `/ecommerce2/backend/api/auth/admin-login.php` |

### 📦 APIs Produits

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/api/get-products.php` | `/ecommerce2/backend/api/products/get-products.php` |
| `/ecommerce2/api/add-product.php` | `/ecommerce2/backend/api/products/add-product.php` |
| `/ecommerce2/api/update-product.php` | `/ecommerce2/backend/api/products/update-product.php` |
| `/ecommerce2/api/delete-product.php` | `/ecommerce2/backend/api/products/delete-product.php` |

### 📋 APIs Commandes

| Ancien | Nouveau |
|--------|---------|
| `/ecommerce2/api/checkout.php` | `/ecommerce2/backend/api/orders/checkout.php` |

---

## 🚀 Mise à Jour des Références

### Dans les fichiers HTML

**Avant :**
```html
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<a href="login.html">Login</a>
<a href="api/get-products.php">
```

**Après :**
```html
<link rel="stylesheet" href="../css/style.css">
<script src="../js/script.js"></script>
<a href="../forms/login.html">Login</a>
<a href="../../backend/api/products/get-products.php">
```

### Dans les appels d'API (JavaScript)

**Avant :**
```javascript
fetch('api/login.php')
fetch('api/get-products.php')
fetch('api/add-product.php')
```

**Après :**
```javascript
fetch('../../backend/api/auth/login.php')
fetch('../../backend/api/products/get-products.php')
fetch('../../backend/api/products/add-product.php')
```

---

## 📌 Points d'Entrée Principaux

### 🏠 Accueil (Point d'entrée recommandé)
```
http://localhost/ecommerce2/
  ↓ Redirection automatique vers
http://localhost/ecommerce2/frontend/pages/index.html
```

### 👤 Connexion Client
```
http://localhost/ecommerce2/frontend/forms/login.html
```

### 🔐 Connexion Admin
```
http://localhost/ecommerce2/frontend/forms/admin-login.html
```

### 📊 Dashboard Admin
```
http://localhost/ecommerce2/backend/admin.php
```

---

## ✅ Fichiers Déjà Mis à Jour

Tous les fichiers créés/déplacés ont **déjà leurs chemins mis à jour** :

- ✅ `frontend/pages/*.html` - Chemins CSS/JS/API corrects
- ✅ `frontend/forms/*.html` - Chemins vers pages/API/css/js corrects
- ✅ `frontend/js/script.js` - Chemins d'appels API mis à jour
- ✅ `backend/api/*/*.php` - Chemins de configuration relatifs
- ✅ `backend/admin.php` - Chemins vers API et CSS corrects

---

## ⚠️ Attention

**Les fichiers à la racine** (ancien `index.html`, `login.html`, etc.) 
existent toujours mais ne sont **plus utilisés**. 

Préférez les nouveaux chemins dans la structure Frontend/Backend.

---

## 🔄 Checklist de Migration

- [x] Pages HTML déplacées
- [x] Formulaires regroupés
- [x] CSS/JS centralisés
- [x] APIs réorganisées
- [x] Configuration centralisée
- [x] Chemins relatifs mis à jour
- [x] index.html redirection ajoutée
- [x] Documentation créée

---

**Status** : ✅ Migration Complète
**Date** : 2024
**Version** : 2.0
