DROP DATABASE IF EXISTS stress_manager;
CREATE DATABASE stress_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE stress_manager;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    derniere_connexion DATETIME DEFAULT NULL,
    actif TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE emotions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    humeur ENUM('tres_heureux', 'heureux', 'neutre', 'stresse', 'tres_stresse') NOT NULL,
    commentaire TEXT DEFAULT NULL,
    niveau_stress TINYINT DEFAULT NULL,
    date_enregistrement DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_emotions_utilisateur
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE exercices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    instructions TEXT NOT NULL,
    duree_secondes INT NOT NULL,
    type ENUM('respiration', 'relaxation', 'etirement') NOT NULL DEFAULT 'respiration',
    difficulte ENUM('debutant', 'intermediaire', 'avance') NOT NULL DEFAULT 'debutant',
    parametres JSON DEFAULT NULL,
    icone VARCHAR(50) DEFAULT 'wind',
    couleur VARCHAR(7) DEFAULT '#4A90A4',
    actif TINYINT(1) NOT NULL DEFAULT 1,
    ordre_affichage INT NOT NULL DEFAULT 0,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE historique_exercices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    exercice_id INT NOT NULL,
    duree_reelle_secondes INT DEFAULT NULL,
    complete TINYINT(1) NOT NULL DEFAULT 1,
    note TINYINT DEFAULT NULL,
    ressenti TEXT DEFAULT NULL,
    date_realisation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_historique_exercices_utilisateur
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_historique_exercices_exercice
        FOREIGN KEY (exercice_id) REFERENCES exercices(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE meditations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    contenu_guide TEXT NOT NULL,
    duree_minutes INT NOT NULL,
    type ENUM('guidee', 'silence', 'musique', 'visualisation') NOT NULL DEFAULT 'guidee',
    niveau ENUM('debutant', 'intermediaire', 'avance') NOT NULL DEFAULT 'debutant',
    theme VARCHAR(100) DEFAULT NULL,
    actif TINYINT(1) NOT NULL DEFAULT 1,
    ordre_affichage INT NOT NULL DEFAULT 0,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE historique_meditations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    meditation_id INT NOT NULL,
    duree_reelle_minutes INT DEFAULT NULL,
    complete TINYINT(1) NOT NULL DEFAULT 1,
    note TINYINT DEFAULT NULL,
    ressenti TEXT DEFAULT NULL,
    date_realisation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_historique_meditations_utilisateur
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_historique_meditations_meditation
        FOREIGN KEY (meditation_id) REFERENCES meditations(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE conseils (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    contenu TEXT NOT NULL,
    resume VARCHAR(500) DEFAULT NULL,
    categorie ENUM('temps', 'sommeil', 'alimentation', 'physique', 'relaxation', 'mental') NOT NULL,
    icone VARCHAR(50) DEFAULT 'lightbulb',
    actif TINYINT(1) NOT NULL DEFAULT 1,
    ordre_affichage INT NOT NULL DEFAULT 0,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
