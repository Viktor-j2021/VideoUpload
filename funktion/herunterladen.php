<?php
require_once __DIR__ . './../tabela/Video.php';
session_start();

if (isset($_POST['submit']) && isset($_FILES['my_video'])) {
    $tmp_name = $_FILES['my_video']['tmp_name'];
    $error = $_FILES['my_video']['error'];

    if ($error !== UPLOAD_ERR_OK) {
        header('Location: ./../index.php?meldung=upload_error&error=upload_error');
        die();
    }

    $video_name = $_FILES['my_video']['name'];
    $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
    $new_video_name = uniqid("video-", true) . '.' . $video_ex;
    $video_upload_path = __DIR__ . './../uploads/' . $new_video_name;

    $file_hash = md5_file($tmp_name);

    $user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
    if ($user_email && Video::hashExists($file_hash, $user_email)) {
        header('Location: ./../index.php?meldung=upload_error&error=video_exists');
        die();
    }

    if (move_uploaded_file($tmp_name, $video_upload_path)) {
        if ($user_email) {
            $video_path = './../uploads/' . $new_video_name;
            $result = Video::addVideo($video_path, $user_email, $file_hash);

            if ($result) {
                header('Location: ./../video_sehen.php');
                die();
            } else {
                header('Location: ./../index.php?meldung=upload_error&error=db_error');
                die();
            }
        } else {
            header('Location: ./../index.php?meldung=upload_error&error=not_logged_in');
            die();
        }
    } else {
        header('Location: ./../index.php?meldung=upload_error&error=upload_failed');
        die();
    }
} else {
    header('Location: ./../index.php');
    die();
}
?>
