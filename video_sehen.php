<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}
require_once __DIR__ . '/tabela/Video.php';

$videos = Video::getAllVideos();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Löschen und Herunterladen</title>
    <link rel="stylesheet" href="./style/main.css">
</head>

<body class="video">

    <div class="header">
        <a class="herunterladen_Btn" href="index.php">Herunterladen</a>
    </div>

    <img src="./img/video-sehen.jpg" alt="">

    <div class="alb">
    <?php foreach ($videos as $video) : ?>

<div class="video-container">
    <p class="upload_zeit" >Upload Datum und Zeit: <br> <?php echo $video['zeit']; ?></p>

    <video controls>
        <source src="uploads/<?= htmlspecialchars($video['videos']) ?>" type="video/mp4">
        <source src="uploads/<?= htmlspecialchars($video['videos']) ?>" type="video/webm">
        <source src="uploads/<?= htmlspecialchars($video['videos']) ?>" type="video/ogg">
        Ihr Browser unterstützt das Video-Tag nicht                </video>

    <a class="herunterladen_Btn" href="./funktion/löshen.php?action=delete&id=<?= $video['id'] ?>" onclick='return confirm("Sind Sie sicher, dass Sie löschen möchten?")'>Löschen</a>
</div>
<?php endforeach; ?>
    </div>
</body>

</html>