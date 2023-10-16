<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Función para realizar un nuevo préstamo (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos enviados en formato JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $libro_id = $data['libros_id'];
    $usuario_id = $data['usuarios_id'];

    // Insertar el nuevo préstamo en la tabla "prestamos"
    $query = "INSERT INTO prestamos (usuarios_id, libros_id)
            VALUES (?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("ii", $usuario_id, $libro_id);

        if ($stmt->execute()) {
            echo "Nuevo préstamo insertado exitosamente.";
        } else {
            echo "Error al insertar el préstamo: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la consulta: " . $mysqli->error;
    }
}

// Función para obtener los préstamos de un usuario con detalles de libro y autor (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ID del usuario
    $usuario_id = 1; // Reemplaza esto con el ID del usuario que deseas consultar

    // Consulta SQL para obtener los préstamos de un usuario con detalles del libro y el autor
    $query = "SELECT prestamos.id, prestamos.fecha_prestamo, prestamos.fecha_vencimiento, prestamos.fue_retirado, libros.nombre AS nombre_libro, autores.nombre AS nombre_autor
            FROM prestamos
            INNER JOIN libros ON prestamos.libros_id = libros.id
            INNER JOIN autores ON libros.autores_id = autores.id
            WHERE prestamos.usuarios_id = ?
            ORDER BY prestamos.fecha_prestamo DESC";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $usuario_id);

        if ($stmt->execute()) {
            // Obtener resultados de la consulta
            $result = $stmt->get_result();

            // Inicializar un arreglo para almacenar los préstamos
            $prestamos = array();

            while ($row = $result->fetch_assoc()) {
                $prestamos[] = $row;
            }

            // Cerrar la consulta
            $stmt->close();

            // Convertir el arreglo de préstamos a formato JSON
            $json_response = json_encode($prestamos);

            // Enviar la respuesta JSON
            header('Content-Type: application/json');
            echo $json_response;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
    } else {
        echo "Error en la consulta: " . $mysqli->error;
    }
}

// Cerrar la conexión
$mysqli->close();

