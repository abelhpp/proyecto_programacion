<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoGenero = $_POST["nuevoGenero"];

    $sql = $conn->prepare("INSERT INTO generos (nombre) VALUES (?)");
    $sql->bind_param("s", $nuevoGenero);

    if ($sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Género agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al agregar género']);
    }

    $sql->close();
}

$conn->close();
?>
