<?php
header('Content-Type: application/json'); // Establece el tipo de contenido de la respuesta como JSON

$response = array(); // Inicializa un array para almacenar la respuesta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar a la base de datos
    $host = 'localhost';
    $usuario = 'santiago';
    $contrasena = 'santiago'; 
    $base_datos = 'pruebatecnica';

    // Crear una instancia de la clase mysqli para la conexión a la base de datos
    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    // Verificar la conexión a la base de datos
    if ($conexion->connect_error) {
        $response['error'] = 'Error de conexión: ' . $conexion->connect_error;
    } else {
        // Obtener datos del formulario enviados mediante POST
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $mensaje = $_POST['mensaje'];

        // Preparar la consulta SQL para insertar datos en la base de datos
        $sql = "INSERT INTO mensajes (nombre, correo, mensaje) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Vincular parámetros a la declaración preparada
            $stmt->bind_param("sss", $nombre, $correo, $mensaje);

            // Ejecutar la consulta preparada
            if ($stmt->execute()) {
                $response[] = 'Formulario enviado con éxito y datos almacenados en la base de datos';
            } else {
                $response['error'] = 'Error al ejecutar la consulta: ' . $stmt->error;
            }

            // Cerrar la declaración preparada para liberar recursos
            $stmt->close();
        } else {
            $response['error'] = 'Error al preparar la consulta: ' . $conexion->error;
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    }
} else {
    $response['error'] = 'Acceso no autorizado'; // Respuesta si el método de solicitud no es POST
}

// Devolver la respuesta como JSON
echo json_encode($response);
?>
