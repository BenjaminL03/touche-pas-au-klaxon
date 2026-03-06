<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers\Admin;

use Benjamin\Klaxon\Models\Employe;

/**
 * Contrôleur de gestion des employés (admin)
 */
class EmployeController
{
    private Employe $employe;

    public function __construct()
    {
        global $pdo;
        $this->employe = new Employe($pdo);
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
     * Liste tous les employés
     */
    public function index(): void
    {
        $this->requireAdmin();
        $employes = $this->employe->findAll();
        require_once __DIR__ . '/../../Views/admin/employes.php';
    }
}