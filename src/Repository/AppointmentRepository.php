<?php

require_once __DIR__ . '/../../config/database.php';

class AppointmentRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function cancel($id)
    {
        $sql = "UPDATE RendezVous SET statut = 'ANNULE' WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function getByPatient($patientId): array
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        SELECT 
            r.id,
            r.date_heure,
            r.motif,
            r.statut,
            u.nom AS doctor_nom,
            u.prenom AS doctor_prenom,
            c.dateHeureDebut,
            c.dateHeureFin
        FROM RendezVous r
        JOIN Creneau c ON r.creneau_id = c.id
        JOIN Medecin m ON c.medecin_id = m.id
        JOIN User u ON m.user_id = u.id
        WHERE r.patient_id = ?
        ORDER BY r.date_heure DESC
    ");

    $stmt->execute([$patientId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}
public function create($patientId, $creneauId, $motif)
{
    $pdo = Database::connect();

    try {
        // Kan-bdaaw transaction
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO RendezVous (patient_id, creneau_id, date_heure, statut, motif)
            VALUES (?, ?, NOW(), 'EN_ATTENTE', ?)
        ");

        $stmt->execute([$patientId, $creneauId, $motif]);

        $stmt2 = $pdo->prepare("
            UPDATE Creneau SET disponible = 0 WHERE id = ?
        ");

        $stmt2->execute([$creneauId]);

        // Ila kolchi daz mzyan, kan-sauvegardiw
        $pdo->commit();
        return true;

    } catch (PDOException $e) {
        // Ila w9e3 chi mouchkil (bhal l-créneau déjà réservé), kan-trawj3ou lor
        $pdo->rollBack();
        
        // Hna n9drou n-retourniw false wla n-gériw l-erreur bla may-crachi l-site
        return false;
    }
}
public function searchDoctors($name, $specialty)
{
    $pdo = Database::connect();

    $sql = "
        SELECT 
            m.id,
            u.nom,
            u.prenom,
            s.libelle AS specialite
        FROM Medecin m
        JOIN User u ON m.user_id = u.id
        JOIN Specialite s ON m.specialite_id = s.id
        WHERE 1=1
    ";

    $params = [];

    if (!empty($name)) {
        $sql .= " AND (u.nom LIKE ? OR u.prenom LIKE ?)";
        $params[] = "%$name%";
        $params[] = "%$name%";
    }

    if (!empty($specialty)) {
        $sql .= " AND m.specialite_id = ?";
        $params[] = $specialty;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}
}