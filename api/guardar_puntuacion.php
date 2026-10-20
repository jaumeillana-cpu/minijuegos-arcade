<?php

require_once "conexion.php";

// Recogemos los datos enviados desde el juego
$nombre = trim($_POST["nombre"] ?? "");
$juegoCodigo = trim($_POST["juego"] ?? "");
$puntuacion = trim($_POST["puntuacion"] ?? "");

// Comprobamos que no falte ningún dato
if ($nombre === "" || $juegoCodigo === "" || $puntuacion === "") {
    echo "Error: faltan datos para guardar la puntuación.";
    exit;
}

// Comprobamos que la puntuación sea un número
if (!is_numeric($puntuacion)) {
    echo "Error: la puntuación no es válida.";
    exit;
}

try {
    // Insertamos el jugador si no existe
    $sqlJugador = "INSERT INTO jugadores (nombre)
                   VALUES (:nombre)
                   ON DUPLICATE KEY UPDATE nombre = nombre";

    $consultaJugador = $conexion->prepare($sqlJugador);
    $consultaJugador->execute([
        ":nombre" => $nombre
    ]);

    $jugadorId = $conexion->lastInsertId();

    // Si el jugador ya existía, buscamos su id
    if ($jugadorId == 0) {
        $sqlBuscarJugador = "SELECT id FROM jugadores WHERE nombre = :nombre";

        $consultaBuscarJugador = $conexion->prepare($sqlBuscarJugador);
        $consultaBuscarJugador->execute([
            ":nombre" => $nombre
        ]);

        $jugador = $consultaBuscarJugador->fetch(PDO::FETCH_ASSOC);
        $jugadorId = $jugador["id"];
    }

    // Buscamos el juego en la tabla juegos usando su código
    $sqlBuscarJuego = "SELECT id FROM juegos WHERE codigo = :codigo";

    $consultaJuego = $conexion->prepare($sqlBuscarJuego);
    $consultaJuego->execute([
        ":codigo" => $juegoCodigo
    ]);

    $juego = $consultaJuego->fetch(PDO::FETCH_ASSOC);

    if (!$juego) {
        echo "Error: el juego no existe en la base de datos.";
        exit;
    }

    $juegoId = $juego["id"];

    // Guardamos la puntuación relacionada con el jugador y el juego
    $sqlPuntuacion = "INSERT INTO puntuaciones (jugador_id, juego_id, juego, puntuacion)
                      VALUES (:jugador_id, :juego_id, :juego, :puntuacion)";

    $consultaPuntuacion = $conexion->prepare($sqlPuntuacion);
    $consultaPuntuacion->execute([
        ":jugador_id" => $jugadorId,
        ":juego_id" => $juegoId,
        ":juego" => $juegoCodigo,
        ":puntuacion" => $puntuacion
    ]);

    echo "Puntuación guardada correctamente";

} catch (PDOException $e) {
    error_log("Error al guardar puntuación: " . $e->getMessage());
    http_response_code(500);
    echo "No se ha podido guardar la puntuación.";
}