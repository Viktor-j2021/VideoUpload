<?php
require_once __DIR__ . '/Tabela.php';

class Video extends Tabela
{
    public $id;
    public $videos;
    public $user_email;
    public $file_hash ;
    public $zeit;

    public static function getAllVideos()
    {
        $db = Database::getInstance();
    
        try {
            $query = 'SELECT * FROM video ORDER BY id DESC';
            $videos = $db->fetchAllQuery($query);
    
            return $videos;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function videoExists($video_path, $user_email)
    {
        $db = Database::getInstance();
        
        try {
            $query = 'SELECT * FROM video WHERE videos = :videos AND user_email = :email';
            $stmt = $db->prepare($query);
            $stmt->execute([':videos' => $video_path, ':email' => $user_email]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function hashExists($file_hash, $user_email)
    {
        $db = Database::getInstance();
        
        try {
            $query = 'SELECT * FROM video WHERE file_hash = :file_hash AND user_email = :email';
            $stmt = $db->prepare($query);
            $stmt->execute([':file_hash' => $file_hash, ':email' => $user_email]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addVideo($video_path, $user_email, $file_hash)
    {
        $db = Database::getInstance();
        $query = 'INSERT INTO video (videos, user_email, file_hash) VALUES (:v, :e, :h)';
        $params = [
            ':v' => $video_path,
            ':e' => $user_email,
            ':h' => $file_hash
        ];

        try {
            $db->insert('video', $query, $params);
            return $db->lastInsertId();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function deleteVideo($id)
    {
        $db = Database::getInstance();
        $query = 'DELETE FROM video WHERE id = :id';
        
        $params = [
            ':id' => $id
        ];
    
        $db->delete($query, $params);
    }
}
?>
