<?php 

if (isset($_SESSION['username'])){
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();
    $das = $usuarioModel->verificarToken($_SESSION['id'], $_SESSION['token']);
    
    if(!$usuarioModel->verificarToken($_SESSION['id'], $_SESSION['token'])){
        // Eliminar todas las variables de sesión
        session_unset();
        session_destroy();
        header('Location: /proyecto_programacion/cerrada');
        exit();
    }

    if($usuarioModel->sessionTime()){ 
        //Eliminar todas las variables de sesión
        session_unset();
        session_destroy();
        header('Location: /proyecto_programacion/time');
        exit();
    }
}
?>