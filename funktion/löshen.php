<?php

session_start();

require_once __DIR__ . './../tabela/Video.php';

if(isset($_GET['id'])) {
    try{
        $löschen = Video::deleteVideo($_GET['id']);
        header('Location: ./../video_sehen.php');
       die; 
    } catch(Exception $ex) {
        echo '{"status":"'.$ex->getMessage().'"}';
    }
} else {
    echo '{"status":"Sie haben keine ID weitergeleitet"}';
}

?>
