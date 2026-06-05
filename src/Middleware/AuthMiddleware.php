<?php

class AuthMiddleware {

    public static function checkLogin() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /MedFlow/templates/auth/login.php");
            exit();
        }
    }

    public static function checkRole($role) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
            header("Location: /MedFlow/templates/auth/login.php");
            exit();
        }
    }
}