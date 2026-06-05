<?php

require_once __DIR__ . '/../Repository/AppointmentRepository.php';
require_once __DIR__ . '/../Repository/DoctorRepository.php';
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
}