<?php

namespace App\Model;

use App\Config\Database;
use PDO;
use PDOException;

class CatalogoModel
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    // Listar todos los ítems del catálogo
    public function listarCatalogo()
    {
        try {
            $stmt = $this->pdo->query("SELECT codigo_de_herramienta, nombre, tipo, descripcion, cantidad_disponible FROM catalogo ORDER BY nombre ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en CatalogoModel::listarCatalogo: " . $e->getMessage());
            return ['estado' => 'error', 'mensaje' => 'Error al cargar los ítems del catálogo.'];
        }
    }

    // Verificar si un código de herramienta ya existe
    public function codigoExiste($codigo_de_herramienta)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM catalogo WHERE codigo_de_herramienta = :codigo_de_herramienta");
        $stmt->execute([':codigo_de_herramienta' => $codigo_de_herramienta]);
        return $stmt->fetchColumn() > 0;
    }

    // Crear nuevo ítem en el catálogo
    public function crear($data)
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO catalogo (codigo_de_herramienta, nombre, tipo, descripcion, cantidad_disponible)
                VALUES (:codigo_de_herramienta, :nombre, :tipo, :descripcion, :cantidad_disponible)
            ");
            $stmt->execute([
                ':codigo_de_herramienta' => $data['codigo_de_herramienta'],
                ':nombre' => $data['nombre'],
                ':tipo' => $data['tipo'],
                ':descripcion' => $data['descripcion'],
                ':cantidad_disponible' => $data['cantidad_disponible']
            ]);
            return ['estado' => 'ok'];
        } catch (PDOException $e) {
            error_log("Error en CatalogoModel::crear: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al guardar ítem. El código de herramienta ya existe.' : 'Error al guardar ítem.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Eliminar ítem del catálogo por código de herramienta
    public function eliminar($codigo_de_herramienta)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM catalogo WHERE codigo_de_herramienta = :codigo_de_herramienta");
            $stmt->bindValue(':codigo_de_herramienta', $codigo_de_herramienta, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'no_encontrado', 'mensaje' => 'Ítem del catálogo no encontrado.'];
            }
        } catch (PDOException $e) {
            error_log("Error en CatalogoModel::eliminar: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'No se pudo eliminar el ítem. Puede estar asociado a una orden de trabajo.' : 'No se pudo eliminar el ítem.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }

    // Modificar ítem del catálogo por código de herramienta
    public function modificar($data)
    {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE catalogo SET
                    nombre = :nombre,
                    tipo = :tipo,
                    descripcion = :descripcion,
                    cantidad_disponible = :cantidad_disponible
                WHERE codigo_de_herramienta = :codigo_de_herramienta
            ");
            $stmt->execute([
                ':codigo_de_herramienta' => $data['codigo_de_herramienta'],
                ':nombre' => $data['nombre'],
                ':tipo' => $data['tipo'],
                ':descripcion' => $data['descripcion'],
                ':cantidad_disponible' => $data['cantidad_disponible']
            ]);

            if ($stmt->rowCount() > 0) {
                return ['estado' => 'ok'];
            } else {
                return ['estado' => 'sin_cambios', 'mensaje' => 'No se realizaron cambios en el ítem del catálogo.'];
            }
        } catch (PDOException $e) {
            error_log("Error en CatalogoModel::modificar: " . $e->getMessage());
            $mensaje = ($e->getCode() == 23000) ? 'Error al modificar ítem. El código de herramienta ya existe.' : 'Error al modificar ítem.';
            return ['estado' => 'error', 'mensaje' => $mensaje];
        }
    }
}
