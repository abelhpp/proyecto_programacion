<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'models/usuarioModel.php';
    $codigo = $_POST["codigo"];
    $userObject = new UsuarioModel();
    
    if ($userObject->verificar($codigo)){
        $ok_message = "Ya puede iniciar su sesión.";
    }else{
        $error_message = "Codigo de verificacion incorrecto.";
    }   
}

/*
$correoController = new emailModel('abelipes@gmail.com');
$codigoVerificacion = $correoController->enviarCorreoVerificacion();

if ($codigoVerificacion) {
    echo "Correo enviado correctamente. Código de verificación: $codigoVerificacion";
} else {
    echo "Error al enviar el correo.";
}
*/
?>