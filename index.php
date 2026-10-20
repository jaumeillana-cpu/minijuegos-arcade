<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minijuegos Arcade</title>

    <!-- Bootstrap para maquetación responsive -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <!-- Fuente estilo arcade retro -->
    <link 
        href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" 
        rel="stylesheet"
    >

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            color: white;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top, #2b1055 0%, #111 40%, #050505 100%);
        }

        .hero {
            padding: 55px 20px 35px 20px;
            text-align: center;
        }

        .titulo-arcade {
            font-family: 'Press Start 2P', Arial, sans-serif;
            font-size: 34px;
            color: #00f7ff;
            text-shadow:
                0 0 5px #00f7ff,
                0 0 15px #00f7ff,
                0 0 25px #ff00ff;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        .subtitulo {
            max-width: 850px;
            margin: 0 auto;
            color: #f1f1f1;
            font-size: 18px;
        }

        .texto-neon {
            color: #ffcc00;
            font-weight: bold;
        }

        .contenedor-principal {
            max-width: 1100px;
        }

        .card-juego {
            background: rgba(10, 10, 25, 0.95);
            border: 2px solid #00f7ff;
            border-radius: 18px;
            color: white;
            height: 100%;
            transition: 0.2s;
            box-shadow:
                0 0 10px rgba(0, 247, 255, 0.6),
                0 0 25px rgba(255, 0, 255, 0.25);
        }

        .card-juego:hover {
            transform: translateY(-7px);
            border-color: #ff00ff;
            box-shadow:
                0 0 15px rgba(255, 0, 255, 0.8),
                0 0 35px rgba(0, 247, 255, 0.5);
        }

        .icono-juego {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .card-title {
            font-family: 'Press Start 2P', Arial, sans-serif;
            font-size: 16px;
            color: #ffcc00;
            line-height: 1.5;
            text-shadow: 0 0 8px #ff9900;
        }

        .card-text {
            color: #e7e7e7;
            min-height: 85px;
            font-size: 15px;
        }

        .btn-jugar {
            background: #ffcc00;
            color: #111;
            border: 2px solid white;
            font-weight: bold;
            padding: 10px 28px;
            border-radius: 0;
            box-shadow: 4px 4px 0 #ff00ff;
            transition: 0.15s;
        }

        .btn-jugar:hover {
            background: #00f7ff;
            color: #111;
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #ff00ff;
        }

        .ranking {
            margin-top: 60px;
            margin-bottom: 45px;
            background: rgba(5, 5, 15, 0.9);
            border: 2px solid #ff00ff;
            border-radius: 18px;
            padding: 25px;
            box-shadow:
                0 0 12px rgba(255, 0, 255, 0.7),
                0 0 30px rgba(0, 247, 255, 0.25);
        }

        .ranking h2 {
            font-family: 'Press Start 2P', Arial, sans-serif;
            font-size: 20px;
            color: #00f7ff;
            text-shadow: 0 0 10px #00f7ff;
            margin-bottom: 25px;
        }

        .table {
            margin-bottom: 0;
            border-color: #00f7ff;
        }

        .table th {
            background: #ffcc00;
            color: #111;
            border-color: #111;
        }

        .table td {
            background: rgba(15, 15, 35, 0.95);
            color: white;
            border-color: #444;
        }

        .mensaje-ranking {
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
            color: #ffcc00;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #d0d0d0;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .titulo-arcade {
                font-size: 22px;
            }

            .subtitulo {
                font-size: 15px;
            }

            .ranking h2 {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Cabecera principal -->
    <section class="hero">
        <h1 class="titulo-arcade">MINIJUEGOS<br>ARCADE</h1>

        <p class="subtitulo">
            Elige un minijuego, supera tu puntuación y entra en el 
            <span class="texto-neon">Ranking Top 5</span>.
        </p>
    </section>

    <main class="container contenedor-principal">

        <!-- Tarjetas de acceso a los juegos -->
        <div class="row g-4 justify-content-center">

            <div class="col-12 col-md-4">
                <div class="card card-juego p-3">
                    <div class="card-body text-center">
                        <div class="icono-juego">🏓</div>
                        <h2 class="card-title">PONG</h2>
                        <p class="card-text">
                            Mueve la pala con el teclado y consigue la máxima puntuación posible.
                        </p>
                        <a href="pong.php" class="btn btn-jugar">JUGAR</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-juego p-3">
                    <div class="card-body text-center">
                        <div class="icono-juego">❌⭕</div>
                        <h2 class="card-title">TRES EN RAYA</h2>
                        <p class="card-text">
                            Juega contra el ordenador y gana puntos según el resultado de la partida.
                        </p>
                        <a href="tres_en_raya.php" class="btn btn-jugar">JUGAR</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card card-juego p-3">
                    <div class="card-body text-center">
                        <div class="icono-juego">🃏</div>
                        <h2 class="card-title">DOBLES PAREJAS</h2>
                        <p class="card-text">
                            Encuentra todas las parejas con el menor número de intentos posible.
                        </p>
                        <a href="dobles_parejas.php" class="btn btn-jugar">JUGAR</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Ranking de puntuaciones -->
        <section class="ranking">
            <h2 class="text-center">RANKING TOP 5</h2>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>Jugador</th>
                            <th>Juego</th>
                            <th>Puntuación</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody id="tabla-ranking"></tbody>
                </table>
            </div>

            <p id="mensajeRanking" class="mensaje-ranking"></p>
        </section>

    </main>

    <footer>
        Proyecto desarrollado por Jaume Illana con HTML, CSS, JavaScript, PHP, MySQL y Bootstrap.
    </footer>

    <script>
        // Esta función obtiene el ranking desde PHP y lo muestra en la tabla
        function actualizarRanking() {
            fetch("api/ranking.php")
                .then(function(respuesta) {
                    return respuesta.json();
                })
                .then(function(datos) {
                    const tabla = document.getElementById("tabla-ranking");
                    const mensajeRanking = document.getElementById("mensajeRanking");

                    tabla.innerHTML = "";
                    mensajeRanking.textContent = "";

                    if (datos.length === 0) {
                        mensajeRanking.textContent = "Todavía no hay puntuaciones guardadas.";
                        return;
                    }

                    datos.forEach(function(fila) {
                        const tr = document.createElement("tr");
                        [fila.jugador, fila.juego, fila.puntuacion, fila.fecha].forEach(function(valor) {
                            const td = document.createElement("td");
                            td.textContent = String(valor ?? "");
                            tr.appendChild(td);
                        });
                        tabla.appendChild(tr);
                    });
                })
                .catch(function(error) {
                    document.getElementById("mensajeRanking").textContent =
                        "No se ha podido cargar el ranking.";

                    console.log(error);
                });
        }

        // Carga el ranking al abrir la página
        actualizarRanking();
    </script>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>