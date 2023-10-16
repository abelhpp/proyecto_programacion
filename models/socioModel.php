<?php

// Importar la conexión a la base de datos (db.php)

require_once 'config/db.php';

class SocioModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario en la base de datos

    public function getLibros(){
        // Consulta SQL con valores incrustados
        $query = "SELECT libros.id, nombre, foto, fecha_registro, descripcion, autores_id, generos_id, stock_libros.cantidad 
        FROM libros 
        INNER JOIN stock_libros ON libros.id = stock_libros.libros_id";
        
        $query = $this->db->execute($query);
        if ($query) {
            return $query;
        }
    
        return false;
    }
    
    public function getAutores(){
        // Consulta SQL con valores incrustados
        $query = "SELECT * FROM autores";
        
        $query = $this->db->execute($query);
        if ($query) {
            return $query;
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