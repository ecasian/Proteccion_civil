<?php
// Incluir el archivo de configuración de la base de datos
require_once "db_config.php";

// Definir variables e inicializarlas con valores vacíos
$nombre_completo = $email = $telefono = $n_cuenta = $carrera = $semestre = $brigada_id = $motivacion = $experiencia_previa = "";

// Procesar datos del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger y limpiar los datos de entrada
    $nombre_completo = trim($_POST["nombre_completo"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["telefono"]);
    $n_cuenta = trim($_POST["n_cuenta"]);
    $carrera = trim($_POST["carrera"]);
    $semestre = !empty($_POST["semestre"]) ? trim($_POST["semestre"]) : null;
    $brigada_id = trim($_POST["brigada_id"]);
    $motivacion = trim($_POST["motivacion"]);
    $experiencia_previa = trim($_POST["experiencia_previa"]);

    // Preparar una declaración de inserción (prepared statement) para evitar inyección SQL
    $sql = "INSERT INTO solicitudes_brigadistas (nombre_completo, email, telefono, n_cuenta, carrera, semestre, brigada_id, motivacion, experiencia_previa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Vincular variables a la declaración preparada como parámetros
        // s = string, i = integer
        $stmt->bind_param("sssssiiss", $param_nombre, $param_email, $param_telefono, $param_n_cuenta, $param_carrera, $param_semestre, $param_brigada, $param_motivacion, $param_experiencia);

        // Establecer los parámetros
        $param_nombre = $nombre_completo;
        $param_email = $email;
        $param_telefono = $telefono;
        $param_n_cuenta = $n_cuenta;
        $param_carrera = $carrera;
        $param_semestre = $semestre;
        $param_brigada = $brigada_id;
        $param_motivacion = $motivacion;
        $param_experiencia = $experiencia_previa;

        // Intentar ejecutar la declaración preparada
        if ($stmt->execute()) {
            // Si tiene éxito, mostrar un mensaje de confirmación
            echo "<!DOCTYPE html><html><head><title>Registro Exitoso</title><script src='https://cdn.tailwindcss.com'></script></head><body class='bg-gray-100 flex items-center justify-center h-screen'>";
            echo "<div class='text-center bg-white p-10 rounded-lg shadow-xl'>";
            echo "<h1 class='text-2xl font-bold text-green-700'>¡Solicitud Enviada Exitosamente!</h1>";
            echo "<p class='mt-4 text-gray-600'>Gracias por tu interés, <strong>" . htmlspecialchars($nombre_completo) . "</strong>. Hemos recibido tu solicitud y la revisaremos pronto.</p>";
            echo "<a href='main.html' class='mt-6 inline-block bg-green-700 text-white px-5 py-2 rounded hover:bg-green-800 transition'>Volver a la página principal</a>";
            echo "</div></body></html>";
        } else {
            // Si falla, mostrar un mensaje de error
            echo "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
        }

        // Cerrar la declaración
        $stmt->close();
    }
    
    // Cerrar la conexión
    $mysqli->close();
}
?>