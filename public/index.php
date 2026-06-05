<?php

require_once __DIR__ . '/../src/Controller/PatientController.php';

$controller = new PatientController();

$action = $_GET['action'] ?? 'dashboard';

switch ($action) {

    case 'search':
        $controller->search();
        break;

    case 'creneaux':
        $controller->creneaux();
        break;

    case 'book':
        $controller->book();
        break;

    case 'ordonnance':
        $controller->ordonnance(); // <--- Hna fin kan l-mouchkil (zdna l-'a')
        break;

    default:
        $controller->dashboard(1);
        break;
}