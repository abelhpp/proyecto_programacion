<?php
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idLibro = $_GET["id"];

    $sql = $conn->prepare("SELECT s.cantidad, l.nombre 
                          FROM stock_libros s 
                          JOIN libros l ON s.libros_id = l.id 
                          WHERE s.libros_id = ?");
    $sql->bind_param("i", $idLibro);

    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $info = $result->fetch_assoc();
        echo json_encode($info);
    } else {
        echo json_encode(['error' => 'No se encontró el libro en el stock']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}

$sql->close();
$conn->close();
?>