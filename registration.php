<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
<img src="./img/uplod.webp" alt="">
    <div class="container">
        <form action="funktion/register.php" method="post">
            <h1>Registrieren Sie sich</h1>
            <div class="input-style">
                <input type="text" name="username" required /><br />
                <label for="">Username</label>
            </div>
            <div class="input-style">
                <input type="email" name="email" required /><br />
                <label for="">Email</label>
            </div>
            <div class="input-style">
                <input type="password" name="password" required /><br />
                <label for="">Password</label>
            </div>
            <div class="input-style">
                <input type="password" name="w_password" required /><br />
                <label for="">Password2</label>
            </div>
            <div class="button-container">
                <button class="button">Registration</button>
            </div>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <h5><span><?php echo $_GET['error']; ?></span></h5>
                </p>
            <?php } ?>
            <?php if (isset($_GET['w_password'])) { ?>
                <p class="error">
                    <h5><span>Die Passwörter stimmen nicht überein!.</span></h5>
                </p>
            <?php } ?>
            <?php if (isset($_GET['email'])) { ?>
                <p class="error">
                    <h5><span>Ein Konto mit dieser E-Mail-Adresse ist bereits registriert!.</span></h5>
                </p>
            <?php } ?>
            <?php if (isset($_GET['password_length'])) { ?>
                <p class="error">
                    <h5><span>Das Passwort muss mindestens 8 Zeichen lang sein!.</span></h5>
                </p>
            <?php } ?>
            <?php if (isset($_GET['email_format'])) { ?>
                <p class="error">
                    <h5><span>Ungültiges E-Mail-Format!.</span></h5>
                </p>
            <?php } ?>
        </form>
    </div>
</body>

</html>
