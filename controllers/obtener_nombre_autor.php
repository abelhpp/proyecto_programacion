<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idAutor = $_GET["id"];

    // Consultar la base de datos para obtener el nombre del autor
    $query = "SELECT nombre FROM autores WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idAutor);
    $stmt->execute();
    $stmt->bind_result($nombreAutor);

    if ($stmt->fetch()) {
        $respuesta = array('nombre' => $nombreAutor);
        echo json_encode($respuesta);
    } else {
        echo json_encode(['error' => 'No se encontró el autor']);
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>