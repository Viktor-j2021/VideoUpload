<?php
require_once __DIR__ . '/Tabela.php';

class Benutzer extends  Tabela
{

    public $id;
    public $username;
    public $email;
    public $password;
    public $zeit;


    public static function register($username, $email, $password)
    {
        $password = hash('sha512', $password);
        $db = Database::getInstance();
        $query = 'INSERT INTO benutzer (username, email, password) VALUES (:u, :e, :p)';
        $params =
            [
                ':u' => $username,
                ':e' => $email,
                ':p' => $password
            ];
        try {
            $db->insert('Benutzer', $query, $params);
        } catch (Exception $e) {
            return false;
        }
        return $db->lastInsertId();
    }


    public static function angemeldet($email)
    {
        $db = Database::getInstance();

        $angemeldet = $db->select(
            'Benutzer',

            "SELECT  * FROM benutzer WHERE email = :e ",


            [
                ':e' => $email,

            ]
        );

        foreach ($angemeldet as $benutzer) {
            return $benutzer;
        }
        return null;
    }


    public static function log_anmeldung($email, $password)
    {
        $db = Database::getInstance();

        $password = hash('sha512', $password);


        $benutz = $db->select(
            'Benutzer',
            'SELECT * ' .
                'FROM benutzer ' .
                'WHERE  email = :e AND password = :p',
            [
               
                ':e' => $email,
                ':p' => $password
            ]
        );
         if ($benutz) {
            return $benutz[0]; 
        } else {
            return null; 
        }
    }


    public static function change_password($email, $neu_password) {
        $neu_password = hash('sha512', $neu_password);
        $db = Database::getInstance();
        $db->update('Benutzer',
        'UPDATE benutzer '.
        'SET password= :p '.
        'WHERE email = :e',
        
         [
    
            
            ':p'=> $neu_password,
            ':e'=> $email
            
        ]);
       
    }
    
  
}
