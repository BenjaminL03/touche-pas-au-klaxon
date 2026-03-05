<?php

declare(strict_types=1);

namespace Benjamin\Klaxon\Models;

/**
 * Modèle Trajet
 * Gère les accès à la table trajets
 */
class Trajet
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retourne les trajets avec places disponibles et non passés
     * triés par date de départ croissante
     *
     * @return array
     */
    public function findAvailable(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT t.*, 
                    a1.nom AS agence_depart,
                    a2.nom AS agence_arrivee,
                    e.nom AS employe_nom,
                    e.prenom AS employe_prenom,
                    e.telephone AS employe_telephone,
                    e.email AS employe_email
             FROM trajets t
             JOIN agences a1 ON t.id_agence_depart = a1.id_agence
             JOIN agences a2 ON t.id_agence_arrivee = a2.id_agence
             JOIN employes e ON t.id_employe = e.id_employe
             WHERE t.nb_places_disponibles > 0
               AND t.gdh_depart > NOW()
             ORDER BY t.gdh_depart ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Retourne tous les trajets (pour l'admin)
     *
     * @return array
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT t.*,
                    a1.nom AS agence_depart,
                    a2.nom AS agence_arrivee,
                    e.nom AS employe_nom,
                    e.prenom AS employe_prenom
             FROM trajets t
             JOIN agences a1 ON t.id_agence_depart = a1.id_agence
             JOIN agences a2 ON t.id_agence_arrivee = a2.id_agence
             JOIN employes e ON t.id_employe = e.id_employe
             ORDER BY t.gdh_depart DESC'
        );
        return $stmt->fetchAll();
    }

    /**
     * Trouve un trajet par son id
     *
     * @param int $id
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            'SELECT t.*,
                    a1.nom AS agence_depart,
                    a2.nom AS agence_arrivee,
                    e.nom AS employe_nom,
                    e.prenom AS employe_prenom,
                    e.telephone AS employe_telephone,
                    e.email AS employe_email
             FROM trajets t
             JOIN agences a1 ON t.id_agence_depart = a1.id_agence
             JOIN agences a2 ON t.id_agence_arrivee = a2.id_agence
             JOIN employes e ON t.id_employe = e.id_employe
             WHERE t.id_trajet = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Crée un nouveau trajet
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO trajets 
                (gdh_depart, gdh_arrivee, nb_places_total, nb_places_disponibles, id_employe, id_agence_depart, id_agence_arrivee)
             VALUES 
                (:gdh_depart, :gdh_arrivee, :nb_places_total, :nb_places_total, :id_employe, :id_agence_depart, :id_agence_arrivee)'
        );
        return $stmt->execute([
            ':gdh_depart'       => $data['gdh_depart'],
            ':gdh_arrivee'      => $data['gdh_arrivee'],
            ':nb_places_total'  => $data['nb_places_total'],
            ':id_employe'       => $data['id_employe'],
            ':id_agence_depart' => $data['id_agence_depart'],
            ':id_agence_arrivee'=> $data['id_agence_arrivee'],
        ]);
    }

    /**
     * Met à jour un trajet
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE trajets SET
                gdh_depart          = :gdh_depart,
                gdh_arrivee         = :gdh_arrivee,
                nb_places_total     = :nb_places_total,
                nb_places_disponibles = :nb_places_disponibles,
                id_agence_depart    = :id_agence_depart,
                id_agence_arrivee   = :id_agence_arrivee
             WHERE id_trajet = :id'
        );
        return $stmt->execute([
            ':gdh_depart'             => $data['gdh_depart'],
            ':gdh_arrivee'            => $data['gdh_arrivee'],
            ':nb_places_total'        => $data['nb_places_total'],
            ':nb_places_disponibles'  => $data['nb_places_disponibles'],
            ':id_agence_depart'       => $data['id_agence_depart'],
            ':id_agence_arrivee'      => $data['id_agence_arrivee'],
            ':id'                     => $id,
        ]);
    }

    /**
     * Supprime un trajet
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM trajets WHERE id_trajet = :id'
        );
        return $stmt->execute([':id' => $id]);
    }
}