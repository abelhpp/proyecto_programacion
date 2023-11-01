<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        
    
    //Objeto login
    require_once 'models/usuarioModel.php';
    
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $ip = $_SERVER['REMOTE_ADDR'];//No es obligatorio
    $captcha = $_POST['g-recaptcha-response'];
    class Login {
        private $_user;
        private $_password;
        private $usuarioModel; // Esta propiedad almacenará una instancia de UsuarioModel
        private $captcha;
        private $respuestaCaptcha;
        private $ip;
        public $error = "Session cerrada";
        public function __construct($user, $password, $captcha, $ip) {
            $this->_user = $user;
            $this->_password = $password;
            $this->captcha = $captcha;
            $this->ip = $ip;
            $this->usuarioModel = new UsuarioModel(); // Crear una instancia de UsuarioModel
            $this->createCaptcha();
            

        }
        public function createCaptcha() {
            //Recaptcha
            /*
            $secretkey = "Clave Privada";
            $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$this->captcha");
            $respuestaJson = json_decode($respuesta, True);
            //Realiza la lógica de verificación del captcha y manejo de errores aquí
            if ($respuestaJson["success"]) {
                $this->respuestaCaptcha = true;
            } else {
                // Captcha no válido, maneja el error apropiadamente
                $this->respuestaCaptcha = false;
            }*/
            $this->respuestaCaptcha = true;
        }

        public function validarCaptcha(){
            if ($this->respuestaCaptcha) { 
                return true;
            }
            $this->error = "en el captcha, inténtalo de nuevo.";
            return false;
        }


        public function validarEmail(){
            if($this->usuarioModel->existsEmail($this->_user)){
                return true;    
            }
            $this->error = " El correo ingresado es invalido";
            return false;
        }

        public function validarPass(){
            if($this->usuarioModel->password_validate($this->_password)){
                $this->usuarioModel->create_sessiones($this->_user);
                return true;
            }
            $this->error = " Contraseña invalida";
            return false;
        }

        public function getError(){
            return $this->error;
        }



        //Login general
        public function login(){
            if (!$this->validarCaptcha() || !$this->validarEmail() || !$this->validarPass()) {
                return false;
            }

            return true;
        }        
    }

    $userObject = new Login($username, $password, $captcha, $ip);
    
    if($userObject->login()) {
        
        
        header("Location: index.php");
        exit(); // Asegura que el script se detenga después de redirigir
        
    }else{
        $error_message = $userObject->getError();
    }



}

?>