<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: ./../index.php');
    die();
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: ./../login.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ./../login.php?error=email_format');
    die();
}

if (strlen($password) < 8) {
    header('Location: ./../login.php?error=password_length');
    die();
}

require_once __DIR__ . './../tabela/Benutzer.php';

$benutzer = Benutzer::log_anmeldung($email, $password);

if ($benutzer == null) {
    if (!Benutzer::angemeldet($email)) {
        header('Location: ./../login.php?error=email_not_registered');
    } else {
        header('Location: ./../login.php?error=password');
    }
    die();
}

$_SESSION['username'] = $benutzer->username;
$_SESSION['user_email'] = $email; 
header('Location: ./../index.php');
die();
?>
