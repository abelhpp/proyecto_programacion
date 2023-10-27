<?php

// Importar la conexión a la base de datos (db.php)

require ("../config/db.php");

class Loans_Model{

    private $db;

    public function  __construct()
    {

        $this->db =new Database();
    }

    //metodo para consultar todos los libros en la BD.

    public function consultartabla(){

        $query = "SELECT prestamos.id, prestamos.fecha_prestamo, prestamos.fecha_vencimiento, prestamos.fue_retirado, usuarios.nombre AS nombre, usuarios.apellido AS apellido, usuarios.email, libros.nombre AS NombreLibro FROM prestamos JOIN usuarios ON prestamos.usuarios_id = usuarios.id JOIN libros ON prestamos.libros_id = libros.id";

        $consulta =$this->db->fetchAll($query);
        
        if(!$this->db->execute($query)){
            echo $this->db->getError();
            throw new Exception("Error al consultar la tabla libros : " . $this->db->getError());
        }

        return $consulta;
    }
    //metodo para consultar info de la reserva en la BD.
    public function consultarDetalle($id){
        
        $query = "SELECT  id, nombre, apellido, email FROM usuarios WHERE id = $id";
    
        $consulta =$this->db->fetchAll($query);
            
        if(!$this->db->execute($query)){
            echo $this->db->getError();
            throw new Exception("Error al consultar la tabla libros : " . $this->db->getError());
        }
        return  $consulta;
    }
    //metodo para consultar la informacion del prestamo en el modal.
    public function consultarPrestamo($id){
        
        $query = "SELECT * FROM prestamos WHERE id = $id";
    
        $consulta =$this->db->fetchAll($query);
            
        if(!$this->db->execute($query)){
            echo $this->db->getError();
            throw new Exception("Error al consultar la tabla libros : " . $this->db->getError());
        }
        return  $consulta;
        
    }
    //funcion para dar  de baja la reserva de la BD.
    public function darBajaReserva($id){

        $query = "DELETE FROM prestamos WHERE id=$id";

        $consulta=$this->db->executeAndInform($query);
        
        if(!$this->db->execute($query)){
            echo $this->db->getError();
            throw new Exception("Error al borrar reserva:" . $this->db->getError());
        }
        return $consulta;
        
    }
    //funcion para confirmar retiro fisico de la reserva en la BD
    public function ConfirmarRetiro($id){

        $query ="UPDATE prestamos SET fue_retirado = 1 WHERE id = $id LIMIT 1 ";

        $consulta=$this->db->executeAndInform($query);

        if (!$this->db->executeAndInform($query)) {
            echo $this->db->getError();
            throw new Exception("Error al registrar el usuario: " . $this->db->getError());
        }

        return $consulta;
        
    }

}
