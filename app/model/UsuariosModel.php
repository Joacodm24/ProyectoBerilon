<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class UsuariosModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function listarUsuarios()
    {
        try {
            // Se selecciona el ID, nombre, usuario y cargo. La contraseña no se expone.
            $stmt = $this->pdo->query("SELECT id, nombre, usuario, cargo FROM usuarios ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UsuariosModel::listarUsuarios: " . $e->getMessage()); // Registrar el error
            return ['estado' => 'error', 'mensaje' => 'Error al cargar los usuarios.'];
        }
    }

    public function crear($data)
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO usuarios (nombre, usuario, contrasena, cargo)
                VALUES (:nombre, :usuario, :contrasena, :cargo)
            ");
            // La contraseña se usa directamente sin hashear, como solicitaste.
            $stmt->execute($data);
            return ['estado' => 'ok'];
        } catch (PDOException $e) {
            error_log("Error en UsuariosModel::crear: " . $e->getMessage()); // Registrar el error
            $mensaje = ($e->getCode() == 23000) ? 'Error al crear usuario. El nombre de usuario ya existe.' : 'Error al crear el usuario.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    public function modificar($data)
    {
        try {
            $sql = "UPDATE usuarios SET nombre = :nombre, usuario = :usuario, cargo = :cargo";
            $params = [
                ':nombre'  => $data[':nombre'],
                ':usuario' => $data[':usuario'],
                ':cargo'   => $data[':cargo'],
                ':id'      => $data[':id']
            ];

            // Si se proporciona una nueva contraseña (no vacía), se añade a la consulta.
            if (isset($data[':contrasena']) && !empty($data[':contrasena'])) {
                $sql .= ", contrasena = :contrasena";
                $params[':contrasena'] = $data[':contrasena'];
            }

            $sql .= " WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en el usuario.'];
            }
        } catch (PDOException $e) {
            error_log("Error en UsuariosModel::modificar: " . $e->getMessage()); // Registrar el error
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar usuario. El nombre de usuario ya existe.' : 'Error al modificar el usuario.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    public function eliminar($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Usuario no encontrado.'];
            }
        } catch (PDOException $e) {
            error_log("Error en UsuariosModel::eliminar: " . $e->getMessage()); // Registrar el error
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar el usuario. Puede tener registros relacionados.' : 'Error al eliminar el usuario.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    public function usuarioExiste($usuario)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario");
        $stmt->execute([':usuario' => $usuario]);
        return $stmt->fetchColumn() > 0;
    }
}
