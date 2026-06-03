<?php

require_once __DIR__ . '/../Repository/DoctorRepository.php';

class PatientController
{
    private $doctorRepo;

    public function __construct()
    {
        $this->doctorRepo = new DoctorRepository();
    }

    public function getDoctors()
    {
        return $this->doctorRepo->getAllDoctors();
    }
}