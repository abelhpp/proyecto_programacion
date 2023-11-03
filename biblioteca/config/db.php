
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
        $result = $this->conexion->query($sql);
        if (!$result) {
            throw new Exception("Error en la consulta SQL: " . $this->conexion->error);
        }
        return $result;
    } catch (Exception $e) {
        // Puedes registrar el error o manejarlo de otra manera adecuada
        throw $e; // Relanza la excepción para que se maneje en un nivel superior
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

    public function fetchOneId($sql)
    {
        try {
            $result = $this->conexion->query($sql);
            if ($result){
                $row = $result->fetch_assoc();
                return $row['id_mas_grande'];
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


    // Lista de libros
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
}
