<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Models;

/**
 * Modèle Employe
 * Gère les accès à la table employes
 */
class Employe
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Trouve un employé par son email
     *
     * @param string $email
     * @return array|false
     */
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM employes WHERE email = :email LIMIT 1'
        );
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Retourne tous les employés
     *
     * @return array
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT id_employe, nom, prenom, email, telephone, role FROM employes ORDER BY nom, prenom'
        );
        return $stmt->fetchAll();
    }
}