<?php

require_once __DIR__ . '/../Repository/AppointmentRepository.php';
require_once __DIR__ . '/../Repository/DoctorRepository.php';
require_once __DIR__ . '/../Repository/SpecialiteRepository.php';
require_once __DIR__ . '/../../config/database.php';

class PatientController
{
    private AppointmentRepository $appointmentRepo;
    private DoctorRepository $doctorRepo;
    private SpecialiteRepository $specialiteRepo;

    public function __construct()
    {
        $this->appointmentRepo = new AppointmentRepository();
        $this->doctorRepo = new DoctorRepository();
        $this->specialiteRepo = new SpecialiteRepository();
    }

    public function dashboard($patientId)
    {
        $appointments = $this->appointmentRepo->getByPatient($patientId) ?? [];
        $specialites = $this->specialiteRepo->getAll() ?? [];

        require __DIR__ . '/../../templates/patient/dashboard.php';
    }

    public function search()
    {
        $name = $_GET['name'] ?? '';
        $specialty = $_GET['specialty'] ?? '';

        $doctors = $this->doctorRepo->searchDoctors($name, $specialty) ?? [];

        require __DIR__ . '/../../templates/patient/search.php';
    }

    public function creneaux()
    {
        $medecinId = $_GET['medecin_id'] ?? null;
        
        if (!$medecinId) {
            header("Location: index.php?action=dashboard");
            exit;
        }

        global $conn;
        $pdo = $conn;
        $stmt = $pdo->prepare("SELECT id, dateHeureDebut, dateHeureFin FROM Creneau WHERE medecin_id = ? AND disponible = 1");
        $stmt->execute([$medecinId]);
        $creneaux = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        require __DIR__ . '/../../templates/patient/creneaux.php';
    }

    public function book()
    {
        $patientId = 1; 
        $creneauId = $_GET['creneau_id'] ?? null;

        if ($creneauId) {
            $this->appointmentRepo->create($patientId, $creneauId, 'Consultation');
        }

        header("Location: index.php?action=dashboard");
        exit;
    }
    public function ordonnance()
    {
        $rdvId = $_GET['id'] ?? null;
        $ord = null;

        if ($rdvId) {
            global $conn;
            $pdo = $conn;
            $stmt = $pdo->prepare("SELECT contenuTexte FROM Ordonnance WHERE rendezvous_id = ?");
            $stmt->execute([$rdvId]);
            $ord = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // L-fichier f templates smito ordonnence.php b 'e' kima f l-projet dialek
        require __DIR__ . '/../../templates/patient/ordonnence.php';
    }
}