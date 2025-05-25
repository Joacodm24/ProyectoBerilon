<?php

require_once __DIR__ . '/../config/Database.php';

class RecursosModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function obtenerTodos()
    {
        $stmt = $this->pdo->query("SELECT * FROM RecursosTecnologicos ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function codigoExiste($codigo)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM RecursosTecnologicos WHERE codigo_de_herramientas = :codigo");
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetchColumn() > 0;
    }

    public function crear($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO RecursosTecnologicos (
                codigo_de_herramientas, nombre, tipo_de_h, herramientas, materiales, disponibilidad, cantidad
            ) VALUES (
                :codigo_de_herramientas, :nombre, :tipo_de_h, :herramientas, :materiales, :disponibilidad, :cantidad
            )
        ");
        return $stmt->execute($data);
    }

    public function eliminar($codigo)
    {
        $stmt = $this->pdo->prepare("DELETE FROM RecursosTecnologicos WHERE codigo_de_herramientas = :codigo");
        return $stmt->execute([':codigo' => $codigo]);
    }

    public function modificar($data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE RecursosTecnologicos SET 
                nombre = :nombre,
                tipo_de_h = :tipo_de_h,
                herramientas = :herramientas,
                materiales = :materiales,
                disponibilidad = :disponibilidad,
                cantidad = :cantidad
            WHERE codigo_de_herramientas = :codigo_de_herramientas
        ");
        return $stmt->execute($data);
    }
}
