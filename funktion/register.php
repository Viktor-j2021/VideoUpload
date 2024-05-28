<?php

require_once __DIR__ . './../tabela/Benutzer.php';

if (!isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['w_password'])) {
    header('Location: ./../registration.php');
    die();
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$w_password = $_POST['w_password'];

$benutzer = Benutzer::angemeldet($email);
if ($benutzer) {
    header('Location: ./../registration.php?email=achtung');
    die();
}

if ($password !== $w_password) {
    header('Location: ./../registration.php?w_password=achtung');
    die();
}

if (strlen($password) < 8) {
    header('Location: ./../registration.php?password_length=achtung');
    die();
}

if (!preg_match('/@(gmail\.com|yahoo\.com|hotmail\.com)$/', $email)) {
    header('Location: ./../registration.php?email_format=achtung');
    die();
}

$id = Benutzer::register($username, $email, $password);
if ($id > 0) {
    header('Location: ./../login.php');
    die();
}

header('Location: ./../registration.php?error=achtung');
die();
?>