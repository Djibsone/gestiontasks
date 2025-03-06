
# Gestion des Tâches (TaskManager)

## Description
Cette application Laravel permet aux utilisateurs de gérer leurs tâches de manière simple et efficace.

## Prérequis
- PHP >= 7.3
- Composer
- MySQL ou un autre système de gestion de base de données pris en charge par Laravel

## Installation

### 1. **Clonez le dépôt**
```bash
git clone <https://github.com/Djibsone/gestiontasks.git>
cd tasks
```

### 2. **Installez les dépendances**
```bash
composer install
```

### 3. **Copiez le fichier d'environnement**
```bash
cp .env.example .env
```

### 4. **Configurez votre environnement**
Ouvrez le fichier `.env` et modifiez les paramètres de connexion à la base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base_de_données
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe
```

Ajoutez également la clé de chiffrement :
```env
ENCRYPTION_KEY=MaSuperCleSecrete1234567890123456 //La clé est peut-être 123 par example
```
⚠️ **Assurez-vous que la clé fait exactement 32 caractères pour être compatible avec `aes-256-cbc`.**

### 5. **Générez la clé de l'application**
```bash
php artisan key:generate
```

### 6. **Exécutez les migrations**
```bash
php artisan migrate
```

### 7. **(Optionnel) Exécutez les seeders**
Si vous souhaitez insérer des données de test, exécutez :
```bash
php artisan db:seed

## Les identifiants de connexion sont `admin@admin.fr` et `password123`, avec deux tâches créées.
```

### 8. **Installez les dépendances front-end (si nécessaire)**
```bash
npm install  # ou yarn install
```

### 9. **Compilez les fichiers front-end (si nécessaire)**
```bash
npm run dev  # ou npm run build pour la production
```

### 10. **Exécutez le serveur**
```bash
php artisan serve
```
L'application sera accessible à l'adresse [http://localhost:8000](http://localhost:8000).

---

## 📌 **Utilisation des Helpers d'Encryption**
L'application inclut des fonctions de chiffrement et de déchiffrement des données.

### **Chiffrer une donnée**
```php
$texte = "Mon message secret";
$chiffre = encryptData($texte);
echo "Texte chiffré : " . $chiffre;
```

### **Déchiffrer une donnée**
```php
$dechiffre = decryptData($chiffre);
echo "Texte déchiffré : " . $dechiffre;
```

---

## Fonctionnalités
✅ Inscription et connexion des utilisateurs.  
✅ Ajout, modification et suppression des tâches.  
✅ Chiffrement des données sensibles.  

---

## 📜 Licence
Ce projet est sous licence MIT. Vous êtes libre de l'utiliser et de le modifier.
