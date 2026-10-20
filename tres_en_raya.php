<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres en raya</title>

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

        .tablero {
            width: 315px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 5px;
        }

        .casilla {
            width: 100px;
            height: 100px;
            background: #222;
            border: 2px solid white;
            font-size: 50px;
            color: white;
            cursor: pointer;
        }

        .casilla:hover {
            background: #333;
        }

        #mensaje {
            font-size: 22px;
            margin-top: 20px;
            font-weight: bold;
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

<h1>Tres en raya</h1>

<p>Tú eres <strong>X</strong> y el ordenador es <strong>O</strong></p>

<!-- Tablero del juego -->
<div class="tablero">
    <button class="casilla" onclick="jugar(0)" id="casilla0"></button>
    <button class="casilla" onclick="jugar(1)" id="casilla1"></button>
    <button class="casilla" onclick="jugar(2)" id="casilla2"></button>

    <button class="casilla" onclick="jugar(3)" id="casilla3"></button>
    <button class="casilla" onclick="jugar(4)" id="casilla4"></button>
    <button class="casilla" onclick="jugar(5)" id="casilla5"></button>

    <button class="casilla" onclick="jugar(6)" id="casilla6"></button>
    <button class="casilla" onclick="jugar(7)" id="casilla7"></button>
    <button class="casilla" onclick="jugar(8)" id="casilla8"></button>
</div>

<p id="mensaje">Tu turno</p>

<!-- Formulario que aparece al terminar la partida -->
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
let tablero = ["", "", "", "", "", "", "", "", ""];
let partidaTerminada = false;
let puntuacion = 0;

// Esta función se ejecuta cuando el jugador pulsa una casilla
function jugar(posicion) {
    if (partidaTerminada) {
        return;
    }

    if (tablero[posicion] !== "") {
        return;
    }

    tablero[posicion] = "X";
    document.getElementById("casilla" + posicion).textContent = "X";

    if (comprobarGanador("X")) {
        terminarPartida("Has ganado", 10);
        return;
    }

    if (tableroLleno()) {
        terminarPartida("Empate", 5);
        return;
    }

    turnoOrdenador();
}

// Esta función hace que el ordenador juegue en una casilla libre
function turnoOrdenador() {
    if (partidaTerminada) {
        return;
    }

    let casillasLibres = [];

    for (let i = 0; i < tablero.length; i++) {
        if (tablero[i] === "") {
            casillasLibres.push(i);
        }
    }

    if (casillasLibres.length === 0) {
        terminarPartida("Empate", 5);
        return;
    }

    let posicionAleatoria = Math.floor(Math.random() * casillasLibres.length);
    let posicionOrdenador = casillasLibres[posicionAleatoria];

    tablero[posicionOrdenador] = "O";
    document.getElementById("casilla" + posicionOrdenador).textContent = "O";

    if (comprobarGanador("O")) {
        terminarPartida("Has perdido", 0);
        return;
    }

    if (tableroLleno()) {
        terminarPartida("Empate", 5);
        return;
    }

    document.getElementById("mensaje").textContent = "Tu turno";
}

// Comprueba si el jugador indicado ha ganado
function comprobarGanador(jugador) {
    const combinacionesGanadoras = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],

        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],

        [0, 4, 8],
        [2, 4, 6]
    ];

    for (let i = 0; i < combinacionesGanadoras.length; i++) {
        let combinacion = combinacionesGanadoras[i];

        let a = combinacion[0];
        let b = combinacion[1];
        let c = combinacion[2];

        if (
            tablero[a] === jugador &&
            tablero[b] === jugador &&
            tablero[c] === jugador
        ) {
            return true;
        }
    }

    return false;
}

// Comprueba si ya no quedan casillas vacías
function tableroLleno() {
    for (let i = 0; i < tablero.length; i++) {
        if (tablero[i] === "") {
            return false;
        }
    }

    return true;
}

// Termina la partida y asigna la puntuación correspondiente
function terminarPartida(mensajeFinal, puntos) {
    partidaTerminada = true;
    puntuacion = puntos;

    document.getElementById("mensaje").textContent = mensajeFinal;
    document.getElementById("puntuacionFinal").textContent = puntuacion;
    document.getElementById("formularioPuntuacion").style.display = "block";
}

// Reinicia el tablero y oculta el formulario
function reiniciarJuego() {
    tablero = ["", "", "", "", "", "", "", "", ""];
    partidaTerminada = false;
    puntuacion = 0;

    for (let i = 0; i < tablero.length; i++) {
        document.getElementById("casilla" + i).textContent = "";
    }

    document.getElementById("mensaje").textContent = "Tu turno";
    document.getElementById("puntuacionFinal").textContent = "0";
    document.getElementById("formularioPuntuacion").style.display = "none";
    document.getElementById("nombreJugador").value = "";
    document.getElementById("mensajeGuardado").textContent = "";
}

// Envía la puntuación al archivo PHP para guardarla en la base de datos
function guardarPuntuacion() {
    const nombre = document.getElementById("nombreJugador").value.trim();
    const mensajeGuardado = document.getElementById("mensajeGuardado");

    if (nombre === "") {
        mensajeGuardado.textContent = "Tienes que escribir un nombre.";
        return;
    }

    const datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("juego", "tres_en_raya");
    datos.append("puntuacion", puntuacion);

    fetch("api/guardar_puntuacion.php", {
        method: "POST",
        body: datos
    })
    .then(function(respuesta) {
        return respuesta.text();
    })
    .then(function(texto) {
        mensajeGuardado.textContent = texto;
    })
    .catch(function(error) {
        mensajeGuardado.textContent = "Error al guardar la puntuación.";
        console.log(error);
    });
}
</script>

</body>
</html>