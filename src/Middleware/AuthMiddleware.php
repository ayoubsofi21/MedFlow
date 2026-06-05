<?php
    class AuthMiddleware {

    private static function ensureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function checkLogin() {
        self::ensureSession();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /MedFlow/templates/auth/login.php");
            exit();
        }
    }

    public static function checkRole($role) {
        self::ensureSession();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
            header("Location: /MedFlow/templates/auth/login.php");
            exit();
        }
    }
}
?>