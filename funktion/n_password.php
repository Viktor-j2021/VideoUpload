<?php
if (!isset($_POST['email'], $_POST['neu_password'], $_POST['c_password'])) {
    header('Location: ./../neu_password.php');
    die();
}

$email = $_POST['email'];
$neu_password = $_POST['neu_password'];
$c_password = $_POST['c_password'];

require_once __DIR__ . '/../tabela/Benutzer.php';

$benutzer = Benutzer::angemeldet($email);
if ($benutzer === null) {
    header('Location: ./../neu_password.php?error=email');
    die();
}
if ($neu_password !== $c_password) {
    header('Location: ./../neu_password.php?error=c_password');
    die();
}

if (strlen($neu_password) < 8) {
    header('Location: ./../neu_password.php?error=password_length');
    die();
}


if (Benutzer::change_password($email, $neu_password)) {
   
} else {
    header('Location: ./../login.php');
    die();
}
?>
