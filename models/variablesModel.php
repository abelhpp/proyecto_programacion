<?php


class VariablesModel {
    
    private $host;
    private $usuario;
    private $contrasena;
    private $nombre;
    private $secretKey;
    private $emailPass;
    private $emailHost;
    private $emailName;

    // Constructor que obtiene la SECRET_KEY al crear la instancia
    public function __construct() {
        // Incluir el autoloader de Composer
        require_once __DIR__ . '/../vendor/autoload.php';

        // Crear una nueva instancia de Dotenv
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Obtener la SECRET_KEY de las variables de entorno
        $this->secretKey = $_ENV['SECRET_KEY'];
        $this->host = $_ENV['DB_HOST'];
        $this->usuario = $_ENV['DB_USUARIO'];
        $this->contrasena = $_ENV['DB_CONTRASENA'];
        $this->nombre = $_ENV['DB_NOMBREBASEDATOS'];
        $this->emailPass = $_ENV['EMAIL_PASS'];
        $this->emailHost = $_ENV['EMAIL_HOST'];
        $this->emailName = $_ENV['EMAIL_NAME'];
    }

    public function getEmailName(){
        return $this->emailName;
    }

    public function getEmailHost(){
        return $this->emailHost;
    }
    public function getEmailPass(){
        return $this->emailPass;
    }

    public function getHost(){
        return $this->host;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getContrasena(){
        return $this->contrasena;
    }
    public function getNombre(){
        return $this->nombre;
    }

    // Método para obtener la SECRET_KEY
    public function getKey() {
        return $this->secretKey;
    }
}


?>