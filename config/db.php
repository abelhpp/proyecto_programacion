<?php
class Database
{
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $nombreBaseDatos = 'biblioteca';
    private $conexion;

    public function __construct()
    {   
        
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBaseDatos);
        if ($this->conexion->connect_error) {    
            die('Error de conexión a la base de datos: ' . $this->conexion->connect_error);
        }
    }

    // Método para preparar y ejecutar una consulta SQL
    public function execute($sql)
    {
        return $this->conexion->query($sql);
    }

    public function getError()
    {
        return $this->conexion->error;
    }

    // Método para obtener un solo resultado de una consulta
    public function fetchOne($sql)
    {
        $result = $this->execute($sql);
        return $result->fetch_assoc();
    }
    
    public function __destruct()
    {
        $this->cerrarConexion();
    }

    // Método para cerrar la conexión a la base de datos
    public function cerrarConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
