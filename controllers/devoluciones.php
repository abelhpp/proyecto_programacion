<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ID del usuario
    $usuario_id = 1; // Reemplaza esto con el ID del usuario que deseas consultar

    // Consulta SQL para obtener los préstamos de un usuario con detalles del libro y el autor,
    // teniendo en cuenta si un libro ha sido devuelto o no.
    // $query = "SELECT p.id, p.fecha_prestamo, p.libros_id,
    //             d.prestamos_id AS prestamos_id,
    //             CASE WHEN d.id IS NOT NULL THEN 'Devuelto' ELSE 'Prestado' END AS estado
    //             FROM prestamos AS p
    //             LEFT JOIN devoluciones AS d ON p.id = d.prestamos_id
    //             WHERE p.usuarios_id = ?
    //             ORDER BY p.fecha_prestamo DESC";
    $query = "SELECT *
    FROM devoluciones
    WHERE devoluciones.usuarios_id = ?
    ORDER BY devoluciones.fecha_devolucion DESC
    
";

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
