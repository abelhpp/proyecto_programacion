<?php
    
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();

    // Verifica si existe la variable de sesión $_SESSION['id']
    if (isset($_SESSION['id']) && isset($_SESSION['username'])){
        
        //Tiempo se session
        if(time() - $_SESSION['ultimo_acceso'] > $session_lifetime){
            session_unset();
            session_destroy();
            
            header('Location: login.php');
            exit;
        }
        $_SESSION['ultimo_acceso'] = time();
        //Controlar tiempo
        if($usuarioModel->verificarToken($_SESSION['id'], $_SESSION['token'])){
            header('Location: login.php');
        }
        
   
    }