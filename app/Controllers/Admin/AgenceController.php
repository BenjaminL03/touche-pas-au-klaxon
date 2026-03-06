<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers\Admin;

use Benjamin\Klaxon\Models\Agence;

/**
 * Contrôleur de gestion des agences (admin)
 */
class AgenceController
{
    private Agence $agence;

    public function __construct()
    {
        global $pdo;
        $this->agence = new Agence($pdo);
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
     * Liste toutes les agences
     */
    public function index(): void
    {
        $this->requireAdmin();
        $agences = $this->agence->findAll();
        require_once __DIR__ . '/../../Views/admin/agences.php';
    }

    /**
     * Affiche le formulaire de création d'une agence
     */
    public function create(): void
    {
        $this->requireAdmin();
        require_once __DIR__ . '/../../Views/admin/agence_form.php';
    }

    /**
     * Traite la création d'une agence
     */
    public function store(): void
    {
        $this->requireAdmin();

        $nom    = trim($_POST['nom'] ?? '');
        $errors = [];

        if (empty($nom)) {
            $errors[] = "Le nom de l'agence est obligatoire.";
        }

        if (!empty($errors)) {
            require_once __DIR__ . '/../../Views/admin/agence_form.php';
            return;
        }

        $this->agence->create($nom);
        $_SESSION['flash'] = "L'agence a été créée.";
        header('Location: /klaxon/admin/agences');
        exit;
    }

    /**
     * Affiche le formulaire de modification d'une agence
     *
     * @param int $id
     */
    public function edit(int $id): void
    {
        $this->requireAdmin();
        $agence = $this->agence->findById($id);

        if (!$agence) {
            header('Location: /klaxon/admin/agences');
            exit;
        }

        require_once __DIR__ . '/../../Views/admin/agence_form.php';
    }

    /**
     * Traite la modification d'une agence
     *
     * @param int $id
     */
    public function update(int $id): void
    {
        $this->requireAdmin();

        $nom    = trim($_POST['nom'] ?? '');
        $agence = $this->agence->findById($id);
        $errors = [];

        if (empty($nom)) {
            $errors[] = "Le nom de l'agence est obligatoire.";
        }

        if (!empty($errors)) {
            require_once __DIR__ . '/../../Views/admin/agence_form.php';
            return;
        }

        $this->agence->update($id, $nom);
        $_SESSION['flash'] = "L'agence a été modifiée.";
        header('Location: /klaxon/admin/agences');
        exit;
    }

    /**
     * Supprime une agence
     *
     * @param int $id
     */
    public function destroy(int $id): void
    {
        $this->requireAdmin();
        $this->agence->delete($id);
        $_SESSION['flash'] = "L'agence a été supprimée.";
        header('Location: /klaxon/admin/agences');
        exit;
    }
}