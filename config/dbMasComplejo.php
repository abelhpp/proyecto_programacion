<?php
class Database
{
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '';
    private $nombreBaseDatos = 'biblioteca';
    private $conexion;
    
    private $stmt; // Variable para la declaración preparada

    public function __construct()
    {   
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBaseDatos);
        if ($this->conexion->connect_error) {    
            die('Error de conexión a la base de datos: ' . $this->conexion->connect_error);
        }
    }

    // Método para preparar y ejecutar una consulta SQL con parámetros
    public function execute($sql, $params = null)
    {
        $this->stmt = $this->conexion->prepare($sql);

        if ($this->stmt) {
            if ($params) {
                $types = "";
                $paramsArray = [];

                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= "i"; // Entero
                    } elseif (is_float($param)) {
                        $types .= "d"; // Doble (flotante)
                    } else {
                        $types .= "s"; // Cadena (por defecto)
                    }

                    $paramsArray[] = $param;
                }

                array_unshift($paramsArray, $types);

                // Ligar los parámetros
                call_user_func_array(array($this->stmt, 'bind_param'), $paramsArray);
            }

            if ($this->stmt->execute()) {
                return $this->stmt->get_result();
            } else {
                return false;
            }
        }

        return false;
    }

    public function getError()
    {
        return $this->conexion->error;
    }

    // Método para obtener un solo resultado de una consulta
    public function fetchOnes($sql, $params = null)
    {
        $result = $this->execute($sql, $params);
        return $result ? $result->fetch_assoc() : null;
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
