<?php

// Importar la conexión a la base de datos (db.php)

require_once 'config/db.php';

class activarModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario en la base de datos

    public function getSocios(){
        // Consulta SQL con valores incrustados

        $sql = "SELECT nombre, apellido, email, fotocopia_dni AS dni_img, activado AS activo, id 
        FROM usuarios 
        WHERE roles_id = 1";
        $query = $this->db->execute($sql);
        if ($query) {
            return $query;
        }
        return false;
    }

    
    public function getActivar($id){
        // Consulta SQL con valores incrustados

        $sql = "SELECT 	activado 
        FROM usuarios 
        WHERE id = $id limit 1";
        $query = $this->db->fetchOne($sql);
        if ($query['activado'] == '0') {
            $sql2 = "UPDATE usuarios SET activado = 1 WHERE id = $id";
            $this->db->execute($sql2);
            return false;
        }
        return true;
    }

    public function getDesactivar($id){
        // Consulta SQL con valores incrustados

        $sql = "UPDATE usuarios SET activado = 0 WHERE id = $id"; 
        
        $this->db->execute($sql);
        
    }



    public function getAutores(){
        // Consulta SQL con valores incrustados
        $query = "SELECT * FROM autores";
        
        $query = $this->db->execute($query);
        if ($query) {
            $restl =$query->fetch_assoc();
            return $restl;
        }
        return $this->db->getError();;
    }

    public function getGeneros(){
        // Consulta SQL con valores incrustados
        $query = "SELECT * FROM generos";
        
        $query = $this->db->execute($query);
        if ($query) {
            return $query;
        }
        return $this->db->getError();;
    }

    // Otros métodos para gestionar Libros...

}