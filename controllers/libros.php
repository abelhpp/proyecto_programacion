<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Consulta SQL para obtener todos los libros
$query = "SELECT * FROM libros";
$result = $mysqli->query($query);

if ($result) {
    // Inicializar un arreglo para almacenar los libros
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
?>

