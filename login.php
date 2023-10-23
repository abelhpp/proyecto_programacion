<?php 
//config para errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session inicio
session_start();

if (isset($_SESSION['token'])){
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();
    if(!$usuarioModel->verificarToken($_SESSION['id'], $_SESSION['token'])){
        header('Location: index.php');
        exit;
    }
}else{
    require_once 'controllers/loginController.php';
    include 'views/login.php';   
}