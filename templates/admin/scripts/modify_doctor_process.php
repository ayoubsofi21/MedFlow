<?php
session_start();
require_once __DIR__ . '/../../../src/Repository/adminRepositories.php';
if (isset($_POST['user_id'])) {
    $user_id       = $_POST['user_id'];
    $nom           = trim($_POST['nom']);
    $prenom        = trim($_POST['prenom']);
    $email         = trim($_POST['email']);
    $numeroRPPS    = trim($_POST['numeroRPPS']);
    $specialite_id = $_POST['specialite_id'];
    if ($nom === "" || $prenom === "" || $email === "" || $numeroRPPS === "" || $specialite_id === 0) {
        $_SESSION['edit_error'] = "Tu as oublié de remplir une case !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $succes = updateMed($user_id, $nom, $prenom, $email, $numeroRPPS, $specialite_id);
    if ($succes === false) {
        $_SESSION['edit_error'] = "Erreur : Cet email ou ce RPPS est déjà utilisé.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

} else {
    header("Location: ../dashboard.php");
    exit();
}