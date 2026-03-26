# Guide Pour Étudiants - E-Commerce Simplifié

## 📚 Vue d'ensemble du projet

Ce projet e-commerce a été **radicalement simplifié** pour les étudiants débutants. Au lieu de 1200+ lignes de CSS complexe, vous avez maintenant ~300 lignes. Les fichiers PHP ont été streamlinés pour montrer les principaux concepts.

## 🎯 Objectifs d'apprentissage

✅ Comprendre l'architecture Frontend/Backend
✅ Apprendre les bases du PHP et MySQL
✅ Maîtriser l'authentification utilisateur simple
✅ Implémenter des opérations CRUD basiques
✅ Créer une interface utilisateur fonctionnelle

## 📂 Structure du projet

```
ecommerce2/
├── frontend/
│   ├── css/
│   │   └── style.css (297 lignes - CSS minimal)
│   ├── js/
│   │   └── script.js (routines JS basiques)
│   ├── pages/ (index, shop, product-detail, cart)
│   └── forms/ (login, register, admin-login)
└── backend/
    ├── config.php (Configuration DB)
    └── api/
        ├── auth/ (login, register)
        └── products/ (get, add, update, delete)
```

## 🔑 Concepts clés

### 1. Base de données (MySQL)
- Table `users` : Authentification
- Table `products` : Catalogue produits
- **Important** : Exécutez `database-setup.sql` pour créer les tables

### 2. Frontend (HTML/CSS/JavaScript)
- **HTML** : Structure simple avec classes minimales
- **CSS** : Couleurs basiques, pas d'animations complexes
- **JavaScript** : Formulaires et appels API seulement

### 3. Backend (PHP)
- **config.php** : Connexion DB + fonctions utiles
- **API endpoints** : Recevoir requêtes, interagir DB, envoyer JSON

## 🚀 Démarrage

### Étape 1 : Installation DB
```sql
-- Exécutez database-setup.sql dans phpMyAdmin
```

### Étape 2 : Testez un formulaire
- Allez à `http://localhost/ecommerce2/register.html`
- Remplissez le formulaire et envoyez
- Vérifiez que les données sont en DB

### Étape 3 : Explorez le code
1. Ouvrez `frontend/forms/register.html` → Voyez le HTML
2. Ouvrez `frontend/js/script.js` → Voyez comment les données sont envoyées
3. Ouvrez `backend/api/auth/register.php` → Voyez la réception et insertion en DB

## 💡 Concepts à maîtriser

### PHP - Reçevoir les données
```php
$email = $_POST['email'];  // Données du formulaire
$data = json_decode(file_get_contents('php://input'), true); // Données JSON
```

### PHP - Interagir avec DB
```php
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
```

### PHP - Envoyer une réponse
```php
header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'OK']);
```

### JavaScript - Envoyer un formulaire
```javascript
const formData = new FormData(form);
fetch('../../backend/api/auth/register.php', {
    method: 'POST',
    body: formData
}).then(r => r.json()).then(data => console.log(data));
```

## 🎨 Personnalisation CSS

Vous voulez changer les couleurs? C'est facile:

1. Ouvrez `frontend/css/style.css`
2. Trouvez `background: #0066cc;` (bleu)
3. Changez en votre couleur: `background: #ff0000;` (rouge)
4. Cherchez "0066cc" pour changer toutes les occurrences du bleu principal

## 📝 Fichiers à comprendre en premier

**Pour débutants absolus :**
1. `frontend/forms/register.html` - Formulaire simple
2. `backend/api/auth/register.php` - Insertion en DB
3. `frontend/js/script.js` - Envoi de formulaire

**Après, explorez :**
4. `backend/config.php` - Fonctions réutilisables
5. `backend/api/products/get-products.php` - SELECT simple
6. `frontend/pages/shop.html` - Affichage de produits

## 🐛 Débogage

### Vérifier une erreur PHP
```php
// Ajoutez au top du fichier PHP:
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Vérifier les requêtes depuis JavaScript
```javascript
// Ouvrez DevTools (F12), allez à Network, et regardez les requêtes
```

### Vérifier la structure DB
- Allez à `phpmyadmin` 
- Cliquez sur la DB `ecommerce_db`
- Regardez les tables et colonnes

## ✨ Améliorations futures possibles

Une fois confortable, essayez:
- [ ] Ajouter validation de mot de passe fort
- [ ] Ajouter gestion du panier en DB (au lieu de localStorage)
- [ ] Ajouter pagination aux produits
- [ ] Ajouter système de commandes

## 📚 Ressources d'apprentissage

- **PHP** : w3schools.com/php
- **MySQL** : w3schools.com/sql
- **JavaScript** : developer.mozilla.org/en-US/docs/Web/JavaScript
- **CSS** : w3schools.com/css

---

**Bon courage! 🎓**
