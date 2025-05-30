<?php

require_once __DIR__ . '/../config/Database.php';

class loginModel
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function obtenerUsuarioPorUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
