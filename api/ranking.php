<?php

require_once "conexion.php";

try {
    // Consulta para obtener las 5 mejores puntuaciones
    $sql = "SELECT jugadores.nombre AS jugador,
                   juegos.nombre AS juego,
                   puntuaciones.puntuacion,
                   puntuaciones.fecha
            FROM puntuaciones
            INNER JOIN jugadores ON puntuaciones.jugador_id = jugadores.id
            INNER JOIN juegos ON puntuaciones.juego_id = juegos.id
            ORDER BY puntuaciones.puntuacion DESC, puntuaciones.fecha DESC
            LIMIT 5";

    $consulta = $conexion->prepare($sql);
    $consulta->execute();

    $ranking = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos los datos en formato JSON para usarlos desde JavaScript
    header("Content-Type: application/json");
    echo json_encode($ranking);

} catch (PDOException $e) {
    error_log("Error al obtener ranking: " . $e->getMessage());
    http_response_code(500);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["error" => "No se ha podido cargar el ranking."]);
}