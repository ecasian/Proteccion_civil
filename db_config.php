<?php
// Configuración de la conexión a la base de datos
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // <-- CAMBIA ESTO
define('DB_PASSWORD', ''); // <-- CAMBIA ESTO
define('DB_NAME', 'proteccion_civil');

// Intentar conectar a la base de datos MySQL
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Comprobar la conexión
if($mysqli === false){
    // Si la conexión falla, se detiene la ejecución y se muestra un error.
    // En un entorno de producción, esto debería registrarse en un archivo de log en lugar de mostrarse al usuario.
    die("ERROR: No se pudo conectar. " . $mysqli->connect_error);
}

// Establecer el juego de caracteres a UTF-8 para soportar acentos y caracteres especiales
$mysqli->set_charset("utf8mb4");
?>