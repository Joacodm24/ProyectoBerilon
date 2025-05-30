<?php

require_once __DIR__ . '/../config/Database.php';

class UsuariosModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTodos()
    {
        $stmt = $this->pdo->query("SELECT id, nombre, usuario, contrasena, cargo FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (nombre, usuario, contrasena, cargo)
            VALUES (:nombre, :usuario, :contrasena, :cargo)
        ");
        return $stmt->execute($data);
    }

    public function modificar($data)
    {
        if (isset($data[':contrasena'])) {
            $stmt = $this->pdo->prepare("
                UPDATE usuarios SET 
                    nombre = :nombre,
                    usuario = :usuario,
                    contrasena = :contrasena,
                    cargo = :cargo
                WHERE id = :id
            ");
        } else {
            $stmt = $this->pdo->prepare("
                UPDATE usuarios SET 
                    nombre = :nombre,
                    usuario = :usuario,
                    cargo = :cargo
                WHERE id = :id
            ");
        }
        return $stmt->execute($data);
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function usuarioExiste($usuario)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
    return $stmt->fetchColumn() > 0;
    }

}
