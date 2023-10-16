<?php

// Importar la conexión a la base de datos (db.php)

require_once 'config/db.php';

class UsuarioModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario en la base de datos

    public function registrarNuevoUsuario( $email, $name, $apellido, $dni, $password, $imagenBinaria)
    {
        //Traer id mas grande
        $sql = "SELECT MAX(id) AS id_mas_grande FROM usuarios;";
        $idDB = $this->db->fetchOneId($sql);



        $id = $idDB + 1;
        $activado = 0; $roles_id = 1; $token = '0';
        echo "</br>";
        echo $id;

        $fecha_registro = date("Y-m-d");

        $hashPass = password_hash($password, PASSWORD_DEFAULT);

        // Consulta SQL con valores incrustados
        $query = "INSERT INTO usuarios (id, nombre, apellido, email, contraseña, fecha_registro, fotocopia_dni, dni, activado, roles_id, token) 
        VALUES($id, '$name', '$apellido', '$email', '$hashPass', '$fecha_registro', '$imagenBinaria', $dni, $activado, $roles_id, '$token')";
        
        $insert = $this->db->execute($query);
        if (!$insert) {
            echo "Error en enviar Modelo";
        }

        return true;
    }

    //Token crear
    public function tokenCreate($id, $token){
        
        // Consulta SQL con valores incrustados
        $query = "UPDATE usuarios SET token='$token' WHERE id=$id;";

        if (!$this->db->execute($query)) {
            echo $this->db->getError();
            throw new Exception("Error al registrar el usuario: " . $this->db->getError());
        }

        return true;
    }


    //Token crear
    public function verificarToken($id, $token){
        
        // Consulta SQL con valores incrustados
        $query = "SELECT token FROM usuarios WHERE id=$id;";

        $tokenDB = $this->db->fetchOne($query);
        
        if ($tokenDB['token'] === $token){
            return false;
        }

        return true;
        
    }




    

    // comprobrar clave
    public function existsEmail($usuario){

        $query = "SELECT contraseña, id, roles_id FROM usuarios where email = '$usuario' AND activado = 1";
        $result = $this->db->fetchOne($query);
        if ($result) {
            return $result;    
        }
        return false; 
    }

 

    // Método para cambiar la contraseña de un usuario
    public function cambiarContrasenaUsuario($idUsuario, $nuevaContrasena)
    {
        $hashNuevaContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET contrasena = ? WHERE id = ?";


        return $this->db->execute($query);
    }
    // Otros métodos para gestionar usuarios, como actualizar información personal, etc.
}
