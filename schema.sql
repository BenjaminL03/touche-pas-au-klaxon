-- ============================================================
-- Touche Pas au Klaxon — Script de création de la BDD
-- ============================================================

CREATE DATABASE IF NOT EXISTS klaxon
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE klaxon;

-- ------------------------------------------------------------
-- Table : employes
-- ------------------------------------------------------------
CREATE TABLE employes (
    id_employe    INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(100)    NOT NULL,
    prenom        VARCHAR(100)    NOT NULL,
    email         VARCHAR(255)    NOT NULL UNIQUE,
    telephone     VARCHAR(20)     NOT NULL,
    mot_de_passe  VARCHAR(255)    NOT NULL,           -- bcrypt hash
    role          ENUM('employe', 'admin') NOT NULL DEFAULT 'employe',
    created_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table : agences
-- ------------------------------------------------------------
CREATE TABLE agences (
    id_agence     INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(100)    NOT NULL UNIQUE,
    created_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table : trajets
-- ------------------------------------------------------------
CREATE TABLE trajets (
    id_trajet              INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
    gdh_depart             DATETIME        NOT NULL,
    gdh_arrivee            DATETIME        NOT NULL,
    nb_places_total        TINYINT UNSIGNED NOT NULL,
    nb_places_disponibles  TINYINT UNSIGNED NOT NULL,
    id_employe             INT UNSIGNED    NOT NULL,
    id_agence_depart       INT UNSIGNED    NOT NULL,
    id_agence_arrivee      INT UNSIGNED    NOT NULL,
    created_at             DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at             DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_trajet_employe
        FOREIGN KEY (id_employe)
        REFERENCES employes(id_employe)
        ON DELETE CASCADE,

    CONSTRAINT fk_trajet_agence_depart
        FOREIGN KEY (id_agence_depart)
        REFERENCES agences(id_agence)
        ON DELETE RESTRICT,

    CONSTRAINT fk_trajet_agence_arrivee
        FOREIGN KEY (id_agence_arrivee)
        REFERENCES agences(id_agence)
        ON DELETE RESTRICT,

    -- On ne peut pas partir et arriver à la même agence
    CONSTRAINT chk_agences_differentes
        CHECK (id_agence_depart <> id_agence_arrivee),

    -- On ne peut pas arriver avant de partir
    CONSTRAINT chk_dates_coherentes
        CHECK (gdh_arrivee > gdh_depart),

    -- Les places dispo ne peuvent pas dépasser le total
    CONSTRAINT chk_places_coherentes
        CHECK (nb_places_disponibles <= nb_places_total)

) ENGINE=InnoDB;