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
                u.id,
                u.nom,
                u.prenom,
                s.libelle AS speciality
            FROM Medecin m
            JOIN User u ON m.user_id = u.id
            JOIN Specialite s ON m.specialite_id = s.id
            WHERE 1=1";

    $params = [];

    if (!empty($name)) {
        $sql .= " AND (u.nom LIKE :name OR u.prenom LIKE :name)";
        $params[':name'] = "%$name%";
    }

    if (!empty($speciality)) {
        $sql .= " AND s.libelle LIKE :speciality";
        $params[':speciality'] = "%$speciality%";
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}}