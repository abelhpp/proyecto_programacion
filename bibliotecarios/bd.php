<?php 
//conexión a la base de datos

$servidor="localhost"; 
$baseDeDatos="biblioteca";
$usuario="root";
$contrasenia="";

try {
    $conexion= new PDO ("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
}catch(Exception $ex){
    echo $ex->getMessage();
}



?>