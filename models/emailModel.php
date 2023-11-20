<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
require_once 'PHPMailer-master/src/Exception.php';
require_once 'models/variablesModel.php';

class EmailModel
{
    private $variables;
    private $mailer;
    private $correoEnvio;

    public function __construct($correoEnvio)
    {
        $this->mailer = new PHPMailer(true);
        $this->correoEnvio = $correoEnvio;
        $this->variables = new VariablesModel();
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->variables->getEmailHost();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->variables->getEmailName();
        $this->mailer->Password = $this->variables->getEmailPass();
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Port = 465;
        $this->mailer->setFrom('nuevoencuentrolist@gmail.com');
    }

    private function generarCodigoVerificacion()
    {
        $longitud = 6;
        $caracteresPermitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';

        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteresPermitidos[random_int(0, strlen($caracteresPermitidos) - 1)];
        }

        return $codigo;
    }

    public function enviarCorreoVerificacion()
    {
        $codigoVerificacion = $this->generarCodigoVerificacion();

        try {
            $this->mailer->addAddress($this->correoEnvio);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Correo de Verificación';
            
            // Leer el contenido de mensaje_verificacion.html
            $htmlContent = file_get_contents(__DIR__ . '/../views/mensaje.php');
            
            // Reemplazar la variable XXXXXX con el código de verificación dinámico
            $htmlContent = str_replace('XXXXXX', $codigoVerificacion, $htmlContent);
            
            // Asignar el contenido HTML al cuerpo del correo
            $this->mailer->Body = $htmlContent;

            $this->mailer->send();
            
            return $codigoVerificacion;
        } catch (Exception $e) {
            return false;
        }
    }
}

?>
