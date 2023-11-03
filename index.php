
<?php 
//config para errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Control se session
require_once 'controllers/sessions/sessionController.php';


if (isset($_SESSION['roles_id'])) {
    $opcion = (int)$_SESSION["roles_id"]; 
    
    switch ($opcion) {
        case 1:            
            include 'views/inicio.php'; 
            break; 
        case 2:
            header('Location: biblioteca/lista.php');
            break;
        case 3:
            echo "Usuario tipo 3";
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