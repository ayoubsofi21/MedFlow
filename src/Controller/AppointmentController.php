<?php

class AppointmentController {

    private $appointmentRepository;

    public function __construct($repo) {
        $this->appointmentRepository = $repo;
    }

    // 📌 BOOK RDV
    public function book($patientId, $creneauId) {

        return $this->appointmentRepository->create($patientId, $creneauId);
    }

    // ❌ CANCEL RDV
    public function cancel($id) {

        return $this->appointmentRepository->updateStatus($id, 'ANNULE');
    }

    // ✅ CONFIRM RDV
    public function confirm($id) {

        return $this->appointmentRepository->updateStatus($id, 'CONFIRME');
    }
}