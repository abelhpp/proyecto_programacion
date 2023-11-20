<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importo model
    require_once 'models/usuarioModel.php';
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
    $emal_validar = "Registrado con exito, en las proximas 48hs su cuenta sera validada";
    $infoDb = $usuarioModel->registrarNuevoUsuario($email, $name, $apellido, $dni, $password, $imagenBinaria);
    }
    

    //envios
    //$infoDb = $usuarioModel->registrarNuevoUsuario($email, $name, $apellido, $dni, $password, $imagenBinaria);
    
}
?>