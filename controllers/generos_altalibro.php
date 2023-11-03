<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Consulta SQL para obtener todos los géneros
$query = "SELECT * FROM generos";
$result = $mysqli->query($query);

if ($result) {
    // Obtener y mostrar los géneros en formato JSON
    $generos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($generos);

    // Liberar el resultado
    $result->free();
} else {
    echo json_encode(['error' => 'Error en la consulta: ' . $mysqli->error]);
}

// Cerrar la conexión
$mysqli->close();
?>
