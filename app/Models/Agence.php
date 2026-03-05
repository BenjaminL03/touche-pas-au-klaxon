<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Models;

/**
 * Modèle Agence
 * Gère les accès à la table agences
 */
class Agence
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retourne toutes les agences triées par nom
     *
     * @return array
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT * FROM agences ORDER BY nom'
        );
        return $stmt->fetchAll();
    }

    /**
     * Trouve une agence par son id
     *
     * @param int $id
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM agences WHERE id_agence = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Crée une nouvelle agence
     *
     * @param string $nom
     * @return bool
     */
    public function create(string $nom): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO agences (nom) VALUES (:nom)'
        );
        return $stmt->execute([':nom' => $nom]);
    }

    /**
     * Met à jour une agence
     *
     * @param int $id
     * @param string $nom
     * @return bool
     */
    public function update(int $id, string $nom): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE agences SET nom = :nom WHERE id_agence = :id'
        );
        return $stmt->execute([':nom' => $nom, ':id' => $id]);
    }

    /**
     * Supprime une agence
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM agences WHERE id_agence = :id'
        );
        return $stmt->execute([':id' => $id]);
    }
}