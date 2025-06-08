<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;


class TecnicosModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Listar técnicos
    public function listarTecnicos() {
        try {
            $stmt = $this->db->prepare("SELECT cedula, nombre, apellido, cargo, direccion, correo, telefono, especializacion FROM PersonalTecnico");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['estado' => 'error', 'mensaje' => 'Error al cargar los técnicos: ' . $e->getMessage()];
        }
    }

    // Crear técnico
    public function crearTecnico($data) {
        try {
            $sql = "INSERT INTO PersonalTecnico
                (cedula, nombre, apellido, cargo, direccion, correo, telefono, especializacion)
                VALUES (:cedula, :nombre, :apellido, :cargo, :direccion, :correo, :telefono, :especializacion)";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':cedula' => $data['cedula'],
                ':nombre' => $data['nombre'],
                ':apellido' => $data['apellido'],
                ':cargo' => $data['cargo'],
                ':direccion' => $data['direccion'],
                ':correo' => $data['correo'],
                ':telefono' => $data['telefono'],
                ':especializacion' => $data['especializacion']
            ]);
            return ['estado' => 'ok', 'mensaje' => 'Técnico registrado exitosamente.'];
        } catch (PDOException $e) {
            $mensaje = ($e->getCode() == 23000) ? 'Error al guardar técnico. La cédula ya existe.' : 'Error al guardar técnico: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar técnico
    public function modificarTecnico($data) {
        try {
            $sql = "UPDATE PersonalTecnico SET
                nombre = :nombre,
                apellido = :apellido,
                cargo = :cargo,
                direccion = :direccion,
                correo = :correo,
                telefono = :telefono,
                especializacion = :especializacion
                WHERE cedula = :cedula"; // Actualiza por cédula

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':cedula' => $data['cedula'], 
                ':nombre' => $data['nombre'],
                ':apellido' => $data['apellido'],
                ':cargo' => $data['cargo'],
                ':direccion' => $data['direccion'],
                ':correo' => $data['correo'],
                ':telefono' => $data['telefono'],
                ':especializacion' => $data['especializacion']
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Técnico modificado correctamente.'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en el técnico.'];
            }
        } catch (PDOException $e) {
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar técnico. La cédula ya existe.' : 'Error al modificar técnico: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar técnico
    public function eliminarTecnico($cedula) {
        try {
            $sql = "DELETE FROM PersonalTecnico WHERE cedula = :cedula"; // Elimina por cédula
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok', 'mensaje' => 'Técnico eliminado correctamente.'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Técnico no encontrado.'];
            }
        } catch (PDOException $e) {
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar el técnico. Puede tener órdenes de trabajo asociadas.' : 'No se pudo eliminar el técnico: ' . $e->getMessage();
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }
}
