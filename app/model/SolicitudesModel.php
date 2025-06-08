<?php

namespace App\Model; // Asegúrate de que esta línea esté presente y sea correcta

use App\Config\Database; // Importa la clase Database desde su namespace
use PDO;
use PDOException;

class SolicitudesModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Listar solicitudes
    public function listarSolicitudes() {
        try {
            $sql = "SELECT id_solicitud, cedula_cliente, empresa_rif, descripcion, fecha, estado_ticket, prioridad
                    FROM Solicitudes ORDER BY fecha DESC, prioridad ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::listarSolicitudes: " . $e->getMessage());
            return ['estado' => 'error', 'mensaje' => 'Error al cargar las solicitudes.'];
        }
    }

    // Crear solicitud
    public function crearSolicitud($datos) {
        try {
            $sql = "INSERT INTO Solicitudes (cedula_cliente, empresa_rif, descripcion, fecha, estado_ticket, prioridad)
                    VALUES (:cedula_cliente, :empresa_rif, :descripcion, :fecha, :estado_ticket, :prioridad)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':cedula_cliente' => $datos['cedula_cliente'],
                ':empresa_rif' => $datos['empresa_rif'],
                ':descripcion' => $datos['descripcion'],
                ':fecha' => $datos['fecha'],
                ':estado_ticket' => $datos['estado_ticket'],
                ':prioridad' => $datos['prioridad']
            ]);
            return ['estado' => 'ok', 'mensaje' => 'Solicitud registrada exitosamente'];
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::crearSolicitud: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al registrar la solicitud. La cédula de cliente o RIF de empresa no existen.' : 'Error al registrar la solicitud: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar solicitud
    public function modificarSolicitud($datos) {
        try {
            $sql = "UPDATE Solicitudes SET
                        cedula_cliente = :cedula_cliente,
                        empresa_rif = :empresa_rif,
                        descripcion = :descripcion,
                        fecha = :fecha,
                        estado_ticket = :estado_ticket,
                        prioridad = :prioridad
                    WHERE id_solicitud = :id_solicitud";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_solicitud' => $datos['id_solicitud'],
                ':cedula_cliente' => $datos['cedula_cliente'],
                ':empresa_rif' => $datos['empresa_rif'],
                ':descripcion' => $datos['descripcion'],
                ':fecha' => $datos['fecha'],
                ':estado_ticket' => $datos['estado_ticket'],
                ':prioridad' => $datos['prioridad']
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Solicitud modificada correctamente'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en la solicitud.'];
            }
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::modificarSolicitud: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar la solicitud. La cédula de cliente o RIF de empresa no existen.' : 'Error al modificar la solicitud: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar solicitud
    public function eliminarSolicitud($id_solicitud) {
        try {
            $sql = "DELETE FROM Solicitudes WHERE id_solicitud = :id_solicitud";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_solicitud' => $id_solicitud]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Solicitud eliminada correctamente'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Solicitud no encontrada.'];
            }
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::eliminarSolicitud: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar la solicitud. Puede tener órdenes de trabajo asociadas.' : 'Error al eliminar la solicitud: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Métodos para obtener clientes y empresas (para futuros selects, no usados directamente ahora)
    public function obtenerClientesParaSelect() {
        try {
            $stmt = $this->db->query("SELECT cedula, nombre, apellido FROM Cliente ORDER BY nombre ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::obtenerClientesParaSelect: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerEmpresasParaSelect() {
        try {
            $stmt = $this->db->query("SELECT RIF, nombre FROM Empresas ORDER BY nombre ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en SolicitudesModel::obtenerEmpresasParaSelect: " . $e->getMessage());
            return [];
        }
    }
}
