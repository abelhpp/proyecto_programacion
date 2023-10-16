<?php

//Importar model
require_once 'models/socioModel.php';
$socioModel = new SocioModel();

//Ejecuta consulta
$result = $socioModel->getAutores();


$autores = $result->fetch_all(MYSQLI_ASSOC);
header('Content-Type: application/json');
echo json_encode($autores);

