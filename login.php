<?php 
//config para errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session inicio
$session_lifetime = 1800; // 30 minutos en segundos
ini_set('session.gc_maxlifetime', $session_lifetime);$session_lifetime = 1800; // 30 minutos en segundos
ini_set('session.gc_maxlifetime', $session_lifetime);
session_start();

if (isset($_SESSION['roles_id'])){
    header('Location: index.php');
    exit;
}else{
    require_once 'controllers/loginController.php';
    include 'views/login.php'; 
   
}