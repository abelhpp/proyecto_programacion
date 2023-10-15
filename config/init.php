<?php


// Definir la ruta base de la aplicación
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost/proyecto_programacion/'); // Reemplaza con la URL de tu aplicación

// Incluir funciones de utilidad
include_once(BASE_PATH . '/core/helpers/utilidades.php');

// Autoload para cargar clases automáticamente
spl_autoload_register(function ($clase) {
    include BASE_PATH . '/models/' . strtolower($clase) . '.php';
});

// Establecer la zona horaria
date_default_timezone_set('America/Buenos_Aires');
