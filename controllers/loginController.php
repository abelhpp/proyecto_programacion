<?php




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Importo model
    require_once 'models/usuarioModel.php';
    $usuarioModel = new UsuarioModel();
    
    // Recibir los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    //Si existe email devuelve pass
    $infoDb = $usuarioModel->existsEmail($username);
    if ($infoDb){

        if ($infoDb["contraseña"] === $password) {
            // Iniciar la sesión (si aún no está iniciada)
            $_SESSION["username"] = $username;
            $_SESSION["roles_id"] = $infoDb["roles_id"];
            $_SESSION["id"] = $infoDb["id"];
            $_SESSION['ultimo_acceso'] = time();
            //Crea token y crea session token
            include "controllers/sessions/tokenController.php";
            header("Location: index.php");
            exit(); // Asegura que el script se detenga después de redirigir

        } else {
            // Error de autenticación
            $error_message = "Contraseña ingresada es incorrecta";
        }
        
    }    
    else {
        // Usuario no existe
        $error_message = "El usuario ingresado no es válido.";
    }

}
?>
