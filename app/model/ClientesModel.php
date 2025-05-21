<?php

require_once __DIR__ . '/../config/Database.php';

class ClientesModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTodos()
    {
        $stmt = $this->pdo->query("SELECT * FROM Cliente ORDER BY apellido, nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cedulaExiste($cedula)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Cliente WHERE cedula = :cedula");
        $stmt->execute([':cedula' => $cedula]);
        return $stmt->fetchColumn() > 0;
    }

    public function crear($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Cliente (cedula, nombre, apellido, correo, telefono, direccion, organizacion, sede) 
                                     VALUES (:cedula, :nombre, :apellido, :correo, :telefono, :direccion, :organizacion, :sede)");
        return $stmt->execute($data);
    }

    public function eliminar($cedula)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Cliente WHERE cedula = :cedula");
        return $stmt->execute([':cedula' => $cedula]);
    }

    public function modificar($data)
    {
        $stmt = $this->pdo->prepare("UPDATE Cliente SET 
            nombre = :nombre,
            apellido = :apellido,
            correo = :correo,
            telefono = :telefono,
            direccion = :direccion,
            organizacion = :organizacion,
            sede = :sede
            WHERE cedula = :cedula");
        return $stmt->execute($data);
    }
}
