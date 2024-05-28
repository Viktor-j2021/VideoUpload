<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entspannungsseite</title>
    <link rel="stylesheet" href="./style/main.css">
</head>
<img src="./img/video-sehen.jpg" alt="">

<body>
    <br>
    <a class="ausloggen" href="funktion/logout.php">Ausloggen</a>

    <h3 class="user_anmelden">
        <?php echo "<span class='username'>" . htmlspecialchars($_SESSION['username']) . "</span>, willkommen auf der Entspannungsseite. Teilen Sie mit uns Videos."; ?>
    </h3>

    <div class="file">
        <a class="sehen_video" href="video_sehen.php">Video Sehen</a>
        <br>
        <br>
        <form action="./funktion/herunterladen.php" method="post" enctype="multipart/form-data" class="upload-form">
            <input type="file" class="file-label" name="my_video">
            <input type="submit" class="uploadBtn" name="submit" value="Upload">
        </form>

        <?php if (isset($_GET['meldung']) && $_GET['meldung'] === 'upload_error') { ?>
            <p id="error">
                <?php if ($_GET['error'] === 'video_exists') { ?>
                    <h5><span>Das Video wurde bereits hochgeladen.</span></h5>
                <?php } elseif ($_GET['error'] === 'upload_error') { ?>
                    <h5><span>Das Video wurde nicht hochgeladen, bitte laden Sie es hoch.</span></h5>
                <?php } ?>
            </p>
        <?php } ?>
    </div>
</body>


</html>