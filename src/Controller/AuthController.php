<?php

class AuthController {

    private $userRepository;

    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }

    // 🔑 LOGIN
    public function login($email, $password) {

        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return "User not found";
        }

        if (!password_verify($password, $user['passwordHash'])) {
            return "Wrong password";
        }

        session_start();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['nom'];
        $_SESSION['role'] = $user['role_name'];

        // Redirect by role
        if ($user['role_name'] === 'ADMIN') {
            header("Location: /admin/dashboard.php");
        } elseif ($user['role_name'] === 'MEDECIN') {
            header("Location: /doctor/dashboard.php");
        } else {
            header("Location: /patient/dashboard.php");
        }

        exit();
    }

    // 🧾 REGISTER
    public function register($data) {

        $exists = $this->userRepository->findByEmail($data['email']);

        if ($exists) {
            return "Email already exists";
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->userRepository->createPatient($data);
    }

    // 🚪 LOGOUT
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /login.php");
    }
}