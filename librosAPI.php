<?php
$APIs = $_GET['APIs'];

switch ($APIs) {
    case '1':
        require_once 'controllers/libros.php';
        break;
    case '2':
        require_once 'controllers/autores.php'; // Reemplaza 'otra_api.php' con el nombre de tu segundo archivo
        break;
    case '3':
        require_once 'controllers/generos.php'; // Reemplaza 'otra_api_mas.php' con el nombre de tu tercer archivo
        break;
    default:
        // Manejo de un valor no válido
        echo 'API no válida';
        echo $APIs;
        break;
}
