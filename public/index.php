<?php

declare(strict_types=1);

/**
 * Point d'entrée de l'application Touche Pas au Klaxon
 * Toutes les requêtes passent par ce fichier
 */

// Affichage des erreurs (à supprimer en production)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Démarre la session
session_start();

// Autoload Composer (classes + dépendances)
require_once __DIR__ . '/../vendor/autoload.php';

// Configuration de la base de données
require_once __DIR__ . '/../config/database.php';

// Supprime le préfixe /klaxon pour que le routeur fonctionne en sous-dossier
$_SERVER['REQUEST_URI'] = str_replace('/klaxon', '', $_SERVER['REQUEST_URI']) ?: '/';

// Chargement des routes
require_once __DIR__ . '/../config/routes.php';