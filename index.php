<?php 
//config para errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//Obtener el atributo path del objeto url server
$uri = $_SERVER['REQUEST_URI'];
$url = parse_url($uri);
//Esto es por la rais "HTDOCS" de XAMPP.
$path = trim($url['path'], '/');
$parts = explode('/', $path);
$loginSegment = end($parts);

//Session
session_start();


require_once('controllers/sessions/session.php');



//Routers
$routes = [
    'login'  => 'views/login.php',
    'inicio' => 'views/inicio.php',
    'cerrada'=> 'views/cerrada.php',
    'time'=> 'views/time.php',
    'salir' => 'views/salir.php',
    'registrarse' => 'views/registrarse.php',
    'correo' => 'views/correo_verificacion.php',
];



if(array_key_exists($loginSegment, $routes)) {  
    require_once $routes[$loginSegment];
}else{
    http_response_code(404);
    require_once 'views/404.php';
    die();
}


?>

