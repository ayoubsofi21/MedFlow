<?php
session_start();
require_once __DIR__ . '//../../../src/Repository/adminRepositories.php.php'; 

if (isset($_POST['libelle'])) {
    $nouvelle_specialite = trim($_POST['libelle']);
    if ($nouvelle_specialite === "") {
        $_SESSION['spec_error'] = "Tu dois écrire le nom d'une spécialité !";
        header("Location: " . $_SERVER['HTTP_REFERER']); 
        exit();
    }

    $liste_specialites = getAllSpecialities();
    $existe_deja = false;

    foreach ($liste_specialites as $specialite) {
        
        if (strtolower($specialite->libelle) === strtolower($nouvelle_specialite)) {
            $existe_deja = true;
        }
    }

    if ($existe_deja === true) {
        $_SESSION['spec_error'] = "Désolé, la spécialité '" . $nouvelle_specialite . "' existe déjà.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $resultat = addSpecialit($nouvelle_specialite);

    if ($resultat === true) {
        unset($_SESSION['spec_error']);
    } else {
        $_SESSION['spec_error'] = "Erreur technique : impossible d'enregistrer.";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

} else {
    header("Location: ../dashboard.php");
    exit();
}