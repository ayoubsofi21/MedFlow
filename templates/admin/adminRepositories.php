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


function getAllMedecins() {
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


function addMed( string $nom, 
                    string $prenom, 
                    string $email, 
                    string $password, 
                    string $numeroRPPS, 
                    int $specialite_id)
{
    $MEDECIN_ROLE_ID = 2;
    $conn = DB::connect();
    $sql1 = "INSERT INTO User (nom, prenom, email, passwordHash, role_id)
            VALUES (:nom, :prenom, :email, :passwordHash, :role_id)";

    $sql2 = "INSERT INTO Medecin (user_id, numeroRPPS, specialite_id)
            VALUES (:user_id, :numeroRPPS, :specialite_id)";
    try {
        
        $stmt = $conn->prepare($sql1);
        $stmt->execute([
            ':nom'          => $nom,
            ':prenom'       => $prenom,
            ':email'        => $email,
            ':passwordHash' => password_hash($password, PASSWORD_BCRYPT),
            ':role_id'      => $MEDECIN_ROLE_ID,
        ]);

        $stmt = $conn->prepare($sql2);
        $stmt->execute([
            ':user_id'       => $userId,
            ':numeroRPPS'    => $numeroRPPS,
            ':specialite_id' => $specialite_id,
        ]);

        return true;
    } catch (Exception $e) {
        return false;
    }
}

function addSpecialit(string $libelle) : bool {
    $conn = DB::connect();
    $sql = "INSERT INTO Specialite (libelle)
            VALUES (:libelle)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([':libelle' => $libelle]);
        return true;

    } catch (Exception $e) {
        return false;
    }
}