<?php
require_once __DIR__ . "/conn/db.php";

function getTotalRDVs() {
    try {
        $conn = DB::connect();
        $sql = "SELECT COUNT(*) FROM RendezVous";
        $stmt = $conn->query($sql);
        $res =  $stmt->fetch();
        return $res;
    } catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}

function getTotalCancels() {
    try {
        $conn = DB::connect();
        $sql = "SELECT COUNT(*) FROM RendezVous WHERE statut = :statut";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':statut' => 'ANNULE']);
        $res = $stmt->fetch();
        return $res;
    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}

function getTotalDrsActifs() {
    try {
        $conn = DB::connect();
        $sql = "SELECT COUNT(*) FROM Medecin WHERE actif = 1";
        $stmt = $conn->query($sql);
        $res =  $stmt->fetch();
        return $res;
    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}

function countFinishedCons(){
   try {
        $conn = DB::connect();
        $sql = "SELECT COUNT(*) FROM RendezVous WHERE statut = :statut";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':statut' => 'TERMINE']);
        $res = $stmt->fetch();
        return $res;
    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}


function getAllMedecins(PDO $conn) {
    try {
        $conn = DB::connect();
        $sql = "SELECT u.id, u.nom, u.prenom, u.email,m.numeroRPPS, m.actif, s.libelle AS specialite
                FROM Medecin m
                JOIN User u       ON u.id = m.user_id
                JOIN Specialite s ON s.id = m.specialite_id ";
        $stmt = $conn->query($sql);
        $res =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}