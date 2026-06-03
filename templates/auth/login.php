<?php
//  require '../layout/header.php'; 
?>
<?php
require '../../config/database.php';
session_start();

$message = '';

if (isset($_POST['Sign_in'])) {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {

        $sql = $conn->prepare("SELECT * FROM User WHERE email = ?");
        $sql->execute([$email]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['passwordHash'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['nom'];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Invalid email or password";
        }

    } else {
        $message = "Please fill all fields";
    }
}
?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-slate-50">
<div class="h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50 overflow-hidden">
    <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-xl">

        <h1 class="text-4xl font-black text-center text-blue-600">
            MedFlow
        </h1>

        <p class="text-center text-slate-500 mt-2">
            Welcome Back
        </p>

        <form method="POST" class="mt-8 space-y-5">

            <?php if (!empty($message)) : ?>
                <p class="text-red-500 text-center"><?= $message ?></p>
            <?php endif; ?>

            <div>
                <label>Email</label>
                <input type="email" name="email"
                    class="w-full mt-2 border rounded-xl p-3">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password"
                    class="w-full mt-2 border rounded-xl p-3">
            </div>

            <button type="submit" name="Sign_in"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                Sign In
            </button>

            <div class="text-center pt-2">
                <span class="text-slate-500">Don't have an account?</span>
                <a href="register.php" class="text-blue-600 font-semibold ml-1">
                    Sign Up
                </a>
            </div>

        </form>

    </div>

</div>

<?php require '../layout/footer.php'; ?>