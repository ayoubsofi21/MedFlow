<?php
require_once __DIR__ . "/../../templates/admin/conn/db.php";

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
        $sql = "SELECT COUNT(*) AS total FROM Medecin WHERE actif = 1";
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
        $sql = "SELECT COUNT(*) AS total FROM RendezVous WHERE statut = :statut";
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
        $sql = "SELECT u.id AS user_id, u.nom, u.prenom, u.email, m.numeroRPPS, m.actif, m.specialite_id, s.libelle AS specialite
                FROM Medecin m
                JOIN User u       ON u.id = m.user_id
                JOIN Specialite s ON s.id = m.specialite_id";
        $stmt = $conn->query($sql);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    } catch(PDOException $e) {
        echo "error : " . $e->getMessage();
        return [];
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

        $userId = $conn->lastInsertId();

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

function getWorkingSpecialities() {
    $conn = DB::connect();
    $sql = "Select s.libelle , COUNT(m.user_id) FROM  Specialite s
            INNER JOIN Medecin m ON m.specialite_id = s.id 
            GROUP BY s.id,s.libelle";
    
    try {
        $stmt = $conn->query($sql);
        $res =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;

    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }
}

function getAllSpecialities(){
    $conn = DB::connect();
    $sql = "Select id , libelle FROM  Specialite";
    try {
        $stmt = $conn->query($sql);
        $res =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;

    }catch(PDOException $e){
        echo "error : " . $e->getMessage();
    }

}

function updateMedecinStatus(int $id_medecin, int $nouveau_statut) : bool {
    $conn = DB::connect();
    $sql = "UPDATE Medecin SET actif = :statut WHERE user_id = :id";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':statut' => $nouveau_statut,
            ':id' => $id_medecin
        ]);
        return true; 
    } catch (Exception $e) {
        return false;
    }
}

function updateMed($user_id, $nom, $prenom, $email, $numeroRPPS, $specialite_id) {
    $conn = DB::connect();
    $sql1 = "UPDATE User 
                 SET nom = :nom, prenom = :prenom, email = :email 
                 WHERE id = :user_id";

    $sql2 = "UPDATE Medecin 
                    SET numeroRPPS = :numeroRPPS, specialite_id = :specialite_id 
                    WHERE user_id = :user_id";

    try {
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([
            ':nom'      => $nom,
            ':prenom'   => $prenom,
            ':email'    => $email,
            ':user_id'  => $user_id
        ]);

        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([
            ':numeroRPPS'    => $numeroRPPS,
            ':specialite_id' => $specialite_id,
            ':user_id'       => $user_id
        ]);

        return true;

    } catch (Exception $e) {
        echo "error : " . $e->getMessage();
        return false;
    }
}

function todayDatemr(string $timezone = 'Africa/Casablanca'){
   $jours = [
        'Sunday'    => 'Dimanche',
        'Monday'    => 'Lundi',
        'Tuesday'   => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday'  => 'Jeudi',
        'Friday'    => 'Vendredi',
        'Saturday'  => 'Samedi'
    ];

    $mois = [
        'January'   => 'Janvier',
        'February'  => 'Février',
        'March'     => 'Mars',
        'April'     => 'Avril',
        'May'       => 'Mai',
        'June'      => 'Juin',
        'July'      => 'Juillet',
        'August'    => 'Août',
        'September' => 'Septembre',
        'October'   => 'Octobre',
        'November'  => 'Novembre',
        'December'  => 'Décembre'
    ];
    $jourAnglais = date('l'); 
    $jourNumero  = date('j');
    $moisAnglais = date('F');
    $annee       = date('Y');
    $jourFrancais = $jours[$jourAnglais];
    $moisFrancais = $mois[$moisAnglais];

    return "{$jourFrancais}, {$jourNumero} {$moisFrancais} {$annee}";
}