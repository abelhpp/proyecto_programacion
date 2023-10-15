<?php 

$session_lifetime = 1800; // 30 minutos en segundos
ini_set('session.gc_maxlifetime', $session_lifetime);
session_start();


if (isset($_SESSION['roles_id'])) {
    $opcion = (int)$_SESSION["roles_id"]; 

    switch ($opcion) {
        case 1:
            require_once 'controllers/sessions/sessionController.php'; 
            include 'views/inicio.php'; 
            break; 
        case 2:
            //llevar donde sea
            break;
        case 3:
            //llevar donde sea
            break;
        default:
            header('Location: login.php');
            exit;
    }
}else{
    header('Location: login.php');
    exit;
}
?>