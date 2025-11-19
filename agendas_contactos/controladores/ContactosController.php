<?php
require_once __DIR__ . '/../modelos/ContactoModel.php';

class ContactosController {
    
    private static function redirect($url) {
        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        }
        echo '<script>window.location.href="' . $url . '";</script>';
        exit;
    }

    public static function listar() {
        $busqueda = $_GET['q'] ?? '';
        $contactos = ContactoModel::obtenerTodos($busqueda);
        // Ya no incluimos header/footer aquí porque lo maneja index.php
        include __DIR__ . '/../vistas/contactos/listar.php';
    }

    public static function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $email = trim($_POST['email'] ?? '');
            
            // Validación del lado del servidor
            $errores = [];
            if (empty($nombre)) {
                $errores['nombre'] = 'El nombre es obligatorio';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'El email no es válido';
            }
            if (!empty($email) && ContactoModel::existeEmail($email)) {
                $errores['email'] = 'Este email ya está registrado';
            }
            if (!empty($telefono)) {
                // Validación de formato paraguayo
                $telefonoLimpio = preg_replace('/[\s\-]/', '', $telefono);
                // Patrón para números paraguayos:
                // +595 o 0 seguido de código de área (móvil 96x-99x o fijo 21-48) y 6-7 dígitos
                if (!preg_match('/^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$/', $telefonoLimpio)) {
                    $errores['telefono'] = 'Formato de teléfono paraguayo no válido (Ej: 0981-123-456, +595981123456)';
                }
            }

            if (empty($errores)) {
                if (ContactoModel::crear($nombre, $telefono, $email)) {
                    self::redirect('index.php?action=listar&success=1');
                } else {
                    $errores['general'] = 'Error al crear el contacto';
                }
            }
        }

        // Ya no incluimos header/footer aquí porque lo maneja index.php
        include __DIR__ . '/../vistas/contactos/crear.php';
    }

    public static function editar() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $favorito = isset($_POST['favorito']) ? 1 : 0;

            // Validación del lado del servidor
            $errores = [];
            if (empty($nombre)) {
                $errores['nombre'] = 'El nombre es obligatorio';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'El email no es válido';
            }
            if (!empty($email) && ContactoModel::existeEmail($email, $id)) {
                $errores['email'] = 'Este email ya está registrado en otro contacto';
            }
            if (!empty($telefono)) {
                // Verificar si el teléfono ya existe en otro contacto
                if (ContactoModel::existeTelefono($telefono, $id)) {
                    $errores['telefono'] = 'Este número de teléfono ya está registrado en otro contacto';
                }
                // Validación de formato paraguayo
                $telefonoLimpio = preg_replace('/[\s\-]/', '', $telefono);
                // Patrón para números paraguayos:
                // +595 o 0 seguido de código de área (móvil 96x-99x o fijo 21-48) y 6-7 dígitos
                if (!preg_match('/^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$/', $telefonoLimpio)) {
                    $errores['telefono'] = 'Formato de teléfono paraguayo no válido (Ej: 0981-123-456, +595981123456)';
                }
            }

            if (empty($errores)) {
                if (ContactoModel::actualizar($id, $nombre, $telefono, $email, $favorito)) {
                    self::redirect('index.php?action=listar&success=1');
                } else {
                    $errores['general'] = 'Error al actualizar el contacto';
                }
            }
        }
        
        $contacto = ContactoModel::obtenerPorId($id);
        if (!$contacto) {
            header('Location: index.php?action=listar&error=1');
            exit;
        }

        // Ya no incluimos header/footer aquí porque lo maneja index.php
        include __DIR__ . '/../vistas/contactos/editar.php';
    }

    public static function eliminar() {
        $id = $_GET['id'] ?? 0;
        if (ContactoModel::eliminar($id)) {
            self::redirect('index.php?action=listar&deleted=1');
        } else {
            self::redirect('index.php?action=listar&error=1');
        }
    }

    public static function toggleFavorito() {
        $id = $_GET['id'] ?? 0;
        if (ContactoModel::toggleFavorito($id)) {
            self::redirect('index.php?action=listar&updated=1');
        } else {
            self::redirect('index.php?action=listar&error=1');
        }
    }

    public static function eliminarSeleccionados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ids'])) {
            $ids = array_map('intval', $_POST['ids']);
            $errores = false;
            
            foreach ($ids as $id) {
                if (!ContactoModel::eliminar($id)) {
                    $errores = true;
                }
            }

            if (!$errores) {
                self::redirect('index.php?action=listar&deleted=' . count($ids));
            } else {
                self::redirect('index.php?action=listar&error=1');
            }
        }
        self::redirect('index.php?action=listar');
    }

    public static function vaciarLista() {
        if (ContactoModel::vaciarTabla()) {
            self::redirect('index.php?action=listar&cleared=1');
        } else {
            self::redirect('index.php?action=listar&error=1');
        }
    }
}
