<?php

require_once __DIR__ . '/../../config/database.php';

class DoctorRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function searchDoctors($name = '', $speciality = '')
    {
        $sql = "SELECT 
                    m.id,
                    u.nom,
                    u.prenom,
                    s.id AS speciality_id,
                    s.libelle AS speciality
                FROM Medecin m
                JOIN User u ON m.user_id = u.id
                JOIN Specialite s ON m.specialite_id = s.id
                WHERE m.actif = 1";

        $params = [];

        if (!empty($name)) {
            $sql .= " AND (u.nom LIKE ? OR u.prenom LIKE ?)";
            $params[] = "%$name%";
            $params[] = "%$name%";
        }

        if (!empty($speciality)) {
            $sql .= " AND s.id = ?";
            $params[] = $speciality;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}