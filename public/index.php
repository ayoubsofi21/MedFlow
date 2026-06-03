<?php
// public/index.php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php'; // Si Composer est utilisé, sinon charger manuellement

// Chargement des variables d'environnement (.env fictif ou package Dotenv)
$_ENV['DB_HOST'] = '127.0.0.1';
$_ENV['DB_NAME'] = 'medflow';
$_ENV['DB_USER'] = 'root';
$_ENV['DB_PASSWORD'] = '';

// Logique simple de routage (Front Controller)
$route = $_GET['route'] ?? 'patient-dashboard';

session_start();

switch ($route) {
    case 'patient-dashboard':
        $_SESSION['user_role'] = 'ROLE_PATIENT';
        $controller = new \App\Controller\PatientController();
        $controller->index();
        break;

    case 'doctor-agenda':
        $_SESSION['user_role'] = 'ROLE_DOCTOR';
        // Appeler le DoctorController...
        break;

    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}