<?php

require_once __DIR__ . '/../Repository/RendezVousRepository.php';
require_once __DIR__ . '/../Enum/StatutRendezVous.php';

class MedecinController {

    private RendezVousRepository $repo;

    public function __construct() {
        $this->repo = new RendezVousRepository();
    }

    public function getDashboardAppointments(): array {
        return $this->repo->findByMedecin($_SESSION['user_id'] ?? 1);
    }

    public function handleActions(array &$appointments): void {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        foreach ($appointments as $app) {

            // ✔ VALIDATE
            if (isset($_POST['validate_id']) && $_POST['validate_id'] == $app->id) {
                if ($app->statut === StatutRendezVous::EN_ATTENTE) {
                    $app->statut = StatutRendezVous::CONFIRME;
                }
            }

            // ❌ CANCEL
            if (isset($_POST['cancel_id']) && $_POST['cancel_id'] == $app->id) {
                if ($app->statut === StatutRendezVous::EN_ATTENTE) {
                    $app->statut = StatutRendezVous::ANNULE;
                }
            }

            // ✔ FINISH + PRESCRIPTION (US2.3)
            if (isset($_POST['finish_id']) && $_POST['finish_id'] == $app->id) {
                if ($app->statut === StatutRendezVous::CONFIRME) {
                    $app->statut = StatutRendezVous::TERMINE;
                    $app->prescription = $_POST['prescription'] ?? '';
                }
            }
        }
    }
}