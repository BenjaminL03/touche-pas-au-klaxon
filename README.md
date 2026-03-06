# Touche Pas au Klaxon

Application de covoiturage intranet développée en PHP avec une architecture MVC.

# Description

Cette application permet aux employés d'une entreprise de proposer et consulter des trajets de covoiturage entre les différents sites. Elle est déployée sur l'intranet de l'entreprise et accessible uniquement depuis les postes de travail des employés.

# Technologies utilisées

- **PHP 8.3** — Backend
- **MySQL / MariaDB** — Base de données
- **Architecture MVC** — Organisation du code
- **Bootstrap 5 + Sass** — Interface utilisateur
- **Composer** — Gestion des dépendances PHP
- **izniburak/router** — Routeur PHP
- **PHPStan** — Analyse statique du code
- **PHPUnit** — Tests unitaires

# Prérequis

- MAMP (ou équivalent : WAMP, Laragon, XAMPP)
- PHP 8.3+
- MySQL 5.7+ / MariaDB
- Composer
- Node.js + npm

# Installation

# 1. Cloner le dépôt

```bash
git clone https://github.com/BenjaminL03/touche-pas-au-klaxon.git
cd touche-pas-au-klaxon
```

# 2. Installer les dépendances PHP

```bash
composer install
```

# 3. Installer les dépendances npm et compiler le Sass

```bash
npm install
npm run sass-build
```

# 4. Créer la base de données

- Démarrer MAMP et ouvrir phpMyAdmin (`http://localhost:8888/phpmyadmin`)
- Importer `database/schema.sql` (créer la structure)
- Importer `database/seed.sql` (insérer les données de test)

# 5. Configurer la connexion BDD

Dans `config/database.php`, vérifier les paramètres :

```php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '8889');   // 8889 sur Mac avec MAMP
define('DB_NAME', 'klaxon');
define('DB_USER', 'root');
define('DB_PASS', 'root');
```

# 6. Lancer l'application

Démarrer MAMP et accéder à :

```
http://localhost:8888/klaxon
```

# Comptes de test

| Rôle           | Email                     | Mot de passe |
| -------------- | ------------------------- | ------------ |
| Administrateur | alexandre.martin@email.fr | Password1!   |
| Employé        | sophie.dubois@email.fr    | Password1!   |

# Fonctionnalités

# Visiteur (non connecté)

- Consulter la liste des trajets disponibles (avec places, non passés)

# Employé connecté

- Consulter les détails d'un trajet (modale)
- Proposer un nouveau trajet
- Modifier ses propres trajets
- Supprimer ses propres trajets

# Administrateur

- Accès complet à tous les trajets (consultation, création, modification, suppression)
- Gestion des agences (création, modification, suppression)
- Consultation de la liste des employés

## Lancer les tests

```bash
vendor/bin/phpunit
```

## Analyser la qualité du code

```bash
vendor/bin/phpstan analyse
```

## Structure du projet

```
touche-pas-au-klaxon/
├── app/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── AdminController.php
│   │   │   ├── AgenceController.php
│   │   │   └── EmployeController.php
│   │   ├── AuthController.php
│   │   ├── HomeController.php
│   │   └── TrajetController.php
│   ├── Models/
│   │   ├── Agence.php
│   │   ├── Employe.php
│   │   └── Trajet.php
│   └── Views/
│       ├── admin/
│       ├── auth/
│       ├── home/
│       ├── layouts/
│       └── trajets/
├── config/
│   ├── database.php
│   └── routes.php
├── database/
│   ├── schema.sql
│   └── seed.sql
├── public/
│   ├── css/
│   ├── sass/
│   └── index.php
├── tests/
│   ├── AgenceTest.php
│   └── TrajetTest.php
├── composer.json
├── phpstan.neon
├── phpunit.xml
└── README.md
```
