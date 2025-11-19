<?php
require_once __DIR__ . '/../bd.php';

class ContactoModel {

    public static function obtenerTodos($busqueda = '') {
        global $pdo;
        if ($busqueda) {
            $stmt = $pdo->prepare("SELECT * FROM contactos WHERE nombre LIKE :q OR telefono LIKE :q OR email LIKE :q ORDER BY favorito DESC, nombre ASC");
            $stmt->execute(['q' => "%$busqueda%"]);
        } else {
            $stmt = $pdo->query("SELECT * FROM contactos ORDER BY favorito DESC, nombre ASC");
        }
        return $stmt->fetchAll();
    }

    public static function obtenerPorId($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function crear($nombre, $telefono, $email) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO contactos (nombre, telefono, email) VALUES (:n, :t, :e)");
        return $stmt->execute(['n'=>$nombre,'t'=>$telefono,'e'=>$email]);
    }

    public static function existeEmail($email, $excluirId = null) {
        global $pdo;
        // Si el email está vacío, retornar false
        if (empty($email)) {
            return false;
        }
        if ($excluirId) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contactos WHERE email = :email AND id != :id");
            $stmt->execute(['email' => $email, 'id' => $excluirId]);
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contactos WHERE email = :email");
            $stmt->execute(['email' => $email]);
        }
        return $stmt->fetchColumn() > 0;
    }

    public static function existeTelefono($telefono, $excluirId = null) {
        global $pdo;
        // Si el teléfono está vacío, retornar false
        if (empty($telefono)) {
            return false;
        }
        if ($excluirId) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contactos WHERE telefono = :telefono AND id != :id");
            $stmt->execute(['telefono' => $telefono, 'id' => $excluirId]);
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM contactos WHERE telefono = :telefono");
            $stmt->execute(['telefono' => $telefono]);
        }
        return $stmt->fetchColumn() > 0;
    }

    public static function actualizar($id, $nombre, $telefono, $email, $favorito) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE contactos SET nombre=:n, telefono=:t, email=:e, favorito=:f WHERE id=:id");
        return $stmt->execute(['n'=>$nombre,'t'=>$telefono,'e'=>$email,'f'=>$favorito,'id'=>$id]);
    }

    public static function eliminar($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM contactos WHERE id = :id");
        return $stmt->execute(['id'=>$id]);
    }

    public static function toggleFavorito($id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE contactos SET favorito = NOT favorito WHERE id = :id");
        return $stmt->execute(['id'=>$id]);
    }

    public static function vaciarTabla() {
        global $pdo;
        $stmt = $pdo->prepare("TRUNCATE TABLE contactos");
        return $stmt->execute();
    }
}
