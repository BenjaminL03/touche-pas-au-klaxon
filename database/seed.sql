-- ============================================================
-- Touche Pas au Klaxon — Jeu d'essai (seed)
-- À exécuter APRÈS schema.sql
-- Mot de passe de tous les comptes : Password1!
-- Hash bcrypt généré avec password_hash('Password1!', PASSWORD_BCRYPT)
-- Hash : $2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa
-- ============================================================

USE klaxon;

-- ------------------------------------------------------------
-- Agences (données fournies en annexe)
-- ------------------------------------------------------------
INSERT INTO agences (nom) VALUES
    ('Paris'),
    ('Lyon'),
    ('Marseille'),
    ('Toulouse'),
    ('Nice'),
    ('Nantes'),
    ('Strasbourg'),
    ('Montpellier'),
    ('Bordeaux'),
    ('Lille'),
    ('Rennes'),
    ('Reims');

-- ------------------------------------------------------------
-- Employés (données fournies en annexe)
-- Le premier compte (Alexandre Martin) est administrateur
-- Tous les autres sont des employés standard
-- Mot de passe commun : Password1!
-- ------------------------------------------------------------
INSERT INTO employes (nom, prenom, email, telephone, mot_de_passe, role) VALUES
    ('Martin',    'Alexandre', 'alexandre.martin@email.fr',  '0612345678', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'admin'),
    ('Dubois',    'Sophie',    'sophie.dubois@email.fr',     '0698765432', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Bernard',   'Julien',    'julien.bernard@email.fr',    '0622446688', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Moreau',    'Camille',   'camille.moreau@email.fr',    '0611223344', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Lefèvre',   'Lucie',     'lucie.lefevre@email.fr',     '0777889900', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Leroy',     'Thomas',    'thomas.leroy@email.fr',      '0655443322', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Roux',      'Chloé',     'chloe.roux@email.fr',        '0633221199', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Petit',     'Maxime',    'maxime.petit@email.fr',      '0766778899', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Garnier',   'Laura',     'laura.garnier@email.fr',     '0688776655', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Dupuis',    'Antoine',   'antoine.dupuis@email.fr',    '0744556677', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Lefebvre',  'Emma',      'emma.lefebvre@email.fr',     '0699887766', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Fontaine',  'Louis',     'louis.fontaine@email.fr',    '0655667788', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Chevalier', 'Clara',     'clara.chevalier@email.fr',   '0788990011', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Robin',     'Nicolas',   'nicolas.robin@email.fr',     '0644332211', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Gauthier',  'Marine',    'marine.gauthier@email.fr',   '0677889922', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Fournier',  'Pierre',    'pierre.fournier@email.fr',   '0722334455', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Girard',    'Sarah',     'sarah.girard@email.fr',      '0688665544', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Lambert',   'Hugo',      'hugo.lambert@email.fr',      '0611223366', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Masson',    'Julie',     'julie.masson@email.fr',      '0733445566', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe'),
    ('Henry',     'Arthur',    'arthur.henry@email.fr',      '0666554433', '$2y$10$N6WG.LLuYOoGlq7AntPv5.KlHgs27/hMaIj9TZ9yRoWanm6otkFYa', 'employe');

-- ------------------------------------------------------------
-- Trajets — jeu d'essai varié :
--   - trajets futurs avec places disponibles  → visibles page accueil
--   - trajets futurs complets (0 place dispo) → masqués page accueil
--   - trajets passés                          → masqués page accueil
-- id_employe : 1=Martin(admin), 2=Dubois, 3=Bernard, etc.
-- id_agence  : 1=Paris, 2=Lyon, 3=Marseille, 4=Toulouse,
--              5=Nice, 6=Nantes, 7=Strasbourg, 8=Montpellier,
--              9=Bordeaux, 10=Lille, 11=Rennes, 12=Reims
-- ------------------------------------------------------------
INSERT INTO trajets
    (gdh_depart, gdh_arrivee, nb_places_total, nb_places_disponibles, id_employe, id_agence_depart, id_agence_arrivee)
VALUES
    -- Trajets futurs avec places disponibles (visibles)
    ('2026-03-10 07:30:00', '2026-03-10 11:00:00', 4, 3, 2,  1, 2),   -- Paris → Lyon       (Dubois)
    ('2026-03-10 08:00:00', '2026-03-10 14:00:00', 3, 2, 3,  2, 3),   -- Lyon → Marseille   (Bernard)
    ('2026-03-11 06:45:00', '2026-03-11 10:30:00', 5, 4, 4,  1, 10),  -- Paris → Lille      (Moreau)
    ('2026-03-12 09:00:00', '2026-03-12 15:00:00', 4, 1, 5,  9, 4),   -- Bordeaux → Toulouse(Lefèvre)
    ('2026-03-13 07:00:00', '2026-03-13 12:00:00', 3, 2, 6,  7, 12),  -- Strasbourg → Reims (Leroy)
    ('2026-03-14 08:30:00', '2026-03-14 13:30:00', 4, 3, 7,  6, 1),   -- Nantes → Paris     (Roux)
    ('2026-03-15 10:00:00', '2026-03-15 14:00:00', 5, 5, 8,  2, 7),   -- Lyon → Strasbourg  (Petit)
    ('2026-03-17 07:15:00', '2026-03-17 11:45:00', 3, 1, 9,  3, 8),   -- Marseille → Montpellier (Garnier)
    ('2026-03-18 08:00:00', '2026-03-18 12:30:00', 4, 2, 10, 4, 5),   -- Toulouse → Nice    (Dupuis)
    ('2026-03-20 09:30:00', '2026-03-20 13:00:00', 3, 3, 11, 10, 12), -- Lille → Reims      (Lefebvre)

    -- Trajets futurs COMPLETS (places dispo = 0) → masqués page accueil
    ('2026-03-11 09:00:00', '2026-03-11 13:30:00', 3, 0, 12, 1, 9),   -- Paris → Bordeaux   (Fontaine)
    ('2026-03-16 07:00:00', '2026-03-16 11:00:00', 4, 0, 13, 5, 3),   -- Nice → Marseille   (Chevalier)

    -- Trajets PASSÉS → masqués page accueil
    ('2026-02-20 08:00:00', '2026-02-20 12:00:00', 4, 2, 14, 2, 1),   -- Lyon → Paris       (Robin)
    ('2026-02-25 07:30:00', '2026-02-25 11:30:00', 3, 1, 15, 1, 11),  -- Paris → Rennes     (Gauthier)
    ('2026-03-01 09:00:00', '2026-03-01 14:00:00', 5, 3, 16, 8, 4);   -- Montpellier → Toulouse (Fournier)