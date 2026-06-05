<?php

class UserRepository {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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