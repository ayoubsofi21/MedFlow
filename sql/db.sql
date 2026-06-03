-- Active: 1778664580360@@127.0.0.1@3306@gestion_rendezvous_medical
-- Create Database
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
    libelle VARCHAR(100) NOT NULL UNIQUE
);

-- =========================
-- PATIENT
-- =========================
CREATE TABLE Patient (
    user_id INT PRIMARY KEY,
    dateNaissance DATE NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(id)
        ON DELETE CASCADE
);

-- =========================
-- MEDECIN
-- =========================
CREATE TABLE Medecin (
    user_id INT PRIMARY KEY,
    numeroRPPS VARCHAR(50) NOT NULL UNIQUE,
    actif BOOLEAN DEFAULT TRUE,
    specialite_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(id)
        ON DELETE CASCADE,
    FOREIGN KEY (specialite_id) REFERENCES Specialite(id)
);

-- =========================
-- ADMINISTRATEUR
-- =========================
CREATE TABLE Administrateur (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES User(id)
        ON DELETE CASCADE
);

-- =========================
-- CRENEAU
-- =========================
CREATE TABLE Creneau (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateHeureDebut DATETIME NOT NULL,
    dateHeureFin DATETIME NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    medecin_id INT NOT NULL,
    FOREIGN KEY (medecin_id) REFERENCES Medecin(user_id)
);

-- =========================
-- RENDEZVOUS
-- =========================
CREATE TABLE RendezVous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_heure DATETIME NOT NULL,
    statut ENUM(
        'EN_ATTENTE',
        'CONFIRME',
        'ANNULE',
        'TERMINE'
    ) DEFAULT 'EN_ATTENTE',
    motif TEXT,
    patient_id INT NOT NULL,
    medecin_id INT NOT NULL,
    creneau_id INT UNIQUE NOT NULL,

    FOREIGN KEY (patient_id) REFERENCES Patient(user_id),
    FOREIGN KEY (medecin_id) REFERENCES Medecin(user_id),
    FOREIGN KEY (creneau_id) REFERENCES Creneau(id)
);

-- =========================
-- ORDONNANCE
-- =========================
CREATE TABLE Ordonnance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenuTexte TEXT NOT NULL,
    creeLe DATETIME DEFAULT CURRENT_TIMESTAMP,
    accesSecurise BOOLEAN DEFAULT TRUE,
    rendezvous_id INT UNIQUE NOT NULL,

    FOREIGN KEY (rendezvous_id) REFERENCES RendezVous(id)
);



INSERT INTO Specialite (libelle)
VALUES
('Cardiologie'),
('Dermatologie'),
('Pediatrie'),
('Ophtalmologie'),
('Gynecologie');
INSERT INTO Role (name) VALUES ('ADMIN');
INSERT INTO Role (name) VALUES ('DOCTOR');
INSERT INTO Role (name) VALUES ('PATIENT');
INSERT INTO Role (name) VALUES ('SECRETARY');
INSERT INTO User(email,passwordHash,nom,prenom,role_id)
VALUES
('admin@gmail.com','123456','Admin','System',1),

('medecin1@gmail.com','123456','Alaoui','Mohamed',2),
('medecin2@gmail.com','123456','Bennani','Youssef',2),

('patient1@gmail.com','123456','Karimi','Sara',3),
('patient2@gmail.com','123456','El Idrissi','Omar',3);
INSERT INTO Administrateur(user_id)
VALUES (1);
INSERT INTO Medecin(user_id,numeroRPPS,actif,specialite_id)
VALUES
(2,'RPPS10001',TRUE,1),
(3,'RPPS10002',TRUE,2);
INSERT INTO Patient(user_id,dateNaissance,telephone)
VALUES
(4,'1998-05-10','0612345678'),
(5,'2001-08-20','0677777777');
INSERT INTO Creneau(
dateHeureDebut,
dateHeureFin,
disponible,
medecin_id
)
VALUES
('2026-06-01 09:00:00',
 '2026-06-01 09:30:00',
 TRUE,
 2),

('2026-06-01 10:00:00',
 '2026-06-01 10:30:00',
 TRUE,
 2),

('2026-06-01 11:00:00',
 '2026-06-01 11:30:00',
 TRUE,
 3);
 INSERT INTO RendezVous(
date_heure,
statut,
motif,
patient_id,
medecin_id,
creneau_id
)
VALUES
(
'2026-06-01 09:00:00',
'CONFIRME',
'Consultation generale',
4,
2,
1
),
(
'2026-06-01 11:00:00',
'EN_ATTENTE',
'Controle dermatologique',
5,
3,
3
);
INSERT INTO Ordonnance(
contenuTexte,
accesSecurise,
rendezvous_id
)
VALUES
(
'Paracetamol 500mg - 3 fois par jour pendant 5 jours',
TRUE,
1
);