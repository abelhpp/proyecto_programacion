<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Incluir el autoloader de Composer
require_once __DIR__ . '/vendor/autoload.php';

// Importar la clase Dotenv
#use Dotenv\Dotenv;

// Crear una nueva instancia de Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$SECRET_KEY = $_ENV['SECRET_KEY'];

?>