<?php
// Vista de inicio: muestra la lista de contactos con título o el formulario de crear
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cargar el controlador de contactos
require_once __DIR__ . '/../../controladores/ContactosController.php';

// Determinar la acción basada en los parámetros de la URL
$accion = $_GET['action'] ?? 'listar';

// Encabezado común
include __DIR__ . '/../header.php';
?>

<main>
    <?php
    // Ejecutar la acción correspondiente
    switch ($accion) {
        case 'crear':
            ContactosController::crear();
            break;
        case 'editar':
            ContactosController::editar();
            break;
        case 'eliminar':
            ContactosController::eliminar();
            break;
        case 'toggleFavorito':
            ContactosController::toggleFavorito();
            break;
        case 'eliminarSeleccionados':
            ContactosController::eliminarSeleccionados();
            break;
        case 'vaciarLista':
            ContactosController::vaciarLista();
            break;
        case 'listar':
        default:
            echo '<h1>Lista de contactos</h1>';
            ContactosController::listar();
            break;
    }
    ?>
</main>

<?php
// Pie de página común
include __DIR__ . '/../footer.php';
