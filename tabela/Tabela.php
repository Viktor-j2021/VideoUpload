<?php
require_once __DIR__ . './../DB/config.php';
require_once __DIR__ . './../includes/Database.php';

class Tabela {
    public static function getById($id, $tabela, $classe) {
        $db =Database::getInstance();

        $query = "SELECT * FROM $tabela WHERE id = :id";
        $params = [
            ':id' => $id
        ];
        $configclass = $db->select($query, $params);
        foreach($configclass as $config) {
            return $config;
        }
        return null;
    }

    protected static $tableName;

    public static function getTableName()
    {
        return static::$tableName;
    }

}
?>