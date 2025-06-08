<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db = 'berilion';
    private $user = 'root';   
    private $pass = '';      
    private $charset = 'utf8'; 
    private $pdo;            

    public function connect() {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->db;charset=$this->charset", 
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
