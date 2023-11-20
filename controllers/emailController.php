<?php

require_once 'models/emailModel.php';

// Ejemplo de uso
$correoController = new emailModel('abelipes@gmail.com');
$codigoVerificacion = $correoController->enviarCorreoVerificacion();

if ($codigoVerificacion) {
    echo "Correo enviado correctamente. Código de verificación: $codigoVerificacion";
} else {
    echo "Error al enviar el correo.";
}

?>
