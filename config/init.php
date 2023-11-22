<?php

// Definir rutas y URLs base
define('BASE_URL', 'http://localhost/biblioteca/'); // Reemplaza con la URL de tu aplicación
define('BASE_PATH', __DIR__);

// Incluir funciones de utilidad
include_once(BASE_PATH . '/core/helpers/utilidades.php');

// Autoload para cargar clases automáticamente
spl_autoload_register(function ($clase) {
    include BASE_PATH . '/models/' . strtolower($clase) . '.php';
});

// Establecer la zona horaria
date_default_timezone_set('America/Buenos_Aires');
