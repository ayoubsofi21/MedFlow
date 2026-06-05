-- Active: 1777286959087@@127.0.0.1@3306@medflow
-- Create Database
DROP DATABASE gestion_rendezvous_medical;
CREATE DATABASE gestion_rendezvous_medical;
USE gestion_rendezvous_medical;

-- =========================
-- ROLE
-- =========================
CREATE TABLE Role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- =========================
-- USER
-- =========================
CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    passwordHash VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES Role(id)
);

-- =========================
-- SPECIALITE
-- =========================
CREATE TABLE Specialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL
);

-- =========================
-- MEDECIN
-- =========================
CREATE TABLE Medecin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    specialite_id INT NOT NULL,
    numeroRPPS VARCHAR(50) NOT NULL UNIQUE,
    actif BOOLEAN DEFAULT TRUE,

    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (specialite_id) REFERENCES Specialite(id)
);

-- =========================
-- PATIENT
-- =========================
CREATE TABLE Patient (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    dateNaissance DATE NOT NULL,
    telephone VARCHAR(20),

    FOREIGN KEY (user_id) REFERENCES User(id)
);

-- =========================
-- CRENEAU
-- =========================
CREATE TABLE Creneau (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medecin_id INT NOT NULL,
    dateHeureDebut DATETIME NOT NULL,
    dateHeureFin DATETIME NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,

    FOREIGN KEY (medecin_id) REFERENCES Medecin(id)
);

-- =========================
-- RENDEZ-VOUS
-- =========================
CREATE TABLE RendezVous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    creneau_id INT NOT NULL UNIQUE,

    date_heure DATETIME NOT NULL,
    statut ENUM(
        'EN_ATTENTE',
        'CONFIRME',
        'ANNULE',
        'TERMINE'
    ) DEFAULT 'EN_ATTENTE',

    motif TEXT,

    FOREIGN KEY (patient_id) REFERENCES Patient(id),
    FOREIGN KEY (creneau_id) REFERENCES Creneau(id)
);

-- =========================
-- ORDONNANCE
-- =========================
CREATE TABLE Ordonnance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rendezvous_id INT UNIQUE,

    contenuTexte TEXT NOT NULL,
    creeLe DATETIME DEFAULT CURRENT_TIMESTAMP,
    accesSecurise BOOLEAN DEFAULT TRUE,

    FOREIGN KEY (rendezvous_id)
        REFERENCES RendezVous(id)
        ON DELETE CASCADE
);
-- =========================
-- INSERT DATA - ROLE
-- =========================
INSERT INTO Role (name) VALUES 
('ADMIN'),
('MEDECIN'),
('PATIENT');

-- =========================
-- INSERT DATA - USER
-- =========================
INSERT INTO User (email, passwordHash, nom, prenom, role_id) VALUES
('admin@medflow.com', 'hash_admin_123', 'Benali', 'Youssef', 1),
('dr.sofi@medflow.com', 'hash_doc_456', 'Sofi', 'Ayoub', 2),
('dr.elalami@medflow.com', 'hash_doc_789', 'El Alami', 'Sara', 2),
('patient1@gmail.com', 'hash_pat_111', 'Amrani', 'Omar', 3),
('patient2@gmail.com', 'hash_pat_222', 'Zahir', 'Salma', 3);

-- =========================
-- INSERT DATA - SPECIALITE
-- =========================
INSERT INTO Specialite (libelle) VALUES
('Cardiologie'),
('Dermatologie'),
('Pédiatrie'),
('Médecine Générale');

-- =========================
-- INSERT DATA - MEDECIN
-- =========================
INSERT INTO Medecin (user_id, specialite_id, numeroRPPS, actif) VALUES
(2, 1, 'RPPS-10001', TRUE),
(3, 2, 'RPPS-10002', TRUE);

-- =========================
-- INSERT DATA - PATIENT
-- =========================
INSERT INTO Patient (user_id, dateNaissance, telephone) VALUES
(4, '1998-05-12', '0612345678'),
(5, '2001-09-22', '0678912345');

-- =========================
-- INSERT DATA - CRENEAU
-- =========================
INSERT INTO Creneau (medecin_id, dateHeureDebut, dateHeureFin, disponible) VALUES
(1, '2026-06-04 09:00:00', '2026-06-04 09:30:00', FALSE),
(1, '2026-06-04 09:30:00', '2026-06-04 10:00:00', TRUE),
(2, '2026-06-04 10:00:00', '2026-06-04 10:30:00', TRUE);

-- =========================
-- INSERT DATA - RENDEZVOUS
-- =========================
INSERT INTO RendezVous (patient_id, creneau_id, date_heure, statut, motif) VALUES
(1, 1, '2026-06-04 09:00:00', 'CONFIRME', 'Consultation cardiaque'),
(2, 3, '2026-06-04 10:00:00', 'EN_ATTENTE', 'Douleurs dermatologiques');

-- =========================
-- INSERT DATA - ORDONNANCE
-- =========================
INSERT INTO Ordonnance (rendezvous_id, contenuTexte, accesSecurise) VALUES
(1, 'Paracétamol 1g - 3 fois par jour pendant 5 jours', TRUE);