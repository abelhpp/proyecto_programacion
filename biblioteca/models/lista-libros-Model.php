<?php

// Importar la conexión a la base de datos (db.php)

// Conexión a la base de datos
$db = new mysqli("localhost", "root", "", "biblioteca");

if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

require_once ("./config/db.php");

class lista_libros{

    private $db;

    public function  __construct()
    {
        $this->db =new Database();
    }

    //metodo para consultar todos los libros en la BD.

    public function consultartabla(){

        $query = "SELECT libros.id, libros.nombre, libros.foto, libros.descripcion, autores.nombre AS autor, generos.nombre AS genero FROM libros JOIN autores ON libros.autores_id = autores.id JOIN generos ON libros.generos_id = generos.id";

        $consulta =$this->db->fetchAll($query);
        
        if(!$this->db->execute($query)){
            echo $this->db->getError();
            throw new Exception("Error al consultar la tabla libros : " . $this->db->getError());
        }

        return $consulta;
    }
}