<?php
session_start();
require_once '/../../../src/Repository/adminRepositories.php.php';
if (isset($_POST['nom'])) {

    $nom           = trim($_POST['nom']);
    $prenom        = trim($_POST['prenom']);
    $email         = trim($_POST['email']);
    $numeroRPPS    = trim($_POST['numeroRPPS']);
    $specialite_id = $_POST['specialite_id']; 

    if ($nom === "" || $prenom === "" || $email === "" || $numeroRPPS === "" || $specialite_id === 0) {
        $_SESSION['error'] = "Tu as oublié de remplir une case du formulaire !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $password_DEMO = "AZERTY123";
    $succes = addMed($nom, $prenom, $email, $password_DEMO, $numeroRPPS, $specialite_id);
    if ($succes === false) {
        $_SESSION['error'] = "Erreur : Un médecin utilise déjà cet email ou ce numéro RPPS.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

} else {
    header("Location: ../dashboard.php");
    exit();
}