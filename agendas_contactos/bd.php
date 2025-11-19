<?php
$host = 'localhost';
$port = 3306;
$dbname = 'agenda_contactos';
$user = 'root';
$pass = '';

try {
    // Primero conectamos sin seleccionar base de datos
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Leemos el archivo SQL
    $sql = file_get_contents(__DIR__ . '/database.sql');
    
    // Ejecutamos las consultas del archivo SQL
    $pdo->exec($sql);
    
    // Reconectamos seleccionando la base de datos
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Verificamos si hay datos en la tabla contactos
    $stmt = $pdo->query("SELECT COUNT(*) FROM contactos");
    $count = $stmt->fetchColumn();
    
   /* if ($count > 0) {
        echo "✅ Conexión DB exitosa - Base de datos ya contiene datos";
    } else {
        echo "✅ Conexión DB exitosa - Base de datos inicializada con datos de ejemplo";
    }*/

} catch (PDOException $e) {
    die("❌ Error conexión DB: " . $e->getMessage());
}
