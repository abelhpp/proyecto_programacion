<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtén el ID del usuario de la consulta
    $prestamo_id = isset($_GET['prestamo_id']) ? intval($_GET['prestamo_id']) : null;

    if ($prestamo_id === null) {
        // Si no se proporcionó un usuario_id válido, puedes manejar el error adecuadamente.
        echo "ID de prestamo no válido";
    } else {
        // Consulta SQL para obtener los préstamos de un usuario con detalles del libro y el autor
        $query = "SELECT prestamos.id, prestamos.fecha_prestamo, prestamos.fecha_vencimiento, prestamos.fue_retirado, prestamos.libros_id, libros.nombre AS nombre_libro, autores.nombre AS nombre_autor
            FROM prestamos
            INNER JOIN libros ON prestamos.libros_id = libros.id
            INNER JOIN autores ON libros.autores_id = autores.id
            WHERE prestamos.id = ?";

        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $prestamo_id);

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
}




// Cerrar la conexión
$mysqli->close();