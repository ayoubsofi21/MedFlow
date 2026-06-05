

   <?php

class AuthController {

    private $userRepository;

    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }

    // 🔑 LOGIN
    public function login($email, $password) {

        session_start(); 

        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            die("User not found");
        }

        if (!password_verify($password, $user['passwordHash'])) {
            header("Location: /MedFlow/templates/auth/login.php?error=1");
            exit(); 
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['nom'];
        $_SESSION['role'] = $user['role_name'];

        // ✅ FIXED ROUTES
        if ($user['role_name'] === 'ADMIN') {
            header("Location: /MedFlow/templates/admin/dashboard.php");

        } elseif ($user['role_name'] === 'MEDECIN') {
            header("Location: /MedFlow/templates/doctor/dashboard.php");

        } else {
            header("Location: /MedFlow/templates/patient/dashboard.php");
        }

        exit();
    }

    // 🧾 REGISTER
    public function register($data) {

        $exists = $this->userRepository->findByEmail($data['email']);

        if ($exists) {
            return "Email already exists";
        }

        // ❌ FIX: match DB field passwordHash
        $data['passwordHash'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->userRepository->createPatient($data);
    }

    // 🚪 LOGOUT
    public function logout() {
        session_start();
        session_destroy();

        header("Location: /MedFlow/templates/auth/login.php");
        exit();
    }
}

