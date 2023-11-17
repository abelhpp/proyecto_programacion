<?php
if (isset($_SESSION['username'])){
    header('Location: /proyecto_programacion/inicio');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    require_once 'models/loginModel.php';
    

    $username = $_POST["username"];
    $password = $_POST["password"];
    $ip = $_SERVER['REMOTE_ADDR'];//No es obligatorio
    $captcha = $_POST['g-recaptcha-response'];
    

    $userObject = new LoginModel($username, $password, $captcha, $ip);

    if($userObject->login()) {
        
        
        header("Location: inicio");
        exit(); // Asegura que el script se detenga después de redirigir
        
    }else{
        $error_message = $userObject->getError();
    }



}

?>