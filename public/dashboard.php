<?php
if ($user && password_verify($password, $user['passwordHash'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['nom'];
    $_SESSION['role'] = $user['role_name'];

    if ($user['role_name'] === 'ADMIN') {
        header("Location: ../admin/dashboard.php");
        exit();
    } 
    elseif ($user['role_name'] === 'DOCTOR') {
        header("Location: ../doctor/dashboard.php");
        exit();
    } 
    else {
        header("Location: ../patient/dashboard.php");
        exit();
    }
}
?>
