<?php

class Database {
    private $host =  "localhost";
    private $db_name = "violations_db";
    private $usermane = "root";
    private $password = "";
    public $conn;

    public function getConnection () {
    $this->conn = null;

    try {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->usermane, $this->password);
    } catch (PDOException $exception) {
        echo "Ошибка подключения" . $exception->getMessage();
    }

    return $this->conn; 
    }

}


?>