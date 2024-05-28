<?php
require_once __DIR__.'/Factory.php';

class Database {
    private $db;
    private static $instance = null;

    public static function getInstance($dbname = null, $host = null, $user = null, $pass = null) {
        if(self::$instance === null) {
            self::$instance = new Database($dbname, $host, $user, $pass);
        }
        return self::$instance;
    }

    public function __construct($dbname = null, $host = null, $user = null, $pass = null) {
        try {
            $this->db = new PDO(
                'mysql:dbname=' . ($dbname ?? DBNAME) . ';host=' . ($host ?? HOST),
                $user ?? USER,
                $pass ?? PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function prepare($query) {
        return $this->db->prepare($query);
    }

    public function fetchAllQuery($query, $params = []) {
        $result = $this->db->prepare($query);
    
        foreach ($params as $key => &$val)
            $result->bindParam($key, $val);

        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select($class, $query, $params = []) {
        $result = $this->db->prepare($query);
        
        foreach($params as $key => &$val)
            $result->bindParam($key, $val);
        $result->execute();

        Factory::autoload($class);
        $result->setFetchMode(PDO::FETCH_CLASS, $class);
        $arr = [];
        while($object = $result->fetch())
            array_push($arr, $object);
        return $arr;
    }

    public function selectQuery($query, $params = []) {
        $result = $this->db->prepare($query);
    
        foreach($params as $key => &$val)
            $result->bindParam($key, $val);

        $result->execute();
        $result = $result->fetch();
        return $result;
    }

    public function insert($class, $query_insert, $params_insert = [], $query_select = '', $params_select = []) {
        if(strlen($query_select) > 0) {
            if(count(self::select($class, $query_select, $params_select)) > 0)
                return false;
        }
        $this->result = $this->db->prepare($query_insert);

        foreach($params_insert as $key => &$val)
            $this->result->bindParam($key, $val);
        
        return $this->result->execute();
    }

    public function update($class, $query_update, $params_update, $query_select = '', $params_select = []) {
        if(strlen($query_select) > 0) {
            $arr = self::select($class, $query_select, $params_select);
            if(count($arr) === 0)
                return null;
        }
        $this->result = $this->db->prepare($query_update);
        
        foreach($params_update as $key => &$val)
            $this->result->bindParam($key, $val);
        $this->result->execute();
        
        $arr = [];
        if(strlen($query_select) > 0) {
            $arr = self::select($class, $query_select, $params_select);
            if(count($arr) === 0)
                return null;
        }
        foreach($arr as $a)
            return $a;
        return null;
    }

    public function delete($query, $params_delete = []) {
        $result = $this->db->prepare($query);

        foreach($params_delete as $key => &$val)
            $result->bindParam($key, $val);
        $result->execute();
        return true;
    }

    public function beginTransaction() {
        return $this->db->beginTransaction();
    }

    public function commit() {
        return $this->db->commit();
    }

    public function rollBack() {
        return $this->db->rollBack();
    }

    public function lastInsertId($name = null) {
        if($name === null)
            return $this->db->lastInsertId();
        else
            return $this->db->lastInsertIt($name);
    }
}
?>
