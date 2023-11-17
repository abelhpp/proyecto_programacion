<?php
require_once 'models/usuarioModel.php';
require_once 'models/variablesModel.php';

class LoginModel {
        private $variables;
        private $_user;
        private $_password;
        private $usuarioModel; // Esta propiedad almacenará una instancia de UsuarioModel
        private $captcha;
        private $respuestaCaptcha;
        private $ip;
        public $error = "Session cerrada";
        public function __construct($user, $password, $captcha, $ip) {
            $this->variables = new VariablesModel();
            $this->usuarioModel = new UsuarioModel();
            $this->_user = $user;
            $this->_password = $password;
            $this->captcha = $captcha;
            $this->ip = $ip;
            $this->createCaptcha();
            

        }
        public function createCaptcha() {
            //Recaptcha
            $secretkey = $this->variables->getKey();
            $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$this->captcha");
            $respuestaJson = json_decode($respuesta, True);
            //Realiza la lógica de verificación del captcha y manejo de errores aquí
            
            if ($respuestaJson["success"]) {
                $this->respuestaCaptcha = true;
            } else {
                // Captcha no válido, maneja el error apropiadamente
                $this->respuestaCaptcha = false;
            }
        }

        public function validarCaptcha(){
            if ($this->respuestaCaptcha) { 
                return true;
            }
            $this->error = "Complete el captcha e inténtalo de nuevo.";
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

?>