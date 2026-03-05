<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers;

/**
 * Contrôleur de la page d'accueil
 */
class HomeController
{
    /**
     * Affiche la page d'accueil
     */
    public function index(): string
    {
        return "Touche Pas au Klaxon — Page d'accueil 🚗";
    }
}