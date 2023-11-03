<?php
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idLibro = $_GET["id"];

    $sql = $conn->prepare("SELECT * FROM libros WHERE id = ?");
    $sql->bind_param("i", $idLibro);

    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $libro = $result->fetch_assoc();
        echo json_encode($libro);
    } else {
        echo json_encode(["error" => "No se encontró ningún libro con ese ID"]);
    }
} else {
    echo json_encode(["error" => "Método no permitido"]);
}

$conn->close();
?>