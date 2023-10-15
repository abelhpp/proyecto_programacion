<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$query = "SELECT libros.id, nombre, foto, fecha_registro, descripcion, autores_id, generos_id, stock_libros.cantidad 
        FROM libros 
        INNER JOIN stock_libros ON libros.id = stock_libros.libros_id";

$result = $mysqli->query($query);

if ($result) {
    // Inicializar un arreglo para almacenar los libros con su cantidad en stock
    $libros = array();

    // Obtener y almacenar los libros en un arreglo
    while ($row = $result->fetch_assoc()) {
        $libros[] = $row;
    }

    // Liberar el resultado
    $result->free();

    // Cerrar la conexión
    $mysqli->close();

    // Convertir el arreglo de libros a formato JSON
    $json_response = json_encode($libros);

    // Enviar la respuesta JSON
    header('Content-Type: application/json');
    echo $json_response;
} else {
    echo "Error en la consulta: " . $mysqli->error;
}
