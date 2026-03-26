# ECommerce Store - Reorganized Structure

## 📂 New Project Organization

Le projet a été réorganisé pour séparer le **Frontend** et le **Backend**, avec tous les formulaires regroupés ensemble.

```
ecommerce2/
├── index.html                          # Point d'entrée principal (redirection)
│
├── frontend/                           # Frontend - Interface utilisateur
│   ├── pages/                          # Pages principales
│   │   ├── index.html                 # Page d'accueil
│   │   ├── shop.html                  # Catalogue de produits
│   │   ├── product-detail.html        # Détails du produit
│   │   └── cart.html                  # Panier
│   │
│   ├── forms/                          # Tous les formulaires ensemble
│   │   ├── login.html                 # Formulaire de connexion utilisateur
│   │   ├── register.html              # Formulaire d'inscription
│   │   └── admin-login.html           # Formulaire de connexion admin
│   │
│   ├── css/                            # Feuilles de styles
│   │   └── style.css                  # Styles globaux
│   │
│   └── js/                             # Scripts frontend
│       └── script.js                   # Utilitaires et fonctions JS
│
├── backend/                            # Backend - Logique serveur
│   ├── config.php                      # Configuration base de données (partagée)
│   ├── admin.php                       # Tableau de bord admin
│   │
│   └── api/                            # API REST
│       ├── auth/                       # Authentification
│       │   ├── login.php              # Connexion utilisateur
│       │   ├── register.php           # Inscription utilisateur
│       │   └── admin-login.php        # Connexion admin
│       │
│       ├── products/                  # Gestion produits
│       │   ├── get-products.php       # Récupérer les produits
│       │   ├── add-product.php        # Ajouter un produit
│       │   ├── update-product.php     # Modifier un produit
│       │   └── delete-product.php     # Supprimer un produit
│       │
│       └── orders/                    # Gestion commandes
│           └── checkout.php           # Traiter la commande
│
├── uploads/                            # Dossier des images (produits)
├── database-setup.sql                  # Script de création base de données
├── README.md                           # Documentation (ancien)
└── STRUCTURE.md                        # Ce fichier
```

## 🎯 Avantages de cette organisation

### Frontend (`/frontend`)
- **pages/** : Toutes les pages HTML principales
- **forms/** : Formulaires d'authentification centralisés
- **css/** : Feuilles de styles uniques
- **js/** : Scripts frontend

### Backend (`/backend`)
- **api/auth/** : Authentification (login, register)
- **api/products/** : CRUD produits
- **api/orders/** : Gestion des commandes
- **config.php** : Configuration centralisée

## 🔗 Chemins d'accès

### Depuis le Frontend
- CSS : `../css/style.css`
- JS : `../js/script.js`
- API Produits : `../../backend/api/products/get-products.php`
- API Auth : `../../backend/api/auth/login.php`

### Depuis les Pages
```
pages/
├── index.html → ../css/style.css
├── index.html → ../js/script.js
├── shop.html → ../../backend/api/products/get-products.php
└── product-detail.html → ../forms/login.html
```

### Depuis les Formulaires
```
forms/
├── login.html → ../css/style.css
├── login.html → ../js/script.js
├── login.html → ../pages/index.html (lien retour)
└── login.html → ../../backend/api/auth/login.php (API)
```

## 🚀 Points d'entrée

1. **Accueil** : `http://localhost/ecommerce2/`
   - Redirige vers → `frontend/pages/index.html`

2. **Admin** : `http://localhost/ecommerce2/frontend/forms/admin-login.html`
   - Authentification → `backend/admin.php`

3. **API** : `http://localhost/ecommerce2/backend/api/[endpoint]`
   - Tous les appels API

## 📋 Navigation utilisateur

```
index.html (redirect)
    ↓
frontend/pages/index.html (accueil)
    ├→ frontend/pages/shop.html (boutique)
    ├→ frontend/pages/product-detail.html (détail)
    ├→ frontend/pages/cart.html (panier)
    ├→ frontend/forms/login.html (connexion)
    └→ frontend/forms/admin-login.html (admin)
```

## 🔐 Navigation Admin

```
frontend/forms/admin-login.html
    ↓
backend/admin.php (tableau de bord)
    ├→ API: backend/api/products/...
    ├→ API: backend/api/orders/...
    └→ API: backend/api/auth/...
```

## 🛠️ Modifications apportées

✅ Structure séparée Frontend/Backend
✅ Formulaires regroupés dans `/forms`
✅ APIs organisées par domaine (auth, products, orders)
✅ Configuration centralisée en backend
✅ Chemins relatifs mis à jour dans tous les fichiers
✅ CSS et JS centralisés en frontend

## 📝 Fichiers modifiés

- ✅ Toutes les pages HTML (chemins CSS/JS/API mis à jour)
- ✅ Tous les formulaires (chemins relatifs corrigés)
- ✅ Toutes les APIs (structure reorganisée)
- ✅ scripts.js (chemins des appels API mis à jour)

---

**Date de restructuration** : 2024
**Version** : 2.0 (Reorganized)
