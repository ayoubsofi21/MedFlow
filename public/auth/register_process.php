<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/../../config/database.php";   // MUST define $conn FIRST
require __DIR__ . "/../../src/Repository/UserRepository.php";

session_start();

$userRepository = new UserRepository($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        die("Passwords do not match");
    }

    $exists = $userRepository->findByEmail($email);

    if ($exists) {
         header("Location: /MedFlow/templates/auth/register.php");
            exit();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $userRepository->createPatient([
        'email' => $email,
        'passwordHash' => $hash,
        'nom' => $nom,
        'prenom' => ''
    ]);

    header("Location: /MedFlow/templates/auth/login.php");
    exit();
}