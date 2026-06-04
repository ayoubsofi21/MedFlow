<?php

require_once __DIR__ . '/../../config/database.php';

class SpecialiteRepository
{
    private PDO $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT id, libelle 
            FROM Specialite 
            ORDER BY libelle ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}