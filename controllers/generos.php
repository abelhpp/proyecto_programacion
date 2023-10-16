<?php
//Importar model
require_once 'models/socioModel.php';
$socioModel = new SocioModel();

//Ejecuta consulta
$result = $socioModel->getGeneros();


if ($result) {
    // Obtener y mostrar los géneros en formato JSON
    $generos = $result->fetch_all(MYSQLI_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($generos);

} else {
    echo json_encode(['error' => 'Error en la consulta: ' . $mysqli->error]);
}