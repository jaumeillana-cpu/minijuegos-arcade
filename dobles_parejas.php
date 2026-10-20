<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dobles parejas</title>

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
            width: 440px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(4, 100px);
            gap: 10px;
        }

        .carta {
            width: 100px;
            height: 100px;
            background: #222;
            border: 2px solid white;
            color: white;
            font-size: 40px;
            cursor: pointer;
            border-radius: 10px;
        }

        .carta:hover {
            background: #333;
        }

        .carta.descubierta {
            background: #444;
            cursor: default;
        }

        .carta.acertada {
            background: #1d5c3b;
            cursor: default;
        }

        .info {
            font-size: 20px;
            margin-top: 15px;
        }

        #mensaje {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
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

<h1>Dobles parejas</h1>

<p>Encuentra todas las parejas con el menor número de intentos posible.</p>

<div class="info">
    <p>Intentos: <span id="intentos">0</span></p>
</div>

<!-- Aquí se crea el tablero de cartas con JavaScript -->
<div class="tablero" id="tablero"></div>

<p id="mensaje">Selecciona dos cartas</p>

<!-- Formulario que aparece cuando se termina la partida -->
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
let cartas = ["🍎", "🍎", "🍌", "🍌", "🍇", "🍇", "🍒", "🍒"];

let primeraCarta = null;
let segundaCarta = null;
let bloquearTablero = false;

let intentos = 0;
let parejasEncontradas = 0;
let puntuacion = 0;

// Mezcla las cartas para que cada partida sea diferente
function mezclarCartas() {
    cartas.sort(function() {
        return Math.random() - 0.5;
    });
}

// Crea los botones de las cartas dentro del tablero
function crearTablero() {
    const tablero = document.getElementById("tablero");
    tablero.innerHTML = "";

    for (let i = 0; i < cartas.length; i++) {
        const boton = document.createElement("button");

        boton.className = "carta";
        boton.id = "carta" + i;
        boton.dataset.valor = cartas[i];
        boton.textContent = "?";

        boton.onclick = function() {
            seleccionarCarta(i);
        };

        tablero.appendChild(boton);
    }
}

// Se ejecuta cuando el jugador pulsa una carta
function seleccionarCarta(posicion) {
    if (bloquearTablero) {
        return;
    }

    const carta = document.getElementById("carta" + posicion);

    if (carta.classList.contains("acertada")) {
        return;
    }

    if (carta === primeraCarta) {
        return;
    }

    carta.textContent = carta.dataset.valor;
    carta.classList.add("descubierta");

    if (primeraCarta === null) {
        primeraCarta = carta;
        return;
    }

    segundaCarta = carta;
    intentos++;

    document.getElementById("intentos").textContent = intentos;

    comprobarPareja();
}

// Comprueba si las dos cartas seleccionadas son iguales
function comprobarPareja() {
    const valor1 = primeraCarta.dataset.valor;
    const valor2 = segundaCarta.dataset.valor;

    if (valor1 === valor2) {
        primeraCarta.classList.add("acertada");
        segundaCarta.classList.add("acertada");

        primeraCarta = null;
        segundaCarta = null;

        parejasEncontradas++;

        document.getElementById("mensaje").textContent = "¡Pareja encontrada!";

        if (parejasEncontradas === 4) {
            terminarPartida();
        }
    } else {
        bloquearTablero = true;

        document.getElementById("mensaje").textContent = "No son pareja";

        setTimeout(function() {
            primeraCarta.textContent = "?";
            segundaCarta.textContent = "?";

            primeraCarta.classList.remove("descubierta");
            segundaCarta.classList.remove("descubierta");

            primeraCarta = null;
            segundaCarta = null;
            bloquearTablero = false;

            document.getElementById("mensaje").textContent = "Selecciona dos cartas";
        }, 1000);
    }
}

// Calcula la puntuación final según los intentos realizados
function calcularPuntuacion() {
    let resultado = 100 - intentos;

    if (resultado < 0) {
        resultado = 0;
    }

    return resultado;
}

// Termina la partida y muestra el formulario para guardar
function terminarPartida() {
    puntuacion = calcularPuntuacion();

    document.getElementById("mensaje").textContent = "¡Has encontrado todas las parejas!";
    document.getElementById("puntuacionFinal").textContent = puntuacion;
    document.getElementById("formularioPuntuacion").style.display = "block";
}

// Reinicia el juego desde cero
function reiniciarJuego() {
    primeraCarta = null;
    segundaCarta = null;
    bloquearTablero = false;

    intentos = 0;
    parejasEncontradas = 0;
    puntuacion = 0;

    document.getElementById("intentos").textContent = "0";
    document.getElementById("mensaje").textContent = "Selecciona dos cartas";
    document.getElementById("puntuacionFinal").textContent = "0";
    document.getElementById("formularioPuntuacion").style.display = "none";
    document.getElementById("nombreJugador").value = "";
    document.getElementById("mensajeGuardado").textContent = "";

    mezclarCartas();
    crearTablero();
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
    datos.append("juego", "dobles_parejas");
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

// Inicia el juego al cargar la página
mezclarCartas();
crearTablero();
</script>

</body>
</html>