<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos enviados en formato JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $libro_id = $data['libros_id'];
    $usuario_id = $data['usuarios_id'];

    // Iniciar una transacción
    $mysqli->begin_transaction();

    // Obtener el ID de stock_libros correspondiente al libro_id
    $stock_id_query = "SELECT id FROM stock_libros WHERE libros_id = ?";
    if ($stmt = $mysqli->prepare($stock_id_query)) {
        $stmt->bind_param("i", $libro_id);
        $stmt->execute();
        $stmt->bind_result($stock_id);
        $stmt->fetch();
        $stmt->close();

        // Verificar si se encontró un registro en stock_libros
        if ($stock_id !== null) {
            // Insertar el nuevo préstamo en la tabla "prestamos"
            $insert_query = "INSERT INTO prestamos (usuarios_id, libros_id) VALUES (?, ?)";
            if ($stmt = $mysqli->prepare($insert_query)) {
                $stmt->bind_param("ii", $usuario_id, $libro_id);

                if ($stmt->execute()) {
                    // Restar 1 al stock de libros
                    $update_query = "UPDATE stock_libros SET cantidad = cantidad - 1 WHERE id = ?";
                    if ($stmt = $mysqli->prepare($update_query)) {
                        $stmt->bind_param("i", $stock_id);
                        if ($stmt->execute()) {
                            echo "Nuevo préstamo insertado y stock actualizado con éxito.";
                        } else {
                            echo "Error al actualizar el stock: " . $stmt->error;
                        }
                    } else {
                        echo "Error en la consulta de actualización: " . $mysqli->error;
                    }
                } else {
                    echo "Error al insertar el préstamo: " . $stmt->error;
                }
            } else {
                echo "Error en la consulta de préstamo: " . $mysqli->error;
            }
        } else {
            echo "No se encontró un registro en stock_libros para el libro especificado.";
        }
    } else {
        echo "Error en la consulta de stock_id: " . $mysqli->error;
    }

    // Finalizar la transacción
    $mysqli->commit();
}






// Función para obtener los préstamos de un usuario con detalles de libro y autor (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ID del usuario
    $usuario_id = 1; // Reemplaza esto con el ID del usuario que deseas consultar

    // Consulta SQL para obtener los préstamos de un usuario con detalles del libro y el autor
    $query = "SELECT prestamos.id, prestamos.fecha_prestamo, prestamos.fecha_vencimiento, prestamos.fue_retirado, prestamos.libros_id, libros.nombre AS nombre_libro, autores.nombre AS nombre_autor
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