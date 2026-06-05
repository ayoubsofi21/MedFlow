<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . "/../../config/database.php";
// require "../../src/Repository/UserRepository.php";
require __DIR__ . "/../../src/Repository/UserRepository.php";
require "../../src/Controller/AuthController.php";

session_start();

$userRepository = new UserRepository($conn);
$auth = new AuthController($userRepository);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $auth->login($email, $password);
}