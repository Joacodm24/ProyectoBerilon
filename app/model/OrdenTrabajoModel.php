<?php

namespace App\Model; // Define el namespace para esta clase

use App\Config\Database; // Importa la clase Database desde su namespace
use PDO; // Importa la clase PDO para operaciones de base de datos
use PDOException; // Importa la clase PDOException para manejar errores de la base de datos

class OrdenTrabajoModel {
    private $db; // Propiedad para la conexión a la base de datos

    // Constructor de la clase. Establece la conexión a la base de datos.
    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Listar órdenes de trabajo
    public function listarOrdenes() {
        try {
            $sql = "SELECT
                id_orden,
                solicitud_id,
                tecnico_cedula,
                codigo_herramienta_asignada,
                fecha_visita,
                direccion_visita,
                estado_planificacion,
                tipo_de_trabajo,
                observaciones
                FROM orden_de_trabajo
                ORDER BY id_orden DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en OrdenTrabajoModel::listarOrdenes: " . $e->getMessage());
            return ['estado' => 'error', 'mensaje' => 'Error al cargar las órdenes de trabajo.'];
        }
    }

    // Crear orden de trabajo
    public function crearOrden($data) {
        try {
            $sql = "INSERT INTO orden_de_trabajo (
                solicitud_id,
                tecnico_cedula,
                codigo_herramienta_asignada,
                fecha_visita,
                direccion_visita,
                estado_planificacion,
                tipo_de_trabajo,
                observaciones
            ) VALUES (
                :solicitud_id,
                :tecnico_cedula,
                :codigo_herramienta_asignada,
                :fecha_visita,
                :direccion_visita,
                :estado_planificacion,
                :tipo_de_trabajo,
                :observaciones
            )";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':solicitud_id' => $data['solicitud_id'],
                ':tecnico_cedula' => $data['tecnico_cedula'],
                ':codigo_herramienta_asignada' => !empty($data['codigo_herramienta_asignada']) ? $data['codigo_herramienta_asignada'] : null,
                ':fecha_visita' => $data['fecha_visita'],
                ':direccion_visita' => $data['direccion_visita'],
                ':estado_planificacion' => $data['estado_planificacion'],
                ':tipo_de_trabajo' => $data['tipo_de_trabajo'],
                ':observaciones' => $data['observaciones'] ?? null
            ]);
            return ['estado' => 'ok', 'mensaje' => 'Orden de trabajo creada exitosamente.'];
        } catch (PDOException $e) {
            error_log("Error en OrdenTrabajoModel::crearOrden: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al crear la orden. Verifique que los IDs de Solicitud, Técnico y Herramienta existan.' : 'Error al crear la orden de trabajo: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar orden de trabajo
    public function modificarOrden($data) {
        try {
            $sql = "UPDATE orden_de_trabajo SET
                solicitud_id = :solicitud_id,
                tecnico_cedula = :tecnico_cedula,
                codigo_herramienta_asignada = :codigo_herramienta_asignada,
                fecha_visita = :fecha_visita,
                direccion_visita = :direccion_visita,
                estado_planificacion = :estado_planificacion,
                tipo_de_trabajo = :tipo_de_trabajo,
                observaciones = :observaciones
                WHERE id_orden = :id_orden";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id_orden' => $data['id_orden'],
                ':solicitud_id' => $data['solicitud_id'],
                ':tecnico_cedula' => $data['tecnico_cedula'],
                ':codigo_herramienta_asignada' => !empty($data['codigo_herramienta_asignada']) ? $data['codigo_herramienta_asignada'] : null,
                ':fecha_visita' => $data['fecha_visita'],
                ':direccion_visita' => $data['direccion_visita'],
                ':estado_planificacion' => $data['estado_planificacion'],
                ':tipo_de_trabajo' => $data['tipo_de_trabajo'],
                ':observaciones' => $data['observaciones'] ?? null
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Orden de trabajo modificada correctamente.'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en la orden de trabajo.'];
            }
        } catch (PDOException $e) {
            error_log("Error en OrdenTrabajoModel::modificarOrden: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar la orden. Verifique los IDs de Solicitud, Técnico y Herramienta.' : 'Error al modificar la orden de trabajo: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar orden de trabajo
    public function eliminarOrden($id_orden) {
        try {
            $sql = "DELETE FROM orden_de_trabajo WHERE id_orden = :id_orden";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_orden' => $id_orden]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Orden de trabajo eliminada correctamente.'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Orden de trabajo no encontrada.'];
            }
        } catch (PDOException $e) {
            error_log("Error en OrdenTrabajoModel::eliminarOrden: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar la orden de trabajo. Puede tener registros relacionados.' : 'Error al eliminar la orden de trabajo: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }
}
