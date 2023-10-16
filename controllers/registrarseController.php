<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importo model
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();
    
    // recibo datos
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
    

    //validaciones


    //envios
    $infoDb = $usuarioModel->registrarNuevoUsuario($email, $name, $apellido, $dni, $password, $imagenBinaria);
    //header("Location: index.php");
    //exit(); // Asegura que el script se detenga después de redirigir

}
?>