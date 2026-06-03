<?php

require_once __DIR__ . '/../../config/database.php';

class DoctorRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllDoctors()
    {
        $sql = "SELECT * FROM doctors";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}