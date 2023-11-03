<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoAutor = $_POST["nuevoAutor"];

    $sql = $conn->prepare("INSERT INTO autores (nombre) VALUES (?)");
    $sql->bind_param("s", $nuevoAutor);

    if ($sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Autor agregado correctamente']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al agregar autor']);
    }

    $sql->close();
}

$conn->close();
?>