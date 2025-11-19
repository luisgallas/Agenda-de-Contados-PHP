<?php
require_once __DIR__ . '/modelos/ContactoModel.php';
header('Content-Type: application/json');
$email = trim($_POST['email'] ?? '');
$excluirId = isset($_POST['excluirId']) ? $_POST['excluirId'] : null;
if (!$email) {
    echo json_encode(['existe' => false]);
    exit;
}
if (ContactoModel::existeEmail($email, $excluirId)) {
    echo json_encode(['existe' => true]);
} else {
    echo json_encode(['existe' => false]);
}
