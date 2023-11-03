<?php
$conn = new mysqli("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAutor = $_GET["id"];

    $sql = $conn->prepare("DELETE FROM autores WHERE id = ?");
    $sql->bind_param("i", $idAutor);

    if ($sql->execute()) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false];
    }
} else {
    $response = ['success' => false];
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>