<?php
session_start();
require_once __DIR__ . '//../../../src/Repository/adminRepositories.php.php';  
$id_medecin = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_medecin > 0) {
    $liste_medecins = getAllMedecins();
    foreach ($liste_medecins as $medecin) {
        if ($medecin->user_id == $id_medecin) {
            if ($medecin->actif == 1) {
                $nouveau_statut = 0;
            } else {
                $nouveau_statut = 1;
            }
            updateMedecinStatus($id_medecin, $nouveau_statut);
            break;
        }
    }
    
} else {
    $_SESSION['error'] = "Identifiant du médecin introuvable.";
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();