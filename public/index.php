
<?php
require_once __DIR__ . '/../src/Middleware/AuthMiddleware.php';

AuthMiddleware::checkLogin(); // user must be logged in
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
        $controller->ordonnance();
        break;
    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
        break;
    default:
        $controller->dashboard(1);
        break;
}