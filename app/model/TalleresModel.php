<?php

require_once __DIR__ . '/../config/Database.php';

class TalleresModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTodos()
    {
        $stmt = $this->pdo->query("SELECT * FROM Talleres ORDER BY fecha DESC, hora DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function codigoExiste($codigo_taller)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Talleres WHERE codigo_taller = :codigo_taller");
        $stmt->execute([':codigo_taller' => $codigo_taller]);
        return $stmt->fetchColumn() > 0;
    }

    public function crear($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Talleres 
                                    (codigo_taller, descripcion_taller, correo, participante, encargado, fecha, hora) 
                                     VALUES 
                                    (:codigo_taller, :descripcion_taller, :correo, :participante, :encargado, :fecha, :hora)");
        return $stmt->execute($data);
    }

    public function eliminar($codigo_taller)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Talleres WHERE codigo_taller = :codigo_taller");
        return $stmt->execute([':codigo_taller' => $codigo_taller]);
    }

    public function modificar($data)
    {
        $stmt = $this->pdo->prepare("UPDATE Talleres SET 
            descripcion_taller = :descripcion_taller,
            correo = :correo,
            participante = :participante,
            encargado = :encargado,
            fecha = :fecha,
            hora = :hora
            WHERE codigo_taller = :codigo_taller");
        return $stmt->execute($data);
    }
}