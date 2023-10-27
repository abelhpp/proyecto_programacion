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
    
    //Método para preparar y ejecutar consulta SQL retornando num. row afectadas.(en proceso)
    public function executeAndInform($sql){

        $this->conexion->query($sql);
        $filas = $this->conexion->affected_rows;
        if($filas ===true){
            $inform = "se modificó exitosamente"; 
            return $inform;
        }else{
            $inform = "no se modifico ningun dato";
            return $inform;

        }

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

    //Método para traer todos los resultados.

    public function fetchAll($sql){

        $result = $this->execute($sql);
        if($result){
            $datos = array();
            while($fila = mysqli_fetch_assoc($result)){
                $datos[]=$fila;
            }
            //liberamos espacio de la memoria
            mysqli_free_result($result);

            //devolvemos los datos
            return $datos;
        }else{
            echo "error al buscar datos". mysqli_connect_error();
            return null;
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
