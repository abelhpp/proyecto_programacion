<?php
// Conexión a la base de datos utilizando mysqli
$mysqli = new mysqli("localhost", "root", "", "biblioteca");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idGenero = $_GET["id"];

    // Consultar la base de datos para obtener el nombre del género
    $query = "SELECT nombre FROM generos WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idGenero);
    $stmt->execute();
    $stmt->bind_result($nombreGenero);

    if ($stmt->fetch()) {
        $respuesta = array('nombre' => $nombreGenero);
        echo json_encode($respuesta);
    } else {
        echo json_encode(['error' => 'No se encontró el género']);
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>