<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class ClientesModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Listar todos los clientes
    public function listarClientes() {
        try {
            $stmt = $this->db->prepare("SELECT cedula, nombre, apellido, correo, telefono, direccion FROM Cliente");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ClientesModel::listarClientes: " . $e->getMessage());
            return ['estado' => 'error', 'mensaje' => 'Error al cargar los clientes.'];
        }
    }

    // Crear nuevo cliente
    public function crearCliente($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Cliente (cedula, nombre, apellido, correo, telefono, direccion)
                                         VALUES (:cedula, :nombre, :apellido, :correo, :telefono, :direccion)");
            $stmt->execute([
                ':cedula' => $data['cedula'],
                ':nombre' => $data['nombre'],
                ':apellido' => $data['apellido'],
                ':correo' => $data['correo'],
                ':telefono' => $data['telefono'],
                ':direccion' => $data['direccion']
                // 'organizacion' y 'sede' eliminados
            ]);
            return ['estado' => 'ok'];
        } catch (PDOException $e) {
            error_log("Error en ClientesModel::crearCliente: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al guardar cliente. La cédula ya existe.' : 'Error al guardar cliente.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar cliente por cedula
    public function modificarCliente($data) {
        try {
            $stmt = $this->db->prepare("UPDATE Cliente
                                         SET nombre = :nombre,
                                             apellido = :apellido,
                                             correo = :correo,
                                             telefono = :telefono,
                                             direccion = :direccion
                                         WHERE cedula = :cedula_original");
            $stmt->execute([
                ':nombre' => $data['nombre'],
                ':apellido' => $data['apellido'],
                ':correo' => $data['correo'],
                ':telefono' => $data['telefono'],
                ':direccion' => $data['direccion'],
                ':cedula_original' => $data['cedula'] 
                // 'organizacion' y 'sede' eliminados
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en el cliente.'];
            }
        } catch (PDOException $e) {
            error_log("Error en ClientesModel::modificarCliente: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar cliente. La nueva cédula ya existe.' : 'Error al modificar cliente.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar cliente por cedula
    public function eliminarCliente($cedula) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Cliente WHERE cedula = :cedula");
            $stmt->bindValue(':cedula', $cedula, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Cliente no encontrado.'];
            }
        } catch (PDOException $e) {
            error_log("Error en ClientesModel::eliminarCliente: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar el cliente. Puede tener solicitudes asociadas.' : 'No se pudo eliminar el cliente.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Verificar si un cliente existe por cédula
    public function clienteExiste($cedula) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Cliente WHERE cedula = :cedula");
        $stmt->execute([':cedula' => $cedula]);
        return $stmt->fetchColumn() > 0;
    }
}
