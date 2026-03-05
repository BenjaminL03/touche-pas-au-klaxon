<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers;

use Benjamin\Klaxon\Models\Trajet;

/**
 * Contrôleur de la page d'accueil
 */
class HomeController
{
    private Trajet $trajet;

    public function __construct()
    {
        global $pdo;
        $this->trajet = new Trajet($pdo);
    }

    /**
     * Affiche la page d'accueil avec la liste des trajets disponibles
     */
    public function index(): void
    {
        $trajets = $this->trajet->findAvailable();
        require_once __DIR__ . '/../Views/home/index.php';
    }
}