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