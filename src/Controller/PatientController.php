<?php

require_once __DIR__ . '/../Repository/DoctorRepository.php';

class PatientController
{
    private $doctorRepo;

    public function __construct()
    {
        $this->doctorRepo = new DoctorRepository();
    }

    public function searchDoctors()
    {
        $name = $_GET['doctor_name'] ?? '';
        $speciality = $_GET['speciality'] ?? '';

        return $this->doctorRepo->searchDoctors($name, $speciality);
    }
}