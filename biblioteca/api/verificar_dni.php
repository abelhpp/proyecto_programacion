<?php
// Conexión a la base de datos (ajusta las credenciales según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el DNI de la solicitud
$dni = $_GET['dni'];

// Consultar la base de datos para verificar si el DNI existe
$sql = "SELECT * FROM usuarios WHERE dni = $dni";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // El DNI existe en la base de datos, devolver los datos del usuario
    $row = $result->fetch_assoc();
    $response = array(
        "existe" => true,
        "usuario" => $row
    );
    
} else {
    // El DNI no existe en la base de datos
    $response = array(
        "existe" => false
    );
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión a la base de datos
$conn->close();
?>
