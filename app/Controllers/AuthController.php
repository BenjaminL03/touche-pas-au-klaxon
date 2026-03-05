<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Controllers;

use Benjamin\Klaxon\Models\Employe;

/**
 * Contrôleur d'authentification
 * Gère la connexion et la déconnexion
 */
class AuthController
{
    private Employe $employe;

    public function __construct()
    {
        global $pdo;
        $this->employe = new Employe($pdo);
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function showLogin(): void
    {
        // Redirige si déjà connecté
        if (isset($_SESSION['user'])) {
            header('Location: /klaxon');
            exit;
        }
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    /**
     * Traite le formulaire de connexion
     */
    public function login(): void
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validation basique
        if (empty($email) || empty($password)) {
            $error = 'Veuillez remplir tous les champs.';
            require_once __DIR__ . '/../Views/auth/login.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Adresse email invalide.';
            require_once __DIR__ . '/../Views/auth/login.php';
            return;
        }

        // Vérification en base
        $user = $this->employe->findByEmail($email);

        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $error = 'Email ou mot de passe incorrect.';
            require_once __DIR__ . '/../Views/auth/login.php';
            return;
        }

        // Stockage en session
        $_SESSION['user'] = [
            'id'     => $user['id_employe'],
            'nom'    => $user['nom'],
            'prenom' => $user['prenom'],
            'email'  => $user['email'],
            'telephone' => $user['telephone'],
            'role'   => $user['role'],
        ];

        // Redirection selon le rôle
        if ($user['role'] === 'admin') {
            header('Location: /klaxon/admin');
        } else {
            header('Location: /klaxon');
        }
        exit;
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /klaxon');
        exit;
    }
}