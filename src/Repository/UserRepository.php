<?php

class UserRepository {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPatient($data) {

        $sql = $this->conn->prepare("
            INSERT INTO User (email, passwordHash, nom, prenom, role_id)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $sql->execute([
            $data['email'],
            $data['passwordHash'],
            $data['nom'],
            $data['prenom'],
            3
        ]);
    }
       public function findByEmail($email) {
        $sql = $this->conn->prepare("
            SELECT u.*, r.name AS role_name
            FROM User u
            JOIN Role r ON u.role_id = r.id
            WHERE u.email = ?
        ");

        $sql->execute([$email]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}
?>