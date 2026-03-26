# ECommerce Structure Summary

## 📊 Nouvelle Structure Hierarchique

```
ECOMMERCE2/
│
├── 📄 index.html ........................ Point d'entrée (redirect)
│
├── 📁 FRONTEND/ ......................... Interface Utilisateur
│   ├── 📁 pages/ ........................ Pages principales
│   │   ├── 📄 index.html ............... Accueil
│   │   ├── 📄 shop.html ................ Boutique
│   │   ├── 📄 product-detail.html ...... Détail produit
│   │   └── 📄 cart.html ................ Panier
│   │
│   ├── 📁 forms/ ........................ Formulaires (centralisés)
│   │   ├── 📄 login.html ............... Login utilisateur
│   │   ├── 📄 register.html ............ Inscription
│   │   └── 📄 admin-login.html ......... Login admin
│   │
│   ├── 📁 css/ .......................... Styles
│   │   └── 📄 style.css ................ Feuille de styles principale
│   │
│   └── 📁 js/ ........................... Scripts
│       └── 📄 script.js ................ Utilitaires JS
│
├── 📁 BACKEND/ .......................... Logique Serveur
│   ├── 📄 config.php ................... Configuration BD
│   ├── 📄 admin.php .................... Tableau de bord
│   │
│   └── 📁 api/ .......................... API REST
│       ├── 📁 auth/ .................... Authentification
│       │   ├── 📄 login.php ............ Login API
│       │   ├── 📄 register.php ......... Register API
│       │   └── 📄 admin-login.php ...... Admin Login API
│       │
│       ├── 📁 products/ ................ Gestion produits
│       │   ├── 📄 get-products.php .... GET produits
│       │   ├── 📄 add-product.php .... POST produit
│       │   ├── 📄 update-product.php . PUT produit
│       │   └── 📄 delete-product.php . DELETE produit
│       │
│       └── 📁 orders/ .................. Gestion commandes
│           └── 📄 checkout.php ........ Traiter commande
│
├── 📁 uploads/ .......................... Images produits
│
├── 📄 database-setup.sql ............... Setup BD
├── 📄 README.md ......................... Ancien README
└── 📄 STRUCTURE.md ..................... Cette doc

```

## 🔄 Flux de Données

### Client (Frontend)
```
User Action
    ↓
frontend/pages/*.html
    ↓
frontend/js/script.js (Fetch API)
    ↓
backend/api/*/...php
    ↓
Réponse JSON
    ↓
Mise à jour DOM
```

### Authentification
```
frontend/forms/login.html
    ↓
backend/api/auth/login.php
    ↓
localStorage/sessionStorage
    ↓
Redirection vers page
```

### Produits
```
frontend/pages/shop.html
    ↓
backend/api/products/get-products.php
    ↓
Affichage grille produits
```

## 📑 Fichiers Clés

| Fichier | Rôle |
|---------|------|
| `frontend/pages/index.html` | Page d'accueil |
| `frontend/forms/login.html` | Connexion utilisateur |
| `frontend/forms/admin-login.html` | Connexion admin |
| `backend/config.php` | Configuration DB |
| `backend/api/auth/login.php` | Authentification |
| `backend/api/products/get-products.php` | Récupérer produits |
| `backend/admin.php` | Tableau de bord admin |

## 🎯 Avantages

✅ **Séparation des responsabilités** - Frontend/Backend clairs
✅ **Maintenabilité** - Code organisé par fonctionnalité
✅ **Scalabilité** - Facile d'ajouter de nouvelles APIs
✅ **Sécurité** - Backend logique centralisée
✅ **Flexibilité** - Formulaires ensemble et réutilisables
✅ **Performance** - Charge modulaire

---

**Année** : 2024 | **Version** : 2.0 (Reorganized)
