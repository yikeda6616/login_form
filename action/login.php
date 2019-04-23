<?php

session_start();
include '../User.php';
$pdo = DB::connect();

$email = User::sanitizeEmail();
$password = User::sanitizePassword();

$is_valid_email = User::validateEmail($email);

if ($is_valid_email) {
    $user = User::login($email);
} else {
    header('location: ../index.php?error=true');
}

if (!$user) { // if the user related to the email doesn't exist
    header('location: ../index.php?error=true');
}

// verify user input password and hash stored in db
if (password_verify($password, $user['hash'])) {
    $_SESSION['user_id'] = $user['id'];
    header('location: ../dashboard.php?success=true');
} else {
    header('location: ../index.php?error=true');
}
