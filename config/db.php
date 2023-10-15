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
        try {
            $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBaseDatos);
            if ($this->conexion->connect_error) {
                die('Error de conexión a la base de datos: ' . $this->conexion->connect_error);
            }
        } catch (Exception $e) {
            die('Error en la conexión a la base de datos: ' . $e->getMessage());
        }
    }

    // Método para preparar y ejecutar una consulta SQL
    public function execute($sql)
    {
        try {
            return $this->conexion->query($sql);
        } catch (Exception $e) {
            die('Error en la consulta SQL: ' . $e->getMessage());
        }
    }

    public function getError()
    {
        return $this->conexion->error;
    }

    // Método para obtener un solo resultado de una consulta
    public function fetchOne($sql)
    {
        try {
            $result = $this->conexion->query($sql);
            if ($result){
                $row = $result->fetch_assoc();
                return $row;
            }
            return false;

        } catch (Exception $e) {
            die('Error al obtener un resultado de la consulta SQL: ' . $e->getMessage());
        }
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
