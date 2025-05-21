<?php

require_once __DIR__ . '/../config/Database.php';

class TecnicosModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTecnicos()
    {
        $stmt = $this->pdo->query("SELECT * FROM PersonalTecnico ORDER BY apellido, nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cedulaExiste($cedula)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM PersonalTecnico WHERE cedula = :cedula");
        $stmt->execute([':cedula' => $cedula]);
        return $stmt->fetchColumn() > 0;
    }

    public function crearTecnico($datos)
    {
        $stmt = $this->pdo->prepare("INSERT INTO PersonalTecnico (cedula, nombre, apellido, cargo, direccion, correo, telefono, cursos_realizados) 
                                     VALUES (:cedula, :nombre, :apellido, :cargo, :direccion, :correo, :telefono, :cursos_realizados)");
        return $stmt->execute($datos);
    }

    public function eliminarTecnico($cedula)
    {
        $stmt = $this->pdo->prepare("DELETE FROM PersonalTecnico WHERE cedula = :cedula");
        return $stmt->execute([':cedula' => $cedula]);
    }

    public function actualizarTecnico($datos)
    {
        $stmt = $this->pdo->prepare("UPDATE PersonalTecnico SET 
            nombre = :nombre,
            apellido = :apellido,
            cargo = :cargo,
            direccion = :direccion,
            correo = :correo,
            telefono = :telefono,
            cursos_realizados = :cursos_realizados
            WHERE cedula = :cedula");
        return $stmt->execute($datos);
    }
}
