<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers\Admin;

use Benjamin\Klaxon\Models\Trajet;
use Benjamin\Klaxon\Models\Employe;
use Benjamin\Klaxon\Models\Agence;

/**
 * Contrôleur du tableau de bord administrateur
 */
class AdminController
{
    private Trajet $trajet;
    private Employe $employe;
    private Agence $agence;

    public function __construct()
    {
        global $pdo;
        $this->trajet  = new Trajet($pdo);
        $this->employe = new Employe($pdo);
        $this->agence  = new Agence($pdo);
    }

    /**
     * Vérifie que l'utilisateur est admin
     */
    private function requireAdmin(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /klaxon');
            exit;
        }
    }

    /**
     * Affiche le tableau de bord
     */
    public function index(): void
    {
        $this->requireAdmin();
        header('Location: /klaxon/admin/employes');
        exit;
    }

    /**
     * Liste tous les trajets (admin)
     */
    public function trajets(): void
    {
        $this->requireAdmin();
        $trajets = $this->trajet->findAll();
        require_once __DIR__ . '/../../Views/admin/trajets.php';
    }

    /**
     * Supprime un trajet (admin)
     *
     * @param int $id
     */
    public function destroyTrajet(int $id): void
    {
        $this->requireAdmin();
        $this->trajet->delete($id);
        $_SESSION['flash'] = 'Le trajet a été supprimé.';
        header('Location: /klaxon/admin/trajets');
        exit;
    }
}