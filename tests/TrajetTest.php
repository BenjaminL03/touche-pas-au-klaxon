<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Benjamin\Klaxon\Models\Trajet;

/**
 * Tests unitaires du modèle Trajet
 * Couvre les opérations d'écriture en base de données (create, update, delete)
 */
class TrajetTest extends TestCase
{
    private PDO $pdo;
    private Trajet $trajet;

    /**
     * Initialisation avant chaque test
     * Utilise une base SQLite en mémoire pour isoler les tests
     */
    protected function setUp(): void
    {
        // Base SQLite en mémoire pour les tests
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Création des tables nécessaires
        $this->pdo->exec("
            CREATE TABLE employes (
                id_employe INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT NOT NULL,
                prenom TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                telephone TEXT NOT NULL,
                mot_de_passe TEXT NOT NULL,
                role TEXT NOT NULL DEFAULT 'employe'
            )
        ");

        $this->pdo->exec("
            CREATE TABLE agences (
                id_agence INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT NOT NULL UNIQUE
            )
        ");

        $this->pdo->exec("
            CREATE TABLE trajets (
                id_trajet INTEGER PRIMARY KEY AUTOINCREMENT,
                gdh_depart DATETIME NOT NULL,
                gdh_arrivee DATETIME NOT NULL,
                nb_places_total INTEGER NOT NULL,
                nb_places_disponibles INTEGER NOT NULL,
                id_employe INTEGER NOT NULL,
                id_agence_depart INTEGER NOT NULL,
                id_agence_arrivee INTEGER NOT NULL
            )
        ");

        // Données de test
        $this->pdo->exec("
            INSERT INTO employes (nom, prenom, email, telephone, mot_de_passe, role)
            VALUES ('Test', 'User', 'test@test.fr', '0600000000', 'hash', 'employe')
        ");

        $this->pdo->exec("
            INSERT INTO agences (nom) VALUES ('Paris'), ('Lyon')
        ");

        $this->trajet = new Trajet($this->pdo);
    }

    /**
     * Test de création d'un trajet
     */
    public function testCreate(): void
    {
        $data = [
            'gdh_depart'        => '2026-06-01 08:00:00',
            'gdh_arrivee'       => '2026-06-01 12:00:00',
            'nb_places_total'   => 4,
            'id_employe'        => 1,
            'id_agence_depart'  => 1,
            'id_agence_arrivee' => 2,
        ];

        $result = $this->trajet->create($data);

        $this->assertTrue($result);
    }

    /**
     * Test de mise à jour d'un trajet
     */
    public function testUpdate(): void
    {
        // Créer un trajet d'abord
        $this->pdo->exec("
            INSERT INTO trajets (gdh_depart, gdh_arrivee, nb_places_total, nb_places_disponibles, id_employe, id_agence_depart, id_agence_arrivee)
            VALUES ('2026-06-01 08:00:00', '2026-06-01 12:00:00', 4, 4, 1, 1, 2)
        ");

        $data = [
            'gdh_depart'              => '2026-06-01 09:00:00',
            'gdh_arrivee'             => '2026-06-01 13:00:00',
            'nb_places_total'         => 3,
            'nb_places_disponibles'   => 2,
            'id_agence_depart'        => 1,
            'id_agence_arrivee'       => 2,
        ];

        $result = $this->trajet->update(1, $data);

        $this->assertTrue($result);
    }

    /**
     * Test de suppression d'un trajet
     */
    public function testDelete(): void
    {
        // Créer un trajet d'abord
        $this->pdo->exec("
            INSERT INTO trajets (gdh_depart, gdh_arrivee, nb_places_total, nb_places_disponibles, id_employe, id_agence_depart, id_agence_arrivee)
            VALUES ('2026-06-01 08:00:00', '2026-06-01 12:00:00', 4, 4, 1, 1, 2)
        ");

        $result = $this->trajet->delete(1);

        $this->assertTrue($result);
    }

    /**
     * Test que findById retourne false pour un id inexistant
     */
    public function testFindByIdReturnsfalseWhenNotFound(): void
    {
        $result = $this->trajet->findById(999);
        $this->assertFalse($result);
    }
}