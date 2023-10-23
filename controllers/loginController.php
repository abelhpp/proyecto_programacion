<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importo model
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();
    
    // Recibir los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    //Si existe email devuelve pass
    if($usuarioModel->existsEmail($username)){
        
        //Si password es verdadero
        if($usuarioModel->password_validate($password)){
            //crea session para username
            $usuarioModel->create_sessiones($username);
            header("Location: index.php");
            exit(); // Asegura que el script se detenga después de redirigir
        }else{
            // Error de autenticación
            $error_message = "Contraseña ingresada es incorrecta";
        }

    } else{
        // Usuario no existe
        $error_message = "El usuario ingresado no es válido.";
    }
    
}
?>