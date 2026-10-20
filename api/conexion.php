<?php
// Configuración mediante variables de entorno. No guardar credenciales en Git.
$host = getenv('DB_HOST') ?: '127.0.0.1';
$baseDatos = getenv('DB_NAME') ?: 'minijuegos_db';
$usuario = getenv('DB_USER') ?: 'minijuegos_app';
$password = getenv('DB_PASSWORD');

if ($password === false) {
    http_response_code(500);
    exit('Falta configurar DB_PASSWORD en el servidor.');
}

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$baseDatos;charset=utf8mb4",
        $usuario,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES => false]
    );
} catch (PDOException $e) {
    error_log('Error de conexión a base de datos: ' . $e->getMessage());
    http_response_code(500);
    exit('No se ha podido conectar con la base de datos.');
}
