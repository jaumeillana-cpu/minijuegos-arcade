<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pong</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111;
            color: white;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
        }

        canvas {
            background: black;
            border: 3px solid white;
            margin-top: 20px;
        }

        .info {
            margin-top: 15px;
            font-size: 18px;
        }

        #formularioPuntuacion {
            display: none;
            margin: 20px auto;
            padding: 20px;
            width: 350px;
            background: #222;
            border: 2px solid white;
            border-radius: 10px;
        }

        input {
            padding: 10px;
            font-size: 16px;
            text-align: center;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        a {
            color: white;
            display: block;
            margin-top: 20px;
        }

        #mensajeGuardado {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<h1>Pong</h1>

<!--
Línea usada durante las pruebas para comprobar que se estaba cargando
el archivo pong.php correcto.
<p class="version">VERSIÓN CORREGIDA - FIN DE PARTIDA ACTIVO</p>
-->

<canvas id="juego" width="700" height="400"></canvas>

<div class="info">
    <p>Puntuación: <span id="puntuacion">0</span></p>
    <p>Usa las teclas ↑ y ↓ para mover la pala</p>
</div>

<div id="formularioPuntuacion">
    <h2>Guardar puntuación</h2>

    <p>Puntuación final: <span id="puntuacionFinal">0</span></p>

    <input 
        type="text" 
        id="nombreJugador" 
        placeholder="Escribe tu nombre"
        maxlength="50"
    >

    <br>

    <button onclick="guardarPuntuacion()">Guardar puntuación</button>

    <p id="mensajeGuardado"></p>
</div>

<button onclick="reiniciarJuego()">Reiniciar</button>

<a href="index.php">Volver al menú</a>

<script>
const canvas = document.getElementById("juego");
const ctx = canvas.getContext("2d");

let puntuacion = 0;
let juegoTerminado = false;
let animacion;

let pala = {
    x: 30,
    y: 160,
    ancho: 12,
    alto: 80,
    velocidad: 7
};

let pelota = {
    x: 350,
    y: 200,
    radio: 8,
    velocidadX: -4,
    velocidadY: 4
};

let teclaArriba = false;
let teclaAbajo = false;

// Detecta cuándo se pulsan las teclas para mover la pala
document.addEventListener("keydown", function(evento) {
    if (evento.key === "ArrowUp") {
        teclaArriba = true;
    }

    if (evento.key === "ArrowDown") {
        teclaAbajo = true;
    }
});

// Detecta cuándo se dejan de pulsar las teclas
document.addEventListener("keyup", function(evento) {
    if (evento.key === "ArrowUp") {
        teclaArriba = false;
    }

    if (evento.key === "ArrowDown") {
        teclaAbajo = false;
    }
});

// Dibuja la pala del jugador
function dibujarPala() {
    ctx.fillStyle = "white";
    ctx.fillRect(pala.x, pala.y, pala.ancho, pala.alto);
}

// Dibuja la pelota
function dibujarPelota() {
    ctx.beginPath();
    ctx.arc(pelota.x, pelota.y, pelota.radio, 0, Math.PI * 2);
    ctx.fillStyle = "white";
    ctx.fill();
    ctx.closePath();
}

// Texto que aparece cuando termina la partida
function dibujarTextoFinal() {
    ctx.fillStyle = "white";
    ctx.font = "32px Arial";
    ctx.fillText("Fin del juego", 255, 180);

    ctx.font = "22px Arial";
    ctx.fillText("Puntuación final: " + puntuacion, 255, 220);
}

// Mueve la pala hacia arriba o abajo
function moverPala() {
    if (teclaArriba && pala.y > 0) {
        pala.y -= pala.velocidad;
    }

    if (teclaAbajo && pala.y + pala.alto < canvas.height) {
        pala.y += pala.velocidad;
    }
}

// Mueve la pelota y comprueba rebotes y colisiones
function moverPelota() {
    pelota.x += pelota.velocidadX;
    pelota.y += pelota.velocidadY;

    // Rebote arriba
    if (pelota.y - pelota.radio <= 0) {
        pelota.velocidadY *= -1;
    }

    // Rebote abajo
    if (pelota.y + pelota.radio >= canvas.height) {
        pelota.velocidadY *= -1;
    }

    // Rebote en la pared derecha
    if (pelota.x + pelota.radio >= canvas.width) {
        pelota.velocidadX *= -1;
    }

    /*
    Cuando la pelota llega a la zona de la pala:
    si toca la pala, rebota y suma un punto;
    si no toca la pala, termina la partida.
    */
    if (pelota.velocidadX < 0 && pelota.x - pelota.radio <= pala.x + pala.ancho) {

        const tocaPala =
            pelota.y + pelota.radio >= pala.y &&
            pelota.y - pelota.radio <= pala.y + pala.alto;

        if (tocaPala) {
            pelota.velocidadX = Math.abs(pelota.velocidadX);
            pelota.x = pala.x + pala.ancho + pelota.radio;

            puntuacion++;
            document.getElementById("puntuacion").textContent = puntuacion;
        } else {
            terminarJuego();
            return;
        }
    }

    // Seguridad extra por si la pelota sale por la izquierda
    if (pelota.x + pelota.radio < 0) {
        terminarJuego();
        return;
    }
}

// Finaliza la partida y muestra el formulario para guardar
function terminarJuego() {
    juegoTerminado = true;
    cancelAnimationFrame(animacion);

    document.getElementById("puntuacionFinal").textContent = puntuacion;
    document.getElementById("formularioPuntuacion").style.display = "block";

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    dibujarTextoFinal();
}

// Bucle principal del juego
function actualizarJuego() {
    if (juegoTerminado) {
        return;
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    moverPala();
    moverPelota();

    if (!juegoTerminado) {
        dibujarPala();
        dibujarPelota();
        animacion = requestAnimationFrame(actualizarJuego);
    }
}

// Reinicia la partida desde cero
function reiniciarJuego() {
    cancelAnimationFrame(animacion);

    puntuacion = 0;
    juegoTerminado = false;

    document.getElementById("puntuacion").textContent = "0";
    document.getElementById("puntuacionFinal").textContent = "0";
    document.getElementById("formularioPuntuacion").style.display = "none";
    document.getElementById("nombreJugador").value = "";
    document.getElementById("mensajeGuardado").textContent = "";

    pala.y = 160;

    pelota.x = 350;
    pelota.y = 200;
    pelota.velocidadX = -4;
    pelota.velocidadY = 4;

    actualizarJuego();
}

// Envía la puntuación al archivo PHP para guardarla en la base de datos
function guardarPuntuacion() {
    const nombre = document.getElementById("nombreJugador").value.trim();
    const mensaje = document.getElementById("mensajeGuardado");

    if (nombre === "") {
        mensaje.textContent = "Tienes que escribir un nombre.";
        return;
    }

    const datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("juego", "pong");
    datos.append("puntuacion", puntuacion);

    fetch("api/guardar_puntuacion.php", {
        method: "POST",
        body: datos
    })
    .then(function(respuesta) {
        return respuesta.text();
    })
    .then(function(texto) {
        mensaje.textContent = texto;
    })
    .catch(function(error) {
        mensaje.textContent = "Error al guardar la puntuación.";
        console.log(error);
    });
}

// Inicia el juego al cargar la página
actualizarJuego();
</script>

</body>
</html>