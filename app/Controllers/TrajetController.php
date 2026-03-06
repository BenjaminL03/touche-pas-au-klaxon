<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers;

use Benjamin\Klaxon\Models\Trajet;
use Benjamin\Klaxon\Models\Agence;

/**
 * Contrôleur des trajets
 * Gère la création, modification et suppression des trajets
 */
class TrajetController
{
    private Trajet $trajet;
    private Agence $agence;

    public function __construct()
    {
        global $pdo;
        $this->trajet = new Trajet($pdo);
        $this->agence = new Agence($pdo);
    }

    /**
     * Vérifie que l'utilisateur est connecté
     * Redirige vers le login sinon
     */
    private function requireAuth(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /klaxon/login');
            exit;
        }
    }

    /**
     * Affiche le formulaire de création d'un trajet
     */
    public function create(): void
    {
        $this->requireAuth();
        $agences = $this->agence->findAll();
        require_once __DIR__ . '/../Views/trajets/create.php';
    }

    /**
     * Traite la soumission du formulaire de création
     */
    public function store(): void
    {
        $this->requireAuth();

        $agences = $this->agence->findAll();
        $errors  = [];

        $id_agence_depart  = (int)($_POST['id_agence_depart'] ?? 0);
        $id_agence_arrivee = (int)($_POST['id_agence_arrivee'] ?? 0);
        $gdh_depart        = trim($_POST['gdh_depart'] ?? '');
        $gdh_arrivee       = trim($_POST['gdh_arrivee'] ?? '');
        $nb_places_total   = (int)($_POST['nb_places_total'] ?? 0);

        // Validations
        if ($id_agence_depart === 0) {
            $errors[] = "L'agence de départ est obligatoire.";
        }
        if ($id_agence_arrivee === 0) {
            $errors[] = "L'agence d'arrivée est obligatoire.";
        }
        if ($id_agence_depart === $id_agence_arrivee && $id_agence_depart !== 0) {
            $errors[] = "L'agence de départ et l'agence d'arrivée doivent être différentes.";
        }
        if (empty($gdh_depart)) {
            $errors[] = "La date de départ est obligatoire.";
        }
        if (empty($gdh_arrivee)) {
            $errors[] = "La date d'arrivée est obligatoire.";
        }
        if (!empty($gdh_depart) && !empty($gdh_arrivee) && $gdh_arrivee <= $gdh_depart) {
            $errors[] = "La date d'arrivée doit être postérieure à la date de départ.";
        }
        if ($nb_places_total < 1) {
            $errors[] = "Le nombre de places doit être au moins 1.";
        }

        if (!empty($errors)) {
            require_once __DIR__ . '/../Views/trajets/create.php';
            return;
        }

        $this->trajet->create([
            'gdh_depart'        => $gdh_depart,
            'gdh_arrivee'       => $gdh_arrivee,
            'nb_places_total'   => $nb_places_total,
            'id_employe'        => $_SESSION['user']['id'],
            'id_agence_depart'  => $id_agence_depart,
            'id_agence_arrivee' => $id_agence_arrivee,
        ]);

        $_SESSION['flash'] = 'Le trajet a été créé avec succès.';
        header('Location: /klaxon');
        exit;
    }

    /**
     * Affiche le formulaire de modification d'un trajet
     *
     * @param int $id
     */
    public function edit(int $id): void
    {
        $this->requireAuth();

        $trajet  = $this->trajet->findById($id);
        $agences = $this->agence->findAll();

        if (!$trajet) {
            header('Location: /klaxon');
            exit;
        }

        // Seul l'auteur ou l'admin peut modifier
        if ($trajet['id_employe'] !== $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin') {
            header('Location: /klaxon');
            exit;
        }

        require_once __DIR__ . '/../Views/trajets/edit.php';
    }

    /**
     * Traite la soumission du formulaire de modification
     *
     * @param int $id
     */
    public function update(int $id): void
    {
        $this->requireAuth();

        $trajet  = $this->trajet->findById($id);
        $agences = $this->agence->findAll();

        if (!$trajet || ($trajet['id_employe'] !== $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin')) {
            header('Location: /klaxon');
            exit;
        }

        $errors = [];

        $id_agence_depart     = (int)($_POST['id_agence_depart'] ?? 0);
        $id_agence_arrivee    = (int)($_POST['id_agence_arrivee'] ?? 0);
        $gdh_depart           = trim($_POST['gdh_depart'] ?? '');
        $gdh_arrivee          = trim($_POST['gdh_arrivee'] ?? '');
        $nb_places_total      = (int)($_POST['nb_places_total'] ?? 0);
        $nb_places_disponibles = (int)($_POST['nb_places_disponibles'] ?? 0);

        // Validations
        if ($id_agence_depart === $id_agence_arrivee && $id_agence_depart !== 0) {
            $errors[] = "L'agence de départ et l'agence d'arrivée doivent être différentes.";
        }
        if (!empty($gdh_depart) && !empty($gdh_arrivee) && $gdh_arrivee <= $gdh_depart) {
            $errors[] = "La date d'arrivée doit être postérieure à la date de départ.";
        }
        if ($nb_places_total < 1) {
            $errors[] = "Le nombre de places doit être au moins 1.";
        }
        if ($nb_places_disponibles < 0 || $nb_places_disponibles > $nb_places_total) {
            $errors[] = "Le nombre de places disponibles est invalide.";
        }

        if (!empty($errors)) {
            require_once __DIR__ . '/../Views/trajets/edit.php';
            return;
        }

        $this->trajet->update($id, [
            'gdh_depart'              => $gdh_depart,
            'gdh_arrivee'             => $gdh_arrivee,
            'nb_places_total'         => $nb_places_total,
            'nb_places_disponibles'   => $nb_places_disponibles,
            'id_agence_depart'        => $id_agence_depart,
            'id_agence_arrivee'       => $id_agence_arrivee,
        ]);

        $_SESSION['flash'] = 'Le trajet a été modifié.';
        header('Location: /klaxon');
        exit;
    }

    /**
     * Supprime un trajet
     *
     * @param int $id
     */
    public function destroy(int $id): void
    {
        $this->requireAuth();

        $trajet = $this->trajet->findById($id);

        if (!$trajet) {
            header('Location: /klaxon');
            exit;
        }

        // Seul l'auteur ou l'admin peut supprimer
        if ($trajet['id_employe'] !== $_SESSION['user']['id'] && $_SESSION['user']['role'] !== 'admin') {
            header('Location: /klaxon');
            exit;
        }

        $this->trajet->delete($id);

        $_SESSION['flash'] = 'Le trajet a été supprimé.';
        header('Location: /klaxon');
        exit;
    }
}