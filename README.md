# Minijuegos Arcade 🎮

Proyecto académico de **Desarrollo de Aplicaciones Web (DAW)** desarrollado desde cero con apoyo de herramientas de inteligencia artificial para aprender y revisar código.

## Juegos

- **Pong**: juego de pala y pelota, puntuación y colisiones en Canvas.
- **Tres en raya**: partida por turnos frente al ordenador.
- **Dobles parejas**: juego de memoria para encontrar parejas.

Incluye registro de puntuaciones y una clasificación consultada desde PHP.

## Tecnologías

HTML, CSS, JavaScript, Canvas, PHP (PDO), MySQL/MariaDB y Bootstrap (según las páginas del proyecto).

## Cómo ejecutarlo en local

1. Instala un entorno con **PHP 8+**, **MySQL/MariaDB** y el controlador PHP `pdo_mysql` (por ejemplo XAMPP).
2. Copia el proyecto dentro del directorio web del servidor (en XAMPP: `htdocs/minijuegos-arcade`).
3. Importa `database/minijuegos_db.sql` desde phpMyAdmin o el cliente MySQL. Esto crea las tablas y los tres juegos, **sin jugadores ni puntuaciones de prueba**.
4. Crea un usuario de base de datos específico para la aplicación y dale permisos sobre `minijuegos_db`. Ejemplo desde una cuenta administradora de MySQL:

   ```sql
   CREATE USER 'minijuegos_app'@'localhost' IDENTIFIED BY 'TU_CLAVE_SEGURA';
   GRANT SELECT, INSERT, UPDATE ON minijuegos_db.* TO 'minijuegos_app'@'localhost';
   ```

5. Configura en el servidor web las variables de entorno `DB_HOST`, `DB_NAME`, `DB_USER` y `DB_PASSWORD` tomando `.env.example` como referencia. **El proyecto no carga automáticamente el archivo `.env.example`**. Si usas XAMPP, configura las variables del proceso Apache/PHP o adapta la configuración local sin subir claves a GitHub.
6. Abre `http://localhost/minijuegos-arcade/index.php` con Apache iniciado.

> No funciona abriendo los archivos PHP con doble clic: requiere un servidor PHP y una base de datos en ejecución. No hay una demo pública desplegada actualmente.

## Organización

- `index.php`: página principal y ranking.
- `pong.php`, `tres_en_raya.php`, `dobles_parejas.php`: juegos.
- `api/`: endpoints PHP y conexión PDO.
- `database/`: esquema SQL con catálogo de juegos.

## Estado

Proyecto de aprendizaje. Se han retirado datos de pruebas y credenciales locales del código antes de compartirlo. No se ha verificado aún la ejecución integral con una instancia de MySQL en este entorno.

**Autor:** Jaume Illana
