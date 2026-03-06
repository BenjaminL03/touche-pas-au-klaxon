<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Benjamin\Klaxon\Models\Agence;

/**
 * Tests unitaires du modèle Agence
 * Couvre les opérations d'écriture en base de données (create, update, delete)
 */
class AgenceTest extends TestCase
{
    private PDO $pdo;
    private Agence $agence;

    /**
     * Initialisation avant chaque test
     * Utilise une base SQLite en mémoire pour isoler les tests
     */
    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->pdo->exec("
            CREATE TABLE agences (
                id_agence INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT NOT NULL UNIQUE
            )
        ");

        $this->agence = new Agence($this->pdo);
    }

    /**
     * Test de création d'une agence
     */
    public function testCreate(): void
    {
        $result = $this->agence->create('Paris');
        $this->assertTrue($result);
    }

    /**
     * Test que l'agence créée est bien retrouvable
     */
    public function testCreateAndFind(): void
    {
        $this->agence->create('Lyon');
        $agences = $this->agence->findAll();
        $this->assertCount(1, $agences);
        $this->assertEquals('Lyon', $agences[0]['nom']);
    }

    /**
     * Test de mise à jour d'une agence
     */
    public function testUpdate(): void
    {
        $this->agence->create('Marseille');
        $agences = $this->agence->findAll();
        $id = (int)$agences[0]['id_agence'];

        $result = $this->agence->update($id, 'Bordeaux');
        $this->assertTrue($result);

        $agence = $this->agence->findById($id);
        $this->assertEquals('Bordeaux', $agence['nom']);
    }

    /**
     * Test de suppression d'une agence
     */
    public function testDelete(): void
    {
        $this->agence->create('Toulouse');
        $agences = $this->agence->findAll();
        $id = (int)$agences[0]['id_agence'];

        $result = $this->agence->delete($id);
        $this->assertTrue($result);

        $agence = $this->agence->findById($id);
        $this->assertFalse($agence);
    }

    /**
     * Test que findById retourne false pour un id inexistant
     */
    public function testFindByIdReturnsFalseWhenNotFound(): void
    {
        $result = $this->agence->findById(999);
        $this->assertFalse($result);
    }
}