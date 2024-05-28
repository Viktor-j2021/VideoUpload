<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort ändern</title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
<img src="./img/uplod.webp" alt="">
    <div class="container">
        <form action="funktion/n_password.php" method="post">
            <h1>Passwort ändern</h1>

            <div class="input-style">
                <input type="email" name="email" required /><br />
                <label for="">Email</label>
            </div>

            <div class="input-style">
                <input type="password" name="neu_password" required /><br />
                <label for="">NeuPassword</label>
            </div>

            <div class="input-style">
                <input type="password" name="c_password" required /><br />
                <label for="">NeuPassword2</label>
            </div>

            <div class="button-container">
                <button type="submit" class="button" name="submit">Promeni lozinku</button>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php if ($_GET['error'] === 'email') { ?>
                        <h5><span>Diese E-Mail-Adresse wurde nicht gefunden!.</span></h5>
                    <?php } elseif ($_GET['error'] === 'c_password') { ?>
                        <h5><span>Die Passwörter stimmen nicht überein!.</span></h5>
                    <?php } elseif ($_GET['error'] === 'password_length') { ?>
                        <h5><span>Das neue Passwort muss mindestens 8 Zeichen enthalten..</span></h5>
                    <?php } ?>
                </p>
            <?php } ?>
        </form>
    </div>
</body>

</html>