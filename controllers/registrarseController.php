<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importo model
    require_once 'models/usuarioModel.php';
    require_once 'models/emailModel.php';
    $usuarioModel = new UsuarioModel();
    

    $email = $_POST["email"];
    //Primero ver que el correo no esta registrado
    $email = $_POST["email"];
    // Ruta temporal de la imagen
    $imagenTemporal = $_FILES["dni_front"]["tmp_name"];
    // Convertir la imagen en datos binarios
    $imagenBinaria = addslashes(file_get_contents($imagenTemporal));

    // Resto de los datos del formulario
    $email = $_POST["email"];
    $name = $_POST["name"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $password = $_POST["password"];




    if($usuarioModel->verificaEmail($email)){
        $error_message = "El correo ingresado, ya se encuentra registrado en nuestra.";
    }else{
    //envios
    $correoController = new emailModel($email);
    $tokenVerificacion = $correoController->enviarCorreoVerificacion();
    
    $emal_validar = "Registrado con exito, se ha enviado un codigo de verifacación al correo ingresado";
    $infoDb = $usuarioModel->registrarNuevoUsuario($email, $name, $apellido, $dni, $password, $imagenBinaria, $tokenVerificacion);
    }
    

    //envios
    //$infoDb = $usuarioModel->registrarNuevoUsuario($email, $name, $apellido, $dni, $password, $imagenBinaria);
}
?>