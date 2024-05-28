<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/main.css">

</head>

<body>
    <img src="./img/uplod.webp" alt="">

    <div class="container">
        <h1>Login</h1>
        <form action="funktion/log_anmeldung.php" method="post">
            <div class="input-style">
                <input type="email" name="email" required /><br />
                <label for="">Email</label>
            </div>

            <div class="input-style">
                <input type="password" name="password" required /><br />
                <label for="">Password</label>
            </div>

            <div class="button-container">
                <button type="submit" class="button" name="submit">Login</button>
            </div>

            <br>
            <br>
            <div class="location-wrapper">
                <a class="location" href="registration.php">Sind Sie nicht registriert?
                    <br>
                    <span> Registrieren Sie sich hier</span>
                </a>

                <a class="location" href="neu_password.php"><span>Passwort ändern </span></a>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p id="error">
                <?php if ($_GET['error'] === 'email_format') { ?>
                    <h5><span> Falsches Email Format! Bitte geben Sie eine gültige E-Mail-Adresse ein.</span></h5>
                <?php } elseif ($_GET['error'] === 'password_length') { ?>
                    <h5><span> Das Passwort muss mindestens 8 Zeichen lang sein.</span></h5>
                <?php } elseif ($_GET['error'] === 'password') { ?>
                    <h5><span> Falsches Passwort!.</span></h5>
                <?php } elseif ($_GET['error'] === 'email_not_registered') { ?>
                    <h5><span> Sie sind nicht mit dieser E-Mail-Adresse registriert! Bitte registrieren Sie sich.</span></h5>
                <?php } ?>
                </p>
            <?php } ?>
        </form>
    </div>
</body>

</html>
