<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class EmpresasModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Listar todas las empresas
    public function listarEmpresas() {
        try {
            $stmt = $this->db->prepare("SELECT RIF, nombre, direccion_fiscal, numero_telefono, email FROM Empresas ORDER BY nombre ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en EmpresasModel::listarEmpresas: " . $e->getMessage());
            return ['estado' => 'error', 'mensaje' => 'Error al cargar las empresas.'];
        }
    }

    // Crear nueva empresa
    public function crearEmpresa($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Empresas (RIF, nombre, direccion_fiscal, numero_telefono, email)
                                         VALUES (:RIF, :nombre, :direccion_fiscal, :numero_telefono, :email)");
            $stmt->execute([
                ':RIF' => $data['RIF'],
                ':nombre' => $data['nombre'],
                ':direccion_fiscal' => $data['direccion_fiscal'],
                ':numero_telefono' => $data['numero_telefono'],
                ':email' => $data['email']
            ]);
            return ['estado' => 'ok'];
        } catch (PDOException $e) {
            error_log("Error en EmpresasModel::crearEmpresa: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al guardar empresa. El RIF o Email ya existen.' : 'Error al guardar empresa.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar empresa por RIF
    public function modificarEmpresa($data) {
        try {
            $stmt = $this->db->prepare("UPDATE Empresas
                                         SET nombre = :nombre,
                                             direccion_fiscal = :direccion_fiscal,
                                             numero_telefono = :numero_telefono,
                                             email = :email
                                         WHERE RIF = :RIF_original");
            $stmt->execute([
                ':nombre' => $data['nombre'],
                ':direccion_fiscal' => $data['direccion_fiscal'],
                ':numero_telefono' => $data['numero_telefono'],
                ':email' => $data['email'],
                ':RIF_original' => $data['RIF'] // El RIF se usa como identificador
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en la empresa.'];
            }
        } catch (PDOException $e) {
            error_log("Error en EmpresasModel::modificarEmpresa: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar empresa. El nuevo RIF o Email ya existen.' : 'Error al modificar empresa.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar empresa por RIF
    public function eliminarEmpresa($RIF) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Empresas WHERE RIF = :RIF");
            $stmt->bindValue(':RIF', $RIF, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Empresa no encontrada.'];
            }
        } catch (PDOException $e) {
            error_log("Error en EmpresasModel::eliminarEmpresa: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar la empresa. Puede tener solicitudes asociadas.' : 'No se pudo eliminar la empresa.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Verificar si una empresa existe por RIF
    public function empresaExiste($RIF) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Empresas WHERE RIF = :RIF");
        $stmt->execute([':RIF' => $RIF]);
        return $stmt->fetchColumn() > 0;
    }
}
