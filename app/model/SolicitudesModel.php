<?php

require_once __DIR__ . '/../config/Database.php';

class SolicitudesModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTodas()
    {
        $stmt = $this->pdo->query("
            SELECT s.*, 
                   c.nombre AS nombre_cliente, 
                   c.apellido AS apellido_cliente, 
                   t.nombre AS nombre_tecnico, 
                   t.apellido AS apellido_tecnico
            FROM Solicitudes s
            LEFT JOIN Cliente c ON s.cliente = c.cedula
            LEFT JOIN PersonalTecnico t ON s.tecnico_asignado = t.cedula
            ORDER BY s.fecha DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Solicitudes (cliente, descripcion, sede, fecha, estado_ticket, tecnico_asignado, prioridad)
            VALUES (:cliente, :descripcion, :sede, :fecha, :estado_ticket, :tecnico_asignado, :prioridad)
        ");
        return $stmt->execute($data);
    }

    public function eliminar($id_codigo)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Solicitudes WHERE id_codigo = :id_codigo");
        return $stmt->execute([':id_codigo' => $id_codigo]);
    }

    public function modificar($data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE Solicitudes SET 
                cliente = :cliente,
                descripcion = :descripcion,
                sede = :sede,
                fecha = :fecha,
                estado_ticket = :estado_ticket,
                tecnico_asignado = :tecnico_asignado,
                prioridad = :prioridad
            WHERE id_codigo = :id_codigo
        ");
        return $stmt->execute($data);
    }
}
