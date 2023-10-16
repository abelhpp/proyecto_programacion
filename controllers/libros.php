<?php
//Importar model
require_once 'models/socioModel.php';
$socioModel = new SocioModel();

//Ejecuta consulta
$result = $socioModel->getLibros();


if ($result) {
    // Inicializar un arreglo para almacenar los libros con su cantidad en stock
    $libros = array();

    // Obtener y almacenar los libros en un arreglo
    while ($row = $result->fetch_assoc()) {
        $libros[] = $row;
    }



    // Convertir el arreglo de libros a formato JSON
    $json_response = json_encode($libros);

    // Enviar la respuesta JSON
    header('Content-Type: application/json');    
    echo $json_response;
} else {
    echo "Error en la consulta: " . $mysqli->error;
}
