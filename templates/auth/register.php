<?php
//  require '../layout/header.php';
 ?>
 <?php
require '../../config/database.php';;
session_start();

$message = '';

if (isset($_POST['register'])) {

    $nom = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!empty($nom) && !empty($email) && !empty($password)) {

        if ($password !== $confirm) {
            $message = "Passwords do not match";
        } else {

            $check = $conn->prepare("SELECT id FROM User WHERE email = ?");
            $check->execute([$email]);

            if ($check->rowCount() > 0) {
                $message = "Email already exists";
            } else {

                $hash = password_hash($password, PASSWORD_DEFAULT);

                // default role = patient (3)
                $sql = $conn->prepare("
                    INSERT INTO User (email, passwordHash, nom, prenom, role_id)
                    VALUES (?, ?, ?, '', 3)
                ");

                if ($sql->execute([$email, $hash, $nom])) {
                    header("Location: login.php");
                    exit();
                } else {
                    $message = "Registration failed";
                }
            }
        }

    } else {
        $message = "Please fill all fields";
    }
}
?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl p-8 rounded-3xl w-full max-w-lg">

        <h2 class="text-3xl font-black text-center">
            Create Account
        </h2>
        <form method="POST" class="space-y-4 mt-8">

            <?php if (!empty($message)) : ?>
                <p class="text-red-500 text-center"><?= $message ?></p>
            <?php endif; ?>

            <input type="text" name="name" placeholder="Full Name"
                class="w-full border p-3 rounded-xl">

            <input type="email" name="email" placeholder="Email Address"
                class="w-full border p-3 rounded-xl">

            <input type="password" name="password" placeholder="Password"
                class="w-full border p-3 rounded-xl">

            <input type="password" name="confirm_password" placeholder="Confirm Password"
                class="w-full border p-3 rounded-xl">

            <button type="submit" name="register"
                class="w-full bg-blue-600 text-white py-3 rounded-xl">
                Create Account
            </button>

            <div class="text-center mt-3">
                <a href="login.php" class="text-blue-600 font-semibold">
                    Already have an account? Sign In
                </a>
            </div>

        </form>

    </div>

</div>

<?php require '../layout/footer.php'; ?>